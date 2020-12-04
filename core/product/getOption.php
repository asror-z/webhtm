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

$seletedId = $this->httpPost('depend');
$model = $this->httpPost('dependModel');
$column = $this->httpPost('dependAttr');
$data = Az::$app->market->product->getOptionsByCategory($seletedId);
//return $data;
  vdd($data);
