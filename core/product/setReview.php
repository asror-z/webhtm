<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZView;

/** @var ZView $this */

$action = new WebItem();
$action->title = Azl . 'Веб-действия';
$action->icon = 'fa fa-bar-chart';
$action->csrf = true;
$action->debug = true;



$this->paramSet(paramAction, $action);


$action->type = WebItem::type['ajax'];
$review = $this->httpGet("reviewId");
$text = $this->httpGet("text");
echo Az::$app->market->review->SetByReviewId($review,$text);
