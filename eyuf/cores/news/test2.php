<?php


use zetsoft\models\ALL\CoreAction;
use zetsoft\models\ALL\CoreCompany;
use zetsoft\models\ALL\CoreContacts;
use zetsoft\models\ALL\CoreGroup;
use zetsoft\models\ALL\CoreInput;
use zetsoft\models\ALL\CoreManual;
use zetsoft\models\ALL\CoreNews;
use zetsoft\models\user\User;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZUrl;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\former\ZDynaCheckWidget;
use zetsoft\widgets\former\ZCheckConfirmWidget2OLD;
use zetsoft\widgets\former\ZDynaWidget;

/** @var ZView $this */

$action->title = Azl . 'Контакты';

$action->icon = 'fa fa-cropLength';



$model = new CoreGroup();
$cloneUrl = ZUrl::to([
    'clone-all',
    'modelClassName' => $this->modelClassName
]);
/** @var ZView $this */
echo ZDynaWidget::widget([
    'id' => 'asd',
    'model' => $model,
    'rightBtn' => [
        'update' => [
            'content' => '',
            'options' => ['class' => 'btn-group p-1 mr-0 {btnSize} {iconSize}']
        ],

        'system' => [
            'content' => '',
            'options' => ['class' => 'btn-group p-1 mr-0 {btnSize} {iconSize}']
        ],
        'add-clone-delete' => [
            'content' => '{add}{tabular}{clone}{delete}',
            'options' => ['class' => 'btn-group p-1 mr-0 {btnSize} {iconSize}']
        ],
        'filter-sort-id' => [
            'content' => '',
            'options' => ['class' => 'btn-group p-1 mr-0 {btnSize} {iconSize}']
        ],
        'statistics' => [
            'content' => '',
            'options' => ['class' => 'btn-group p-1 mr-0 {btnSize} {iconSize}']
        ],
        'export' => [
            'content' => '{jsonExcel}{export}',
            'options' => ['class' => 'btn-group p-1 {btnSize} {iconSize}']
        ],
        'toggleData' => [
            'content' => '{all}',
            'options' => ['class' => 'btn-group p-1 {btnSize} {iconSize}']
        ],
        'filterPjax' => [
            'content' => '',
            'options' => ['class' => 'btn-group p-1 {btnSize} {iconSize}']
        ],
    ],
    'config' => [
        'toolbar' => [
            'update' => [
                'content' => '{update} ' . ZDynaCheckWidget::widget([
                        'config' => [
                            'url' => '/cores/news/test3.aspx?modelClassName=CoreGroup',
                            'class' => 'simple-asd',
                            'message' => Az::l('Вы хотите клонировать этот элемент(ы)?'),
                            'confirm' => false
                        ]
                    ]),
                'options' => ['class' => 'btn-group p-0 mr-2']
            ],
        ]
    ]
]);










