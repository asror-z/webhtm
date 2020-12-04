<?php

/**
 * Author:  Asror Zakirov
 * https://www.linkedin.com/in/asror-zakirov
 * https://github.com/asror-z
 */

use zetsoft\dbitem\core\WebItem;
use zetsoft\models\dyna\DynaConfig;
use zetsoft\system\kernels\ZView;


/** @var ZView $this */


/**
 *
 * Action Params
 */

$action = new WebItem();

$action->title = Azl . 'Веб-действия';
$action->icon = 'fa fa-desktop';
$action->type = WebItem::type['html'];
$action->csrf = true;
$action->debug = false;



$this->paramSet(paramAction, $action);

$id = $this->httpGet('modelId');

$model = DynaConfig::findOne([
    'dynaId' => $id,
]);

$model->delete();
