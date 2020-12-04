<?php


use zetsoft\dbitem\core\WebItem;
use zetsoft\models\page\PageAction;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\former\ZDynaWidget;
/*  This will clear seesion of RangePicer in Filter - Javohir*/
/** @var ZView $this */
$action = new WebItem();

$action->csrf = true;
$action->debug = true;
$action->cache = false;
$action->call = null;
$action->cacheHttp = false;

$this->paramSet(paramAction, $action);

$action->type = WebItem::type['ajax'];

$this->paramSet(paramAction, $action);

if($this->sessionGet('stat_status'))
    $this->sessionDel('stat_status');

/*
 if($this->sessionGet('rangeDatePeriod'))
    $this->sessionDel('rangeDatePeriod');
*/

return $this->sessionGet('stat_status');
