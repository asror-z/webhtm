<?php


use PHPUnit\Util\Log\JSON;
use zetsoft\dbitem\core\WebItem;
use zetsoft\models\page\PageAction;
use zetsoft\models\shop\ShopCategory;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZVarDumper;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\market\ZDilshodBoxWidget;
use zetsoft\widgets\market\ZProductCardWidget;


/** @var ZView $this */

$action = new WebItem();
$action->type = WebItem::type['ajax'];
$action->debug = false;
$action->csrf = true;

$this->paramSet(paramAction, $action);



$seletedId = $this->httpPost('depend');
$data = Az::$app->market->address->getRegionByCountry($seletedId);

echo json_encode($data);
