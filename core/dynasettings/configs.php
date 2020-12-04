<?php


use zetsoft\dbitem\core\WebItem;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZView;

/** @var ZView $this */
$action = new WebItem();
$action->type = WebItem::type['ajax'];
$action->debug = false;


echo \zetsoft\widgets\inputes\ZKSelect2Widget::widget([
    'model' => new \zetsoft\models\page\PageAction(),
    'attribute' => 'check'
]);
