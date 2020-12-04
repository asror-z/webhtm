<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\models\place\PlaceAdress;
use zetsoft\models\shop\ShopShipment;
use zetsoft\models\ware\Ware;
use zetsoft\models\ware\WareExit;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\helpers\ZUrl;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZCheckButtonWidget;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\inputes\ZBootstrapBorderRadioGroupWidget;
use zetsoft\widgets\menus\ZMmenuWidget;
use zetsoft\widgets\navigat\ZButtonWidget;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;

/** @var ZView $this */


/**
 *
 * Action Params
 */

$action = new WebItem();

$action->title = Azl . 'Передача заказов в подотчёт курьеру';
$action->icon = 'fal fa-cube';
$action->type = WebItem::type['html'];
$action->csrf = true;
if ($this->httpGet('spa'))
    $action->debug = false;



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

    require Root . '/webhtm/block/header/main.php';
    require Root . '/webhtm/block/navbar/admin.php';

    echo ZSessionGrowlWidget::widget();?>

    <div id="content" class="content-footer p-3">


        <div class="row">
            <div class="col-md-12">

                <?
                $shop_shipment_id = $this->httpGet('shop_shipment_id');
                $model = new ShopShipment();

               /* $place_region_id = $this->userIdentity()->place_region_id;

                $place_adress_id = PlaceAdress::find()
                    ->where([
                        'place_region_id' => $place_region_id
                    ])
                    ->all();

                $place_adress_ids = ZArrayHelper::getColumn($place_adress_id, 'id');

                $ware = Ware::find()
                    ->where([
                        'place_adress_id' => $place_adress_ids
                    ])
                    ->all();

                $ware_ids = ZArrayHelper::getColumn($ware, 'id');
                $model->configs->query = WareExit::find()
                    ->where([
                        'ware_id' => $ware_ids,
                    ]);
                    */
                $model->configs->nameOn = [
                    'created_at',
                    'id',
                    'code',
                    'shop_courier_id',
                    'responsible',
                    'date_deliver',
                ];

                $model->configs->spa = false;
                $model->configs->readonly = true;
                echo '<br>';
                $model->columns();
                /** @var ZView $this */

                $url = ZUrl::to([
                    '/api/core/app/word',
                    'namespace' => 'office',
                    'service' => 'word2',
                    'method' => 'cashTemplate',
                ]);
                $button = ZCheckButtonWidget::widget([
                    'model' => $model,
                    'config' => [
                        'btn' => false,
                        'text' => 'Акт передачи',

                        'btnStyle' => 'btn btn-micro text-nowrap fp-14 text-muted pt-2',

                        'attribute' => 'status',
                        'btnRounded' => false,
                        'btnType' => ZButtonWidget::btnType['link'],
                        'class' => 'simple-' . $model->className,
                        'url' => ZUrl::to([
                            '/core/word/actOb',
                            'type'=>'multiGenerateAct',
                            'attribute' => 'status_logistics',
                            'modelClassName' => $model->className,
                            'requiredClassName' => 'ShopOrder',
                            'value' => 'shipment_ready',
                        ]),
                        'requiredClassName' => 'ShopOrder',
                        'attr' => 'status',
                        'modelClassName' => $model->className,
                        'value' => 'shipment_ready',
                        'btnFloating' => false,
                        'title' => Az::l('Акт передачи'),
                        'toggle' => ZButtonWidget::toggle['tooltip'],
                    ]
                ]);

                echo  ZBootstrapBorderRadioGroupWidget::widget([
                    'config' => [
                        'src' => '<img src="/render/inputes/ZBootstrapImgCheckboxWidget/demo/img/annie-spratt.jpg" alt="#" class="img-fluid imgClass">',
                    ]
                ]);

                $button4 = ZBootstrapBorderRadioGroupWidget::widget([
                    'config' => [
                        'src' => '<img src="/render/inputes/ZBootstrapImgCheckboxWidget/demo/img/annie-spratt.jpg" alt="#" class="img-fluid imgClass">',
                    ]
                ]);

                $button2 = ZCheckButtonWidget::widget([
                    'model' => $model,
                    'config' => [
                        'btn' => false,
                        'text' => 'Маршрутный лист',

                        'btnStyle' => 'btn btn-micro fp-14 text-nowrap text-muted pt-2',

                        'attribute' => 'status',
                        'btnRounded' => true,
                        'btnType' => ZButtonWidget::btnType['link'],
                        'class' => 'simple-ShopOrder text-nowrap',
                        'url' => ZUrl::to([
                            '/core/word/actOb',
                            'type' => 'multiRouteList',
                            'attribute' => 'status_logistics',
                            'modelClassName' => $model->className,
                            'requiredClassName' => 'ShopOrder',
                            'value' => 'shipment_ready',
                        ]),
                        'requiredClassName' => 'ShopOrder',
                        'attr' => 'status',
                        'modelClassName' => $model->className,
                        'value' => 'shipment_ready',
                        'btnFloating' => false,
                        'title' => Az::l('На комплектации'),
                        'toggle' => ZButtonWidget::toggle['tooltip'],
                    ]
                ]);

                //vdd($model1);
                /** @var ZView $this */
                echo ZDynaWidget::widget([
                    'model' => $model,
                    'rightBtn' => [
                        'update' => [
                            'content' => '{update}',
                            'options' => ['class' => 'btn-group p-1 mr-0 {btnSize} {iconSize}']
                        ],

                        'system' => [
                            'content' => '',
                            'options' => ['class' => 'btn-group p-1 mr-0 {btnSize} {iconSize}']
                        ],

                        'add-clone-delete' => [
                            'content' => '{choose}{add}{tabular}{clone}{delete}',
                            'options' => ['class' => 'btn-group p-1 mr-0 {btnSize} {iconSize}']
                        ],

                        'filter-sort-id' => [
                            'content' => '{dynagridFilter}{filter}{dynagridSort}{dynagridSettings}{dynagrid}',
                            'options' => ['class' => 'btn-group p-1 mr-0 {btnSize} {iconSize}']
                        ],

                        'statistics' => [
                            'content' => '{statistics}',
                            'options' => ['class' => 'btn-group p-1 mr-0 {btnSize} {iconSize}']
                        ],

                        'export' => [
                            'content' => '{export}{exportAll}{exportExcel}',
                            'options' => ['class' => 'btn-group p-1 {btnSize} {iconSize}']
                        ],


                        'toggleData' => [
                            'content' => '{all}',
                            'options' => ['class' => 'btn-group p-1 {btnSize} {iconSize}']
                        ],

                    ],
                    'leftBtn' => [
                        'update' => [
                            'content' => $button . $button2,
                            'options' => [
                                'class' => 'btn-group p-1 {btnSize} {iconSize}'
                            ]
                        ],
                    ],

                    'config' => [
                        'pjax' => false,
                        'updateUrl' => '{fullUrl}/process.aspx?shop_shipment_id={id}',
                        'actionButtons' => [
                            'update',
                            'delete',
                            'view',
                        ],
                        'spaArray' => [
                            'create' => true,
                            'update' => false
                        ],
                        'columnBefore' => [
                            'serial',
                            'sort',
                            'checkbox',
                            'action',

                        ],
                        'columnAfter' => ['false']
                    ]
                ]);
                ?>
            </div>
        </div>
    </div>
    <?php require Root . '\webhtm\block\footer\footerAdmin.php' ?>
</div>

<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>
