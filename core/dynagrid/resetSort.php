<?php

/**
 * Author:  Asror Zakirov
 * https://www.linkedin.com/in/asror-zakirov
 * https://github.com/asror-z
 */

use zetsoft\dbitem\core\WebItem;
use zetsoft\models\dyna\DynaConfig;
use zetsoft\models\dyna\DynaFilter;
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

$id = $this->httpGet('dynaId');
$name = $this->httpGet('name');
$url = $this->httpGet('pageUrl');

$model = DynaFilter::find()
    ->where([
        'dynaId' =>  $id,
        'type' => 'sort',
        'name' => $name,
    ])
    ->one();

$model->delete();

return $this->urlRedirect($url);
