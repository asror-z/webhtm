<?php

use kartik\grid\DataColumn;
use rmrevin\yii\fontawesome\FA;
use zetsoft\dbitem\core\WebItem;
use zetsoft\system\assets\ZColor;
use zetsoft\system\Az;
use zetsoft\system\column\ZKDataColumn;
use zetsoft\system\helpers\ZUrl;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZCheckButtonWidget;
use zetsoft\widgets\former\ZCheckSelectWidget;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\former\ZIframeSpaWidget;
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

$action->title = Azl . 'Заказы колл центра';
$action->icon = 'fa fa-line-chart';
$action->type = WebItem::type['html'];
$action->csrf = true;
$action->debug = true;
$action->layout = true;
$action->layoutFile = 'admin';



$this->paramSet(paramAction, $action);

$this->title();
$this->toolbar();


?>

<div id="page">

    <div id="content" class="content-footer p-3">


        <div class="row">
            <div class="col-md-12 col-12">

                <?

                //$userCompanyID = 17;
                $userCompanyID = $this->userIdentity()->user_company_id;

                if (empty($userCompanyID))
                    $userCompanyID = 4;

                $model = new ShopOrder();

                $model->configs->query = ShopOrder::find()
                    ->where([
                        'user_company_ids' => $userCompanyID
                    ]);

                $model->configs->nameOn = [
                    'name',
                    'contact_name',
                    'date_deliver',
                    'code',
                    'status_logistics',
                    'status_callcenter',
                    'total_price',

                ];
                $model->configs->filter = false;
                $model->configs->readonly = true;

                $model->columns();
                $url = ZUrl::to([
                    '/api/core/app/word',
                    'namespace' => 'office',
                    'service' => 'word2',
                    'method' => 'test'
                ]);

                $bb = ZCheckButtonWidget::widget([
                    'model' => $model,
                    
                    'config' => [
                        'icon' => 'fal fa-clone fa-lg',
                        'hasIcon' => true,
                        'grapes' => false,

                        'url' => $url,
                        
                        'class' => 'checkbox-' . $model->modelClassName,

                        'modelClassName' => $model->modelClassName
                    ]
                ]);


                /** @var ZView $this */
                echo ZDynaWidget::widget([
                    'model' => $model,
                    'rightNameEx' => [
                        'system'
                    ],
                     'leftBtn' => [
                        'update' => [
                            'content' => "{$bb}",
                            'options' => ['class' => 'btn-group p-1 {btnSize} {iconSize}']
                        ],
                    ],
                    'rightBtn' => [
                        'export' => [
                            'content' => '',
                            'options' => ['class' => 'btn-group p-1 {btnSize} {iconSize}']
                        ],
                        /*  'add-tabular-clone-delete' => [
                              'content' => '{delete}',
                              'options' => ['class' => 'btn-group p-1 mr-0 {btnSize} {iconSize}']
                          ],*/
                        'filter-sort-id' => [
                            'content' => '{dynagridSettings}',
                            'options' => ['class' => 'btn-group p-1 mr-0 {btnSize} {iconSize}']
                        ],
                    ],
                    'config' => [
                        'chooseQuery' => [
                            'contact_name' => 'testUser'
                        ],
                        'hasToolbar' => true,
                        'editableLink' => true,
                        'search' => true,
                        'isCard' => false,
                        'bordered' => false,
                        'striped' => true,
                        'columnBefore' => [
                            'serial',
                            //'sort',
                            //paramsAction,
                             'orderItems'
                        ],

                        'btnDetail' => false,
                        'btnClone' => false,
                    ],

                ]);

                ?>

            </div>
        </div>


    </div>

</div>
