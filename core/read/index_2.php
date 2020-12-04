<?php

use yii\web\NotFoundHttpException;
use zetsoft\dbitem\core\WebItem;
use zetsoft\models\test\TestTerrabayt;
use zetsoft\system\helpers\ZInflector;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\menus\ZMmenuWidget;
use zetsoft\widgets\menus\ZMmenuWidgetSh;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;
use zetsoft\models\user\User;


/** @var ZView $this */


/**
 *
 * Action Params
 */

$action = new WebItem();

$action->title = Azl . 'Потребности';
$action->icon = 'fal fa-graduation-cap';
$action->type = WebItem::type['html'];
$action->csrf = true;

if ($this->httpGet('spa'))
    $action->debug = true;



$this->paramSet(paramAction, $action);

$this->title();
$this->toolbar();
/**
 *
 * Start Page
 */

$modelClassName = $this->bootFullUrl();

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
//if (!$this->httpGet('spa'))
//    echo ZMmenuWidget::widget();
//?>

<div id="page">

    <?
    if (!$this->httpGet('spa'))
        require Root . '/webhtm/block/navbar/admin.php';

 
    ?>

    <div id="content" class="content-footer p-3">


        <div class="row">
            <div class="col-md-12 col-12">

                <?
             
                ?>

            </div>
        </div>


    </div>
    <!-- --><? /*= $this->require( '/webhtm\block\footer\mplace\footerAll.php') */ ?>
</div>


<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>
