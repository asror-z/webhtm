<?php

/**
 *
 *
 * Author:  Asror Zakirov
 * Date:    9/14/2019
 * https://www.linkedin.com/in/asror-zakirov
 * https://www.facebook.com/asror.zakirov
 * https://github.com/asror-z
 *
 */


use zetsoft\system\Az;
use zetsoft\system\kernels\ZView;

/** @var ZView $this */
Az::$app->controller->layout = 'login';


$action->icon =false;
$action->type = WebItem::type['html'];
$this->paramSet(paramIframe, true);
require 'login.php';



