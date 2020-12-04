<?php
/** @var ZView $this */


use zetsoft\dbitem\core\WebItem;
use zetsoft\models\track\CpasStatistic;
use zetsoft\models\track\CpasTeaser;
//use zetsoft\models\track\TizerTrackerStats; // bu yoq ekan, shunga TrackStats ni uladik
use zetsoft\models\shop\ShopOrder;
use zetsoft\models\shop\ShopOrderItem;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZView;


$action = new WebItem();
$action->type = WebItem::type['ajax'];
$action->csrf = false;
$action->debug = false;
$action->cache = false;
$action->call = null;
$action->cacheHttp = false;

$this->paramSet(paramAction, $action);

$this->title();
$this->toolbar();
//return $this->httpGet();
$url = Az::$app->cpas->cpasStats->createStats();
return $url;






