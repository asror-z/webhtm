<?php


use zetsoft\dbitem\core\WebItem;
use zetsoft\former\chart\ChartForm;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\charts\ZChartFormWidget;
use zetsoft\widgets\themes\ZCardWidget;

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
$day = $this->httpGet('day');
$user_company_id = $this->httpGet('companyId');

$forms = Az::$app->market->order->getOrderStatsByStatus($day, $user_company_id)['forms'];


ZCardWidget::begin([
    'config' => [
        'type' => ZCardWidget::type['dynCard'],
        'hasTitle' => false
    ]
]);

echo ZChartFormWidget::widget([
    'data' => $forms,
    'model' => new ChartForm(),
    'config' => [
        'title' => Azl . ('Активные заказы за ' . $day . ' дней'),
        'type' => ZChartFormWidget::type['lineStack'],
        'theme' => ZChartFormWidget::theme['shine']
    ]
]);

ZCardWidget::end();
