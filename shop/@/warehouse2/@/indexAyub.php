<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;
use zetsoft\models\ware\Ware;



/** @var ZView $this */


/**
 *
 * Action Params
 */
 
$action = new WebItem();

$action->title = Azl . 'Склады';
$action->icon = 'fal fa-graduation-cap';
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

</head>


<body class="<?= ZWidget::skin['white-skin'] ?>">

<?php

$this->beginBody();

echo ZNProgressWidget::widget([]);

?>

<div id="page">

    <?

    require Root . '/webhtm/block/navbar/mainAdmin.php';
    require Root . '/webhtm/block/menu/menu-m_old.php';

    echo ZSessionGrowlWidget::widget();?>

    <div id="content" class="content-footer p-3">


 

        <div class="row">
            <div class="col-md-12 col-12">

                <?

                $model = new Ware();

                /** @var ZView $this */
                echo ZDynaWidget::widget([
                    'model' => $model,
                ]);

                ?>

            </div>
        </div>


    </div>

</div>

<?

require(Root . '/webhtm/block\footer\mplace\footerAll.php')

?>

<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>
