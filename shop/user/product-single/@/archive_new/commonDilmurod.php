<?php


use zetsoft\dbitem\shop\ProductItem;
use zetsoft\system\Az;
use zetsoft\widgets\market\ZZoomWpWidget;
use zetsoft\dbitem\core\WebItem;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;

/** @var ZView $this */
$action = new WebItem();

$action->title = Azl . 'Описание';
$action->icon = 'fa fa-area-chart';
$action->type = WebItem::type['html'];
$action->csrf = true;
$action->debug = true;

$action->cache = false;
$action->cacheHttp = false;

$this->paramSet(paramAction, $action);

$this->title();
$this->toolbar();

$product_id = $this->httpGet('id');

if ($product_id === null) {
    echo '<div class="text-muted">' . Az::l('Вам нужно перейти на эту страницу, выбрав определенный продукт. Пожалуйста, выберите продукт обратно на главную страницу.') . '</div>';
    return null;
}

/** @var ProductItem[] $product */

$product = Az::$app->market->product->product($product_id, null, true);
if ($product === null) {
    echo '<div class="text-muted">' . Az::l('В настоящее время невозможно отобразить информацию об этом продукте. Пожалуйста, вернитесь на домашнюю страницу и попробуйте выбрать продукт снова.') . '</div>';
    return null;
}

Az::$app->market->wish->writeViewed($product_id);

/** @var ZView $this */

$this->beginPage();
?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <?php
    require Root . '/webhtm/block/metas/main.php';
    require Root . '/webhtm/block/assets/main.php';
    $this->fileCss('/render/asrorz/css/loader.css');

    $this->head();
    ?>
</head>
<body class="<?= ZWidget::skin['white-skin'] ?>">
<?php
$this->beginBody();
require Root . '/webhtm/block/header/main.php';
require Root . '/webhtm/block/navbar/main.php';
echo $this->require( '/render/market/ZYandexSingleProductHeaderWidget/ready/single-product-header.php', [
    'product_id' => $product_id ?? ''
]);
?>

<div class="container-fluid">
    <?
    echo $this->require( '/webhtm/shop/user/product-single/block/yandexTab.php', [
        'id' => $product_id,
        'type' => 'product'
    ]);
    ?>


    <div class="row px-4">
        <div class="col-md-12">
            <div class="card-title">
                <div class="row p-1">
                    <div class="col-md-4 col-sm-12 pt-3">
                        <?php
                        echo ZZoomWpWidget::widget([
                            'data' => $product->images
                        ]);
                        ?>
                    </div>
                    <div class="col-md-8 col-sm-12">
                        <div class="row">
                            <div class="col-md-7 col-sm-12 my-3 overflow-hidden">
                                <div class="lds-roller"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
                                <div class="fp-26 text-center"><?php echo Az::l('Свойства продукта'); ?></div>
                                <?php
                                /*ZPropertyCheckWidget*/
                                echo $this->require( '/render/market/ZPropertyCheckWidget/ready/main.php', [
                                    'product' => $product
                                ]);
                                ?>
                            </div>

                            <div class="col-md-5 col-sm-12 my-3">
                                <div class="fp-26 text-center"><?php echo Az::l('Коротко о товаре'); ?></div>
                                <ul class="pl-1 my-3 mx-3">
                                    <?
                                    $count = 0;
                                    foreach ($product->properties as $key => $value):

                                        ?>

                                        <li class="font-weight-normal text-muted fp-16">
                                            <?= $value->name . ' - ';
                                            echo implode(', ', $value->items);
                                            ?>
                                        </li>

                                    <? endforeach; ?>
                                </ul>
                                <a href="<?= $product->categoryUrl ?>">
                                    <div style='height: 50px; background-image: url("<?= $product->brandImage ?>"); background-size: contain; background-repeat: no-repeat' class="brand-image"></div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 my-2">
                        <div class="font-weight-normal h3 d-flex justify-content-center my-3"><?= Az::l('Популярные предложения из магазинов'); ?></div>
                        <div id="market" class="d-flex row text-muted">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
echo $this->require( '/webhtm/block/SingleProduct/footer.php');
$this->endBody()
?>
</body>
</html>
<?php $this->endPage() ?>
<script>
    $('.lds-roller').hide()
</script>
