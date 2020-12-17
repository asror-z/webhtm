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
use zetsoft\models\dyna\DynaImport;
use zetsoft\models\shop\ShopProduct;
use zetsoft\models\test\TestTerrabayt;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\former\ZFormWidget;
use function foo\func;

$action = new WebItem();
$action->layout = true;

/** @var ZView $this */

$this->paramSet(paramAction, $action);

$model = new DynaImport();

$this->paramSet(paramTransact, true);
if ($this->modelSave($model)) {

}
$form = $this->ajaxBegin();
echo ZFormWidget::widget([
    'model' => $model,
]);
$this->ajaxEnd();
