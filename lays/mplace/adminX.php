<?php

use yii\web\View;
use zetsoft\dbitem\core\WebItem;
use zetsoft\models\App\eyuf\EyufScholar;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\former\ZFormBuildWidget;
use zetsoft\widgets\former\ZFormWidget;
use zetsoft\widgets\market\ZFooterAllWidgetOrg;
use zetsoft\widgets\menus\ZMmenuWidgetX;
use zetsoft\widgets\notifier\ZJspanelWidget;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;
use zetsoft\widgets\themes\ZCardWidget;
use zetsoft\models\shop\ShopOrder;


/** @var ZView $this */


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
    $this->fileCss('/render/asrorz/css/adminnn.css');
    $this->head();
    ?>

</head>


<body class="<?= ZWidget::skin['white-skin'] ?>" id="scrollbar">
<?php
$this->beginBody();
echo ZNProgressWidget::widget([]);

require Root . '/webhtm/block/navbar/adminNewD.php';

echo ZMmenuWidgetX::widget([
    'config' => [
        'isAll' => true,
        'content' => '',
        'pagedim' => ZMmenuWidgetX::pagedim['pagedim-white'],
        'theme' => ZMmenuWidgetX::theme['umidX'],
        'pageScroll.scroll' => false,
        'shadows' => ZMmenuWidgetX::shadows['shadow-page'],
    ]
]);

?>



<?php


echo ZSessionGrowlWidget::widget();


?>

<div id="page">


    <div id="content" class="content-footer p-3">
        <div class="row">
            <div class="col-md-12 col-12">
                <?
                echo $this->require($content);
                ?>
            </div>
        </div>
    </div>
</div>


<? require Root . '\webhtm\block\footer\footerAdminNewD.php'; ?>


<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>
