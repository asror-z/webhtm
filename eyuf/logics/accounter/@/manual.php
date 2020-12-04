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

use zetsoft\models\App\eyuf\EyufDocument;
use zetsoft\models\App\eyuf\EyufManual;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\former\ZViewWidget;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\former\ZFormBuildWidget;
use zetsoft\dbitem\core\WebItem;

/** @var ZView $this */
$action = new WebItem();

$action->layout = true; $action->debug = false;
$action->icon = 'fa fa-graduation-cap';


$action = new WebItem();

$action->title = Azl . 'Просмотр  Справочника';
$action->icon = 'fa fa-calendar';


$action->layout = true; $action->debug = false;


$this->paramSet(paramAction, $action);

$this->title();
$this->toolbar();

/*$action->title = Azl . 'Просмотр  Справочника';
$action->icon = 'fa fa-calendar';

$id = $this->httpGet('id');
$model = EyufManual::findOne($id);

echo ZViewWidget::widget([
    'model' => $model,

]);*/

$docs = new EyufManual();
$docs->configs->query = EyufManual::find()
    ->where([

    ]);
$docs->configs->edit = false;
$docs->configs->nameOff = [
    'id'
];


echo ZDynaWidget::widget([
    'model' => $docs,
    'config' => [
        'toolbar' => false,
        'actionView' => false,
        'actionEdit' => false,
        'actionDelete' => false,
        'actionClone' => false,
        'columnAction' => false,
        'columnId' => false,

    ]


]);
