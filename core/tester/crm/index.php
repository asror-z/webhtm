<?php


use zetsoft\models\drag\DragConfig;
use zetsoft\models\user\ChatGroup;
use zetsoft\models\App\eyuf\Card;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\former\ZDynaWidget;
/** @var ZView $this */

$action->title = Azl . 'Системные формы';

$action->icon = 'fa fa-rocket rss';
$action->debug = true;
$this->csrf = true;
$action->type = WebItem::type['html'];



$model = new ChatGroup();

/** @var ZView $this */
echo ZDynaWidget::widget([
    'model' => $model,
]);










