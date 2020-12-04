<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\models\shop\ShopProduct;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\former\ZViewWidget;

/** @var ZView $this */

$action = new WebItem();

$action->title = Azl . 'Веб-действия';

$action->icon = 'fa fa-bar-chart';
$action->debug = false;
$action->csrf = false;

$model = ShopProduct::find()->one();

echo ZViewWidget::widget([

    'model'=> $model

]);
