<?php


use zetsoft\dbitem\core\WebItem;
use zetsoft\former\shop\ShopProductItemForm;
use zetsoft\models\core\CoreAdvancedItem;
use zetsoft\system\assets\ZColor;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZView;

use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\cards\ZAzCardWidget;
use zetsoft\widgets\cards\ZMyCardWidget;
use zetsoft\widgets\cards\ZProductCardWidget;
use zetsoft\widgets\cards\ZProductTabsOnlyWidget;
use zetsoft\widgets\market\ZFooterAllWidget;
use zetsoft\widgets\market\ZMenuWidgetAbdulloh;
use zetsoft\widgets\market\ZMSwiperDbWidget;
use zetsoft\widgets\market\ZMSwiperWidget;
use zetsoft\widgets\market\ZMyProductSummaryWidget;
use zetsoft\widgets\menus\ZSidebarWidget;
use zetsoft\widgets\navigat\ZButtonWidget;

/** @var ZView $this */



$action = new WebItem();

$action->title = Azl . Az::l('Избранные товары');
$action->icon = 'fa fa-heart';
$action->type = WebItem::type['html'];
$action->csrf = true;
$action->debug = true;




$this->paramSet(paramAction, $action);

$this->title();
$this->toolbar();

/** @var ZView $this */
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


require Root . '/webhtm/block/header/main.php';
require Root . '/webhtm/block/navbar/main.php';
require Root . '/render/menus/ZSidebarWidget/ready/main.php';

?>
<section class="menu">
    <div class="container-fluid">

        <div class="row ">
            <div class="col-xl-3 col-lg-4 media-category mt-3">
                <?
                echo zetsoft\widgets\market\ZMenuWidget::widget([
                    'config' => [
                        'open' => true,
                        //'name' => 'Категории',
                        'mode' => 'shop'
                    ],
                ]);

                ?>

            </div>
            <div class="col-xl-9 col-lg-8 my-3">
                <div class="d-block w-100">
                    <?
                        echo $this->require('/render/cards/ZListViewWidget/ready/tab_product.php');
                    ?>
                </div>
                <?

                  echo $this->require( '/webhtm/shop/user/session-wish/block/main.php');
                ?>


            </div>

        </div>

    </div>
</section>

<div class="mt-4">
    <?php
    echo ZFooterAllWidget::widget([

    ]);
    ?>
</div>
<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>


