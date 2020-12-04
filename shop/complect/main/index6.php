<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\models\shop\ShopOrder;
use zetsoft\models\shop\ShopOrderItem;
use zetsoft\models\shop\ShopShipment;
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
use zetsoft\widgets\former\ZDynaWidgetFast;
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
/*
            $model->configs->query = ShopOrder::find()
                ->where([
                    'status_logistics' => ShopOrder::status_logistics['complect_wait'],
                ]);*/


            /** @var ZView $this */
            echo ZDynaWidgetFast::widget([
                'model' => $model,
                'rightNameEx' => [
                    'system',
                    'export',
                    'statistics',
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
                    ]
                ]
            ]);
            $this->pjaxEnd();
            ?>

        </div>
    </div>
</div>
