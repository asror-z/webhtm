<?php

/**
 *
 *
 * Author:  Asror Zakirov
 * https://www.linkedin.com/in/asror-zakirov
 * https://github.com/asror-z
 *
 */

use zetsoft\dbitem\core\WebItem;
use zetsoft\dbitem\App\eyuf\CheckboxItem;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\actions\ZSortSelectableWidget;
use zetsoft\widgets\incores\ZMCheckboxWidget;
use zetsoft\widgets\inputes\ZBootstrapItemRadioGroupWidget;


$action = new WebItem();

$action->csrf = true;
$action->debug = true;
$action->cache = false;
$action->call = null;
$action->cacheHttp = false;

$this->paramSet(paramAction, $action);

$action->type = WebItem::type['ajax'];


$checkboxItems = [];
$checkboxItem = new CheckboxItem();
$checkboxItem->icon = '<img width="60" height="auto" src="https://www.calc.ru/imgs/articles/596-3dd4436d599fdf830a5f8ea45495b4ed.jpg" alt="sum">';
$checkboxItem->title = '';
$checkboxItem->text = 'Наличный расчет';
$checkboxItems [] = $checkboxItem;

$checkboxItem = new CheckboxItem();
$checkboxItem->icon = '<img width="60" height="auto" src="https://www.norma.uz/img/3a/fe/b41dfe1a1e097ca094dd632f32fa.png" alt="sfasf">';
$checkboxItem->title = '';
$checkboxItem->text = 'UzCard tooltip';
$checkboxItems [] = $checkboxItem;

$checkboxItem = new CheckboxItem();
$checkboxItem->icon = '<img width="60" height="auto" src="https://nuz.uz/uploads/posts/2019-04/thumbs/1555519524_9832b1e7d050fdec979807eaa4da.jpg" alt="sfasf">';
$checkboxItem->title = '';
$checkboxItem->text = 'Humo tooltip';
$checkboxItems [] = $checkboxItem;
$product = '';

/** @var ZView $this */
$id = $this->httpGet('id');

$items = Az::$app->market->cart->cartOrders($id, true);

echo $this->require( '/webhtm/shop/client/checkout/blocks/companies.php', ['items' => $items]);
?>

