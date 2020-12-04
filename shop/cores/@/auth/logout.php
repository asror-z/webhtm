<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\system\Az;

$action = new WebItem();

$action->title = Azl . 'Веб-действия';

$action->icon = 'fa fa-bar-chart';
$action->csrf = true;
$action->debug = true;




$action->type = WebItem::type['ajax'];

$this->paramSet(paramAction, $action);

if (Az::$app->cores->auth->logout()) {
    $this->urlRedirect($this->urlGetBase());
}

return null;



                                    
