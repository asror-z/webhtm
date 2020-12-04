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
use zetsoft\system\assets\ZColor;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\helpers\ZUrl;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\former\ZFormWidget;
use zetsoft\widgets\inputes\ZHCheckboxWidget;
use zetsoft\widgets\market\ZFooterAllWidget;
use zetsoft\widgets\market\ZInputSpinnerWidget;
use zetsoft\widgets\navigat\ZButtonWidget;
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
$items = Az::$app->market->cart->cartOrders();

//vdd($items);

if (empty($items)) {
    $items = [];
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
    $item2->images = [
        'https://images.pexels.com/photos/1095550/pexels-photo-1095550.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500',
        'https://images.pexels.com/photos/461198/pexels-photo-461198.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500',
        'https://previews.123rf.com/images/veneratio/veneratio1511/veneratio151100044/48203428-landscape-iamge-of-river-flowing-through-lush-green-forest-in-summer.jpg',
        'https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcRVDh2D2fzRSBYnwaA-70G74wjOeeZWbRnEVBMxfu1jVqcP9fMv&usqp=CAU',
    ];

    $items[] = $item;
    $items[] = $item2;
    $items[] = $item2;

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
require Root . '/webhtm/block/navbar/main.php';


if ($this->httpPost('ShopOrderForm')) {


    vdd(Az::$app->market->order->saveOrders($this->httpPost('ShopOrderForm')));
}


?>

<div class="market-container py-5">


    <div class="col-lg-12 col-md-12 col-sm-12 col-12">
        <h4 class="ml-3 text-uppercase texts" align="center">Оформление заказа</h4>
        <div class="row">


            <div class="col-lg-8 col-md-8 col-sm-12 col-12">


                <div class="row">

                    <div class="col-lg-12 col-md-12 col-sm-12 col-12">

                        <h5 class="text-uppercase text-muted ml-2 mt-3 texts">Контактная информация</h5>

                        <?

                        $active = new Active();
                        $active->id = 'sendOrder';

                        $form = $this->activeBegin($active) ?>

                        <div class="col-lg-12 col-md-12 col-sm-12 col-12 shadow-sm h-75 pt-4">

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


                                    ?>
                                </div>

                            </div>
                            <!--<div class="col-lg-4 col-md-4 col-sm-7 col-7 ml-auto">

                                <a href="#" class="btn btn-success btn-block">Send form</a>

                            </div>
-->
                        </div>

                        <? $this->activeEnd(); ?>

                    </div>


                    <!--<div class="col-lg-12 col-md-12 col-sm-12 col-12 mt-5">

                        <h4 class="text-uppercase text-muted ml-2 mt-5 pb-4 texts">Контактная информация</h4>

                        <div class="col-lg-12 col-md-12 col-sm-12 col-12 shadow-sm h-50">

                            <div class="d-flex flex-sm-wrap flex-wrap pt-3 pb-5">


                                <? /*

                                $current_user = User::findOne(29);


                                */ ?>
                                <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                    <? /*
                                    
                                    $user_info = new User();

                                    $user_info->configs->nameOn = [
                                        'name',
                                    ];
                                    
                                    $user_info->setAttributes($current_user->attributes);
                                    $user_info->columns();
                                    echo ZFormWidget::widget([
                                        'model' => $user_info,
                                        'form' => $form,
                                        'config' => [
                                            'topBtn' => false,
                                            'botBtn' => false,
                                        ]
                                    ]);
                                    
                                    */ ?>
                                </div>


                                <div class="col-lg-6 col-md-6 col-sm-12 col-12">

                                    <? /*
                                    $user_info = new User();


                                    $user_info->configs->nameOn = [
                                        'email',
                                    ];
                                    $user_info->setAttributes($current_user->attributes);
                                    $user_info->columns();
                                    echo ZFormWidget::widget([
                                        'model' => $user_info,
                                        'form' => $form,
                                        'config' => [
                                            'topBtn' => false,
                                            'botBtn' => false,
                                        ]
                                    ]);
                                    */ ?>

                                </div>


                            </div>

                        </div>

                    </div>-->

                </div>


                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-12 mt-5">
                        <div class="d-flex  justify-content-between">
                            <h5 class="text-uppercase text-muted ml-2 pt-3 pb-3 texts">Адрес доставки</h5>
                            <?

                            echo ZButtonWidget::widget([
                                'config' => [
                                    'url' => ZUrl::to(['create']),
                                    'btnType' => ZButtonWidget::btnType['link'],
                                    'btnSize' => ZColor::btnSize['default'],
                                    'btnRounded' => false,
                                    'btnFloating' => false,
                                    'text' => 'Добавить Адресс',
                                    'toggle' => ZButtonWidget::toggle['tooltip'],

                                    'hasIcon' => false,
                                    'icon' => 'fas fa-plus',
                                    'class' => 'btn-success pb-0 mb-3',

                                ],

                            ]);
                            ?>
                        </div>

                        <?

                        //  $userId = $this->httpGet('userId');
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
                            //'location',
                        ];
                        $place->configs->readonly = [
                            'place',
                            //'location',
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

                        <div class="col-md-3 mt-3 ml-auto">
                            <div class="d-flex justify-content-end">

                                <? /*

                                echo ZButtonWidget::widget([
                                    'config' => [
                                        'url' => ZUrl::to(['create']),
                                        'btnType' => ZButtonWidget::btnType['link'],
                                        'btnSize' => ZColor::btnSize['default'],
                                        'btnRounded' => false,
                                        'btnFloating' => false,
                                        'text' => 'Добавить Адресс',
                                        'toggle' => ZButtonWidget::toggle['tooltip'],

                                        'hasIcon' => false,
                                        'icon' => 'fas fa-plus',
                                        'class' => 'btn-success',

                                    ],

                                ]);
                                */ ?>
                            </div>


                        </div>


                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-4 col-sm-12 col-12" id="getCartOrders">
                <?
                $this->pjaxBegin();
                echo ZButtonWidget::widget([
                    'config' => [
                        'url' => '',
                        'hasIcon' => true,
                        'btnType' => ZButtonWidget::btnType['link'],
                        'btnStyle' => ZButtonWidget::btnStyle['none'],
                        'btnRounded' => false,
                        'text' => 'hiddne',
                        'pjax' => true,
                        'hidden' => true,
                        'title' => 'Обновление',
                        'ttSize' => ZButtonWidget::ttSize['small'],
                        'ttSide' => ZButtonWidget::ttSide['bottom'],
                        'btn' => false,
                        'class' => 'h-100 p-0 noHover',
                        'iconColor' => 'white',
                        'icon' => 'fp-13 fa fa-' . FA::_SYNC,
                    ],
                    'id' => 'refreshCompany',
                ]);

                echo $this->require( '/webhtm/shop/client/checkout/blocks/Shahzod.php', ['items' => $items, 'model' => $model]);
                $this->pjaxBegin();
                ?>
            </div>

        </div>

    </div>

</div>
</div>


<style>

    @media screen and (max-width: 580px) {
        .texts {
            text-align: center;
        }
    }

    .grid-view .card[class*=border] {

        background-color: #ffffff;
        /* -webkit-box-shadow: 0 0 30px rgba(0,0,0,.08); */
        -moz-box-shadow: 0 0 30px rgba(0, 0, 0, .08);
        box-shadow: 0 0 30px rgba(0, 0, 0, .08);
    }

</style>


<script>


    let radio = $('.radio-PlaceAdress')
    let radioValue = radio.val()
    $(radio).click(function () {
        $.ajax({
            url: '/core/product/getCartOrders.aspx',
            method: 'GET',
            data: {
                id: $(this).val()
            },
            beforeSend: function (jqXHR) {
                console.log('beforeSend')
            },
            success: function (data) {
                //$('#refreshCompany').click()
                $('#getCartOrders').html(data)
            },
            error: function () {
                console.warn("не удалось добавить адресс")
            }

        })
    })

    $('.checkBox-dynawidget').on('change', function (event) {
        if (this.checked) {
            $('#shoporderform-place_adress_id').val($(this).val())
        }
    })


    $('#zakazsend').on('click', function () {
        $('#sendOrder').submit();
    })

</script>


<?php
echo ZFooterAllWidget::widget([

]);
?>
<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>
