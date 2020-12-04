<?php

use yii\widgets\Pjax;
use zetsoft\dbitem\core\WebItem;
use zetsoft\former\shop\ShopProductItemForm;
use zetsoft\system\assets\ZColor;use zetsoft\system\Az;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\cards\ZMyCardWidget;
use zetsoft\widgets\cards\ZProductCardWidget;
use zetsoft\widgets\cards\ZProductTabsOnlyWidget;
use zetsoft\widgets\inputes\ZKRangeWidget;
use zetsoft\widgets\market\ZCompareJobirWidget;
use zetsoft\widgets\market\ZFooterAllWidget;
use zetsoft\widgets\market\ZMegaMenuWidget;
use zetsoft\widgets\market\ZMenuWidget;
use zetsoft\widgets\menus\ZMetisMenuWidget;
use zetsoft\widgets\menus\ZSidebarWidget;
use zetsoft\widgets\navigat\ZButtonWidget;



/** @var ZView $this */
$action = new WebItem();

$action->title = Azl . Az::l('Недавно просмотренные');
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


    $this->head();

    ?>

</head>
<body class="<?= ZWidget::skin['white-skin'] ?>">
<?php

$this->beginBody();


require Root . '/webhtm/block/navbar/main-m.php';
require Root . '/webhtm/block/menu/menu-m_old.php';


?>

<section class="menu">
    <div class="container">
        <div class="row">
            <div class="col-lg">

                <?php
                echo ZProductTabsOnlyWidget::widget([
                     'data' =>Az::$app->market->product->getProductItemForm(35),
                    'model' => new ShopProductItemForm(),
                    'config' => [
                        'pager' => ZProductTabsOnlyWidget::type['scroll'],
                        'widget' => ZProductCardWidget::class,

                    ]]);

                $items = Az::$app->market->product->getViewedProductItems();
                foreach ($items as $item)
                    echo $this->require( '/render/cards/ZVMarketWidget/ready/main.php', [
                        'item' => $item
                    ]);

                ?>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <?
                $products = Az::$app->market->product->getCompareProductItems();
                /** @var ZView $this */
                $baseUrl = $this->urlGetBase();
                if ($products) {
                    echo ZCompareJobirWidget::widget([
                        'config'=>[
                            'borderColor'=>'border-success',
                            'selectColor' => '#00c851',
                            'br-color' => '#00c851',



                        ]]);
                    //echo ZMyCardWidget::widget(['config' => []]);
                } else {
                    ?>
                    <div class="my-5">
                        <div class="text-center d-block">

                            <!--<img width="200" class="img-fluid mx-auto d-block"
                                 src="/render/images/ZHImgWidget/demo/asset/shopping-cart.gif">-->
                            <i class="fas fa-history fa-10x text-light" aria-hidden="true"></i>


                            <h3 class="mt-5 text-muted">
                                <?=Az::l('Нет просмотренныx товаров')  ?>
                            </h3>

                            <span class="mx-1 text-muted">
                                <?= Az::l('Отправляйтесь за покупками или авторизуйтесь чтобы увидеть уже просмотренные товары.') ?>
                             </span><br>
                            <br>
                            <?
                            echo ZButtonWidget::widget([
                                'config' => [
                                    'text' => 'Перейти к покупкам',
                                    'color' => ZColor::color['green'],
                                    'class' => 'ss',
                                    'url' => '/shop/user/main/index.aspx',
                                    'btnStyle' => ZButtonWidget::btnStyle['btn-success'],
                                    'btnSize' => ZColor::btnSize['btn-md'],
                                    'btnFontSize' => ZButtonWidget::btnScale['0.5'],
                                    'btnRounded' => false,
                                ],

                            ]); ?>
                        </div>
                    </div>
                    <?
                }
                ?>
            </div>
        </div>
        <div class="row">
            <div id="contento" class="mb-3">
                <?
                Pjax::begin();
                if($this->sessionGet('viewed')){
                    echo ZButtonWidget::widget( [
                        'config' => [
                            'btnStyle' => ZButtonWidget::btnStyle['btn-success'],
                            'btnRounded' => false,
                            'text' =>  Az::l('Очистить список'),
                            'url' =>  '/core/product/clearViewedSession.aspx',
                        ],
                    ]);
                }
                Pjax::end();
                ?>
            </div>
        </div>
    </div>
</section>


<?php
echo ZFooterAllWidget::widget([]);
?>

<?php $this->endBody() ?>
</body>
</html>

<?php $this->endPage() ?>
