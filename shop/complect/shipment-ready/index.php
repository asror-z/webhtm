<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\models\shop\ShopOrder;
use zetsoft\system\Az;
use zetsoft\system\column\ZKDataColumn;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\menus\ZMmenuWidget;
use zetsoft\widgets\navigat\ZButtonWidget;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;
use zetsoft\models\shop\ShopBrand;
use zetsoft\widgets\notifier\ZSweetAlert2Widget;
use zetsoft\widgets\values\ZDateFormatWidget;



/** @var ZView $this */


/**
 *
 * Action Params
 * @author Shahzod Gulomqodirov
 */

$action = new WebItem();

$action->title = Azl . 'Готов к отгрузке';
$action->icon = 'fal fa-calendar-times-o';
$action->type = WebItem::type['html'];
$action->csrf = true;
$action->debug = false;
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
                $user_id = $this->userIdentity()->id;
                $status = ShopOrder::status_logistics['shipment_ready'];

                $model = new ShopOrder;

                $model->configs->query = ShopOrder::find()
                    ->where([
                        'status_logistics' => $status
                    ]);
                    
                $model->configs->title = Az::l('Заказы, готовые к отгрузке');
                $model->configs->nameOn = [
                    //'id',
                    'number',
                    'name',
                    'code',
                    'date',
                    'status_logistics',
                    'ware_ids',
                    'user_company_ids',
                    'date_deliver'
                ];
                $model->configs->readonly = [
                    'date'
                ];
                $model->configs->changeSave = true;
                $model->columns();

                /** @var ZView $this */
                echo ZDynaWidget::widget([
                    'model' => $model,
                    'rightNameEx' => [
                        ///'system',
                        'export',
                        'statistics',
                    ],
                    'rightBtn' => [
                        'update' => [
                            'content' => '',
                            'options' => ['class' => 'btn-group p-1 mr-0 {btnSize} {iconSize}']
                        ],

                        'system' => [
                            'content' => '{system}',
                            'options' => ['class' => 'btn-group p-1 mr-0 {btnSize} {iconSize}']
                        ],

                        'add-clone-delete' => [
                            'content' => '{tabular}',
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
                            'content' => '',
                            'options' => ['class' => 'btn-group p-1 {btnSize} {iconSize}']
                        ],


                        'toggleData' => [
                            'content' => '{all}',
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
                        'columnAfter' => [
                            'ds'
                        ],
                        'actionButtons' => [
                            'view',
                          
                        ]
                    ]
                ]);
                $this->pjaxEnd();
                ?>

            </div>
        </div>


    </div>

