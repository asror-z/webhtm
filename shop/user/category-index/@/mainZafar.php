<?php

use yii\widgets\Pjax;
use zetsoft\dbitem\core\WebItem;
use zetsoft\models\shop\ShopOrder;
use zetsoft\models\shop\ShopProduct;
use zetsoft\models\user\User;
use zetsoft\service\forms\Active;
use zetsoft\service\forms\Ajaxer;
use zetsoft\service\forms\ZPjax;
use zetsoft\system\assets\ZColor;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZInfinityScrollAjaxWidget;
use zetsoft\widgets\former\ZFormWidget;
use zetsoft\widgets\former\ZListViewWidget;
use zetsoft\widgets\inputes\ZKRangeWidget;
use zetsoft\widgets\market\ZFooterAllWidgetOrg;
use zetsoft\widgets\menus\MenuItemWidget;
use zetsoft\widgets\menus\ZMetisMenuWidget;
use zetsoft\widgets\market\ZMenuWidget;
use zetsoft\widgets\menus\ZSidebarWidget;
use zetsoft\widgets\navigat\ZBreadcrumbsWidget;
use zetsoft\widgets\navigat\ZButtonWidget;
use zetsoft\widgets\navigat\ZReadMoreWidget;

/** @var ZView $this */
$action = new WebItem();

$action->title = Azl . 'Категория';
$action->icon = 'fa fa-area-chart';
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

    $this->fileCss('/webhtm/shop/user/category-index/asset/cardCarouselStyles.css');
    $this->fileJs('/webhtm/shop/user/category-index/asset/cardCarouselJs.js');

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
$this->fileCss('/webhtm/shop/user/category-index/asset/style.css');
?>

<div class="my-4 px-5 container-fluid">
    <div class="row">
        <div class="fvw-4 text-black-75">Продукты</div>
    </div>
    <div class="row">
        <div class="col-3">
            <div>
                <div></div>
                <div>
                    <?
                    echo ZReadMoreWidget::widget()
                    ?>
                </div>
            </div>
        </div>






        <div class="col-9">
            <div class="">
                <div class="">
                    <img src="https://avatars.mds.yandex.net/get-market_banners/1100422/3549760_4.5391b7a54d719ae46c173f9cc627d842.png.3549760/orig" class="img-fluid" alt="Responsive image">
                </div>
                <div class="my-2 d-flex justify-content-left">
                    <img src="https://avatars.mds.yandex.net/get-market_banners/1100422/3549811_4.fe39244f78b23735cb4663243f3406f3.png.3549811/orig" class="img-fluid ml-2" alt="Responsive image" style="max-width: 20vw;">
                    <img src="https://avatars.mds.yandex.net/get-market_banners/1649576/3549812_4.b1efbe248cf4f1b1fb64283bc70291aa.png.3549812/orig" class="img-fluid ml-2" alt="Responsive image" style="max-width: 20vw;">
                    <img src="https://avatars.mds.yandex.net/get-market_banners/1531347/3549809_4.2e7e0bff299fc50a209e4e982f6c0967.png.3549809/orig" class="img-fluid ml-2" alt="Responsive image" style="max-width: 20vw;">
                </div>
            </div>
            <div class="my-5">
                <div class="fvw-2">Популярные категории</div>
                <div class="row">
                    <div class="col-3 px-1">
                        <div class="grey lighten-3 py-2 d-flex flex-column align-items-center" <!--style="max-width: 10vw;-->">
                        <img src="https://png2.cleanpng.com/sh/71a81b47bc11d41e3b4777ffebf71ef1/L0KzQYm3UsA0N5tvfZH0aYP2gLBuTgBtaaR5gdU2YnB3hL3sTgBwdKpqjNpEbHXxdX77hgJmeJl5gNN1YYToPcjolPVzNZN0ReJ1YYP3ebS0gv91fJ1qRadqN0W4SYGChcQya5c9RqMDNEa3QYWAUcUyP2c4Uas9NUm2RIW1kP5o/kisspng-plastic-bottle-polyethylene-terephthalate-water-bo-plastic-bottle-5a755909e41cf8.1846414715176399459344.png" class="img-fluid" alt="Responsive image" style="max-height: 10vw;">
                        <div class="text-dark my-3 fvw-2">Вода</div>
                    </div>
                </div>

                <div class="col-3 px-1">
                    <div class="grey lighten-3 py-2 d-flex flex-column align-items-center" <!--style="max-width: 10vw;-->">
                    <img src="https://png2.cleanpng.com/sh/71a81b47bc11d41e3b4777ffebf71ef1/L0KzQYm3UsA0N5tvfZH0aYP2gLBuTgBtaaR5gdU2YnB3hL3sTgBwdKpqjNpEbHXxdX77hgJmeJl5gNN1YYToPcjolPVzNZN0ReJ1YYP3ebS0gv91fJ1qRadqN0W4SYGChcQya5c9RqMDNEa3QYWAUcUyP2c4Uas9NUm2RIW1kP5o/kisspng-plastic-bottle-polyethylene-terephthalate-water-bo-plastic-bottle-5a755909e41cf8.1846414715176399459344.png" class="img-fluid" alt="Responsive image" style="max-height: 10vw;">
                    <div class="text-dark my-3 fvw-2">Вода</div>
                </div>
            </div>

            <div class="col-3 px-1">
                <div class="grey lighten-3 py-2 d-flex flex-column align-items-center" <!--style="max-width: 10vw;-->">
                <img src="https://png2.cleanpng.com/sh/71a81b47bc11d41e3b4777ffebf71ef1/L0KzQYm3UsA0N5tvfZH0aYP2gLBuTgBtaaR5gdU2YnB3hL3sTgBwdKpqjNpEbHXxdX77hgJmeJl5gNN1YYToPcjolPVzNZN0ReJ1YYP3ebS0gv91fJ1qRadqN0W4SYGChcQya5c9RqMDNEa3QYWAUcUyP2c4Uas9NUm2RIW1kP5o/kisspng-plastic-bottle-polyethylene-terephthalate-water-bo-plastic-bottle-5a755909e41cf8.1846414715176399459344.png" class="img-fluid" alt="Responsive image" style="max-height: 10vw;">
                <div class="text-dark my-3 fvw-2">Вода</div>
            </div>
        </div>

        <div class="col-3 px-1">
            <div class="grey lighten-3 py-2 d-flex flex-column align-items-center" <!--style="max-width: 10vw;-->">
            <img src="https://png2.cleanpng.com/sh/71a81b47bc11d41e3b4777ffebf71ef1/L0KzQYm3UsA0N5tvfZH0aYP2gLBuTgBtaaR5gdU2YnB3hL3sTgBwdKpqjNpEbHXxdX77hgJmeJl5gNN1YYToPcjolPVzNZN0ReJ1YYP3ebS0gv91fJ1qRadqN0W4SYGChcQya5c9RqMDNEa3QYWAUcUyP2c4Uas9NUm2RIW1kP5o/kisspng-plastic-bottle-polyethylene-terephthalate-water-bo-plastic-bottle-5a755909e41cf8.1846414715176399459344.png" class="img-fluid" alt="Responsive image" style="max-height: 10vw;">
            <div class="text-dark my-3 fvw-2">Вода</div>
        </div>
    </div>

</div>
</div>
<div>
    <div class="h3">Рис в больших упаковках</div>
    <div class="" style="max-width: 20vw;">
        <img src="https://avatars.mds.yandex.net/get-mpic/1045304/img_id285200754012233766.png/9hq" class="card-img-top" alt="...">
        <div class="card-body">
            <div class="h4">от 432 000 сум</div>
            <a href="" class="h5">Рис Мистраль Кубань белый круглозерный Expert 5 кг</a>
        </div>
    </div>
</div>
<div>

    <?
    echo $this->require( '/webhtm/shop/user/category-index/block/cardCarousel.php');

    ?>

</div>
</div>
</div>
</div>










<div class="mt-4">
    <?= ZFooterAllWidgetOrg::widget(); ?>
</div>
<?php $this->endBody() ?>
<?/*=
$this->require( '/webhtm/block/SingleProduct/footer.php');
*/?>

</body>
</html>

<?php
$this->endPage()
?>
