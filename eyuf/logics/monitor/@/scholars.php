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


use zetsoft\models\ALL\CoreRole;
use zetsoft\models\App\eyuf\EyufScholar;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\dbitem\core\WebItem;


$action = new WebItem();

$action->title = Az::l('Список стипендиантов');
$action->icon = 'fa fa-gg-circle';


$action->layout = true; $action->debug = false;


$this->paramSet(paramAction, $action);

$this->title();
$this->toolbar();

$this->title (Az::l('Список стипендиантов'));
$action->icon = 'fa fa-gg-circle';

$model = new EyufScholar();
$model->configs->query = EyufScholar::find()
    ->where(['not',
        ['status' => null]
    ])
   ->where(['not',
        ['status' => '']
    ]);

$model->configs->edit = false;
/** @var ZView $this */
echo ZDynaWidget::widget([
    'model' => $model,
    'config' => [
        'columnID' => true,
        'columnSerial' => true,
        'columnAction' => false,
        'columnCheckbox' => false,
        'columnExpand' => false,
        'columnFormula' => false,
        'columnRelation' => false,
        'actionClone' => false,
        'actionDelete' => false,
        'topCreate' => false
    ],
]);

