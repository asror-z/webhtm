<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZView;

/** @var ZView $this */
$action = new WebItem();

$action->csrf = true;
$action->debug = true;
$action->cache = false;
$action->call = null;
$action->cacheHttp = false;

$this->paramSet(paramAction, $action);

$action->type = WebItem::type['html'];

$this->paramSet(paramAction, $action);

$agentId = $this->httpGet('agentId');

$callFrom = $this->httpGet('callFrom');

    
if(!empty($agentId) && $callFrom !== 'manual')
    Az::$app->market->operator->setAgentStatus($agentId, 'process');
else
    return false;
