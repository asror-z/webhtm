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
use zetsoft\models\eyuf\Scholar;
use zetsoft\service\menu\Eyuf;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\former\ZDynaWidget;

$this->title('Список стипендиантов');
$this->icon = 'fa fa-gg-circle';

$model = new Scholar();

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
     ],
]);


if (!$this->hasRole('moder'))
    $this->urlRedirect('/');


$model->configs->query = Scholar::find()->where([
    'status' => Scholar::status['docReady']
])->andWhere([

]);

$model->configs->topCreate = false;
$model->configs->nameOn = [
    'program',
    'status',
];

