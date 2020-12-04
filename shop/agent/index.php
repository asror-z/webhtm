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



$this->paramSet(paramAction, $action);

$this->title();
$this->toolbar();
$this->beginPage();
?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>

    <?php

    require Root . '/webhtm/block/metas/main.php';
    require Root . '/webhtm/block/assets/main.php';

    $this->head();

    ?>

</head>


<body class="<?= ZWidget::skin['white-skin'] ?>">

<?php

$this->beginBody();

echo ZNProgressWidget::widget([]);

?>div id="page">

<?

if (!$this->httpGet('spa'))
    require Root . '/webhtm/block/navbar/main.php';

echo ZSessionGrowlWidget::widget();



?>
<?
//Az::$app->controller->layout = 'Main';     //main

/*$model = new ShopOrder();
$model->configs->query = ShopOrder::find()
    ->where([
        'status' => ShopOrder::status['checking'],
        //'operator_id' => $this->userIdentity()->id
        'operator_id' => 1
    ]);

$model->configs->before = [
    'core_cupon_id' => [
        'class' => ZDataColumn::class,
        'label' => Az::l('Kuryer'),
        'width' => '100px',
        'value' => 'wfs'
    ]
];

$model->configs->nameOff = [
    'operator_id'
];*/


//$model = Az::$app->market->product->getOwnShipments(1);

/*echo ZDynaWidget::widget([
    'model' => $model
]);*/

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

