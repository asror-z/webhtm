<?php

/**
 *
 *
 * Author:  Asror Zakirov
 * https://www.linkedin.com/in/asror-zakirov
 * https://github.com/asror-z
 *
 */

use zetsoft\dbitem\core\WebItem;
use zetsoft\models\App\eyuf\EyufDocument;
use zetsoft\models\App\eyuf\EyufScholar;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\former\ZDynaWidget;



/** @var ZView $this */

$action = new WebItem();

$action->title = Azl . 'Список документов';
$action->icon = 'fas fa-file';


$action->layout = true; $action->debug = false;


$this->paramSet(paramAction, $action);

$this->title();
$this->toolbar();

$user = $this->userIdentity();

$query = EyufScholar::find()
    ->where([
        'user_company_id' => $user->user_company_id
    ])
    ->one();
    


  $docs = new EyufDocument();

  $docs->configs->query = EyufDocument::find()
      ->where([
            'eyuf_scholar_id' => $query->id
      ]);

    $docs->configs->nameOff = [
        'created_at',
        'modified_at',
        'created_by',
        'modified_by',
    ];
    
    $docs->columns();

echo ZDynaWidget::widget([
    'model' => $docs,
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
            'content' => '  {tabular}{clone}{delete}',
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
        'title' => Az::l('Список документов') ,

        'columnCheckbox' => false,
        'columnAction' => false,
        'toolbar' => false,
        'topCreate' => true,
        'topUpdate' => true,
        'actionDelete' => false,
        'actionClone' => false,
        'actionView' => false,
        'topFilter' => false,
        'topSort' => false,
        'topSetting' => true,
        'topExport' => true,
        'titleCreate' => Az::l('Добавить документ'),
        'summary' => false,
        'panelFooter' => false,
        'columnAfter' => false,
        'columnBefore' => [
            'checkbox'
        ]
        
    ]
]);
