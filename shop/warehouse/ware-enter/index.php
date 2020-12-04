<?php

use Ratchet\App;
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
use zetsoft\widgets\menus\ZMmenuWidgetSh;
use zetsoft\widgets\navigat\ZButtonWidget;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;
use zetsoft\models\ware\WareEnter;
use zetsoft\widgets\notifier\ZSweetAlert2Widget;


/** @var ZView $this */


/**
 *
 * Action Params
 */
 
$action = new WebItem();

$action->title = Azl . 'Поступление товаров в склад!';
$action->icon = 'fal fa-film';
$action->type = WebItem::type['html'];
$action->csrf = true;
$action->debug = false;
$action->layout = true;
$action->layoutFile = 'user';



$this->paramSet(paramAction, $action);

$this->title();
$this->toolbar();


?>
    <div id="content" class="content-footer p-3">

        <div class="row">
            <div class="col-md-12 col-12">

                <?
                $this->pjaxBegin();
                $model = new WareEnter();

                $model->configs->readonlyOff = [
                    'ware_enter_id',
                    'shop_catalog_id',
                    'amount',
                    'price_buy',
                    'price',
                    'currency',
                    'title'
                ];
                
                $model->columns();
                /** @var ZView $this */
                echo ZDynaWidget::widget([
                    'model' => $model,
                    'config' => [
                        'pjax' => false,
                        'updateUrl' => '{fullUrl}/process.aspx?ware_enter_id={id}',
                        'viewUrl' => '{fullUrl}/view.aspx?ware_enter_id={id}',
                        'spaArray' => [
                            'create' => true,
                            'update' => false
                        ],

                        'spaHeight' => [
                            'create' => '550px',
                            'update' => '900px',
                            'view' => '750px',
                        ],
                        'actionButtons' => [
                            'update',
                            'delete',
                            'clone',
                            'view',
                        ],
                        'spaTitle' => [
                            'create' => Az::l('Создание поступления товаров в склад'),
                            'view' => Az::l('Просмотр поступления товаров в склад'),
                        ],
                        'columnBefore' => [
                            'serial',
                            'checkbox',
                            'action',
                        ],
                        'columnAfter' => false
                    ],
                    'rightBtn' => [

                        'update' => [
                            'content' => '{update}',
                            'options' => ['class' => 'btn-group p-1 mr-0 {btnSize} {iconSize}']
                        ],

                        'system' => [
                            'content' => '{system}{delDyna}',
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
                ]);
                $this->pjaxEnd();
                ?>

            </div>
        </div>
    </div>

