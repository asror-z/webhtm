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

use zetsoft\system\column\ZKDataColumn;

use zetsoft\models\user\User;
use zetsoft\models\App\eyuf\EyufScholar;
use zetsoft\system\Az;

use zetsoft\system\kernels\ZView;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\navigat\ZDownloadWidget;
use zetsoft\dbitem\core\WebItem;


$action = new WebItem();

$action->title = Azl . 'Список Стипендиант';
$action->icon = 'fa fa-desktop';


$action->layout = true; $action->debug = false;

$this->paramSet(paramAction, $action);

$this->title();
$this->toolbar();

$model = new EyufScholar();
//$model = new User();
//$model->configs->after = [
//    'program' => [
//        [
//            'class' => ZKDataColumn::class,
//            'label' => Az::l('Download'),
//            'value' => function (User $model, $key, $index, ZKDataColumn $dataColumn) {
//                return ZDownloadWidget::widget([
//                    'model' => $model,
//                    'attribute' => 'photo'
//                ]);
//            }
//        ],
//
//    ]
//
//];


/** @var ZView $this */
echo ZDynaWidget::widget([
    'model' => $model,
    'rightBtn' => [
       
    ],
    'config' => [
    
        'topCreate' => true,
       // 'actionButtons' => ['delete']
    ]
  
]);
