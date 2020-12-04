<?php

/**
 *
 *
 * Author:  Nurmukhammadov Shakhrizod
 * https://www.linkedin.com/in/asror-zakirov
 * https://github.com/asror-z
 *
 */

use zetsoft\dbitem\core\WebItem;
use zetsoft\models\shop\ShopOrder;
use zetsoft\widgets\former\ZDynaWidget;
use function foo\func;

$action = new WebItem();
$action->layout = true;

$this->paramSet(paramAction, $action);

$model = new ShopOrder();
$model->configs->readonly = function ($model){
    return $model->accepted;
};
$model->columns();

echo ZDynaWidget::widget([
   'model' => $model,
   'config' => [
        'updateUrl' => '12321312.aspx'
   ]
]);
