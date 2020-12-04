﻿<?php

use kartik\grid\DataColumn;
use zetsoft\dbitem\core\WebItem;
use zetsoft\dbitem\data\TabItem;
use zetsoft\models\shop\ShopOrder;
use zetsoft\models\user\User;
use zetsoft\system\Az;
use zetsoft\system\column\ZKDataColumn;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\helpers\ZUrl;
use zetsoft\system\helpers\ZVarDumper;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZBanderolWidget;
use zetsoft\widgets\former\ZCheckButtonWidget;
use zetsoft\widgets\former\ZCheckDependWidget;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\former\ZExportBtnWidget;
use zetsoft\widgets\former\ZGetChecksWidget;
use zetsoft\widgets\former\ZPdfWidget;
use zetsoft\widgets\inputes\ZInputBtnWidget;
use zetsoft\widgets\menus\ZMmenuWidget;
use zetsoft\widgets\navigat\ZButtonWidget;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;
use zetsoft\widgets\notifier\ZSweetAlert2Widget;
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
$action->debug = false;
$action->cache = false;
$action->call = null;
$action->cacheHttp = false;
$action->layout = true;
$action->layoutFile = 'admin';

$this->paramSet(paramAction, $action);

$this->title();
$this->toolbar();

?>

    <div id="content" class="content-footer p-3">


        <div class="row">
            <div class="col-md-12">
                <?php

                $this->pjaxBegin();

                $model = new ShopOrder;

                $action = $this->urlArrayStr;
                $user_id = $this->userIdentity()->id;
                $sessionKey = "Checkdyna-$model->className-$action-$user_id";

                $model->configs->query = ShopOrder::find()
                    ->where([
                        'status_logistics' => ShopOrder::status_logistics['on_complecting']
                    ]);

                $model->configs->readonly = [
                    'ware_ids' => false,
                ];

                $model->configs->nameOn = [
                    //'id',
                    'number',
                    'name',
                    'code',
                    'parent',
                    'status_logistics',
                    'date_deliver',
                    'ware_ids',
                    'user_company_ids',
                ];
                $model->configs->changeSave = true;
                $model->configs->changeReload = true;
                $model->configs->title = Az::l('Заказы, на комплектации');
                $model->columns();

                $dogovor = ZGetChecksWidget::widget([
                    'model' => $model,
                    'config' => [
                        'url' => ZUrl::to([
                            '/api/shop/cart/actOb',
                            'type' => 'multiContract',
                        ]),
                        'noConfirm' => false,
                        'btnOptions' => [
                            'config' => [
                                'btnType' => ZButtonWidget::btnType['button'],
                                'btnStyle' => ZButtonWidget::btnStyle['btn-outline-dark'],
                                'btnSize' => ZExportBtnWidget::btnSize['btn-mini'],
                                'btnRounded' => false,
                                'text' => Az::l('Договор заказа')
                            ]
                        ],
                    ],
                    'event' => [
                        'ajaxSuccess' => <<<JS
            function(data) {
            
                if (data.error) {
                    alert(data.error)
                }
                if (data.path) {
                    window.open(data.path, '_blank')
                    location.reload()
                }
            
            }
JS,
                    ],

                ]);

                $noComplect = ZGetChecksWidget::widget([
                    'model' => $model,
                    'config' => [
                        'url' => ZUrl::to([
                            '/api/core/dyna/no-complect',
                        ]),
                        'noConfirm' => false,
                        'btnOptions' => [
                            'config' => [

                                'btnType' => ZButtonWidget::btnType['button'],
                                'btnStyle' => ZButtonWidget::btnStyle['btn-outline-dark'],
                                'btnSize' => ZButtonWidget::btnSize['btn-mini'],
                                'btnRounded' => false,
                                'text' => Az::l('Не комплект')
                            ]
                        ],
                    ],
                    'event' => [
                        'ajaxSuccess' => <<<JS
               function () {
                    location.reload()                                 
               }
JS,
                    ]
                ]);

                $noConfirm = false;
                if ($this->httpGet('updated'))
                    $noConfirm = true;

                $banderol = ZGetChecksWidget::widget([
                    'model' => $model,
                    'config' => [
                        'url' => ZUrl::to([
                            '/api/shop/cart/banderol',
                            'type' => 'multiBanderol',
                            'attribute' => 'status_logistics',
                            'modelClassName' => $model->className,
                            'value' => 'shipment_ready',
                        ]),
                        'noConfirm' => $noConfirm,
                        'btnOptions' => [
                            'id' => 'btn-banderol',
                            'config' => [

                                'btnType' => ZButtonWidget::btnType['button'],
                                'btnStyle' => ZButtonWidget::btnStyle['btn-outline-dark'],
                                'btnSize' => ZButtonWidget::btnSize['btn-mini'],
                                'btnRounded' => false,
                                'text' => Az::l('Бандероль')
                            ]
                        ],
                    ],
                    'event' => [
                        'ajaxSuccess' => <<<JS
            function(data) {
            
                if (data.error) {
                   alert(data.error)
                }
                                 
                if (data.data) {
                    
                    if (data.redirect) {
                         if (window.open(data.data, '_blank')) {
                            location.href = '{$this->urlArrayStr}.aspx';
                         }
                    } else {
                        bootbox.confirm({
                            title: 'Ошибка',
                            message: 'Необходимо заполнить вес заказа!',
                            callback: function (result) {
                                if (result === true)
                                    $('#update-'+ data.id).click();
                            }   
                        });
                    }
                    
                }
                
            }
JS,
                    ]
                ]);

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
                            'content' => $dogovor . $noComplect . $banderol,
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
                        'system' => [
                            'content' => '{system}',
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
                        'pjax' => false,
                        'contentOptions' => function ($model, $key, $index, $column) {
                            /** @var ShopOrder $model */
                            /** @var DataColumn $column */
                            $color = '';
                            if (ZArrayHelper::getvalue($model,'parent')) $color = '#cffaec';
                            return [
                                'style' => 'background-color:' . $color,
                            ];
                        },
                        // 'hasItems' => true,
                        'viewUrl' => '{fullUrl}/view.aspx?shop_order_id={id}',
                        'updateUrl' => '{fullUrl}/update.aspx?id={id}&model={modelClassName}',

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


                $updated = false;
                if (!empty($this->sessionGet($sessionKey)) && !empty($this->httpGet('updated')))
                    $updated = ZVarDumper::grapesValue($this->httpGet('updated'));

                $this->pjaxEnd();

                ?>

            </div>
        </div>


    </div>


<script>


    $(document).ready(function () {

        var updated = <?=$this->jscode($updated)?>;

        if (updated) {
            setTimeout(function () {
                $('#btn-banderol').click()
            }, 1000)
        }
    })


</script>
