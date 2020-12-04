<?php

/**
 *
 * Author:  Asror Zakirov
 * https://www.linkedin.com/in/asror-zakirov
 * https://github.com/asror-z
 *
 */

use FontLib\Table\Type\name;
use zetsoft\dbitem\chat\ReviewItem;
use zetsoft\dbitem\core\WebItem;
use zetsoft\dbitem\shop\ProductItem;
use zetsoft\dbitem\shop\PropertyItem;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\navigat\ZYandexTabWidget;
use zetsoft\widgets\navigat\ZButtonWidget;
use zetsoft\widgets\notifier\ZModalWidgetD;

/** @var ZView $this */
$action = new WebItem();

$action->title = Azl . 'Отзывы';
$action->icon = 'fa fa-area-chart';
$action->type = WebItem::type['ajax'];
$action->csrf = true;
$action->debug = true;

$action->cache = false;
$action->cacheHttp = false;

$this->paramSet(paramAction, $action);

$this->title();
$this->toolbar();

$item = new ProductItem();


$product_id = $this->httpGet('id');


if ($product_id !== null)
    $reviews = Az::$app->market->review->getReviewByProductId($product_id);


if (!isset($reviews)) {
    $reviewItems = [];
    $reviewItem = new ReviewItem();
    $reviewItem->id = '20';
    $reviewItem->product_id = '10';
    $reviewItem->user_name = 'kennyS';
    $reviewItem->user_image = 'https://static-01.daraz.pk/p/83b3c9646204ea3de622893858c80f25.jpg';
    $reviewItem->text = ' Lorem ipsum dolor sit amet, consectetur adipisicing elit. Exercitationem inventore ipsa maiores officia possimus provident? Aspernatur culpa cupiditate distinctio, eius enim eos molestiae nisi odio perspiciatis placeat provident qui quibusdam reprehenderit soluta ullam, voluptas voluptatum? Aperiam maxime nesciunt odio vitae.';
    $reviewItem->photo = 'https://static-01.daraz.pk/p/83b3c9646204ea3de622893858c80f25.jpg';
    $reviewItem->rating = 3;
    $reviewItem->rating_option = 3;

    $reviewItem->isdislike = true;
    $reviewItem->islike = false;

    $reviewItems[] = $reviewItem;

}


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

<?
$this->beginBody();


require Root . '/webhtm/block/header/main.php';
require Root . '/webhtm/block/navbar/main.php';

?>

<div id="content" class="container-fluid">
    <?
    echo $this->require( '/render/market/ZYandexSingleProductHeaderWidget/ready/single-product-header.php');
    ?>
    <?php

    echo $this->require( '/webhtm/shop/user/product-single/block/yandexTab.php', [
        'id' => $product_id,
        'type' => 'product'

    ]);
    ?>
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-center">
                <?=
                ZButtonWidget::widget([
                    'config' => [
                        'text' => Az::l('Оставить Отзыв'),
                        'btnRounded' => false,
                        'btnStyle' => 'btn-outline-success',
                        'btnSize' => 'btn-sm',
                        'class' => 'small p-1 pl-2 pr-2'
                    ],
                    'event' => [
                        'click' =>  'function(){$("#form-modal").modal(\'show\')}',
                    ]
                ]);
                ?>
            </div>
        </div>
        <div class="col-12">

            <?php
            echo $this->require( '/webhtm/shop/user/item-review/review-product.php', ['product_id' => $product_id]);
            ?>

        </div>

    </div>
</div>

<div>
    <?=
    $this->require( '/webhtm/block/SingleProduct/footer.php');
    ?>
</div>



<?php


ZModalWidgetD::begin([
    'id' => 'form',
    'config'=>[
        'resetText' => 'Удалить',
        'submitText' => 'Добавить',
        'isBtn' => false,
    ],
]);

echo $this->require( '/webhtm/shop/user/item-review/review-product-new.php',
    ['product_id' => $product_id]);




ZModalWidgetD::end();?>

<?php $this->endBody() ?>

</body>
</html>
<?php $this->endPage() ?>








