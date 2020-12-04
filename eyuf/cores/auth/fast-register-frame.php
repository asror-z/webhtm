<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\former\ALL\RegisterForm;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\former\ZFormBuildWidget;
                                                              

/** @var ZView $this */

//Az::$app->controller->layout = 'login';


$action = new WebItem();

$action->title = Azl . 'Регистрация в интранет системе EYUF';
$action->icon = 'fal fa-print';


$action->layout = true; $action->debug = false;
$action->layoutFile = 'login2';
$action->cache = false;

$action->call = null;
$this->paramSet(paramAction, $action);

$this->title();
$this->toolbar();
$this->paramSet(paramIframe, true);


require 'register.php';
