<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\models\ware\WareTrans;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\menus\ZMmenuWidgetSh;
use zetsoft\widgets\menus\ZMmenuWidgetSh_Axror;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;
use zetsoft\models\ware\WareEnter;


/** @var ZView $this */


/**
 *
 * Action Params
 */

$action = new WebItem();

$action->title = Azl . 'Поступление товаров в склад';
$action->icon = 'fal fa-film';
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
]);
?>

<div id="page">

    <?

/*    require Root . '/webhtm/block/navbar/main_Axror.php';*/
    require Root . '/webhtm/block/navbar/admin.php';
    echo ZSessionGrowlWidget::widget();/* echo ZMMenuWidgetSh::widget([
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
        ],
    ]);*/
/*    echo ZMmenuWidgetSh_Axror::widget([
        //    'data' => $this->cores->menus->create('mmenu'),
        'config' => [
            'theme'=> 'white',
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
        ],
    ]);*/
    ?>

    <div id="content" class="content-footer p-3">


        <div class="row">
            <div class="col-md-12">

                <?

                $model = new WareTrans();
                $model->configs->readonly = true;
                $model->columns();

                /** @var ZView $this */
                echo ZDynaWidget::widget([
                    'model' => $model,
                    'config' => [
                        'spa' => false,
                        'updateUrl' => 'process',
                        'columnBefore' => [
                            'serial',
                            'radio',
                        ],
                        'actionButtons' => [
                        ],
                    ]
                ]);

                ?>

            </div>
        </div>


    </div>

</div>


<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>
