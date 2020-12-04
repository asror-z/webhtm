<?php

/**
 * Author:  Asror Zakirov
 * https://www.linkedin.com/in/asror-zakirov
 * https://github.com/asror-z
 */

use zetsoft\dbitem\core\WebItem;
use zetsoft\system\kernels\ZView;

/** @var ZView $this */
$action = new WebItem();
$action->type = WebItem::type['ajax'];
$action->csrf = true;
$action->debug = false;
$action->cache = false;
$action->call = null;
$action->cacheHttp = false;

$this->paramSet(paramAction, $action);

$action->type = WebItem::type['ajax'];

$this->paramSet(paramAction, $action);

$this->fileJs('/render/ajaxify/ZInfinityScrollAjaxWidget/asset/main.js');

// vertical card
echo $this->require( '/render/cards/ZVMarketWidget/ready/main_row.php', [
    'item' => $item,
    'id' => $id ?? '',
    'isCommon' => false,
]);

// horizontal card
echo $this->require( '/render/cards/ZHCommonSaleWidget/ready/main.php', [
    'item' => $item,
    'id' => $id ?? '',
    'isCommon' => false,
]);
