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

$action->title = Azl . 'Изменить данные Организации';
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
echo ZMMenuWidgetSh::widget([
    //'data' => $this->cores->menus->create('mmenu'),
    'config' => [
        'theme' => 'market',
        'content.img.width' => 80,
        'iconbar.top' => [
            "<a href='#/'><i class='fa fa-home'></i>cc</a>",
            "<a href='#/'><i class='fa fa-home'></i>cc</a>",
        ],
        'iconbar.bottom' => [
            "<a href='#/'><i class='fa fa-home'></i>aa</a>",
            "<a href='#/'><i class='fa fa-home'></i>cc</a>",
        ],
        'all.border' => ZMMenuWidgetSh::border['border-full'],
        'menu-effect-slide' => true,
    ],
])
?>


<div id="page">
<?
require Root . '/webhtm/block/navbar/admin.php';
/*require Root . '/webhtm/block/navbar/mainAdmin.php';
require Root . '/webhtm/block/menu/menu-m.php';*/

echo ZSessionGrowlWidget::widget();



?>
<nav id="menu"></nav>

    <div id="content" class="content-footer p-3">

        <div class="row">
            <div class="col-md-12">

                <?php
                $userCompanyID = $this->userIdentity()->user_company_id;
                if (empty($userCompanyID))
                    $userCompanyID = 4;

                $model = $this->modelGet(UserCompany::class, $userCompanyID);

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
                        'topBtn' => false,
                        'botBtn' => true,
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

<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>
