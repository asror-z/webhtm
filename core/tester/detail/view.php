<?php

use kartik\builder\Form;
use kartik\detail\DetailView;
use kartik\detail\DetailViewAsset;
use yii\helpers\Url;
use zetsoft\models\user\User;
use zetsoft\system\Az;
use zetsoft\widgets\former\ZDetailViewWidget;
use zetsoft\widgets\former\ZDetailWidget;

$model = User::findOne(376);
$view = $model->attributeLabels();
$attributes = [];


foreach ($view as $key => $val) {
    $attributes[] = $key;

}

echo DetailView::widget([
    'model' => $model,
    'condensed' => true,
    'hover' => true,
    'mode' => DetailView::MODE_VIEW,
    'panel' => [
        'heading' => 'Book # ' . $model->id,
        'type' => DetailView::TYPE_INFO,
    ],
    /*'saveOptions' => [
        'url' => Url::to(['update.aspx']),
        'params' => ['id' => 29, 'custom_param' => true],
    ],*/
    'attributes' => $attributes,
]);





