<?php

use kcfinder\type_img;
use zetsoft\dbitem\core\WebItem;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\kernels\ZView;



$action = new WebItem();
$action->title = Azl . 'Grapes';
$action->icon = 'fal fa-calendar-edit';
$action->type = WebItem::type['ajax'];
$action->csrf = true;
$action->cache = false;
$action->toolbar = false;
$action->debug = false;
$action->call = null;
$action->cacheHttp = false;

$this->paramSet(paramAction, $action);

$this->title();
$this->toolbar();

$values = $this->httpPost('values');
$data = $this->httpPost('data');

foreach ($values as $value)  {
    ZArrayHelper::removeValue($data, $value);
}

echo json_encode($data);
