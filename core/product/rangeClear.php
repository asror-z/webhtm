<?php


use zetsoft\dbitem\core\WebItem;
use zetsoft\system\kernels\ZView;

/*  This will clear seesion of RangePicer in Filter - Javohir*/

/** @var ZView $this */
$action = new WebItem();

$action->csrf = true;
$action->debug = true;
$action->cache = false;
$action->call = null;
$action->cacheHttp = false;

/*$action->layout = true;
$action->layoutFile = 'admin';*/

$this->paramSet(paramAction, $action);


$this->paramSet(paramAction, $action);

if ($this->sessionGet('agentRangeDatePeriod'))
    $this->sessionDel('agentRangeDatePeriod');

if ($this->sessionGet('supervisorRangeDatePeriod2'))
    $this->sessionDel('supervisorRangeDatePeriod2');


if ($this->sessionGet('agent_status_worked'))
    $this->sessionDel('agent_status_worked');



/*
 if($this->sessionGet('rangeDatePeriod'))
    $this->sessionDel('rangeDatePeriod');
*/

//return $this->sessionGet('rangeDatePeriod');
