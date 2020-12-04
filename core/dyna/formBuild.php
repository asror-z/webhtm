<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\dbitem\data\Config;
use zetsoft\dbitem\data\ConfigDB;
use zetsoft\models\test\TestAsror3;
use zetsoft\service\forms\Active;
use zetsoft\system\actives\ZActiveQuery;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\kernels\ZView;
use zetsoft\system\module\Models;
use zetsoft\widgets\former\ZFormBuildWidget;
use zetsoft\widgets\former\ZFormWidget;
use zetsoft\widgets\navigat\ZButtonWidget;

/** @var ZView $this */


/**
 *
 * Action Params
 */

$action = new WebItem();

$action->title = Azl . 'Подобрать товары для переноса даты доставки';
$action->icon = 'fal fa-line-chart';
$action->type = WebItem::type['ajax'];
$action->csrf = true;
$action->debug = false;

$this->paramSet(paramAction, $action);

$modelClassName = $this->httpPost('modelClassName');

if (empty($modelClassName))
    return null;

$modelClass = $this->bootFull($modelClassName);
$modelId = $this->httpPost('modelId');
$formId = $this->httpPost('formId');


$cards = $this->sessionGet('cards');
$configs = $this->sessionGet('configs');
$formConfigs = $this->sessionGet('formBuildConfigs');

/** @var Models $modelClass */
$model = $modelClass::findOne($modelId);

if (!empty($configs)) {
    $configs = Az::$app->utility->mains->array2object(ConfigDB::class, $configs);
    $model->configs = $configs;
}

$model->cards = $cards;

$fullWebId = $model->configs->formUrl;

$form = $this->activeBegin(function (Active $active) use ($formId, $fullWebId) {
    $active->id = $formId;
    $active->validationUrl = $fullWebId;
    return $active;
});

$model->columns();

$options = [
    'model' => $model,
    'form' => $form,
];


if (!empty($formConfigs))
    $options['config'] = $formConfigs;

$data = ZFormBuildWidget::widget($options);

echo $data;

//end:TursunaliyevAbdulloh
$this->activeEnd();
