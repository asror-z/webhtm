<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZFormBuildWidget;
use zetsoft\widgets\former\ZFormWidget;
use zetsoft\widgets\market\ZFooterAllWidgetOrg;
use zetsoft\widgets\menus\ZMmenuWidget;
use zetsoft\widgets\menus\ZMmenuWidgetSh;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;
use zetsoft\widgets\themes\ZCardWidget;
use zetsoft\models\user\UserCompany;


/** @var ZView $this */


/**
 *
 * Action Params
 */

$action = new WebItem();

$action->title = Azl . 'Создание Организации';
$action->icon = 'fa fa-desktop';
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



<?

require Root . '/webhtm/block/navbar/mainAdmin.php';
require Root . '/webhtm/block/menu/menu-m_old.php';

echo ZSessionGrowlWidget::widget();



?>
<nav id="menu"></nav>
<div id="page">
    <div id="content" class="content-footer p-3">

        <div class="row">
            <div class="col-md-12">

                <?php
                $model = $this->modelGet(UserCompany::class, $this->userIdentity()->id);

                if ($this->modelSave($model)) {
                    $this->urlRedirect('/seller/shop-catalog/index.aspx');
                }

                ZCardWidget::begin([
                    'config' => [
                        'title' => Az::$app->view->title,
                        'type' => ZCardWidget::type['dynCard'],

                    ]
                ]);

                $form = $this->activeBegin();

                echo ZFormBuildWidget::widget([
                    'model' => $model,
                    'form' => $form,
                    'config' => [
                    ]
                ]);
                $this->activeEnd();

                ZCardWidget::end();

                ?>

            </div>
        </div>

    </div>

</div>
<?php
echo ZFooterAllWidgetOrg::widget();
?>

<script>
    $(document).ready(function () {

        setTimeout(function () {
            $('.file-input .file-caption-main .btn-file ').addClass('p-2')
        },50)
    })
</script>

<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>
