<?php

use yii\web\View;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;


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
    if (!$this->httpGet('spa')) {
        echo ZSessionGrowlWidget::widget();
        require Root . '/webhtm/block/navbar/eyuf_navbar.php';
    }


    ?>

    <div id="content" class="content-footer p-3">
        <div class="row">
            <div class="col-md-12 col-12">
                <?

                if ($this->checked())
                    echo $this->require($content);
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
