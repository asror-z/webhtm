<?php
use zetsoft\system\Az;
use zetsoft\system\kernels\ZView;

/** @var ZView $this */
Az::$app->controller->layout = 'login';


$action->icon =false;
$action->type = WebItem::type['html'];


$this->paramSet(paramIframe, true);

//require Root . '/webhtm\shop\bozor\login\vendor_register.php';
