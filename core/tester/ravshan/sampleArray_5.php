<?php


use zetsoft\former\eyuf\RavshanForm_3;
use zetsoft\system\actives\ZArrayQuery;
use zetsoft\widgets\former\ZArray4Widget;


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




$query = new ZArrayQuery();
$query->from($data);
$query->andFilterWhere(['like', 'name', 78]);


echo ZArray4Widget::widget([
    'model' => new RavshanForm_3(),
    'data' => $data
]);

