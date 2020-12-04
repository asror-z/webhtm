<?php


use zetsoft\dbitem\core\WebItem;
use zetsoft\models\page\PageAction;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\former\ZDynaWidget;
use function mysql_xdevapi\getSession;

/** @var ZView $this */
$action = new WebItem();

$action->title = Azl . 'Веб-действия';
$action->csrf = false;

$this->paramSet(paramAction, $action);
if($this->sessionGet('viewed')) {
    $this->sessionDel('viewed');
}

return $this->urlRedirect(Az::$app->request->referrer);
