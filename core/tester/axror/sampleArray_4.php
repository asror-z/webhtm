<?php


use zetsoft\former\eyuf\EyufProgramForm;
use zetsoft\former\eyuf\RavshanForm_3;
use zetsoft\widgets\former\ZArrayWidget;


$model = new EyufProgramForm();

$action->title = Azl . 'Статистика в формате стран по программам';

/** @var ZView $this */
$data = Az::$app->App->eyuf->main->formByCountries($model);


echo ZArrayWidget::widget([
    'model' => $model,
    'data' => $data
]);

