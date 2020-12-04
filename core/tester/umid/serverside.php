<?php

/**
 *
 *
 * Author:  Asror Zakirov
 * https://www.linkedin.com/in/asror-zakirov
 * https://github.com/asror-z
 *
 */

use zetsoft\former\ALL\AzimForm;
use zetsoft\models\place\PlaceCountry;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\inputes\ZHInputWidget;
use zetsoft\widgets\inputes\ZIconPickerWidget;
use zetsoft\widgets\inputes\ZKSelect2Widget;

$action->type = WebItem::type['ajax'];


$properties = $this->httpPost('ZDynamicModel');
Az::$app->market->product->setFilter($properties);






