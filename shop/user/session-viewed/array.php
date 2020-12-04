<?php

use zetsoft\former\shop\ShopProductItemForm;
use zetsoft\system\Az;
use zetsoft\widgets\former\ZArrayWidget;

echo ZArrayWidget::widget([
'data' => Az::$app->market->product->getProductItemForm(35),
'model' => new ShopProductItemForm()
]);
