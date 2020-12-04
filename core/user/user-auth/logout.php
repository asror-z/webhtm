<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\system\Az;


$action = new WebItem();

$action->title = Azl . 'Logout';
$action->icon = 'fa fa-globe';
$action->type = WebItem::type['html'];
$action->csrf = true;
$action->debug = true;



$this->paramSet(paramAction, $action);

$this->title();
$this->toolbar();
Az::$app->cores->auth->logout();
return $this->urlRedirect('/core/user/user-auth/loginCRM.aspx');



                                    
