<?php

use kartik\base\Config;
use zetsoft\dbitem\core\WebItem;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\menus\ZMmenuWidget;
use zetsoft\widgets\menus\ZMmenuWidgetSh;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;
use zetsoft\models\shop\ShopOrder;


/** @var ZView $this */


/**
 *
 * Action Params
 */

$action = new WebItem();

$action->title = Azl . 'Заказы';
$action->icon = 'fal fa-lock';
$action->type = WebItem::type['html'];
$action->csrf = true;
$action->layout = true;
$action->layoutFile = 'admin';

if ($this->httpGet('spa'))
    $action->debug = true;


$this->paramSet(paramAction, $action);

$this->title();
$this->toolbar();

?>

<div id="content" class="content-footer p-3">


  <div class="row">
    <div class="col-md-12 col-12">

        <?

        $model = new ShopOrder();

        $model->configs->nameOn = [
            'name',
            'call_record',
        ];

        $model->configs->readonly = true;

        $model->columns();

        /** @var ZView $this */
        echo ZDynaWidget::widget([
            'model' => $model,
            'rightNameEx' => [
                'system',
            ],
            'config' => [
                'hasToolbar' => false,

                'columnBefore' => [
                    'serial',
                    'sort',
                    'checkbox',
                ],

                'columnAfter' => ['false']
            ]
        ]);

        ?>

    </div>
  </div>


</div>

