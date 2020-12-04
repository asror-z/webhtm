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
    require Root . '/webhtm/block/assets/App/main_eyuf.php';

    $this->head();
    ?>

</head>

<body class="<?= ZWidget::skin['white-skin'] ?>">

<?php
$this->beginBody();
echo ZNProgressWidget::widget([]);
//require Root . '/webhtm/block/navbar/eyuf_navbar.php';
?>

<div id="page">

    <?
    echo ZSessionGrowlWidget::widget();
    require Root . '/webhtm/block/navbar/eyuf_navbar.php';
    ?>

    <div id="content" class="content-footer p-3">
        <div class="row">
            <div class="col-md-12 col-12">
                <?
                    require Root . $content;
                ?>
            </div>
        </div>
    </div>
</div>


<?php

 $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>
