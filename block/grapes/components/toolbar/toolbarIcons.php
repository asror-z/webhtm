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
    $this->fileCss('/render/grapeAssets/styleComponents/toolbarIcons.css');
    $this->fileCss('https://fonts.googleapis.com/icon?family=Material+Icons');


    ?>
</head>


<body class="<?= ZWidget::skin['white-skin'] ?>">

<?php

$this->beginBody();

echo ZNProgressWidget::widget([]);

?>
    <div id="toolbar">
        <div class="button"></div>
        <ul class="icons">
            <li><i class="fa fa-home fa-2x" aria-hidden="true"></i></li>
            <li><i class="fa fa-user fa-2x" aria-hidden="true"></i></li>
            <li><i class="fa fa-star fa-2x" aria-hidden="true"></i></li>
            <li><i class="fa fa-file-text-o fa-2x" aria-hidden="true"></i></li>
            <li><i class="fa fa-paper-plane-o fa-2x" aria-hidden="true"></i></li>
        </ul>
    </div>

<?php $this->endBody() ?>
<script>
    $( ".button" ).click(function() {
        $(this).toggleClass( "active" );
        $(".icons").toggleClass( "open" );

    });
</script>
</body>
</html>

<?php $this->endPage() ?>



