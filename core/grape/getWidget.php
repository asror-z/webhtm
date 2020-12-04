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
use zetsoft\dbitem\core\WebItem;
use zetsoft\models\page\PageAction;
use zetsoft\models\core\CoreInput;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\helpers\ZVarDumper;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\former\ZFormWidget;


$action = new WebItem();               
$action->title = Azl . 'Grapes';
$action->icon = 'fal fa-calendar-edit';
$action->type = WebItem::type['ajaxFilePreg'];
$action->csrf = true;
$action->cache = false;
$action->toolbar = false;
$action->debug = false;
$action->call = null;
$action->cacheHttp = false;

$this->paramSet(paramAction, $action);

$this->title();
$this->toolbar();
 
$service = Az::$app->App->eyuf->grape;

$widget = str_replace('/', '\\', $this->httpGet('param'));

$widgetObj = new $widget();
$options = $this->httpGet('ZDynamicModel') ?? $widgetObj->_config;

$getOpts = $this->httpGet('configs');
if (!empty($getOpts))
    $options = json_decode($getOpts, true, 512, JSON_THROW_ON_ERROR);

$configs = $service->getSettings($widget, $options);
$configs['grapesWrap'] = false;

$selector = $this->httpGet('blockId');

if ($selector)
    $configs['selector'] = $selector;

echo $widget::widget($configs);
