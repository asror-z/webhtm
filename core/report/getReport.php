<?php

/**
 *
 * @author OtabekNosirov
 * @author JaloliddinovSalohiddin
 * @author AkromovAzizjon
 *
 * /shop/admin/universal-report/index.aspx
 *
 */

use zetsoft\dbitem\core\WebItem;
use zetsoft\former\order\PayBackCCForm;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZView;

/** @var ZView $this */
$action = new WebItem();

$action->csrf = true;
$action->debug = true;
$action->cache = false;
$action->call = null;
$action->cacheHttp = false;
$action->type = WebItem::type['ajax'];

$this->paramSet(paramAction, $action);

$report = $this->httpGet('report');

$model = new PayBackCCForm();

$data = Az::$app->market->order->payBackCallCenter();

$title = 'Выкупы для Колл-Центр';

/*switch ($report){
    case 'income':
        $model = new ReportsSoldProductsForm();
        $data = Az::$app->market->universal-report->soldProductsReport();
        $title = 'Расчёт прибыли';
       break;
    case 'courierreport':
        $model = new ReportsCourierForm();
        $data = Az::$app->market->universal-report->courierReport();
        $title = 'Отчёт по курьерам';
        break;
    case 'acceptcourier':
        $model = new OrderForm();
        $data = Az::$app->market->universal-report->getAcceptanceFromCourier();
        $title = 'Приёмка от курьера';
        break;
    case 'operators':
        $model = new OperatorForm();
        $data = Az::$app->market->shipment->getOperators();
        $title = 'Отчет по операторам';
        break;
    case 'portionorder':
        $model = new PortionFormForm();
        $data = Az::$app->market->order->getPortionOrder();
        $title = 'Проверка порции заказов';
        break;
    case 'pay-backs':
        $model = new PayBackCCForm();
        $title = 'Выкупы для Колл-Центр';
        $data = Az::$app->market->order->payBackCallCenter();
        break;
}*/


$path = $this->urlGetBase();

switch ($report) {
    //start: universal-report
    case 'income':
        $path .= '/shop/admin/universal-report/income.aspx';
        break;
    case 'courier-report':
        $path .= '/shop/admin/universal-report/courier-report.aspx';
        break;
    case 'accept-courier':
        $path .= '/shop/admin/universal-report/accept-courier.aspx';
        break;
    case 'operators':
        $path .= '/shop/admin/universal-report/operators.aspx';
        break;
    case 'portion-order':
        $path .= '/shop/admin/universal-report/portion-order.aspx';
        break;
    case 'pay-backs':
        $path .= '/shop/admin/universal-report/pay-backs.aspx';
        break;

    case 'skd-dailyreport':
        $path .= '/shop/admin/universal-report/skd-dailyreport.aspx';
        break;

    case 'order-report':
        $path .= '/shop/admin/universal-report/order-report/index.aspx';
        break;

    case 'catalog-ware':
        $path .= '/shop/admin/universal-report/catalog-ware/index.aspx';
        break;

    case 'company-order':
        $path .= '/shop/admin/universal-report/company-order.aspx';
        break;
    //end universal-report

    //start: daily-report
    case 'daily-report':
        $path .= '/core/dynagrid/chess_view.aspx?id=2&sort=attr5';
        break;
    //end daily-report /core/dynagrid/chess_view.aspx?id=2
}
 
echo $path;


