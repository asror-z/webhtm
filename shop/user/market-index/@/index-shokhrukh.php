<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZInfinityScrollAjaxWidget;
use zetsoft\widgets\ajaxify\ZInfinityScrollAjaxWidgetShokhrukh;
use zetsoft\widgets\inputes\ZKRangeWidget;
use zetsoft\widgets\market\ZFooterAllWidgetOrg;
use zetsoft\widgets\menus\MenuItemWidget;


/** @var ZView $this */
$action = new WebItem();

$action->title = Azl . 'Компании';
$action->icon = 'fa fa-area-chart';
$action->type = WebItem::type['html'];
$action->csrf = true;
$action->debug = true;



$this->paramSet(paramAction, $action);

$this->title();

$this->toolbar();


/** @var ZView $this */
$items = Az::$app->market->product->allCompanies();

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
<body class="<?= ZWidget::skin['white-skin'] ?> borderzz">
<?php

$this->beginBody();

require Root . '/webhtm/block/header/main.php';
require Root . '/webhtm/block/navbar/main.php';
require Root . '/render/menus/ZSidebarWidget/ready/main.php';

?>


<?
$this->fileCss('/webhtm/shop/user/market-index/asset/style.css')
?>
<div class="container-fluid mt-1 bg-white">

    <div id="contento" class="row">
        <div class="col-lg-12 col-md-12 color-sm-12 col-12">
            <div class="d-flex">
                <div class="col-lg-3 col-md-3 col-sm-12 col-12 mr-5 mt-4">
                    <?

                    echo zetsoft\widgets\market\ZMenuWidget::widget([
                        'config' => [
                            'open' => true,
                            'mode' => 'shop',


                        ],
                    ]);
                    ?>
                </div>
                <div class="col-lg-9 col-md-9 col-sm-12 p-0 ml-lg-n5 col-12">

                    <h3 class="text-center mt-2">Компании</h3>
                    <div class="d-flex flex-wrap">
                        <?

                        foreach ($items as $item) {
                            echo $this->require( '/render/cards/ZVMarketWidget/ready/cardCompanyShokhrukh.php', [
                                'item' => $item,
                                'col'=>3
                            ]);
                        }
                       ?>
                       
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<div class="mt-4">
    <?= ZFooterAllWidgetOrg::widget(); ?>
</div>
<?php $this->endBody() ?>
</body>
</html>

<?php
$this->endPage()
?>
