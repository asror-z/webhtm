<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\dbitem\data\TabItem;
use zetsoft\models\ware\WareReturn;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZUrl;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZCheckButtonWidget;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\former\ZPdfSimpleWidget;
use zetsoft\widgets\menus\ZMmenuWidget;
use zetsoft\widgets\navigat\ZButtonWidget;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;
use zetsoft\widgets\themes\ZDropDownWidget;
use zetsoft\models\place\PlaceCountry;
use function Clue\StreamFilter\fun;


/** @var ZView $this */


/**
 *
 * Action Params
 */

$action = new WebItem();

$action->title = Azl . 'Возврат товаров от клиентов';
$action->icon = 'fal fa-balance-scale';
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
                
                $model = new WareReturn();

                $model->configs->hasPlaceholder = false;
                $model->columns();

                $item = new TabItem();
                $item->title = ZPdfSimpleWidget::widget([
                    'model' => $model,
                    'config' => [
                        'btn' => false,
                        'text' => Az::l('Возврат от клиента '),

                        'btnStyle' => 'btn-micro text-nowrap fp-14 text-muted pt-2',

                        'attribute' => 'status',
                        'btnRounded' => false,
                        'btnType' => ZButtonWidget::btnType['link'],
                        'class' => 'simple-' . $model->className,
                        'url' => ZUrl::to([
                            '/core/word/actOb',
                            'type' => 'selectedReturnFromClient',
                        ]),
                        'attr' => 'status',
                        'modelClassName' => $model->className,
                        'value' => 'shipment_ready',
                        'btnFloating' => false,
                        'toggle' => ZButtonWidget::toggle['tooltip'],
                    ],

                ]);
                $item->param = [
                    'class' => 'd-block'
                ];

                $data[] = $item;

                $item = new TabItem();
                $item->title = ZPdfSimpleWidget::widget([
                    'model' => $model,
                    'config' => [
                        'btn' => false,
                        'text' => Az::l('Заявление на возврат ДС'),

                        'btnStyle' => 'btn-micro text-nowrap fp-14 text-muted pt-2',

                        'attribute' => 'status',
                        'btnRounded' => false,
                        'btnType' => ZButtonWidget::btnType['link'],
                        'class' => 'simple-' . $model->className,
                        'url' => ZUrl::to([
                            '/core/word/actOb',
                            'type' => 'selectedReturnCash',
                        ]),
                        'attr' => 'status',
                        'modelClassName' => $model->className,
                        'value' => 'shipment_ready',
                        'btnFloating' => false,
                        'toggle' => ZButtonWidget::toggle['tooltip'],
                    ]
                ]);
                $item->url = '#';

                $data[] = $item;

                $item = new TabItem();

                $item->title = ZPdfSimpleWidget::widget([
                    'model' => $model,
                    'config' => [
                        'btn' => false,
                        'text' => Az::l('Заявление на возврат товаров'),

                        'btnStyle' => 'btn-micro text-nowrap fp-14 text-muted pt-2',

                        'attribute' => 'status',
                        'btnRounded' => false,
                        'btnType' => ZButtonWidget::btnType['link'],
                        'class' => 'simple-' . $model->className,
                        'url' => ZUrl::to([
                            '/core/word/actOb',
                            'type' => 'selectedReturnProduct',
                        ]),
                        'attr' => 'status',
                        'modelClassName' => $model->className,
                        'value' => 'shipment_ready',
                        'btnFloating' => false,
                        'toggle' => ZButtonWidget::toggle['tooltip'],
                    ],

                ]);
                $item->url = '#';

                $data[] = $item;

                $button = ZDropDownWidget::widget([
                    'data' => $data,
                    'config' => [
                        'title' => Az::l('Печать'),
                        'class' => 'btn btn-mini',
                        'link' => false
                    ]
                ]);
                
                /** @var ZView $this */
                echo ZDynaWidget::widget([
                    'model' => $model,
                    'leftBtn' => [
                        'print' => [
                            'content' => $button,
                            'options' => ['class' => 'btn-group p-1 mr-0 {btnSize} {iconSize}']
                        ]
                    ],
                    'rightBtn' => [
                        'system' => [
                            'content' => '',
                            'options' => ['class' => 'btn-group p-1 mr-0 {btnSize} {iconSize}']
                        ],
                        'update' => [
                            'content' => '{update}',
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
                            'content' => '',
                            'options' => ['class' => 'btn-group p-1 {btnSize} {iconSize}']
                        ],
                        
                        'toggleData' => [
                            'content' => '{all}',
                            'options' => ['class' => 'btn-group p-1 {btnSize} {iconSize}']
                        ],
                    ],
                    'config' => [
                        'spa' => false,
                        'pjax' => false,
                        'updateUrl' => '{fullUrl}/process.aspx?ware_return_id={id}',
                        'spaArray' => [
                            'create' => true,
                            'update' => false
                        ],
                        'spaHeight' => [
                            'create' => '500px',
                            'view' => '750px'
                        ],
                        'actionButtons' => [
                            'update',
                            'delete',
                            'clone',
                            'view',
                        ],
                        'columnBefore' => [
                            'serial',
                            'checkbox',
                            'action',
                        ],
                        'columnAfter' => false,
                    ],
                ]);
                $this->pjaxEnd();
                ?>

            </div>
        </div>
    </div>
