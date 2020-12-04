<?php

/**
 *
 *
 * Author:  Asror Zakirov
 * https://www.linkedin.com/in/asror-zakirov
 * https://www.facebook.com/asror.zakirov
 * https://github.com/asror-z
 *
 */


use yii\web\JsExpression;

use zetsoft\models\drag\DragFormDb;
use zetsoft\models\core\CoreInput;
use zetsoft\system\actives\ZAjaxForm;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\former\ZAjax2Widget;
use zetsoft\widgets\former\ZAjaxWidget;
use zetsoft\widgets\former\ZFormWidget;
use zetsoft\widgets\inputes\ZKSelect2Widget;
use zetsoft\widgets\themes\ZCardWidget;


/** @var ZView $this */
$action = new WebItem();

$action->title = Azl . 'Сохранение Настроек Виджетов';
$action->icon = 'fa fa-rocket rss';
$action->type = WebItem::type['html'];

$modelId = $this->httpGet('modelId');
$model = DragFormDb::findOne($modelId);

$model->options = null;
$model->save();

$this->urlRedirect([
    '/core/widget/settings',
    'modelId' => $modelId
]);
