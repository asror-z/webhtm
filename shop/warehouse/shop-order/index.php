<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\system\Az;
use zetsoft\system\column\ZKDataColumn;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\helpers\ZUrl;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZBanderolWidget;
use zetsoft\widgets\former\ZDynaDialogWidget;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\former\ZExportBtnWidget;
use zetsoft\widgets\former\ZPdfWidget;
use zetsoft\widgets\inputes\ZHRadioButtonGroupWidget;
use zetsoft\widgets\menus\ZMmenuWidget;
use zetsoft\widgets\navigat\ZButtonWidget;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;
use zetsoft\models\shop\ShopOrder;
use zetsoft\widgets\notifier\ZSweetAlert2Widget;
use zetsoft\widgets\values\ZDateFormatWidget;


/** @var ZView $this */


/**
 *
 * Action Params
 * @author MurodovMirbosit
 */

$action = new WebItem();

$action->title = Azl . 'Заказы';
$action->icon = 'fal fa-lock';
$action->type = WebItem::type['html'];
$action->csrf = true;
$action->debug = false;
$action->layout = true;
$action->layoutFile = 'user';

if ($this->httpGet('spa'))
    $action->debug = false;


$this->paramSet(paramAction, $action);

$this->title();
$this->toolbar();

?>
<div id="content" class="content-footer p-3">

    <div class="row">
        <div class="col-md-12 col-12">
            <?php
            $this->pjaxBegin();
            $model = new ShopOrder();
            $model->configs->query = ShopOrder::find()
            ->where([
                'place_region_id' => $this->userIdentity()->place_region_id
            ]);

            $model->configs->nameOff = [
                'id',
            ];

            $model->configs->readonly = true;
            $model->columns();

            /** @var ZView $this */
            echo ZDynaWidget::widget([
                'model' => $model,
                'config' => [
                    'pjax' => false,
                    'actionButtons' => false,
                    'columnBefore' => [
                        'checkbox',
                        'id',
                    ],
                    'columnAfter' => false,
                ],
                'leftBtn' => [
                    'status' => [
                        'content' => '',
                        'options' => ['class' => 'btn-group p-1 mr-0 {btnSize} {iconSize}']
                    ],
                    'update' => [
                        'content' => '',
                        'options' => [
                            'class' => 'btn-group p-1 mr-0 {btnSize} {iconSize}'
                        ]
                    ],
                ],
                'rightBtn' => [
                    'system' => [
                        'content' => '',
                        'options' => ['class' => 'btn-group p-1 mr-0 {btnSize} {iconSize}']
                    ],
                    'update' => [
                        'content' => '',
                        'options' => ['class' => 'btn-group p-1 mr-0 {btnSize} {iconSize}']
                    ],

                    'add-clone-delete' => [
                        'content' => '',
                        'options' => ['class' => 'btn-group p-1 mr-0 {btnSize} {iconSize}']
                    ],

                    'filter-sort-id' => [
                        'content' => '',
                        'options' => ['class' => 'btn-group p-1 mr-0 {btnSize} {iconSize}']
                    ],

                    'statistics' => [
                        'content' => '',
                        'options' => ['class' => 'btn-group p-1 mr-0 {btnSize} {iconSize}']
                    ],

                    'export' => [
                        'content' => '',
                        'options' => ['class' => 'btn-group p-1 {btnSize} {iconSize}']
                    ],


                    'toggleData' => [
                        'content' => '',
                        'options' => ['class' => 'btn-group p-1 {btnSize} {iconSize}']
                    ],
                ],
            ]);
            $this->pjaxEnd();
            ?>

        </div>
    </div>


</div>


