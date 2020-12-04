<?php


use zetsoft\models\dyna\DynaFilter;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\kernels\ZView;


/** @var ZView $this */
$post = $this->httpGet('DynaFilter');
$type = ZArrayHelper::getValue($post, 'type');
$dynaId = ZArrayHelper::getValue($post, 'dynaId');
$name = ZArrayHelper::getValue($post, 'name');
$modelName = ZArrayHelper::getValue($post, 'model');
$url = ZArrayHelper::getValue($post, 'url');

$params = $this->httpPost($modelName);

$coreDynaFilter = DynaFilter::findOne([
    'dynaId' => $dynaId,
    'name' => $name
]);

if (!$coreDynaFilter) {
    $coreDynaFilter = new DynaFilter();
    $coreDynaFilter->name = $name;
    $coreDynaFilter->type = $type;
    $coreDynaFilter->data = $params;
    $coreDynaFilter->dynaId = $dynaId;
    $coreDynaFilter->save();
}

if (!empty($coreDynaFilter->data))
    $params = $coreDynaFilter->data;

$url .= '?';
foreach ($params as $attribute => $param) {
    $url .= $modelName . '[' . $attribute . "]=$param&";
}
$urlParam = '?' . $url;


