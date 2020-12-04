<?php

use zetsoft\system\Az;
use zetsoft\system\kernels\ZView;

$action = new WebItem();
$action->debug = false;
Az::$app->controller = 'test3';

$path = $this->httpGet('path');
$path = str_replace('.php', '', $path);

$file = Az::getAlias('@zetsoft/' . $path.'.php');
require $file;
