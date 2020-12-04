<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\models\core\CoreAdvancedItem;
use zetsoft\system\assets\ZColor;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZView;

use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\cards\ZAzCardWidget;
use zetsoft\widgets\cards\ZMyCardWidget;
use zetsoft\widgets\cards\ZMyCardWidget1;
use zetsoft\widgets\cards\ZMyCardWidgetDataTable_Axror;
use zetsoft\widgets\cards\ZMyCardWidgetDT;
use zetsoft\widgets\market\ZFooterAllWidget;
use zetsoft\widgets\market\ZMenuWidget;
use zetsoft\widgets\market\ZMenuWidgetAbdulloh;
use zetsoft\widgets\market\ZMSwiperDbWidget;
use zetsoft\widgets\market\ZMSwiperWidget;
use zetsoft\widgets\market\ZMyProductSummaryWidget;
use zetsoft\widgets\menus\ZSidebarWidget;
use zetsoft\widgets\navigat\ZButtonWidget;


/** @var ZView $this */
$action = new WebItem();

$action->title = Azl . Az::l('Корзина');
$action->icon = 'fa fa-area-chart';
$action->type = WebItem::type['html'];
$action->csrf = true;
$action->debug = false;



//todo: service call start
$products = Az::$app->market->cart->cartOrders();

//vdd($products);

$this->paramSet(paramAction, $action);
//todo: service call end

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
        <div class="col-md-12 col-lg-3 mt-3">
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
                <div class="col-12 mb-1 mt-3">
                    <?php //echo ZMyProductSummaryWidget::widget([
                    //                        'config' => [
                    //                            'deliveryPrice' => 1500
                    //                        ]
                    //                    ]); ?>
                </div>
            </div>
        </div>
        <div class="col-md-12 col-lg-9">
            <?
            /** @var ZView $this */
            $baseUrl = $this->urlGetBase();/*vdd($products)*/;
            $currentUrl = $this->urlParamStr . '.aspx';
            //vdd($products);
            if (!empty($products))
            {
                //WavWan Product wo`tdan kevoti
                echo ZMyCardWidgetDataTable_Axror::widget([
                    'config' => [

                    ]
                ]);

                $url = '/client/checkout/main.aspx';
                if ($this->userIsGuest())
                    $url = '/core/user/user-auth/login-register.aspx?redirectUrl=' . $currentUrl;

                echo ZButtonWidget::widget([
                    'config' => [
                        'target' => '_blank',
                        'url' => $url,
                        'btnStyle' => ZButtonWidget::btnStyle['btn-outline-success'],
                        'text' => Az::l('Оформить заказ'),
                        'class' => 'float-right mt-2 rounded',
                        'btnRounded' => false,
                    ]
                ]);
           }else
            {
            ?>
             <div class="mt-5">
                    <div class="text-center d-block">
                        <i class="fas fa-shopping-cart fa-10x text-light"></i>
                        <h3 class="mt-5 text-muted">
                            <?= Az::l('Ваша Корзина пуста') ?>
                        </h3>
                        <span class="mx-1 text-muted">
                            <?= Az::l('Отправляйтесь за покупками или') ?>
                        </span>
                        <a class="text-success" href="/core/user/user-auth/login-register.aspx">
                            <?= Az::l('авторизуйтесь') ?>
                        </a>
                        <span class="mx-1 text-muted">
                            <?= Az::l('чтобы увидеть уже добавленные товары.') ?>
                        </span><br><br>
                        <?

                        $url = $this->urlGetBase();
                        if ($this->userIsGuest())
                            $url = '/core/user/user-auth/login-register.aspx?redirectUrl=' . $currentUrl;

                        echo ZButtonWidget::widget([
                            'config' => [
                                'text' => 'Перейти к покупкам',
                                'color' => ZColor::color['green'],
                                'class' => 'ss',
                                'url' => $url,
                                'btnStyle' => ZButtonWidget::btnStyle['btn-success'],
                                'btnSize' => ZColor::btnSize['btn-md'],
                                'btnFontSize' => ZButtonWidget::btnScale['0.5'],
                                'btnRounded' => false,
                            ],
                        ]);
                        ?>
                    </div>
                </div>
            <?php  } ?>
        </div>
    </div>
</div>
<div class="mt-4">
    <?= ZFooterAllWidget::widget(); ?>
</div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>


<!--user/session-basket/main.aspx-->



