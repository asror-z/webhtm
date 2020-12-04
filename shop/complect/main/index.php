<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\models\shop\ShopOrder;
use zetsoft\models\shop\ShopOrderItem;
use zetsoft\system\assets\ZColor;
use zetsoft\system\Az;
use zetsoft\system\column\ZKDataColumn;
use zetsoft\system\helpers\ZUrl;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZCheckButtonWidget;
use zetsoft\widgets\former\ZCheckButtonWidgetJavohir;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\former\ZDynaWidgetAbl;
use zetsoft\widgets\former\ZDynaWidgetRav;
use zetsoft\widgets\former\ZGetChecksWidget;
use zetsoft\widgets\former\ZPdfSimpleWidget;
use zetsoft\widgets\former\ZPdfWidget;
use zetsoft\widgets\menus\ZMmenuWidget;
use zetsoft\widgets\navigat\ZButtonWidget;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;
use zetsoft\widgets\notifier\ZSweetAlert2Widget;
use zetsoft\widgets\values\ZDateFormatWidget;


/** @var ZView $this */


/**
 *
 * Action Params
 * @author Shahzod Gulomqodirov
 */

$action = new WebItem();

$action->title = Azl . 'В ожидании комплектации';
$action->icon = 'fal fa-calendar-times-o';
$action->type = WebItem::type['html'];
$action->csrf = true;
$action->debug = true;
$action->layout = true;
$action->layoutFile = 'user';
$this->paramSet(paramAction, $action);

$this->title();
$this->toolbar();

?>
<div id="content" class="content-footer p-3">
    <div class="row">
        <div class="col-md-12">

            <?php
            $this->pjaxBegin();
            $model = new ShopOrder();

            $model->configs->query = ShopOrder::find()
                ->where([
                    'status_logistics' => ShopOrder::status_logistics['complect_wait'],

                ]);

            $model->configs->nameOn = [
                'number',
                'name',
                'code',
                'date',
                'status_logistics',
                'ware_ids',
                'user_company_ids',
                'date_deliver'
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

            $model->configs->readonly = [
                'date',
              /*  'date_deliver',*/
            ];
            $model->configs->changeSave = true;
            $model->configs->title = Az::l('Заказы, в ожидании комплектации');
            $model->columns();

            /** @var ZView $this */
            echo ZDynaWidget::widget([
                'model' => $model,
                'rightNameEx' => [
                    //'system',
                    'export',
                    'statistics',
                ],
                'leftBtn' => [
                    'update' => [
                        'content' => ZGetChecksWidget::widget([
                            'model' => $model,
                            'config' => [
                                'url' => ZUrl::to([
                                    '/api/shop/cart/contract',
                                    'modelClassName' => $model->className,
                                ]),
                                'noConfirm' => false,
                                'btnOptions' => [
                                    'config' => [

                                        'btnType' => ZButtonWidget::btnType['button'],
                                        'btnStyle' => ZButtonWidget::btnStyle['btn-outline-dark'],
                                        'btnRounded' => false,
                                        'text' => Az::l('На комплектацию')
                                    ]
                                ],
                            ],
                            'event' => [
                                'ajaxSuccess' => <<<JS
        function(data) {
        
            if (data.error)
                alert(data.error)
              
            if (data.path) {
                window.open(data.path, '_blank');
                location.reload()
            }
            
        }
JS,

                            ]
                        ]),
                        'options' => [
                            'class' => 'btn-group p-1 mr-0 {btnSize} {iconSize}'
                        ]
                    ],

                ],
                'rightBtn' => [
                    'system' => [
                        'content' => '{system}',
                        'options' => ['class' => 'btn-group p-1 mr-0 {btnSize} {iconSize}']
                    ],
                    'add-tabular-clone-delete' => [
                        'content' => '{tabular}',
                        'options' => ['class' => 'btn-group p-1 mr-0 {btnSize} {iconSize}']
                    ],
                    'add-clone-delete' => [
                        'content' => '{tabular}{delete}',
                        'options' => ['class' => 'btn-group p-1 mr-0 {btnSize} {iconSize}']
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
                    'columnAfter' => [
                        'maladoy'
                    ],
                    'actionButtons' => [
                        'view',
                        'update',
                    ],
                    'updateUrl' => '{fullUrl}/update.aspx?id={id}&model={modelClassName}',

                ]
            ]);
            $this->pjaxEnd();
            ?>

        </div>
    </div>
</div>
