<?php
/**
 * @author: AzimjonToirov
 * 
 */
use kartik\grid\DataColumn;
use zetsoft\dbitem\core\WebItem;
use zetsoft\system\assets\ZColor;
use zetsoft\system\Az;
use zetsoft\system\column\ZKDataColumn;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\menus\ZMmenuWidget;
use zetsoft\widgets\menus\ZMmenuWidgetSh;
use zetsoft\widgets\navigat\ZButtonWidget;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;
use zetsoft\models\shop\ShopOrder;
use zetsoft\widgets\notifier\ZSweetAlert2Widget;


/** @var ZView $this */


/**
 *
 * Action Params
 */
 
$action = new WebItem();

$action->title = Azl . 'Заказы';
$action->icon = 'fal fa-print';
$action->type = WebItem::type['html'];
$action->csrf = true;
$action->debug = true;
$action->layout = true;
$action->layoutFile = 'admin';



$this->paramSet(paramAction, $action);

$this->title();
$this->toolbar();


?>
    <div id="content" class="content-footer p-3">


 

        <div class="row">
            <div class="col-md-12">

                <?

                $userID = $this->userIdentity()->id;
                
                $model = new ShopOrder();

                $model->configs->query = ShopOrder::find()
                    ->where([
                        'user_id' => $userID
                    ]);

                $model->configs->nameOn = [
                    'name',
                    'contact_name',
                    'date_deliver',
                    'place_adress_id',
                    'shop_reject_cause_id',
                    'source',
                    'fragile',
                    'weight',
                    //'size',
                    'labelled',
                    'packaging',
                    'shop_coupon_id',
                    'shop_channel_id'
                ];
                $model->configs->filter = false;
                $model->configs->readonly = true;

                $model->configs->before = [
    'title' => [
                        [
                            'class' => ZKDataColumn::class,
                            'label' => Az::l('Элементы заказа'),
                            'width' => '50px',
                            'value' => function ($model, $key, $index, DataColumn $dataColumn) {


                                ZSweetAlert2Widget::begin([
                                    
                                    'config' => [
                                        'grapes' => false,
                                        'funcName' => 'dynaSweetCall',
                                        'width' => 'auto',
                                        'height' => 'auto',
                                        'begin' => true,
                                        'title' => Az::l('Элементы заказа'),
                                        'allowOutsideClick' => false,
                                        'showCloseButton' => true,
                                        'footer' => '',
                                        'padding' => '0',

                                    ]
                                ]);

                                ?>

                                <iframe
                                        id="currentId"
                                        width="1500"
                                        height="800"

                                ></iframe>

                                <?php


                                ZSweetAlert2Widget::end();

                                return ZButtonWidget::widget([

                                    //'id' => 'settings-widget-' . $key,
                                    'config' => [
                                        'btnSize' => ZColor::btnSize['btn-lg'],
                                        'class' => 'ZDynaBTN p-1',
                                        'title' => Az::l('Элементы заказа'),
                                        'hasIcon' => true,
                                        'btnRounded' => false,
                                        'btn' => false,
                                        'icon' => 'fal fa-list-ol fa-2x',
                                        'confirm' => 'Are you sure you want DELETE columns?'
                                    ],
                                    'event' => [
                                        'click' => <<<JS
            function() {
                dynaSweetCall()
                var modelId = $(this).closest('.tr-dynawidget').data('key');
                $('#currentId').attr('src', '/seller/shop-order-item/index.aspx?id='+modelId)
            }
JS,
                                    ]
                                ]);
                            }
                        ],
                    ],

                ];

                $model->columns();

                /** @var ZView $this */
                echo ZDynaWidget::widget([
                    'model' => $model,
                    'rightNameEx' => [
                        'system'
                    ],
                    'rightBtn' => [
                        'export' => [
                            'content' => '{exportExcel}',
                            'options' => ['class' => 'btn-group p-1 {btnSize} {iconSize}']
                        ],
                        'add-tabular-clone-delete' => [
                            'content' => '{delete}',
                            'options' => ['class' => 'btn-group p-1 mr-0 {btnSize} {iconSize}']
                        ],
                        'filter-sort-id' => [
                            'content' => '{dynagridSettings}',
                            'options' => ['class' => 'btn-group p-1 mr-0 {btnSize} {iconSize}']
                        ],
                    ],
                    'config' => [
                        'hasToolbar' => true,
                        'editableLink' => true,
                        'search' => true,
                        'isCard' => true,
                        'bordered' => false,
                        'striped' => true,
                        'columnBefore' => [
                            'serial',
                            //'sort',
                            //paramsAction,
                        ],
                    ]
                ]);


                ?>

            </div>
        </div>


    </div>
