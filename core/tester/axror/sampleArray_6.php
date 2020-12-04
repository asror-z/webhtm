<?php


use zetsoft\former\eyuf\EyufProgramForm;
use zetsoft\former\eyuf\RavshanForm_3;
use zetsoft\system\actives\ZArrayQuery;
use zetsoft\widgets\former\ZArray4Widget;
use zetsoft\widgets\former\ZArrayWidget;


$data = [];

$model = new RavshanForm_3();
$form = clone $model;

$form->title = 'ssssssssss';
$form->name = 78777;
$data[] = $form;

$form = clone $model;
$form->title = 'aaaaaaaa';
$form->password = 999999;
$data[] = $form;

$form = clone $model;
$form->title = 'eeeeeeeee';
$form->password = 444444444;
$data[] = $form;

$form = clone $model;
$form->title = '2222';
$form->password = 444444444;
$data[] = $form;

$form = clone $model;
$form->title = '2222';
$form->password = 444444444;
$data[] = $form;

$form = clone $model;
$form->title = '2222';
$form->password = 444444444;
$data[] = $form;

$form = clone $model;
$form->title = 'aaaaaaaa';
$form->password = 1234;
$data[] = $form;


$model = new EyufProgramForm();
$action->title = Azl . 'Статистика в формате стран по программам';
/** @var ZView $this */
$data = Az::$app->App->eyuf->main->formByCountries($model);
/*
$query = new ZArrayQuery();
$query->from($data);
$query->andFilterWhere(['like', 'name', 78]);*/


echo ZArrayWidget::widget([
    'model' => $model,
    'data' => $data,
    'config' => [
        'title' => 'Zetsoft Enterprise',

        'search' => true,
        'pagerAjax' => true,
        'columnSerial' => true,
        'columnFormula' => true,

        'showToolbar' => true,
        'topUpdate' => true,
        'topFilter' => true,
        'topSort' => true,
        'topSetting' => true,
        'topExport' => true,
        'bordered' => false,
    ]
]);

