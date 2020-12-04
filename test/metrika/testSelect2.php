<?php


use zetsoft\dbitem\core\WebItem;
use zetsoft\models\dyna\DynaStats;
use zetsoft\system\actives\ZActiveRecord;
use zetsoft\system\helpers\ZUrl;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\former\ZCheckRedirectWidget;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\navigat\ZButtonWidget;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;

$action = new WebItem();

$action->title = Azl . 'Страны';
$action->icon = 'fal fa-landmark';
$action->type = WebItem::type['html'];
$action->csrf = true;
$action->debug = false;


$this->paramSet(paramAction, $action);


$this->title();
$this->toolbar();


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


    /** @var ZView $this */
    //$this->fileCss('/block/assets/ALL/all.css');

    $this->head();

    ?>

    <title></title>
</head>

<body class="<?= ZWidget::skin['white-skin'] ?>">

<?php

$this->beginBody();

?>

<div id="page">

    <?

    echo ZSessionGrowlWidget::widget();?>



    <button type="button" class="btn btn-primary btn-lg" data-toggle="popover-x" data-target="#myPopover1" data-placement="top">Top</button>
    <div id="myPopover1a" class="popover popover-x popover-primary">
        <div class="arrow"></div>
        <div class="popover-header popover-title"><button type="button" class="close" data-dismiss="popover-x">&times;</button>Title</div>
        <div class="popover-body popover-content">
            <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.</p>
        </div>
    </div>

        <div id="page">


        </div>

    </div>

    <?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>
