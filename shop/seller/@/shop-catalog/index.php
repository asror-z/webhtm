<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\system\module\Models;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\menus\ZMmenuWidget;
use zetsoft\widgets\menus\ZMmenuWidgetSh;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;
use zetsoft\models\shop\ShopCatalog;


/** @var ZView $this */


/**
 *
 * Action Params
 */

$action = new WebItem();

$action->title = Azl . 'Каталог магазина';
$action->icon = 'fa fa-laptop';
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

echo ZMmenuWidget::widget([
    //'data' => $this->cores->menus->create('mmenu'),
    'config' => [
        'theme' => 'white',
        'content.img.width' => 230,
        'iconbar.top' => [
            "<a href='#/'><i class='fa fa-home'></i>cc</a>",
            "<a href='#/'><i class='fa fa-home'></i>cc</a>",
        ],
        'iconbar.bottom' => [
            "<a href='#/'><i class='fa fa-home'></i>aa</a>",
            "<a href='#/'><i class='fa fa-home'></i>cc</a>",
        ],
        'all.border' => ZMmenuWidget::border['border-full'],
    ],
]);
?>

<div id="page">

    <?
    require Root . '/webhtm/block/header/main.php';

    require Root . '/webhtm/block/navbar/admin.php';


    /*  require Root . '/webhtm/block/navbar/main.php';
      require Root . '/webhtm/block/menu/menu-m.php';*/



    echo ZSessionGrowlWidget::widget();?>


    <!--<nav id="menu"></nav>
    <div id="page">
    -->
    <div id="content" class="content-footer p-3">


        <div class="row">
            <div class="col-md-12 col-12">

                <?


                $userCompanyID = $this->userIdentity()->user_company_id;
                if (empty($userCompanyID))
                    $userCompanyID = 4;


                /** @var Models $model */
                $model = new ShopCatalog();
                $model->configs->query = ShopCatalog::find()
                    ->where([
                        'user_company_id' =>  $userCompanyID
                    ]);

                $model->configs->readonly = [
                    'name',
                    'user_company_id',
                    'price_base',
                    'price_history',
                    'id'
                ];
                $model->configs->nameOff = [
                    'user_company_id',
                ];

                $model->columns();
                /** @var ZView $this */
                echo ZDynaWidget::widget([
                    'model' => $model,
                    'rightNameEx' => [
                        'system'
                    ],
                    'rightBtn' => [
                        'update' => [
                            'content' => '{update}',
                            'options' => ['class' => 'btn-group p-1 mr-0 {btnSize} {iconSize}']
                        ],

                        'add-clone-delete' => [
                            'content' => '{add}{clone}{delete}',
                            'options' => ['class' => 'btn-group p-1 mr-0 {btnSize} {iconSize}']
                        ],

                        'filter-sort-id' => [
                            'content' => '{dynagridFilter}{filter}{dynagridSort}{dynagridSettings}{dynagrid}',
                            'options' => ['class' => 'btn-group p-1 mr-0 {btnSize} {iconSize}']
                        ],

                        'export' => [
                            'content' => '{export}{exportAll}{exportExcel}',
                            'options' => ['class' => 'btn-group p-1 {btnSize} {iconSize}']
                        ],


                        'toggleData' => [
                            'content' => '{toggleData}',
                            'options' => ['class' => 'btn-group p-1 {btnSize} {iconSize}']
                        ],
                    ],
                    'config' => [
                        'columnBefore' => [
                            'serial',
                            'sort',
                            'radio',
                            'action',
                        ],
                        'spa' => false
                    ]

                ]);

                ?>

            </div>
        </div>


    </div>

<?
require Root . '\webhtm\block\footer\footerAdmin.php'
?>
</div>

<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>
