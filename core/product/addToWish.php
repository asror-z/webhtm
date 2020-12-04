<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZView;

/** @var ZView $this */
$action = new WebItem();

$action->debug = false;
$action->csrf = false;
$action->type = WebItem::type['ajax'];


$this->paramSet(paramAction, $action);


$this->title();
$this->toolbar();

$product_id = $this->httpGet('product_id');
 Az::$app->market->wish->writeWish($product_id);



/*if ($this->sessionGet('wishList') !== null)
    echo count($this->sessionGet('wishList'));
else
    echo 0;*/



//Az::$app->market->product->inWish($product_id);

//return $this->sessionGet('wishList');






