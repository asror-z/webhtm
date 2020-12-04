<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\models\ware\WareTrans;
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
use zetsoft\widgets\notifier\ZSweetAlert2Widget;


/** @var ZView $this */


/**
 *
 * Action Params
 */

$action = new WebItem();

$action->title = Azl . 'Перемещение между складами';
$action->icon = 'fal fa-film';
$action->type = WebItem::type['html'];
$action->csrf = true;
$action->layout = true;
$action->layoutFile = 'admin';

if ($this->httpGet('spa'))
    $action->debug = false;



$this->paramSet(paramAction, $action);

$this->title();
$this->toolbar();

?>
    <div id="content" class="content-footer p-3">


        <div class="row">
            <div class="col-md-12 col-12">

                <?
                $this->pjaxBegin();
                $model = new WareTrans();

                $model->configs->nameOn = [
                    'id',
                    'created_at',
                    'name',
                    'date',
                    'warehouse_from',
                    'warehouse_to',
                    'user_company_id',
                    'responsible',
                    'comment',
                ];
                $model->columns();

                /** @var ZView $this */
                echo ZDynaWidget::widget([
                    'model' => $model,
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
                        'pjax' => false,
                        'updateUrl' => '{fullUrl}/process.aspx?ware_trans_id={id}',
                        'spaArray' => [
                            'create' => true,
                            'update' => false
                        ],
                        'spaHeight' => [
                            'create' => '600px',
                            'view' => '800px'
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
                        'columnAfter' => false
                    ]
                ]);
                $this->pjaxEnd();
                ?>

            </div>
        </div>


    </div>

