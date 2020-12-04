<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\former\shop\ShopOperatorForm;
use zetsoft\models\core\CoreData;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\market\ZMyCardWidget;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;

$action = new WebItem();
$action->title = Azl . 'Оператор';
$action->icon = 'fa fa-pie-chart';
$action->type = WebItem::type['html'];
$action->csrf = true;
$action->debug = true;
$action->layout = true;
$action->layooutFile = 'admin';



$this->paramSet(paramAction, $action);

$this->title();
$this->toolbar();

$model = new ShopOperatorForm();
$model->configs->spa = false;
$data = Az::$app->market->operator->shipmentData(1);

$model->columns();

/*echo ZDynaWidgetD::widget([
    'model' => $model,
    'data' => $data,
    'type' => ZDynaWidget::type['form'],
    'config' => [
        'summary' => false,
    ]
]);*/

