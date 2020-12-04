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
$this->fileJs('https://cdn.jsdelivr.net/npm/jquery@3.4.1/dist/jquery.min.js');

use zetsoft\former\files\FilesClassForm;

use zetsoft\models\core\CoreInput;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\former\ZFormWidget;
use zetsoft\widgets\inputes\ZInputWidget;
use zetsoft\widgets\themes\ZCardWidget;


/** @var ZView $this */
$action = new WebItem();
$this->title = 'Виджеты';
$action->type = WebItem::type['ajax'];

$className = $this->httpGet('widgetClass');
if (empty($className))
    return $this->alertDanger( $this->httpGet(), 'Please put an ID');
$className = str_replace('/', '\\', $className);
//vdd($className);
$options = $this->httpPost('ZDynamicModel');

if ($className === null)
    $className = 'zetsoft\widgets\inputes\ZInputWidget';

if ($options === null)
    $options = [];



$class = new $className();
$dbType = $class->dbType;

$model = new CoreInput();
$attribute = $dbType . '_2';

/*ZCardWidget::begin([
    'config' => [
        'title' => $this->title,
        'type' => ZCardWidget::type['dynCard'],
    ]
]);*/



echo $className::widget([
    'config' => $options,
    'model' => $model,
    'attribute' => $attribute,

]);


/*ZCardWidget::end();*/

 
