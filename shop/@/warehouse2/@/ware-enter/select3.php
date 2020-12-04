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

    <style>
        .ZFileInputWidget_935154 {

        }

    </style>

    <?php

    require Root . '/webhtm/block/metas/main.php';
    require Root . '/webhtm/block/assets/main.php';

    $this->head();

    ?>

</head>


<body class="<?= ZWidget::skin['white-skin'] ?>">

<?php

$this->beginBody();

?>

    <div class="row">
        <div class="col-lg-4 selfColumn">


            <?php


            echo zetsoft\widgets\inputes\ZFileInputWidget::widget([

                'model' => new zetsoft\models\core\CoreInput(),
                'selector' => 'ZFileInputWidget_131633',
                'attribute' => 'jsonb_2',
                'config' => []
            ]);


            ?>

        </div>
        <div class="col-lg-4 selfColumn">


            <?php


            echo zetsoft\widgets\inputes\ZFileInputWidget::widget([

                'model' => new zetsoft\models\core\CoreInput(),
                'selector' => 'ZFileInputWidget_598073',
                'attribute' => 'jsonb_2',
                'config' => []
            ]);


            ?>

        </div>
        <div class="col-lg-4 selfColumn">


            <?php


            echo zetsoft\widgets\inputes\ZFileInputWidget::widget([

                'model' => new zetsoft\models\core\CoreInput(),
                'selector' => 'ZFileInputWidget_935154',
                'attribute' => 'jsonb_2',
                'config' => []
            ]);


            ?>

        </div>
    </div>


<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>
