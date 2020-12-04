<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZFormBuildWidget;
use zetsoft\widgets\former\ZFormWidget;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;
use zetsoft\widgets\themes\ZCardWidget;
use zetsoft\models\shop\ShopOrder;


/** @var ZView $this */


/**
 *
 * Action Params
 */
 
$action = new WebItem();

$action->title = Azl . 'Создание Заказы';
$action->icon = 'fal fa-money-check-edit-alt';
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

require Root . '/webhtm/block/navbar/mainAdmin.php';
require Root . '/webhtm/block/menu/menu-m_old.php';


echo ZNProgressWidget::widget([]);

?>



    <?



    echo ZSessionGrowlWidget::widget();?>
<nav id="menu"></nav>
<div id="page">
    <div id="content" class="content-footer p-3">

        <div class="row">
            <div class="col-md-12">

                <?


                $id = $this->httpGet('id');
                $model = new ShopOrder();

                if ($this->modelSave($model))
                {

                    /**
                     *
                     * Post save Actions
                     */
                    $model->place_region_id = $this->userIdentity()->place_region_id;
                    $this->urlRedirect(['index', true]);
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
                        'topBtn' => false,
                        'botBtn' => true
                    ]
                ]);

                $this->activeEnd();

                ZCardWidget::end();

                ?>

            </div>
        </div>


    </div>

</div>


<?
echo $this->require( '/webhtm\block\footer\mplace\footerAll.php');
?>

<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>
