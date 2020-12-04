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



$className = str_replace('/', '\\', $this->httpGet('widget'));
$gettedOptions = $this->httpGet('ZDynamicModel');

if ($gettedOptions === null || empty($gettedOptions))
    $gettedOptions = (new $className)->_config;

$config = [];

foreach ($gettedOptions as $key => $value)
    $config[$key] = ZVarDumper::ajaxValue($value);

$config['data'] = Az::$app->smart->widget->dataFix(ZArrayHelper::getValue($gettedOptions, 'data'));

$model = new CoreInput();
$attribute = (new $className())->dbType . '_2';
$data = $config['data'];
$id = bname($className) . '_' . random_int(1, 1000000);

$config = Az::$app->smart->visuals->optionsFix($className, $config);

echo $className::widget([
    'id' => $id,
    'data' => $data,
    'config' => $config,
    'model' => $model,
    'attribute' => $attribute,
]);
