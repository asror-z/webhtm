<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\models\shop\ShopOrder;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZUrl;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZBanderolWidget;
use zetsoft\widgets\former\ZCheckButtonWidget;
use zetsoft\widgets\former\ZCheckDependWidget;
use zetsoft\widgets\former\ZDynaWidget_shoaziz_1;
use zetsoft\widgets\former\ZExportBtnWidget;
use zetsoft\widgets\inputes\ZInputBtnWidget;
use zetsoft\widgets\menus\ZMmenuWidget;
use zetsoft\widgets\navigat\ZButtonWidget;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;

/** @var ZView $this */


/**
 *
 * Action Params
 */

$action = new WebItem();

$action->title = Azl . 'На комплектации';
$action->icon = 'fal fa-calendar-times-o';
$action->type = WebItem::type['html'];
$action->csrf = true;
$action->debug = true;
$action->cache = false;
$action->call = null;
$action->cacheHttp = false;

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
echo ZMmenuWidget::widget([]);

?>

<div id="page">

    <?

    require Root . '/webhtm/block/header/main.php';
    require Root . '/webhtm/block/navbar/admin.php';

    echo ZSessionGrowlWidget::widget();


    ?>

    <div id="content" class="content-footer p-3">


        <div class="row">
            <div class="col-md-12">
                <?

                $user_id = $this->userIdentity()->id;

                $model = new ShopOrder;
                $model->configs->query = ShopOrder::find()
                    ->where([
                        'not', [
                            'status_logistics' => ShopOrder::status_logistics['notset']
                        ]
                    ])
                    ->andWhere([
                        'status_logistics' => ShopOrder::status_logistics['on_complecting']
                    ]);

                $model->configs->nameOn = [
                    'id',
                    'name',
                    'date',
                    'code',
                    'status_logistics',
                    'ware_ids',
                    'date_deliver'
                ];

                $model->configs->readonly = [
                    'name'
                ];

                $model->columns();

                $url = ZUrl::to([
                    '/api/core/app/word',
                    'namespace' => 'office',
                    'service' => 'word2',
                    'method' => 'cashTemplate',
                ]);


                $button = ZCheckDependWidget::widget([
                    'config' => [

                        'url' => ZUrl::to([
                            '/api/core/app/word',
                            'namespace' => 'office',
                            'service' => 'wordpdf',
                            'method' => 'multiContract',
                            'modelClassName' => $model->className
                        ]),
                        'modelClassName' => 'ShopOrder',

                        'btnOptions' => [
                            'config' => [
                                'btnStyle' => ZButtonWidget::btnStyle['btn-outline-success'],
                                'btnSize' => ZExportBtnWidget::btnSize['btn-mini'],
                                'btnRounded' => false,
                                'text' => Az::l('Договор заказа')
                            ]
                        ]
                    ],
                    'event' => [
                        'ajaxComplete' => <<<JS
                                    function () {

                                    location.reload()
                                   
                                   }
JS
                    ]
                ]);
                $button3 = ZBanderolWidget::widget([
                    'config' => [
                        'attr' => 'status_logistics',
                        'value' => 'shipment_ready',
                        'url' => ZUrl::to([
                            '/api/core/app/banderol',
                            'namespace' => 'office',
                            'service' => 'wordpdf',
                            'method' => 'multiBanderol',
                            'rest/app/check',
                            'modelClassName' => $model->className
                        ]),
                        'modelClassName' => 'ShopOrder',
                        'btnOptions' => [
                            'config' => [
                                'btnStyle' => ZButtonWidget::btnStyle['btn-outline-success'],
                                'btnSize' => ZExportBtnWidget::btnSize['btn-mini'],
                                'btnRounded' => false,
                                'text' => Az::l('Бандероль')
                            ]
                        ]
                    ],
                    'event' => [
                        'ajaxComplete' => <<<JS
                                     function() {
   
                                    //window.location.reload()
                                    //alert('sadas');
                                   }
JS
                    ]
                ]);


                $button2 = ZCheckDependWidget::widget([
                    'config' => [
                        'url' => ZUrl::to([
                            'rest/app/no-complect',
                            'modelClassName' => $model->className
                        ]),

                        'modelClassName' => $model->className,
                        'attr' => 'status_logistics',
                        'value' => 'notset',
                        'btnOptions' => [
                            'config' => [
                                'btnStyle' => ZButtonWidget::btnStyle['btn-outline-success'],
                                'btnSize' => ZExportBtnWidget::btnSize['btn-mini'],
                                'btnRounded' => false,
                                'text' => Az::l('Не комплект'),

                            ]
                        ]
                    ],
                    'event' => [
                        'ajaxComplete' => <<<JS
                                     function () {

                                    location.reload()
                                   
                                   }
JS
                    ]
                ]);


                /** @var ZView $this */
                echo ZDynaWidget_shoaziz_1::widget([
                    'model' => $model,
                    'rightNameEx' => [
                        'system'
                    ],
                    'leftBtn' => [

                        'update' => [
                            'content' => $button . $button3 . $button2,
                            'options' => [
                                'class' => 'btn-group p-1 mr-0 {btnSize} {iconSize}'
                            ]
                        ],
                        'search' => [
                            'content' => '',
                            'options' => [
                                'class' => 'btn-group p-1 mr-0 {btnSize} {iconSize}'
                            ]
                        ],
                    ],

                    'rightBtn' => [


                        'add-clone-delete' => [
                            'content' => '{tabular}{delete}',
                            'options' => ['class' => 'btn-group p-1 mr-0 {btnSize} {iconSize}']
                        ],

                        'filter-sort-id' => [
                            'content' => '{dynagridFilter}{filter}{dynagridSort}{dynagridSettings}{dynagrid}',
                            'options' => ['class' => 'btn-group p-1 mr-0 {btnSize} {iconSize}']
                        ],

                        'export' => [
                            'content' => '{export}{exportAll}{exportExcel}',
                            'options' => ['class' => 'btn-group p-1 {btnSize} {iconSize}']
                        ],


                        'toggleData' => [
                            'content' => '{toggleData}',
                            'options' => ['class' => 'btn-group p-1 {btnSize} {iconSize}']
                        ],
                    ],

                    'config' => [
                        'pjax' => false,
                        'columnBefore' => [
                            'checkbox',
                            'serial',
                            'sort',
                            'action',
                        ],
                        'columnAfter' => false,
                        'actionButtons' => [
                            'view',
                            'update',
                        ],
                    ]
                ])

                ?>

            </div>
        </div>


    </div>
    <? require Root . '\webhtm\block\footer\footerAdmin.php' ?>
</div>
<style>
    #ShopOrder_Grid_Reset {
        display: none;
    }
</style>

<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>
