<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\inputes\ZKSelect2Widget;
use zetsoft\widgets\inputes\ZSelect2Widget;

/** @var ZView $this */

/**
 *
 * Action Params
 */


$action = new WebItem();
$action->title = Azl . Az::l('create');
$action->icon = 'fal fa-calendar-edit';
$action->type = WebItem::type['html'];
$action->csrf = 1;
$action->cache = false;
$action->toolbar = false;
$action->debug = false;
$action->call = null;
$action->cacheHttp = false;

/**@var ZView $this */

$this->paramSet(paramAction, $action);
/**
 *
 * Start Page
 */


?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">


</html>


