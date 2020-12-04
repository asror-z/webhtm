<?php


use phpDocumentor\Reflection\Types\This;
use yii\web\Response;
use zetsoft\dbitem\core\WebItem;
use zetsoft\models\dyna\DynaConfig;
use zetsoft\models\page\PageAction;
use zetsoft\system\actives\ZActiveRecord;
use zetsoft\dbitem\data\TabItem;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZUrl;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\system\module\Models;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZCheckButtonWidget;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\former\ZListWidget;
use zetsoft\widgets\navigat\ZButtonWidget;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;
use zetsoft\widgets\navigat\ZSmartTabWidget;
use zetsoft\widgets\themes\ZTabForDynaWidget;

$action = new WebItem();

$action->title = Azl . 'Страны';
$action->icon = 'fal fa-landmark';
$action->type = WebItem::type['html'];
$action->csrf = true;
$action->debug = false;



$this->paramSet(paramAction, $action);

Az::$app->response->format = Response::FORMAT_JSON;

$modelName = $this->httpGet('modelName');
$modelId = $this->httpGet('modelId');
$attribute = $this->httpGet('attribute');
$radioKey = $this->httpPost('radioKey');

$modelClass = $this->bootFull($modelName);

/** @var Models $model */

$model = new $modelClass();
$model->$attribute = $radioKey;
$model->configs->rules = [
    [
        validatorSafe
    ]
];
$model->save();

return [
    'id' => $model->id
];
