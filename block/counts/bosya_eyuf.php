<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;

// Uses

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
$action->loader = false;
$action->cacheHttp = false;

/**@var ZView $this */


$this->paramSet(paramAction, $action);

/**
 *
 * Start Page
 */

?>
<style>
    
</style>

<div class="col-lg-4 selfColumn">

<?php


echo zetsoft\widgets\inputes\ZKSelect2Widget::widget([
    
    'model' => new zetsoft\models\core\CoreInput(),
    'selector' => 'ZKSelect2Widget_845389',
    'attribute' => 'string_2',
    'config' => [
    'placeholder' => 'Стринг 2',
]  
]); 


?>

</div>
<div class="col-lg-4 selfColumn">

<?php


echo zetsoft\widgets\inputes\ZKSelect2Widget::widget([
    
    'model' => new zetsoft\models\core\CoreInput(),
    'selector' => 'ZKSelect2Widget_910670',
    'attribute' => 'string_2',
    'config' => [
    'placeholder' => 'Стринг 2',
]  
]); 


?>

</div>
<div class="col-lg-4 selfColumn">

<?php


echo zetsoft\widgets\inputes\ZKSelect2Widget::widget([
    
    'model' => new zetsoft\models\core\CoreInput(),
    'selector' => 'ZKSelect2Widget_295867',
    'attribute' => 'string_2',
    'config' => [
    'placeholder' => 'Стринг 2',
]  
]); 


?>

</div>

