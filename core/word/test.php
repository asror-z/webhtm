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



$this->paramSet(paramAction, $action);

$post = $this->httpPost();
$ids = [
    1888
];




$modelClassName = 'ShopOrder';
$requiredClassName = $this->httpGet('requiredClassName');
$modelClass = $this->bootFull($modelClassName);
$requiredClass = $this->bootFull($requiredClassName);

$path = Az::$app->office->wordpdf->universalDocument($ids, 'multiContract');
/*
if ($type === 'multiGenerateAct')
    Az::$app->office->wordpdf->changeStatus($ids, $modelClass, $attr, $val, $requiredClass);*/


$domain = $this->urlGetBase();

$this->urlRedirect($path);


//return $this->urlRedirect($path, false);

