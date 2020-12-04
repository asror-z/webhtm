<?php

use zetsoft\models\place\PlaceCountry;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\inptest\ZKSelect2AjaxWidget;
use zetsoft\widgets\inputes\ZKSelect2Widget;




/** @var ZView $this */
$action = new WebItem();

$this->title = Az::l('Веб-действия');
$action->type = WebItem::type['ajax'];
$action->icon =1;

return 'hello';
