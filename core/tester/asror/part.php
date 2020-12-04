<?php

use zetsoft\system\Az;
use zetsoft\system\kernels\ZView;

$action = new WebItem();
$action->debug = false;
$action->icon = 'fa fa-cropLength';
$this->csrf = true;
$action->type = WebItem::type['ajax'];::type['part'];

$path = $this->httpGet('path');

$action->title = Azl . $path;
$path = str_replace('.php', '', $path);

$file = Az::getAlias('@zetsoft/' . $path.'.php');
require $file;
