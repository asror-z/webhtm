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

$this->paramSet(paramAction, $action);

if ($this->sessionGet('filter'))
    $this->sessionDel('filter');

if ($this->sessionGet('brand_filter'))
    $this->sessionDel('brand_filter');


if ($this->sessionGet('price_filter'))
    $this->sessionDel('price_filter');

return $this->urlRedirect(Yii::$app->request->referrer);
