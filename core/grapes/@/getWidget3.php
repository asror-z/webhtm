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
use zetsoft\models\page\PageAction;
use zetsoft\models\core\CoreInput;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\helpers\ZVarDumper;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\former\ZFormWidget;


/** @var ZView $this */
$action = new WebItem();
$action = new WebItem();
$action->type = WebItem::type['ajax'];
$action->debug = false;


$service = Az::$app->smart->widget;
$widget = str_replace('/', '\\', $this->httpGet('param'));
$widgetObj = new $widget();
$options = $this->httpGet('ZDynamicModel') ?? $widgetObj->_config;

$configs = $service->settings($widget, $options);
$configs['grapesWrap'] = false;

echo $widget::widget($configs);
