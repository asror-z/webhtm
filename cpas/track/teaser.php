<?php
/** @var ZView $this */


use zetsoft\dbitem\core\WebItem;
use zetsoft\models\cpas\CpasStreamItem;
use zetsoft\models\cpas\CpasTracker;
use zetsoft\models\track\CpasStatistic;
use zetsoft\models\track\CpasTeaser;

//use zetsoft\models\track\TizerTrackerStats; // bu yoq ekan, shunga TrackStats ni uladik
use zetsoft\models\shop\ShopOrder;
use zetsoft\models\shop\ShopOrderItem;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
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
/*
 * http://194.58.120.82/Xv3B5y?keyword={categories}&cost=+{target.bid}&currency=usd&external_id={goal_tracking}&creative_id={banner.name}&ad_campaign_id={campaign.id}&source={SiteName}&sub_id_1={carrier}

 * */

$cpas_stream_item_id = ZArrayHelper::getValue($this->httpGet(), 'cpas_stream_item_id');

$track_id = Az::$app->cpas->cpasStats->createStats(true);

$model = CpasStreamItem::findOne($cpas_stream_item_id);

// return $url;

$link = "{$model->link}?subId=".$track_id;

//return $link;
return $this->urlRedirect($link);






