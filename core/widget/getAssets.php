<?php


use zetsoft\models\core\CoreInput;
use zetsoft\system\kernels\ZView;

/** @var ZView $this */
$action->type = WebItem::type['ajax'];

$className = str_replace('/', '\\',  $this->httpGet('widget'));
$model = new CoreInput();
$attribute = (new $className())->dbType . '_2';

echo $className::widget([
    'model' => $model,
    'attribute' => $attribute
]);
