<?php


use zetsoft\dbitem\core\WebItem;
use zetsoft\models\App\eyuf\EyufReport;
use zetsoft\system\kernels\ZWidget;
use yii\web\View;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZViewWidget;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;


$action = new WebItem();

$action->title = Azl . 'eyuf';
$action->icon = 'fal fa-print';
$action->type = WebItem::type['html'];
$action->csrf = true;
$action->debug = true;


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
    ?>

    <div id="content" class="content-footer p-3">
        <div class="row">
            <div class="col-md-12 col-12">

                <?


                $id = $this->httpGet('id');

                if (empty($id))
                    return null;

                $model = EyufReport::findOne($id);

                echo ZViewWidget::widget([
                    'model' => $model,
                ]);
                ?>


            </div>
        </div>


    </div>
</div>
</div>
</div>


<?php


$this->endBody()

?>

</body>
</html>

<?php $this->endPage() ?>

