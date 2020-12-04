<?php

use kartik\grid\DataColumn;
use zetsoft\dbitem\core\WebItem;
use zetsoft\dbitem\data\TabItem;
use zetsoft\models\shop\ShopOrder;
use zetsoft\models\user\User;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZUrl;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZBanderolWidget;
use zetsoft\widgets\former\ZCheckButtonWidget;
use zetsoft\widgets\former\ZCheckDependWidget;
use zetsoft\widgets\former\ZCheckRedirectWidget;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\former\ZExportBtnWidget;
use zetsoft\widgets\former\ZPdfWidget;
use zetsoft\widgets\inputes\ZInputBtnWidget;
use zetsoft\widgets\menus\ZMmenuWidget;
use zetsoft\widgets\navigat\ZButtonWidget;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;
use zetsoft\widgets\themes\ZDropDownWidget;
use zetsoft\widgets\values\ZDateFormatWidget;

/** @var ZView $this */


/**
 *
 * Action Params
 * @author Shahzod Gulomqodirov
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
                <?php

                $user_id = $this->userIdentity()->id;

                $model = new ShopOrder;
                $model->configs->query = ShopOrder::find()
                    ->where([
                        'status_logistics' => ShopOrder::status_logistics['on_complecting']
                    ]);
                    
                $model->configs->nameOn = [
                    'id',
                    'name',
                    'number',
                    'date',
                    'parent',
                    'code',
                    'status_logistics',
                    'ware_ids',
                    'date_deliver',
                ];

               $model->configs->readonly = [
                    'name',
                    'date'
                ];

                $model->configs->valueWidget = [
                    'date' => ZDateFormatWidget::class,
                    'date_deliver' => ZDateFormatWidget::class,
                ];

                $model->configs->valueOptions = [
                    'date' => [
                        'config' => [
                            'hour' => true,
                        ]
                    ],
                    'date_deliver' => [
                        'config' => [
                            'hour' => true,
                        ]
                    ]
                ];
                
                $model->columns();

                $url = ZUrl::to([
                    '/api/core/app/word',
                    'namespace' => 'office',
                    'service' => 'word2',
                    'method' => 'cashTemplate',
                ]);

                vd($this->sessionGet('ShopOrder-/shop/complect/on-complect/indexD-360'));
                $button = ZCheckRedirectWidget::widget([
                    'config' => [

                        'url' => ZUrl::to([
                            '/core/word/actOb',
                            'type' => 'multiContract',
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
                                    //location.reload()
                                   }
JS
                    ]
                ]);

                $button3 = ZBanderolWidget::widget([
                    'id' => 'btn-banderol',
                    'config' => [
                        'attr' => 'status_logistics',
                        'value' => 'shipment_ready',
                        'url' => ZUrl::to([
                            '/api/shop/cart/banderol',
                            'type' => 'multiBanderol',
                            'attribute' => 'status_logistics',
                            'modelClassName' => $model->className,
                            'value' => 'shipment_ready',
                        ]),
                        'requiredClassName' => 'ShopOrder',
                        'modelClassName' => 'ShopOrder',
                        'btnOptions' => [
                            'config' => [

                                'btnStyle' => ZButtonWidget::btnStyle['btn-outline-success'],
                                'btnSize' => ZExportBtnWidget::btnSize['btn-mini'],
                                'btnRounded' => false,
                                'text' => Az::l('Бандероль'),
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
                
                $button2 = ZPdfWidget::widget([
                    'config' => [
                        'url' => ZUrl::to([
                            '/api/core/dyna/no-complect',
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
                //window.location.reload()                                  
               }
JS,
                    ]
                ]);


                /** @var ZView $this */
                echo ZDynaWidget::widget([
                    'model' => $model,
                    'rightNameEx' => [
                        'system',
                        'export',
                        'statistics',
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
                            'content' => '',
                            'options' => ['class' => 'btn-group p-1 {btnSize} {iconSize}']
                        ],

                    ],
                    'config' => [
                        'contentOptions' => function ($model, $key, $index, $column) {
                            /** @var ShopOrder $model */
                            /** @var DataColumn $column */
                            $color = '';
                            if ($model->parent) $color = '#cffaec';
                            return [
                                'style' => 'background-color:' . $color,
                            ];
                        },
                        'viewUrl' => '{fullUrl}/view.aspx?shop_order_id={id}',
                        'pjax' => false,
                        'columnBefore' => [
                            'checkbox',
                            'serial',
                            'sort',
                            'action',
                        ],
                        'columnAfter' => false,
                        'actionButtons' => [
                            'update',
                            'view',
                        ],
                    ]
                ]);
         
                $myArray = false;

                if (!empty($this->sessionGet('banderolKeys')))
                    $myArray = true;

                $myArray = $this->jscode($myArray);

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


<script>


$(document).ready(function () {

    var myArray = <?=$myArray?>;

    if (myArray === 1) {
        setTimeout(function () {
            $('#btn-banderol').click()
        }, 1000)
    }
})


</script>

<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>
