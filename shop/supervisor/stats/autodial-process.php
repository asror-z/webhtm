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


$this->paramSet(paramAction, $action);

$type = $this->httpGet('type');

switch (true) {

    case $type === 'restart':
        Az::$app->calls->marceAMI->restartAutodial();
        break;
        
    case $type === 'start':
        Az::$app->calls->marceAMI->startAutodial();
        break;
        
    case $type === 'exit':
        Az::$app->calls->marceAMI->exitAutodial();
    break;
    
}






