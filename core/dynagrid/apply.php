<?php


use zetsoft\models\drag\DragConfigDb;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\kernels\ZView;

/** @var ZView $this */

$keys = $this->httpPost('keys');
$keys = explode('|', $keys);
$key = ZArrayHelper::getValue($keys, 0);
$class = DragConfigDb::findOne($key)->class;

if (!empty($key)) {
    \zetsoft\system\Az::$app->utility->execs->php("cruds/visuals/model --class=$class");
    \zetsoft\system\Az::$app->utility->execs->php("cruds/cruds/run --class=$class");
    \zetsoft\system\Az::$app->utility->execs->php("cruds/run/apply --class=$class");
}

$this->urlRedirect(['/shop/admin/core-config-db']);

