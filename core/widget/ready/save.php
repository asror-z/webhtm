<?php

use zetsoft\models\page\PageAction;
use zetsoft\system\kernels\ZView;

/** @var ZView $this */
$data = $this->httpPost('pcontent');
$actionId = $this->httpPost('actionId');
$file = str_replace('/', '\\', $this->httpGet('file'));
$PageAction = PageAction::findOne($actionId);

$content = Az::$app->utility->pregs->pregReplace($data, '<link[^>]*>+', '');

$content = Az::$app->utility->pregs->pregReplace($content, '<style[^>]*>(?:[^<]+|<\/style>)+', '');

$content = Az::$app->utility->pregs->pregReplace($content, '<script[\s\S]*?>[\s\S]*?<\/script>', '');

$content = Az::$app->utility->pregs->pregReplace($content, '<!--BEGIN(.|\s)*?END-->', '');

/*$content =  Az::$app->utility->pregs->pregMatchAll($content, '<div([^>]*?)(class=".*?")(\/?)>');*/

$content = str_replace(['<!--', '-->'], ["\n\n<?php\n\n", "\n\n?>\n\n"], $content);



$fileContent = Az::$app->smart->widget->writeFile($PageAction, $content);

file_put_contents($file, $fileContent);
