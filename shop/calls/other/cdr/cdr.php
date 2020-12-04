<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\dbitem\shop\ProductItem;
use zetsoft\models\calls\CallsCdr;
use zetsoft\models\shop\ShopOrder;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\market\ZFooterAllWidget;
use zetsoft\widgets\market\ZFooterAllWidgetOrg;
use zetsoft\widgets\navigat\ZBreadcrumbsWidget;
use zetsoft\widgets\navigat\ZReadMoreWidget;
use zetsoft\widgets\notifier\ZJspanelWidget;
use zetsoft\widgets\animo\ZFakeLoaderNewWidget;


/** @var ZView $this */
$action = new WebItem();

$action->title = Azl . 'Звонки колл центра';
$action->icon = 'fa fa-area-chart';
$action->type = WebItem::type['html'];
$action->csrf = true;
$action->debug = true;
$action->layout = true;
$action->layoutFile = 'admin';

$action->cache = false;

$action->call = [];

$action->cacheHttp = false;

$this->paramSet(paramAction, $action);


/*$product = Az::$app->market->product->product($product_id, 2, true);*/



$this->title();
$this->toolbar();




$model = new CallsCdr();

/*$model->configs->nameOn = [
'id',
'name',
'call_record',
];*/

echo ZDynaWidget::widget([
    'model' => $model,
    'config' => [
        'cdr' => true
    ]
]);
?>





<?php
echo ZFooterAllWidgetOrg::widget();
echo ZJspanelWidget::widget([]);

?>
