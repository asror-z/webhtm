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

use Illuminate\Support\Collection;
use zetsoft\dbitem\core\WebItem;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZView;

$action = new WebItem();

$action->title = Azl . 'Веб-действия';
$action->icon = 'fa fa-globe';
$action->type = WebItem::type['html'];
$action->csrf = false;
$action->debug = true;





$this->paramSet(paramAction, $action);

$this->title();
$this->toolbar();
$this->require('/webhtm/shop/blocks/404/infinite.php')
?>

<h1>404 not found</h1>
