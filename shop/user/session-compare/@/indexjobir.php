<?php

use zetsoft\system\Az;
use zetsoft\widgets\market\ZCompareJobirWidget;
$this->title = Az::l('Сравнить');
$action->icon = 'fa fa-random';


echo ZCompareJobirWidget::widget([]);
