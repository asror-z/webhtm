<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\widgets\inputes\ZPeriodPickerWidget;

$action = new WebItem();

$action->title = Azl. 'My Blog';
$action->icon = 'fa fa-globe';
$action->type = WebItem::type['html'];
$action->csrf = true;
$action->debug = true;


echo ZPeriodPickerWidget::widget([

]);


