<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\market\ZMenuWidget;
use zetsoft\widgets\menus\ZMmenuWidget;
use zetsoft\widgets\menus\ZMmenuWidgetSh;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;
use zetsoft\models\shop\ShopBrand;


/** @var ZView $this */


/**
 *
 * Action Params
 */
 
$action = new WebItem();

$action->title = Azl . 'Бренды';
$action->icon = 'fa fa-globe';
$action->type = WebItem::type['html'];
$action->csrf = true;
$action->debug = true;



$this->paramSet(paramAction, $action);

$this->title();
$this->toolbar();


//$boot->env('sphinxIP');

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

    require Root . '/webhtm/block/navbar/main.php';

    echo ZSessionGrowlWidget::widget();?>

    <div id="content" class="content-footer p-3">


 

        <div class="row">
            <div class="col-md-12">

                <?

                $model = new ShopBrand();

                /** @var ZView $this */
                echo ZDynaWidget::widget([
                    'model' => $model,
                ]);



                echo ZMMenuWidgetSh::widget([
             //    'data' => $this->cores->menus->create('mmenu'),
                    'config' => [
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
