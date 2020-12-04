<?php

use kartik\grid\DataColumn;use zetsoft\dbitem\core\WebItem;
use zetsoft\former\courier\CourierForm;
use zetsoft\models\place\PlaceAdress;
use zetsoft\models\shop\ShopCourier;
use zetsoft\models\shop\ShopOrder;
use zetsoft\models\shop\ShopShipment;
use zetsoft\service\market\Shipment;
use zetsoft\system\assets\ZColor;use zetsoft\system\Az;
use zetsoft\system\column\ZKDataColumn;
use zetsoft\system\helpers\ZUrl;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZDynaCheckWidget;
use zetsoft\widgets\former\ZCheckSelectWidget;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\inputes\ZDropDownListWidget;
use zetsoft\widgets\inputes\ZSelect2Widget;
use zetsoft\widgets\menus\ZMmenuWidget;
use zetsoft\widgets\menus\ZMmenuWidgetSh;
use zetsoft\widgets\navigat\ZButtonWidget;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;
use zetsoft\models\shop\ShopBrand;use zetsoft\widgets\notifier\ZSweetAlert2Widget;


/** @var ZView $this */


/**
 *
 * Action Params
 */

$action = new WebItem();

$action->title = Azl . 'Курьер';
$action->icon = 'fa fa-globe';
$action->type = WebItem::type['html'];
$action->csrf = true;
$action->debug = true;



$this->paramSet(paramAction, $action);

$this->title();
$this->toolbar();


/**
 *
 * Start Page
 */

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

echo ZNProgressWidget::widget([]);
echo ZMmenuWidget::widget([
    //'data' => $this->cores->menus->create('mmenu'),
    'config' => [
        'theme' => 'white',
        'content.img.width' => 230,
        'iconbar.top' => [
            "<a href='#/'><i class='fa fa-home'></i>cc</a>",
            "<a href='#/'><i class='fa fa-home'></i>cc</a>",
        ],
        'iconbar.bottom' => [
            "<a href='#/'><i class='fa fa-home'></i>aa</a>",
            "<a href='#/'><i class='fa fa-home'></i>cc</a>",
        ],
        'all.border' => ZMMenuWidget::border['border-full'],
        'menu-effect-slide' => true,
    ],
]);
?>


<div id="page">
    <?

    require Root . '/webhtm/block/navbar/admin.php';

    echo ZSessionGrowlWidget::widget();?>
    <nav id="menu"></nav>

    <div id="content" class="content-footer p-3">


        <div class="row">
            <div class="col-md-12 col-12">

                <?
                $model = new ShopShipment;
                $model->configs->spa = false;
                $model->configs->query = ShopShipment::find()->where(['shop_courier_id'=>2]);
                $model->configs->after = [
                    'date_deliver' => [
                        [
                            'class' => ZKDataColumn::class,
                            'label' => Az::l('Место доставки'),
                            'width' => '50px',
                            'value' => function ($model, $key, $index, DataColumn $dataColumn) {
                                 $order = ShopOrder::find()->where(['shop_shipment_id'=>$model->id])->one();
                                 if ($order)
                                     $addressName = PlaceAdress::find()->where(['id' => $order->place_adress_id])->one()->name;
                                 else
                                     $addressName = Azl.('Адрес не задано');

                                return $addressName;
                            }
                        ]
                    ]
                ];
                $model->configs->nameOn = [
                    'id',
                    'status',
                    'date_deliver',
                    'shipment_type',
                    'responsible',
                    'price',
                    'prepayment',
                    'currency_type',
                    'comment',
                    'created_at'
                ];
                //bitta kuryerga tegishli dastavkalani spiskasi
                //$data = Az::$app->market->shipment->getShipmentByCourier(2);
                $model->configs->readonly = true;
                /** @var ZView $this */
                $model->columns();
                $check = ZDynaCheckWidget::widget([

                    'config' => [
                        'inputAttr' => 'status',

                        //'class' => 'simple-Report',
                        'url' => ZUrl::to([
                            '/api/core/app/check-new',
                            'modelClassName' => $model->className,
                        ]),
                        'widgetClass' => ZSelect2Widget::class,
                        'widgetOptions' => [
                            'data' => $model->_status,
                            'id' => 'operator-dropdown',
                            'config' => [
                                'class' => 'form-control w-50'
                            ],
                        ],

                        'modelClassName' => $model->className,
                        'btnOptions' => [
                            'config' => [
                                'text' =>  Az::l('Изменить'),
                                'btnStyle' => ZButtonWidget::btnStyle['btn-outline-success'],
                                'btnType' => ZButtonWidget::btnType['submit'],
                                'btnRounded' => false,
                                'btnSize' => 'btn-ml',
                                'class' => 'p-1 m-1'
                            ]
                        ]
                    ]
                ]);


                echo ZDynaWidget::widget([
                    //'data'=>$data,
                    'model' => $model,
                    'rightNameEx' => [
                        'system'
                    ],
                    'config' => [
                        'columnBefore'=>['false'],
                        //'hasToolbar'=>false,
                        'isCard'=>false
                    ],
                    'leftBtn' => [
                        'check' => [
                            'content' => $check,
                            'options' => [
                                'class' => ' '
                            ]
                        ]
                    ],
                    'rightBtn' => [
                        'update' => [
                            'content' => '{update}',
                            'options' => ['class' => 'btn-group p-1 mr-0 {btnSize} {iconSize} d-none']
                        ],

                        'add-tabular-clone-delete' => [
                            'content' => '',
                            'options' => ['class' => 'btn-group p-1 mr-0 {btnSize} {iconSize}']
                        ],

                        'filter-sort-id' => [
                            'content' => '',
                            'options' => ['class' => 'btn-group p-1 mr-0 {btnSize} {iconSize}']
                        ],

                        'export' => [
                            'content' => '',
                            'options' => ['class' => 'btn-group p-1 {btnSize} {iconSize}']
                        ],


                        'toggleData' => [
                            'content' => '',
                            'options' => ['class' => 'btn-group p-1 {btnSize} {iconSize}']
                        ],

                    ]
                ]);
                ?>

            </div>
        </div>


    </div>
    <?
    echo $this->require( '/webhtm\block\footer\mplace\footerAll.php');
    ?>
</div>


<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>
