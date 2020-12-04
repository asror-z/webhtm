<?php

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
use zetsoft\widgets\former\ZFormWidget;
use zetsoft\widgets\incores\ZMCheckboxWidget;
use zetsoft\widgets\inputes\ZHCheckboxWidget;
use zetsoft\widgets\market\ZFooterAllWidget;
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
//vdd($items);
if (empty($items)) {
    echo ZHTML::tag('div', Az::l('Показаны тестовые данные'), [
        'class' => 'alert alert-warning',
        'role' => 'alert'
    ]);

    /*   $items = [];
       $item = new SingleProductItem();
       $item->id = 2;
       $item->name = 'Арахисовая паста с медом 200г';
       $item->company_name = 'CompanyName';
       $item->title = 'Test Desc';
       $item->new_price = 20;
       $item->total_price = 20;
       $item->price_old = 188920;
       $item->barcode = 34234234;
       $item->exist = ProductItem::exists['not'];
       $item->images = [
           'https://images.pexels.com/photos/1095550/pexels-photo-1095550.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500',
           'https://images.pexels.com/photos/461198/pexels-photo-461198.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500',
           'https://previews.123rf.com/images/veneratio/veneratio1511/veneratio151100044/48203428-landscape-iamge-of-river-flowing-through-lush-green-forest-in-summer.jpg',
           'https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcRVDh2D2fzRSBYnwaA-70G74wjOeeZWbRnEVBMxfu1jVqcP9fMv&usqp=CAU',
       ];
       $item->currency = 'сум';
       $item->currencyType = 'after';
       $item->measure = 'шт';
       $item->rating = 3.5;
       $item->discount = -10;
       $item->catalogId = 19;
       $item->delivery_price = 1200;
       $item->sale = 'sdadsa';
       $item->is_multi = false;
       $item->in_wish = true;
       $item->in_compare = false;
       $item->amount = 1;

       $item2 = new SingleProductItem();
       $item2->id = 3;
       $item2->name = 'Арахиihhuihuiuhiом 200г';
       $item2->company_name = 'NikeName';
       $item2->title = 'Test Desc';
       $item2->new_price = 10;
       $item2->price_old = 188920;
       $item2->currency = 'сум';
       $item2->currencyType = 'after';
       $item2->measure = 'шт';
       $item2->amount = 1;
       $item2->company_image = 's';
       $item2->images = [
           'https://images.pexels.com/photos/1095550/pexels-photo-1095550.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500',
           'https://images.pexels.com/photos/461198/pexels-photo-461198.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500',
           'https://previews.123rf.com/images/veneratio/veneratio1511/veneratio151100044/48203428-landscape-iamge-of-river-flowing-through-lush-green-forest-in-summer.jpg',
           'https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcRVDh2D2fzRSBYnwaA-70G74wjOeeZWbRnEVBMxfu1jVqcP9fMv&usqp=CAU',
       ];

       $items[] = $item;
       $items[] = $item2;
       $items[] = $item2;*/

    //vdd($items);
}


$this->beginPage();
?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" xmlns="http://www.w3.org/1999/html">
<head>
    <?php

    require Root . '/webhtm/block/metas/main.php';
    require Root . '/webhtm/block/assets/main.php';

    $this->head();

    ?>


</head>
<body class="<?= ZWidget::skin['white-skin'] ?>">

<?php

$this->beginBody();
require Root . '/webhtm/block/header/main.php';
require Root . '/webhtm/block/navbar/main.php';
require Root . '/render/menus/ZSidebarWidget/ready/main.php';

$form = $this->httpPost('ShopOrderForm');
//vdd($form);

if (!empty($form)) {

    $save = Az::$app->market->order->saveOrders($form);

    if ($save === true)
        $this->urlRedirect('/client/checkout/success.php');
}

echo ZSweetAlertWidget::widget([
    'config' => [
        'functionName' => 'iframe',
        'type' => ZSweetAlertWidget::type['iframe'],
        'url' => '/webhtm/shop/cores/info/block/ofertaContent.php',
        'iframeWidth' => '100%',
        'iframeHeight' => '500',
        'width' => '800'
    ]
]);
?>

<div class="container-fluid py-1 m-0">
    <div class="col-lg-12 col-md-12 col-sm-12 col-12">

        <h5 class="ml-3 mt-3 text-uppercase texts" align="center">Оформление заказа</h5>
        <div class="row">
            <div class="col-lg-8 col-md-6 col-sm-12 col-12 pr-4 pl-4">

                <div class="row">

                    <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                        <h5 class="text-uppercase text-muted ml-2 mt-3 texts">Контактная информация</h5>
                        <?

                        $active = new Ajaxer();
                        $active->id = 'sendOrder';

                        $form = $this->ajaxBegin($active) ?>

                        <div class="col-lg-12 col-md-12 col-sm-12 col-12 boxShadow h-75 pt-4">

                            <div class="d-flex flex-sm-wrap flex-wrap p-3">

                                <?

                                $userId = $this->userIdentity()->id;

                                ?>
                                <div class="col-6 mb-2">
                                    <?

                                    $model = new ShopOrderForm();
                                    $model->configs->nameOn = [
                                        'contact_name'
                                    ];
                                    $model->columns();
                                    echo ZFormWidget::widget([
                                        'model' => $model,
                                        'form' => $form,
                                        'config' => [
                                            'topBtn' => false,
                                            'botBtn' => false,
                                        ]
                                    ]);

                                    ?>
                                </div>
                                <div class="col-6 mb-2">
                                    <?

                                    $model = new ShopOrderForm();
                                    $model->configs->nameOn = [
                                        'contact_phone'
                                    ];
                                    $model->columns();
                                    echo ZFormWidget::widget([
                                        'model' => $model,
                                        'form' => $form,
                                        'config' => [
                                            'topBtn' => false,
                                            'botBtn' => false,
                                        ]
                                    ]);


                                    ?>
                                </div>
                                <div class="col-6">
                                    <?

                                    $model = new ShopOrderForm();
                                    $model->configs->nameOn = [
                                        'date_deliver'
                                    ];
                                    $model->columns();
                                    echo ZFormWidget::widget([
                                        'model' => $model,
                                        'form' => $form,
                                        'config' => [
                                            'topBtn' => false,
                                            'botBtn' => false,
                                        ]
                                    ]);

                                    ?>

                                </div>
                                <div class="col-6">
                                    <?
                                    $model = new ShopOrderForm();
                                    $model->configs->nameOn = [
                                        'comment_user'
                                    ];
                                    $model->columns();
                                    echo ZFormWidget::widget([
                                        'model' => $model,
                                        'form' => $form,
                                        'config' => [
                                            'topBtn' => false,
                                            'botBtn' => false,
                                        ]
                                    ]);


                                    $model = new ShopOrderForm();
                                    $model->configs->nameOn = [
                                        'place_adress_id'
                                    ];
                                    $model->columns();
                                    echo ZFormWidget::widget([
                                        'model' => $model,
                                        'form' => $form,
                                        'config' => [
                                            'topBtn' => false,
                                            'botBtn' => false,
                                        ]
                                    ]);

                                    $model = new ShopOrderForm();
                                    $model->configs->nameOn = [
                                        'user_id'
                                    ];
                                    $model->configs->value = [
                                        'user_id' => $userId
                                    ];
                                    $model->columns();
                                    echo ZFormWidget::widget([
                                        'model' => $model,
                                        'form' => $form,
                                        'config' => [
                                            'topBtn' => false,
                                            'botBtn' => false,
                                        ]
                                    ]);

                                    $model = new ShopOrderForm();
                                    $model->configs->nameOn = [
                                        'payment_type'
                                    ];

                                    $model->columns();
                                    echo ZFormWidget::widget([
                                        'model' => $model,
                                        'form' => $form,
                                        'config' => [
                                            'topBtn' => false,
                                            'botBtn' => false,
                                            ''
                                        ]
                                    ]);


                                    ?>
                                </div>

                            </div>
                        </div>

                        <? $this->ajaxEnd(); ?>

                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-12 mt-5">
                        <div class="d-flex  justify-content-between">
                            <h5 class="text-uppercase text-muted ml-2 pt-3 pb-3 texts">Адрес доставки</h5>
                            <a href="<? echo ZUrl::to(['create']) ?>" class="text-success ml-1 mt-4 mr-2"><i
                                        class="fas fa-map-marker-alt mr-2"></i>Добавить новый адрес</a>

                        </div>

                        <?

                        $user = User::findOne(29);

                        $place = new PlaceAdress();

                        $place->query =
                            PlaceAdress::find()
                                ->where([
                                    'id' => $user->place_adress_ids
                                ]);

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
                        $place->columns();
                        echo ZDynaWidget::widget([
                            'model' => $place,
                            'config' => [
                                'hasToolbar' => false,
                                'editableLink' => true,
                                'search' => false,
                                'copy' => false,
                                'columnBefore' => [
                                    'radio'
                                ],
                                'isCard' => false,
                                'columnAfter' => ['asd'],
                                'panelTemplate' => '{items}',
                                'theme' => 'success',
                                'bordered' => false,
                                'striped' => false,
                            ]
                        ])
                        ?>
                    </div>
                </div>

            </div>

            <div class="col-lg-4 col-md-6 col-sm-12 col-12 mb-3 ">
                <div class="row ">
                    <h5 class="text-uppercase text-muted ml-2 mt-3 texts" align="center">Состав заказа</h5>
                    <div class="boxShadow loadblok">
                        <div class="pl-3 pt-1" id="getCartOrders">
                            <?php
                            echo $this->require( '/webhtm/shop/client/checkout/blocks/Shahzod.php', [
                                'items' => $items,
                                'model' => $model,
                                /*'form' => $form*/
                            ]);
                            ?>

                        </div>
                        <div class="pr-5 pl-5 pt-2 pb-2">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-12 d-flex p-1 justify-content-lg-between checkbox-main">

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

                                    <?php
                                    echo ZSweetAlertWidget::widget([
                                        'config' => [
                                            'functionName' => 'iframe',
                                            'type' => ZSweetAlertWidget::type['iframe'],
                                            'url' => '/webhtm/shop/cores/info/block/ofertaContent.php',
                                            'iframeWidth' => '100%',
                                            'iframeHeight' => '500',
                                            'width' => '800'
                                        ]
                                    ]);
                                    ?>
                                    <a href="#" role="button" class="link" onclick="iframe()">
                                        публичным договором оферты
                                    </a>
                                </p>

                            </div>
                            <input disabled id="buttononclickdisable" type="submit" value="Заказать"
                            class="btn btn-block btn-success rounded checking-btn">
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
        /* -webkit-box-shadow: 0 0 30px rgba(0,0,0,.08); */
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
            })
        }
    })


    $(radio).on('change', function (event) {
        if (this.checked) {
            console.log($(this).val())
            $('#shoporderform-place_adress_id').val($(this).val())
        }
    })

    let radiogroup = $('.paymentRadioGroup');
    $(radiogroup).on('change', function (event) {
        if (this.checked) {
            console.log($(this).val())
            $('#shoporderform-payment_type').val($(this).val())
        }
    })


    $('#buttononclickdisable').on('click', function () {
        console.log('sadasd')
        $('#sendOrder').submit();
        location.reload()
    })


    $('input:checkbox').change(function () {
        if (this.checked) {
            console.log('checked');
            $('#buttononclickdisable').removeAttr('disabled')
        } else {
            $('#buttononclickdisable').attr('disabled', 'disabled')
            //$('#sendOrder').submit();
            console.log('not checked')
        }
    });

</script>


<?php



echo ZFooterAllWidget::widget([

]);
?>
<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>
