<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\market\ZFooterAllWidget;
use zetsoft\widgets\navigat\ZBreadcrumbsWidget;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;
use zetsoft\models\page\PageBlocks;


/** @var ZView $this */


/**
 *
 * Action Params
 */

$action = new WebItem();

$action->title = Azl . 'Оферта';
$action->icon = 'fa fa-industry';
$action->type = WebItem::type['html'];
$action->csrf = true;
$action->debug = true;



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

    $this->head();

    ?>
    <style>
        p {
            padding: 10px;
        }
    </style>
</head>


<body class="<?= ZWidget::skin['white-skin'] ?>">

<?php

$this->beginBody();
                    
echo ZNProgressWidget::widget([]);

?>

<div id="page">

    <?php

    echo ZSessionGrowlWidget::widget();?>

    <div id="content" class="content-footer p-3">
        <div class="row">
            <div class="col-xl-8 col-lg-8">
                <h1 class="text-center mt-lg-1 mt-0"><?= $action->title ?></h1>
                <?php
                    $this->require('/webhtm/shop/cores/info/block/ofertaContent.php');
                ?>


            </div>
        </div>


    </div>

</div>

<? echo ZFooterAllWidget::widget()?>
<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>
