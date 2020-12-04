<?php

use Google\CRC32\PHP;
use zetsoft\dbitem\core\WebItem;
use yii\bootstrap\Html;
use zetsoft\dbitem\stats\AnalyticStatusItem;
use zetsoft\former\chart\ChartForm;
use zetsoft\former\chart\ChartFormAdmin;
use zetsoft\former\chart\ChartFormAnalytic;
use zetsoft\models\track\CpasTeaser;
use zetsoft\models\track\TizerTrackerStats;
use zetsoft\models\shop\ShopOrder;
use zetsoft\models\shop\ShopStatus;
use zetsoft\service\market\GuestStatistic;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\blocks\ZJqueryKnobWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\charts\ZChartFormWidget;
use zetsoft\widgets\charts\ZChartFormWidgetJaxongir;
use zetsoft\widgets\charts\ZChartJsPieWidget;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\inputes\ZKSelect2Widget;
use zetsoft\widgets\market\ZAnalyticsWidget;
use zetsoft\widgets\menus\ZMmenuWidget;
use zetsoft\widgets\menus\ZMmenuWidgetSh;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;
use zetsoft\models\shop\ShopBrand;
use zetsoft\widgets\themes\ZMarketAdminCardWidget;
use zetsoftspace\ZClassName;


/** @var ZView $this */


/**
 *
 * Action Params
 */

$action = new WebItem();

$action->title = Azl . Az::l('Редирект ...');
$action->icon = 'fa fa-globe';
$action->type = WebItem::type['html'];
$action->csrf = true;
$action->debug = false;
$action->cache = false;
$action->call = null;
$action->cacheHttp = false;
$this->paramSet(paramAction, $action);
$this->title();
$this->toolbar();

echo 'Redirecting...';
Az::$app->cpas->cpasStats->create();

