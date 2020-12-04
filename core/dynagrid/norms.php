<?php


use zetsoft\models\drag\DragConfig;
use zetsoft\models\drag\DragFormDb;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\kernels\ZView;

/** @var ZView $this */

$keys = $this->httpPost('keys');
$keys = explode('|', $keys);
$key = ZArrayHelper::getValue($keys, 0);
$class = DragConfig::findOne($key)->class;

if (!empty($key)) {
    Az::$app->utility->execs->action("cruds/visuals/form --class=$class");
    Az::$app->utility->execs->action("cruds/cruds/run --class=$class");
    Az::$app->utility->execs->action("cruds/norms/run --class=$class");
}

$this->alertSuccess( 'Нормаливана форма' . $class);


