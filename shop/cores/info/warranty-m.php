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

$action->title = Azl . 'Гарантии';
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
            padding: 20px;
        }
    </style>
</head>


<body class="<?= ZWidget::skin['white-skin'] ?>">

<?php

$this->beginBody();

echo ZNProgressWidget::widget([]);

?>



    <?
    require Root . '/webhtm/block/navbar/main-m.php';
  /*  require Root . '/webhtm/block/menu/menu-m.php';*/


    echo ZSessionGrowlWidget::widget();?>



<div id="menu"></div>
<div id="page">
    <div id="content" class="content-footer p-3">
        <div class="row">
            <div class="col-xl-3 col-lg-4 col-md-4 col-sm-4 media-category ml-3 mt-3 mb-5">
                <?
                echo zetsoft\widgets\market\ZMenuWidget::widget([
                    'config' => [
                        'open' => true,
                        'mode' => 'shop'
                    ],
                ]);
                ?>
            </div>
            <div class="col-xl-8 col-lg-8">
                <h1 class="ml-3"><?= $action->title ?></h1>
                <hr size="0.5px" width="250px" align="left" color="#f5f2e9"/>
                  <?
                  $this->require('/webhtm/shop/cores/info/block/warrantyContent.php');
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

