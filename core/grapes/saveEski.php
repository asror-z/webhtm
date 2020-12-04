<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\models\page\PageAction;
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
$css = $this->httpPost('css');
$assets = $this->httpPost('assets');
//$asset = $this->httpPost('asset');

$css = str_replace(['"', ',', '<style>', '{', '}', ';'], ['', ';', "\n<style>\n", "{\n\t", "\n}\n", ";\n\t"], $css);


$service = Az::$app->smart->widget;
$PageAction = null;

if (!empty($actionId))
    $PageAction = PageAction::findOne($actionId);

$content = $service->pregMatchFix($data);

if ($PageAction)
    $content = $service->writeFile($PageAction, $content, $css);
else
    $content .= $css;

file_put_contents($file, $content);
