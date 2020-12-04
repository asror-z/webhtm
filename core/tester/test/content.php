<?php

use yii\debug\Module;
use zetsoft\dbitem\core\WebItem;
use zetsoft\models\test\TestAsror;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZInfinityScrollAjaxWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\market\ZFooterAllWidget;
use zetsoft\widgets\market\ZMSwiperWidget;
use zetsoft\widgets\navigat\ZButtonWidget;
use zetsoft\widgets\navigat\ZShowMoreWidget;
use zetsoft\widgets\notifier\ZJspanelWidget;

/** @var ZView $this */
$action = new WebItem();

$action->title = Azl . 'Главная страница';
$action->icon = 'fa fa-area-chart';
$action->type = WebItem::type['html'];
$action->csrf = true;
$action->debug = true;

$action->cache = false;

$action->call = [];

$action->cacheHttp = false;


$this->paramSet(paramAction, $action);
$this->title();
$this->toolbar();

$model = new TestAsror();

echo ZDynaWidget::widget([
   'model' => $model
]);
