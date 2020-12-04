<?php


use zetsoft\dbitem\core\WebItem;
use zetsoft\models\dyna\DynaFilter;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\kernels\ZView;


$action = new WebItem();

$action->csrf = true;
$action->debug = true;
$action->cache = false;
$action->call = null;
$action->cacheHttp = false;

$this->paramSet(paramAction, $action);

/** @var ZView $this */
$attributeValue = $this->httpGet('attributes');
$this->sessionSet('filterAttributes', $attributeValue);






