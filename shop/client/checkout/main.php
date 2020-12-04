<?php
/**
 * @license : AzimjonToirov
 * @license : ShahzodG'ulomqodirov
 *
 */

use rmrevin\yii\fontawesome\FA;
use zetsoft\dbitem\core\WebItem;
use zetsoft\dbitem\shop\ProductItem;
use zetsoft\dbitem\shop\SingleProductItem;
use zetsoft\former\shop\ShopOrderForm;
use zetsoft\models\place\PlaceAdress;
use zetsoft\models\shop\ShopOrder;
use zetsoft\models\user\User;
use zetsoft\service\forms\Active;
use zetsoft\service\forms\Ajaxer;
use zetsoft\system\assets\ZColor;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\helpers\ZHTML;
use zetsoft\system\helpers\ZUrl;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\former\ZFormBuildWidget;
use zetsoft\widgets\former\ZFormWidget;
use zetsoft\widgets\incores\ZMCheckboxWidget;
use zetsoft\widgets\inputes\ZHCheckboxWidget;
use zetsoft\widgets\inputes\ZHHiddenInputWidget;
use zetsoft\widgets\market\ZFooterAllWidgetOrg;
use zetsoft\widgets\market\ZInputSpinnerWidget;
use zetsoft\widgets\navigat\ZButtonWidget;
use zetsoft\widgets\notifier\ZSweetAlertWidget;
use zetsoft\widgets\themes\ZCardWidget;


/** @var ZView $this */

$action = new WebItem();

$action->title = Azl . 'Проверка покупки';
$action->icon = 'fa fa-area-chart';
$action->type = WebItem::type['html'];
$action->csrf = true;
$action->debug = true;


$action->cache = false;

$action->call = [
//    TagDependency::invalidate()
];
$action->cacheHttp = false;

$this->paramSet(paramAction, $action);

$this->title();
$this->toolbar();

/** @var ZView $this */

$items = Az::$app->market->cart->cartOrders(null, true);

if (empty($items)) {
    echo ZHTML::tag('div', Az::l('Показаны тестовые данные'), [
        'class' => 'alert alert-warning',
        'role' => 'alert'
    ]);
}

?>

<div class="container-fluid py-1 m-0">
  <div class="col-lg-12 col-md-12 col-sm-12">

    <h5 class="ml-3 mt-3 text-uppercase texts" align="center">
        <?= Az::l('Оформление заказа') ?>
    </h5>

    <div class="row">
      <div class="col-lg-8 col-md-6 col-sm-12 pr-4 pl-4">

        <div class="row">

          <div class="col-lg-12 col-md-12 col-sm-12">
            <h5 class="text-uppercase text-muted ml-2 mt-3 texts">
                <?= Az::l('Контактная информация') ?>
            </h5>

            <div class="col-lg-12 col-md-12 col-sm-12 boxShadow h-75 pt-4">

                <?

                $active = new Ajaxer();
                $active->id = 'sendOrder';
                $active->type = Active::type['vertical'];
                $active->childClass = 'my-5';
                $active->enableLabel = false;

                $form = $this->activeBegin($active);

                $user = $this->userIdentity();

                $model = new ShopOrder();

                $model->configs->nameOn = [
                    'contact_name',
                    'place_adress_id',
                    'contact_phone',
                    'comment_user',
                    'payment_type',
                    'date_deliver'
                ];

                if ($this->modelSave($model)) {

                    $save = Az::$app->market->order->saveOrders($model);

                    /**
                     *
                     * Post save Actions
                     */
                    $this->paramSet(paramIframe, true);
                    $this->urlRedirect([
                        '/shop/client/checkout/success'
                    ]);
                }


                $model->user_id = $user->id;
                $model->contact_name = $user->name;
                $model->contact_phone = $user->phone;

                $model->cards = [
                    [
                        'title' => Az::l('Первый этап'),
                        'items' => [
                            [
                                'title' => Az::l('Форма'),
                                'items' => [
                                    [
                                        'contact_name',
                                        'contact_phone',
                                    ],
                                    [
                                        'date_deliver',
                                        'comment_user',
                                    ],
                                    [
                                        'user_id',
                                        'place_adress_id',
                                        'payment_type',
                                    ]
                                ],
                            ],
                        ],
                    ],
                ];

                $model->configs->widget = [
                    'user_id' => ZHHiddenInputWidget::class,
                    'place_adress_id' => ZHHiddenInputWidget::class,
                    'payment_type' => ZHHiddenInputWidget::class,
                ];

                $model->configs->rules = [
                    'contact_name' => [['zetsoft\\system\\validate\\ZRequiredValidator']],
                    'contact_phone' => [['zetsoft\\system\\validate\\ZRequiredValidator']],
                    'date_deliver' => [['zetsoft\\system\\validate\\ZRequiredValidator']],
                    'place_adress_id' => [[validatorSafe]]
                ];

                $model->configs->hasPlaceholder = true;
                $model->configs->hasLabel = false;
                $model->columns();

                echo ZFormBuildWidget::widget([
                    'model' => $model,
                    'form' => $form,
                    'config' => [
                        'topBtn' => false,
                        'botBtn' => false,
                        'stepType' => ZFormBuildWidget::stepType['none'],
                        'blockType' => ZFormBuildWidget::blockType['naked']
                    ]
                ]);


                $this->activeEnd(); ?>

            </div>


          </div>
        </div>
        <div class="row">
          <div class="col-lg-12 col-md-12 col-sm-12 mt-5">

            <div class="d-flex  justify-content-between">

              <h5 class="text-uppercase text-muted ml-2 pt-3 pb-3 texts">Адрес доставки</h5>

            </div>

              <?

              $user = $this->userIdentity();

              $place = new PlaceAdress();

              if ($user->place_adress_ids == null) {
                  $place->query =
                      PlaceAdress::find()
                          ->where([
                              'id' => 65
                          ]);
              } else {
                  $place->query =
                      PlaceAdress::find()
                          ->where([
                              'id' => $user->place_adress_ids
                          ]);
              }

              $place->configs->filter = false;
              $place->configs->nameOn = [
                  'name',
                  'place',
              ];

              $place->configs->readonly = [
                  'place',
                  'adress',
                  'name',
              ];

              $place->configs->dynaButtons = [
                  'add-clone-delete' => [
                      'content' => '{add}',
                      'options' => ['class' => 'btn-group p-1 mr-0 {btnSize} {iconSize}']
                  ],
              ];

              $place->columns();

              echo ZDynaWidget::widget([
                  'model' => $place,
                  'rightNameEx' => [
                      'system'
                  ],
                  'config' => [
                      'hasToolbar' => true,
                      'editableLink' => true,
                      'search' => false,
                      'copy' => false,
                      'columnBefore' => [
                          'radio'
                      ],
                      'isCard' => false,
                      'columnAfter' => false,
                      'theme' => 'success',
                      'bordered' => false,
                      'striped' => true,
                      'heighbody' => '50vh'
                  ],
              ])
              ?>
          </div>
        </div>

      </div>

      <div class="col-lg-4 col-md-6 col-sm-12 mb-3 ">
        <div class="row ">
          <h5 class="text-uppercase text-muted ml-2 mt-3 texts" align="center">Состав заказа</h5>
          <div class="boxShadow loadblok">
            <div class="pl-3 pt-1" id="getCartOrders">
                <?php
                echo $this->require( '/webhtm/shop/client/checkout/blocks/companies.php', [
                    'items' => $items,
                    'model' => $model,
                ], 'checkout');
                ?>

            </div>
            <div class="pr-5 pl-5 pt-2 pb-2">
              <div class="col-lg-12 col-md-12 col-sm-12 d-flex p-1 justify-content-lg-between checkbox-main">

                  <?
                  echo ZMCheckboxWidget::widget([
                      'config' => [
                          'class' => 'checkCheckboxx',
                          'placeholder' => ''
                      ]
                  ])
                  ?>
                <p class="ml-3">
                  Нажимая "Заказать", я соглашаюсь с
                  <a href="#" role="button" class="link" id="oferta">
                    публичным договором оферты
                  </a>
                </p>

              </div>
              <input disabled id="buttononclickdisable" type="submit" value="Заказать"
                     class="btn btn-block btn-success rounded checking-btn" />
            </div>
          </div>

        </div>

      </div>

    </div>

  </div>
</div>


<style>

  @media screen and (max-width: 768px) {
    .texts {
      text-align: center;
    }

    .boxShadowInto {
      margin-top: 2rem;
    }
  }

  .grid-view .card[class*=border], .boxShadow {
    background-color: #ffffff;
    -moz-box-shadow: 0 0 30px rgba(0, 0, 0, .08);
    box-shadow: 0 0 30px rgba(0, 0, 0, .08);
  }

  .boxShadowInto {
    -webkit-box-shadow: inset 0 0 5px 2px rgba(102, 95, 102, 1);
    -moz-box-shadow: inset 0 0 5px 2px rgba(102, 95, 102, 1);
    box-shadow: inset 0px 0px 5px 2px rgba(227, 220, 227, 1);
  }

</style>


<script>
let radio = $('.radio-PlaceAdress')
$(radio).on('change', function () {
  if (this.checked) {
    $.ajax({
      url: '/core/product/getCartOrders.aspx',
      method: 'GET',
      data: {
        id: $(this).val()
      },
      beforeSend: function (jqXHR) {
        $('.loadblok').loader('show');
      },
      success: function (data) {
        $('#getCartOrders').html(data)
        $('.loadblok').loader('hide');
      },
      error: function () {
        console.warn("не удалось добавить адресс")
      }
    });

    $('#shoporder-place_adress_id').val($(this).val())
  }
})

$('#buttononclickdisable').on('click', function () {
  $('#sendOrder').submit();
})


$('input:checkbox').change(function () {
  if (this.checked) {
    $('#buttononclickdisable').removeAttr('disabled')
  } else {
    $('#buttononclickdisable').attr('disabled', 'disabled')
    console.log('not checked')
  }
});

$('#oferta').click(() => {
  Swal.fire({
    title: '',
    html: '<iframe src="/shop/cores/info/ofertaAjax.aspx" width="100%" height="600" scrolling="no"></iframe>',
    width: 1000,
    showClass: {
      popup: 'animate__animated animate__fadeInDown'
    },
    hideClass: {
      popup: 'animate__animated animate__fadeOutUp'
    },
    padding: 0,
    showConfirmButton: false,
    footer: null
  })
})

</script>
