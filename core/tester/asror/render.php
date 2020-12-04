<?php


use zetsoft\system\Az;
use zetsoft\system\kernels\ZView;


/** @var ZView $this */
$this->debug(false);

$path = $this->httpGet('path');
$path = str_replace('.php', '', $path);

$file = Az::getAlias('@zetsoft/' . $path.'.php');
require $file;
/*


$this->render('@zetsoft/' . $path, [
]);

$this->render('@zetsoft/' . $path, [
]);
$this->renderPartial('@zetsoft/' . $path, [
]);
$this->renderPartial('@zetsoft/' . $path, [
]);*/
