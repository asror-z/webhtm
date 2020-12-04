<?php

/**
 *
 *
 * Author:  Asror Zakirov
 * https://www.linkedin.com/in/asror-zakirov
 * https://github.com/asror-z
 *
 */
use zetsoft\system\Az;
use zetsoft\widgets\former\ZDynaWidgetX10052020;
use zetsoft\widgets\inputes\ZInputWidget;
use zetsoft\widgets\places\ZYandexWidgetX;

Az::$app->controller->layout = 'test3';
echo ZYandexWidgetX::widget();
