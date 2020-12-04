<?php

/**
 *
 *
 * Author:  Asror Zakirov
 * https://www.linkedin.com/in/asror-zakirov
 * https://www.facebook.com/asror.zakirov
 * https://github.com/asror-z
 *
 */


use yii\caching\TagDependency;
use zetsoft\dbitem\core\WebItem;
use zetsoft\dbitem\map\StipendItem;
use zetsoft\models\App\eyuf\EyufScholar;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\places\ZAmchartWidget;


/** @var ZView $this */

$action = new WebItem();
$action->title = Az::l('Карта');
$action->icon = 'fa fa-graduation-cap';
$action->layout = true;
$action->debug = true;

$this->paramSet(paramAction, $action);

$this->title();
$this->toolbar();


/** @var StipendItem $item */
$item = $this->cacheRedis('maps22', function () {

    $item = new StipendItem();
    $item->table = Az::$app->App->eyuf->main->table();
    $item->names = Az::$app->App->eyuf->main->getNames();
    $item->datas = Az::$app->App->eyuf->main->statbycounty();
    $item->counts = Az::$app->App->eyuf->main->countsbycounty();

    return $item;
}, [
    EyufScholar::className()
]);


//vdd($item );

echo ZAmchartWidget::widget([
    'config' => [
        'table' => $item->table,
        'value' => $item->counts,
        'name' => $item->names,
        'colorForEmpty' => false
    ]
]);
