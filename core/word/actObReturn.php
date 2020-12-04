<?php

/**
 *
 * @author OtabekNosirov
 * @author JaloliddinovSalohiddin
 * @author AkromovAzizjon
 *
 * Word Pdf generatsiyasi uchun @api
 *
 * /shop/complect/on-complect/index.aspx#
 * /shop/admin/ware-send/index.aspx#
 * /shop/admin/ware-return/index.aspx#
 */
 
use zetsoft\dbitem\core\WebItem;
use zetsoft\former\chart\ChartForm;
use zetsoft\former\order\OperatorForm;
use zetsoft\former\order\OrderForm;
use zetsoft\former\order\PayBackCCForm;
use zetsoft\former\order\PortionFormForm;
use zetsoft\former\reports\ReportsCourierForm;
use zetsoft\former\reports\ReportsSoldProductsForm;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\charts\ZChartFormWidget;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\themes\ZCardWidget;

/** @var ZView $this */
$action = new WebItem();

$action->csrf = true;
$action->debug = true;
$action->cache = false;
$action->call = null;
$action->cacheHttp = false;

$action->type = WebItem::type['ajax'];

$this->paramSet(paramAction, $action);

$post = $this->httpPost();
$ids = [$this->httpGet('id')];
$type = $this->httpGet('type');

$attr = $this->httpGet('attribute');
$val = $this->httpGet('value');

$modelClassName = $this->httpGet('modelClassName');
$requiredClassName = $this->httpGet('requiredClassName');
$modelClass = $this->bootFull($modelClassName);
$requiredClass = $this->bootFull($requiredClassName);

$path = '';
switch ($type){
    case 'multiGenerateAct':
        $path = Az::$app->office->wordpdf->multiGenerateAct($ids);
        Az::$app->office->wordpdf->changeStatus($ids,$modelClass,$attr,$val,$requiredClass);
        break;
    case 'multiRouteList':
        $path = Az::$app->office->wordpdf->multiRouteList($ids);
        break;
    case 'multiContract':
        $path = Az::$app->office->wordpdf->multiContract($ids);
        break;
    case 'selectedCashTemplate':
        $path = Az::$app->office->wordpdf->selectedCashTemplate($ids);
        break;
    case 'multiBanderol':
        $path = Az::$app->office->wordpdf->multiBanderol($ids);
        break;
    case 'selectedReturnCash':
        $path = Az::$app->office->wordpdf->selectedReturnCash($ids);
        break;
    case 'selectedReturnProduct':
        $path = Az::$app->office->wordpdf->selectedReturnProduct($ids);
        break;
}
$domain = $this->urlGetBase();

echo $domain.$path;

//return $this->urlRedirect($path,false);

