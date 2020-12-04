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
use zetsoft\former\files\FilesClassForm;

use zetsoft\models\core\CoreInput;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\former\ZFormWidget;
use zetsoft\widgets\inputes\ZInputWidget;
use zetsoft\widgets\themes\ZCardWidget;


/** @var ZView $this */
$action = new WebItem();
$this->title = 'Виджеты';
$action->type = WebItem::type['ajax'];

/*vdd($this->httpGet());*/
$className = $this->httpGet('widgetClass');
$options = json_decode($this->httpGet('ZDynamicModel'));

//if ($className === null)
    $className1 = 'zetsoft\widgets\inputes\ZInputWidget';

if ($options === null)
    $options = [];

ZCardWidget::begin([
    'config' => [
        'title' => $this->title,
        'type' => ZCardWidget::type['dynCard'],
    ]
]);

$class = new $className();
$dbType = $class->dbType;

$model = new CoreInput();
$attribute = $dbType . '_2';

echo $className::widget([
    'config' => $options,
    'model' => $model,
    'attribute' => $attribute,

]);

ZCardWidget::end();
?>

<script>

        $('head').append($('script'));

</script>
