<?php

use zetsoft\models\page\PageAction;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZView;

/** @var ZView $this */

$data = $this->httpPost('pcontent');
$actionId = $this->httpPost('actionId');
$file = str_replace('/', '\\', $this->httpGet('file'));

$PageAction = PageAction::findOne(3171);

if(!empty($actionId) && $actionId !== null)
    $PageAction = PageAction::findOne($actionId);


$pregService = Az::$app->utility->pregs;

//LINKS
$content = $pregService->pregReplace($data, '<link[^>]*>+', '');
//STYLES
$content = $pregService->pregReplace($content, '<style[^>]*>(?:[^<]+|<\/style>)+', '');
//SCRIPTS
$content = $pregService->pregReplace($content, '<script[\s\S]*?>[\s\S]*?<\/script>', '');

//FIX
$content = $pregService->pregReplace($content, '<!--BEGIN(.|\s)*?END-->', '');

$content = str_replace(["\n\n\n", '<!--', '-->', '><'], ['', "\n\n<?php\n", "\n?>\n\n", ">\n<"], $content);

$content = $pregService->pregReplace($content, ".*?'grapesWrap'\n*.*?\n*=>\n*.*?\n*false,", '');

$content = $pregService->pregReplace($content, "\?>\W\s*?<\?php", '');


if ($PageAction)
    $content = Az::$app->smart->widget->writeFile($PageAction, $content);


file_put_contents($file, $content);
