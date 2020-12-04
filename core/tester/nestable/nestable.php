<?php

/**
 *
 *
 * Author:  Asror Zakirov
 * https://www.linkedin.com/in/asror-zakirov
 * https://github.com/asror-z
 *
 */


/** @var ZView $this */

use zetsoft\dbitem\core\WebItem;
use zetsoft\models\shop\ShopCategory;
use zetsoft\models\place\PlaceCountry;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZView;


$action = new WebItem();

$action->title = Azl . 'Создание Веб-действия';
$action->icon = 'fa fa-desktop';
$action->type = WebItem::type['html'];
$action->csrf = true;
$action->debug = true;



$this->paramSet(paramAction, $action);

$this->title();
$this->toolbar();

$className = str_replace('/','\\', $this->httpPost('modelClassName'));
Az::$app->menu->nestable->modelClassName = $className;
Az::$app->menu->nestable->parent = $this->httpGet('parent');
Az::$app->menu->nestable->sort = $this->httpGet('sort');
Az::$app->menu->nestable->setNestable($this->httpPost('data'));

$attribute = 'name';


?>

