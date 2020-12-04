<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\models\shop\ShopOrder;
use zetsoft\system\Az;
use zetsoft\system\column\ZKDataColumn;
use zetsoft\system\helpers\ZUrl;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZCheckDependWidget;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\former\ZExportBtnWidget;
use zetsoft\widgets\former\ZGetChecksWidget;
use zetsoft\widgets\menus\ZMmenuWidget;
use zetsoft\widgets\navigat\ZButtonWidget;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;
use zetsoft\widgets\notifier\ZSweetAlert2Widget;


/** @var ZView $this */


/**
 *
 * Action Params
 * @author Shahzod Gulomqodirov
 */

$action = new WebItem();

$action->title = Azl . 'Не комплект';
$action->icon = 'fal fa-calendar-times-o';
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
                $this->pjaxBegin();
                $user_id = $this->userIdentity()->id;
                $status = ShopOrder::status_logistics['notset'];

                $model = new ShopOrder;

                $model->configs->query = ShopOrder::find()
                    ->where([
                        'status_logistics' => $status
                    ]);
                    
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

                $model->configs->title = Az::l('Заказы (не комплект)');
                $model->columns();

                $button = ZGetChecksWidget::widget([
                    'model' => $model,
                    'config' => [
                        'url' => ZUrl::to([
                            '/api/core/dyna/no-complect',
                            'bool' => true
                        ]),
                        'noConfirm' => false,
                        'btnOptions' => [
                            'config' => [

                                'btnType' => ZButtonWidget::btnType['button'],
                                'btnStyle' => ZButtonWidget::btnStyle['btn-outline-dark'],
                                'btnSize' => ZButtonWidget::btnSize['btn-mini'],
                                'btnRounded' => false,
                                'text' => Az::l('На комплектацию')
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

                /** @var ZView $this */
                echo ZDynaWidget::widget([
                    'model' => $model,
                    'rightNameEx' => [
                        //'system',
                        'export',
                        'statistics',
                    ],
                    'leftBtn' => [
                         '
                        update' => [
                            'content' => $button,
                            'options' => [
                                'class' => 'btn-group p-1 mr-0 {btnSize} {iconSize}'
                            ]
                        ],
                    ],
                    'rightBtn' => [
                        'update' => [
                            'content' => '{update}',
                            'options' => ['class' => 'btn-group p-1 mr-0 {btnSize} {iconSize}']
                        ],

                        'system' => [
                            'content' => '{system}',
                            'options' => ['class' => 'btn-group p-1 mr-0 {btnSize} {iconSize}']
                        ],

                        'add-clone-delete' => [
                            'content' => '',
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
                            'content' => '{all}',
                            'options' => ['class' => 'btn-group p-1 {btnSize} {iconSize}']
                        ],
                    ],
                    'config' => [
                        'pjax' => false,
                        'columnBefore' => [
                            'serial',
                            'checkbox',
                            'action',
                            'sort',
                        ],
                        'columnAfter' => false,
                        'actionButtons' => [
                            'view',
                            'update',
                        ]
                    ],
                ]);
                $this->pjaxEnd();
                ?>

            </div>
        </div>


    </div>

