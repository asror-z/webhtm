
<?php

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
use zetsoft\system\helpers\ZUrl;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\former\ZFormWidget;
use zetsoft\widgets\market\ZFooterAllWidget;
use zetsoft\widgets\navigat\ZButtonWidget;


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
$items = Az::$app->market->cart->cartOrders(null, false );


if(!isset($item) && $items !== null){

    $item = new SingleProductItem();
    $item->id = 2;
    $item->name = 'Арахисовая паста с медом 200г';
    $item->company_name = 'CompanyName';
    $item->title = 'Test Desc';
    $item->new_price = 14825920;
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

}

$this->beginPage();
?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
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


    Az::$app->market->order->saveOrders($this->httpPost('ShopOrderForm'));
}


?>

<div class="market-container py-5">


    <div class="col-lg-12 col-md-12 col-sm-12 col-12">

        <div class="row">

            <div class="col-lg-8 col-md-8 col-sm-12 col-12">

                <h3 class="text-uppercase texts">Оформление заказа</h3>

                <div class="row">

                    <div class="col-lg-12 col-md-12 col-sm-12 col-12">

                        <h4 class="text-uppercase text-muted ml-2 mt-3 texts">Верификация телефона*</h4>

                        <?

                        $active = new Active();
                        $active->id = 'sendOrder';

                        $form = $this->activeBegin($active) ?>

                        <div class="col-lg-12 col-md-12 col-sm-12 col-12 shadow-lg h-75 pt-4">

                            <div class="d-flex flex-sm-wrap flex-wrap p-3">

                                <?

                                $userId = $this->userIdentity()->id;

                                ?>
                                <div  class="col-md-6 col-sm-12 mb-2">
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
                                <div  class="col-md-6 col-sm-12 mb-2">
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
                                <div  class="col-md-6 col-sm-12">
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
                                <div  class="col-md-6 col-sm-12">
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


                    <div class="col-lg-12 col-md-12 col-sm-12 col-12 mt-5">

                        <h4 class="text-uppercase text-muted ml-2 mt-5 pb-4 texts">Контактная информация</h4>

                        <div class="col-lg-12 col-md-12 col-sm-12 col-12 shadow-lg h-50">

                            <div class="d-flex flex-sm-wrap flex-wrap pt-3 pb-5">


                                <? $current_user = User::findOne(29); ?>

                                <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                    <?

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

                                    ?>
                                </div>


                                <div class="col-lg-6 col-md-6 col-sm-12 col-12">

                                    <?

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

                                    ?>

                                </div>


                            </div>

                        </div>

                    </div>

                </div>


                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-12 mt-5">
                        <h4 class="text-uppercase text-muted ml-2 pt-3 pb-3 texts">Мои Адреса</h4>
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
                            'location',
                        ];
                        $place->configs->readonly = [
                            'place',
                        ];
                        $place->columns();
                        echo ZDynaWidget::widget([
                            'model' => $place,
                            'config' => [
                                'hasToolbar' => false,
                                'search' => false,
                                'columnBefore' => [
                                    'radio'
                                ],
                                'isCard' => false,  
                                'columnAfter' => ['asd'],
                                'panelTemplate' => '{items}'
                            ]
                        ])

                        ?>

                        <div class="col-md-3 mt-3 ml-auto">
                            <div class="d-flex justify-content-end">

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
                                        'class' => 'btn-success',

                                    ],

                                ]);
                                ?>
                            </div>


                        </div>





                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-4 col-sm-12 col-12">

                <?
                echo $this->require( '/webhtm/shop/client/checkout/blocks/tableAbl+Shahzod2.php', ['items' => $items]);
                ?>

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

</style>


<script>

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
