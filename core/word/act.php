<?php


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
$ids = ZArrayHelper::getValue($post, 'checkKeys');
$type = $this->httpGet('type');

$attr = $this->httpGet('attribute');
$val = $this->httpGet('value');

$modelClassName = $this->httpGet('modelClassName');
$requiredClassName = $this->httpGet('requiredClassName');
$modelClass = $this->bootFull($modelClassName);
$requiredClass = $requiredClassName?$this->bootFull($requiredClassName):null;


$path = '';
switch ($type){
    case 'multiGenerateAct':
        $path = Az::$app->office->wordpdf->multiGenerateAct($ids);
        Az::$app->office->wordpdf->changeStatus($ids,$modelClass,$attr,$val,$requiredClass);
        break;
    case 'multiRouteList':
        $path = Az::$app->office->wordpdf->multiRouteList($ids);
        Az::$app->office->wordpdf->changeStatus($ids,$modelClass,$attr,$val,$requiredClass);
        break;
    case 'multiContract':
        $path = Az::$app->office->wordpdf->multiContract($ids);
        break;
    case 'selectedCashTemplate':
        $path = Az::$app->office->wordpdf->selectedCashTemplate($ids);
        break;
    case 'multiBanderol':
        $path = Az::$app->office->wordpdf->multiBanderol($ids);
        Az::$app->office->wordpdf->changeStatus($ids,$modelClass,$attr,$val,$requiredClass);
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

//$this->urlRedirect($domain.$path,false);

