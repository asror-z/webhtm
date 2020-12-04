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


$this->beginPage();
?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>

    <?php

   require Root . '/webhtm/block/metas/main.php';
   require Root . '/webhtm/block/assets/main.php';

    $this->head();
    $this->fileCss('/render/grapeAssets/menus/sideMenu/styleMenu.css');
    
    
    $this->fileJs('/render/grapeAssets/menus/sideMenu/jsMenu.js');




    ?>

</head>


<body class="<?= ZWidget::skin['white-skin'] ?>">

<?php

$this->beginBody();

echo ZNProgressWidget::widget([]);

?>


<div class="side_menu">
    <div class="burger_box">
        <div class="menu-icon-container">
            <a href="#" class="menu-icon js-menu_toggle closed">
				<span class="menu-icon_box">
					<span class="menu-icon_line menu-icon_line--1"></span>
					<span class="menu-icon_line menu-icon_line--2"></span>
					<span class="menu-icon_line menu-icon_line--3"></span>
				</span>
            </a>
        </div>
    </div>
    <div class="container">
        <h2 class="menu_title">Menu Title</h2>
        <ul class="list_load">
            <li class="list_item"><a href="#">List Item 01</a></li>
            <li class="list_item"><a href="#">List Item 02</a></li>
            <li class="list_item"><a href="#">List Item 03</a></li>
            <li class="list_item"><a href="#">List Item 04</a></li>
            <li class="list_item"><a href="#">List Item 05</a></li>
            <li class="list_item"><a href="#">List Item 06</a></li>
            <li class="list_item"><a href="#">List Item 07</a></li>
            <li class="list_item"><a href="#">List Item 08</a></li>
        </ul>
    </div>
</div>








<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>



