<?php

use PHPUnit\Util\Log\JSON;
use yii\authclient\widgets\AuthChoice;
use yii\bootstrap4\Html;
use zetsoft\dbitem\core\WebItem;
use zetsoft\former\ALL\RegisterForm;

use zetsoft\system\Az;
use zetsoft\system\helpers\ZHTML;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\former\ZFormBuildWidget;
use zetsoft\widgets\former\ZFormWidget;
use zetsoft\widgets\themes\ZCardWidget;
use zetsoft\widgets\themes\ZColWidget;
use zetsoft\widgets\themes\ZRowWidget;


/** @var ZView $this */

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

require 'register.php';
