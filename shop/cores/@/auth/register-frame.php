<?php

use PHPUnit\Util\Log\JSON;
use yii\authclient\widgets\AuthChoice;
use yii\bootstrap4\Html;
use zetsoft\former\auth\AuthRegisterForm;
use zetsoft\models\user\User;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZHTML;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\former\ZFormWizardWidget;
use zetsoft\widgets\former\ZFormWidget;
use zetsoft\widgets\themes\ZCardWidget;
use zetsoft\widgets\themes\ZColWidget;
use zetsoft\widgets\themes\ZRowWidget;


/** @var ZView $this */

Az::$app->controller->layout = 'login';


$action->icon =false;
$action->type = WebItem::type['html'];

$this->paramSet(paramIframe, true);

require 'register.php';
