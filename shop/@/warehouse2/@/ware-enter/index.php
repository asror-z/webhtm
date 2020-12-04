<?php

use Ratchet\App;
use zetsoft\dbitem\core\WebItem;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\menus\ZMmenuWidget;
use zetsoft\widgets\menus\ZMmenuWidgetSh;
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
        'all.border' => ZMMenuWidget::border['border-full'],
        'menu-effect-slide' => true,
    ],
]);
?>

<div id="page">

    <?

    require Root . '/webhtm/block/header/main.php';
    require Root . '/webhtm/block/navbar/admin.php';

    echo ZSessionGrowlWidget::widget();?>

    <div id="content" class="content-footer p-3">

        <div class="row">
            <div class="col-md-12">

                <?

                $model = new WareEnter();

                $model->columns();
                /** @var ZView $this */
                echo ZDynaWidget::widget([
                    'model' => $model,
                    'config' => [
                        'updateUrl' => '{fullUrl}/process.aspx?ware_enter_id={id}',

                        'spaArray' => [
                            'create' => true,
                            'update' => false
                        ],
                        
                        'spaHeight' => [
                            'create' => '550px',
                            'update' => '900px',
                            'view' => '750px',
                        ],
                        'actionButtons' => [
                            'update',
                            'delete',
                            'clone',
                            'view',
                        ],
                        'spaTitle' => [
                            'create' => Az::l('Создание поступления товаров в склад'),
                            'view' => Az::l('Просмотр поступления товаров в склад'),
                        ],
                        'columnBefore' => [
                            'serial',
                            'checkbox',
                            'action',
                        ],
                        'columnAfter' => false
                    ]
                ]);

                ?>

            </div>
        </div>


    </div>
    <? require Root . '\webhtm\block\footer\footerAdmin.php' ?>

</div>


<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>
