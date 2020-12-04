<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\models\page\PageAction;
use zetsoft\system\helpers\ZStringHelper;
use zetsoft\system\kernels\ZView;
use zetsoft\system\Az;


$action = new WebItem();
$action->title = Azl . 'Grapes';
$action->icon = 'fal fa-calendar-edit';
$action->type = WebItem::type['ajax'];
$action->csrf = true;
$action->cache = false;
$action->toolbar = false;
$action->debug = false;
$action->call = null;
$action->cacheHttp = false;

$this->paramSet(paramAction, $action);

$this->title();
$this->toolbar();
$data = $this->httpPost('content');
$actionId = $this->httpPost('actionId');

$file = str_replace('/', '\\', $this->httpPost('file'));
$actions = $this->httpPost('actions');

$css = $this->httpPost('css');
$assets = $this->httpPost('assets');

$css = str_replace(['"', ',', '<style>', '{', '}', ';'], ['', ';', "\n<style>\n", "{\n\t", "\n}\n", ";\n\t"], $css);


$service = Az::$app->smart->widget;

$content = $service->pregMatchFix($data);

if (!ZStringHelper::find($file, '\render'))
    $content = $service->writeFileG($actions, $content, $css, $file);
else
    $content .= $css;

file_put_contents($file, $content);
