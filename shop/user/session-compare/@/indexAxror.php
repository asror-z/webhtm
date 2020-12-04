<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\system\assets\ZColor;use zetsoft\system\Az;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\inputes\ZSelect2Widget;
use zetsoft\widgets\market\ZCompareJobirWidget;
use zetsoft\widgets\market\ZFooterAllWidget;
use zetsoft\widgets\market\ZMegaMenuWidget;
use zetsoft\widgets\market\ZMenuWidget;
use zetsoft\widgets\menus\ZSidebarWidget;
use zetsoft\widgets\navigat\ZButtonWidget;



/** @var ZView $this */
$action = new WebItem();

$action->title = Azl . Az::l('Сравнить');
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
require Root . '/webhtm/block/header/main.php';
require Root . '/webhtm/block/navbar/main.php';
require Root . '/render/menus/ZSidebarWidget/ready/main.php';

?>
<div class="container-fluid">
    <div class="row">

        <div class="col-3 mt-3">
            <div class="row">
                <div class="col-12">
                    <?
                        echo ZMenuWidget::widget([
                            'config' => [
                                'open' => true,
                                //'name' => 'Категории',
                                'mode' => 'shop'
                            ],
                        ]);
                    ?>
                </div>
            </div>
        </div>

<div class="col-9 mx-auto">

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
                        <i class="fas fa-retweet fa-10x text-light" aria-hidden="true"></i>


                        <h3 class="mt-5 text-muted">
                            <?=Az::l('Нет выбранных товаров')  ?>
                        </h3>

                        <span class="mx-1 text-muted">
                                <?= Az::l('Добавьте товары в список для сравнения одинаковых категорий товаров.') ?>
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


</div>
<div class="mt-3">
    <?php
    echo ZFooterAllWidget::widget([

    ]);
    ?>
</div>

<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>
