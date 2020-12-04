<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;



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
    .ZKSelect2Widget-26066{
	height: 70px;
	 background-color: rgb(255, 0, 0);
	
}
.ZFileInputWidget-9110{
	height:600px;
	background-color:#000000
}

</style>



<?php


echo zetsoft\widgets\inputes\ZKSelect2Widget::widget([
    
    'model' => new zetsoft\models\page\PageView(),
    'selector' => 'ZKSelect2Widget-58725',
    'attribute' => 'type',
    'config' => [
    'placeholder' => 'Тип',
    'theme' => 'bootstrap',
]  
]); 





echo zetsoft\widgets\inputes\ZKSelect2Widget::widget([
    
    'model' => new zetsoft\models\user\UserCompany(),
    'selector' => 'ZKSelect2Widget-26066',
    'attribute' => 'title',
    'config' => [
    'placeholder' => 'Подробное название',
]  
]); 





echo zetsoft\widgets\inputes\ZFileInputWidget::widget([
    
    'model' => new zetsoft\models\page\PageView(),
    'selector' => 'ZFileInputWidget-9110',
    'attribute' => 'name',
    'config' => [
    'placeholder' => 'Название',
    'maxFileCount' => '50',
]  
]); 


?>



