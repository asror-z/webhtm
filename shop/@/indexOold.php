<?php

use zetsoft\system\assets\ZColor;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\inputes\ZKRangeWidget;
use zetsoft\widgets\cards\ZMyCardWidget;
use zetsoft\widgets\cards\ZProductCardWidget;
use zetsoft\widgets\cards\ZProductTabsOnlyWidget;
use zetsoft\widgets\navigat\ZButtonWidget;

/*
 * Template
 * /render/market/XeMart%20-%20Ecommerce%20Template/html/04-category.html
 * */
/** @var ZView $this */
$this->title = Az::l('Избранные товары');
$action->icon = 'fa fa-heart';
//Az::$app->controller->layout = 'Main';
//
$this->pjaxBegin();
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
                <?

                $wishProducts =Az::$app->market->product->getWishProductItems();
                /** @var ZView $this */

                if ($wishProducts) {
                    ?>
                    <h5 class="text-green-main my-3 text-center">Список избранных товаров</h5>

                    <?
                    echo ZProductTabsOnlyWidget::widget(['model' =>Az::$app->market->product->getWishProductItems(),
                        'config' => [
                            'pager' => ZProductTabsOnlyWidget::type['scroll'],
                            'widget' => ZProductCardWidget::class ]]);

                } else {
                    ?>
                    <div class="mt-5">
                        <div class="text-center d-block">

                            <i class="far fa-heart fa-10x text-light"></i>

                            <h3 class="mt-5 text-muted">
                                <?=Az::l('Ваш список избранных товаров пуст,')  ?>
                            </h3>

                            <p class="text-muted">Добавьте товары в избранное, чтобы понравившиеся товары были всегда под
                                рукой.</p>
                            <br>

                            <?
                            echo ZButtonWidget::widget([
                                'config' => [
                                    'text' => 'Перейти к покупкам',
                                    'color' => ZColor::color['green'],
                                    'class' => '',
                                    'url' => '/shop/bozor/main/index.aspx',
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

    </div>
</section>


<?php $this->pjaxEnd();?>


