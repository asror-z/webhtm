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

use zetsoft\dbitem\core\WebItem;
use zetsoft\models\App\eyuf\Program;
use zetsoft\models\core\CoreSetting;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\former\ZDynaWidget;

/** @var ZView $this */
$action = new WebItem();

$action->title = Azl.'Настройки';
$action->debug = false;
$action->icon = 'fa fa-graduation-cap';

$action->layout = true;

$action->layoutFile = 'admin';


//start|NurbekMakhmudov|2020-10-23
$action->type = WebItem::type['html'];

$this->paramSet(paramAction, $action);

$this->title();
$this->toolbar();
//end|NurbekMakhmudov|2020-10-23


$model = new CoreSetting();



/** @var ZView $this */
echo ZDynaWidget::widget([

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
        'perfectScrollbar' => true,
    ],
    
]);
