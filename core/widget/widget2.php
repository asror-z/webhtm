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


use rmrevin\yii\fontawesome\FA;
use zetsoft\models\core\CoreInput;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\helpers\ZVarDumper;
use zetsoft\system\kernels\ZView;


/** @var ZView $this */
$action = new WebItem();

$this->title = 'Виджеты';
$action = new WebItem();
$action->type = WebItem::type['ajax'];
$action->debug = false;

$widgetName = str_replace('/', '\\', $this->httpGet('widget'));
$widgetObject = new $widgetName();
$gettedOptions = $widgetObject->_config;
$service = Az::$app->smart->widget;

if (!$widgetName) {
    echo('Виджет не Выбран!');
    die;
}

#СОЗДАНИЕ ОПЦИИ _config

if (!empty($this->httpGet('ZDynamicModel')))
    $gettedOptions = $this->httpGet('ZDynamicModel');

$config = [];
foreach ($gettedOptions as $key => $value)
    $config[$key] = ZVarDumper::ajaxValue($value);

$config['data'] = $service->dataFix(ZArrayHelper::getValue($gettedOptions, 'data'));



#НЕОБХОДИМЫЕ ОПЦИИ ДЛЯ ВИДЖЕТОВ

$model = new CoreInput();
$attribute = $widgetObject->dbType . '_2';
$data = $config['data'];

if (!empty($widgetObject->data))
    $data = $widgetObject->data;

$id = bname($widgetName) . '_' . random_int(1, 1000000);
$config = $service->getWidgetOptions($widgetName, $config);

$selfConfigs = [
    

];



#ВЫВОД ВИДЖЕТА С НЕОБХОДИМЫМИ ОПЦИЯМИ

echo $widgetName::widget([
    'id' => $id,
    'data' => $data,
    'config' => ZArrayHelper::merge($config, $selfConfigs),
    'model' => $model,
    'attribute' => $attribute,
]);
