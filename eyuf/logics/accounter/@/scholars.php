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

use zetsoft\models\App\eyuf\EyufScholar;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\dbitem\core\WebItem;

/** @var ZView $this */
$action = new WebItem();

$action->title = Azl . 'Список Стипендиант';
$action->icon = 'fa fa-desktop';


$action->layout = true; $action->debug = false;


$this->paramSet(paramAction, $action);

$this->title();
$this->toolbar();

$model = new EyufScholar();
/*$model->configs->edit = false;*/


/** @var ZView $this */
echo ZDynaWidget::widget([
    'model' => $model,
    'config' => [
        'topCreate' => false,
        'actionDelete' => false,
        'actionClone' => false,
        'topUpdate' => false,
        'edit' => false,
        'columnID' => true,
        'columnSerial' => false,
        'columnAction' => false,
        'columnCheckbox' => true,
        'columnExpand' => false,
        'columnFormula' => false,
        'columnRelation' => false, 
    ]
]);
