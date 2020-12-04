<?php

use rmrevin\yii\fontawesome\FA;
use zetsoft\dbitem\core\WebItem;
use zetsoft\models\core\CoreAdvancedItem;
use zetsoft\service\forms\ZPjax;
use zetsoft\system\assets\ZColor;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZView;

use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\cards\ZAzCardWidget;
use zetsoft\widgets\cards\ZMyCardWidget;
use zetsoft\widgets\cards\ZMyCardWidget1;
use zetsoft\widgets\cards\ZMyCardWidgetDataTable;
use zetsoft\widgets\cards\ZMyCardWidgetDT;
use zetsoft\widgets\market\ZFooterAllWidget;
use zetsoft\widgets\market\ZFooterAllWidgetOrg;
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
require Root . '/webhtm/block/header/mainM.php';
require Root . '/webhtm/block/navbar/main.php';
require Root . '/render/menus/ZSidebarWidget/ready/main.php';

?>

<div id="content" class="container-fluid">
    <div class="row">
        <div class="w-100 my-3 d-flex justify-content-end">
            <?
            if (!empty($products)) {

                echo $this->require( '/render/cards/ZModalWidget/ready/main.php');
            }
            ?>
        </div>
        <div class="col-lg-12">
            <?
            /** @var ZView $this */
            $baseUrl = $this->urlGetBase();
            $currentUrl = $this->urlParamStr . '.aspx';
            //vd($products);
            if (!empty($products)) {
                //WavWan Product wo`tdan kevoti
                $pjax = new ZPjax();
                $pjax->id = 'dataTableReload';
                $pjax->type = ZPjax::type['POST'];

                $this->pjaxBegin($pjax);
                echo ZMyCardWidgetDataTable::widget();
                $this->pjaxEnd();

                $url = '/shop/client/checkout/main.aspx';
                if ($this->userIsGuest())
                    $url = '/core/user/user-auth/login-register.aspx?redirectUrl=' . $currentUrl;

                echo ZButtonWidget::widget([
                    'config' => [
                        'target' => '_blank',
                        'url' => $url,
                        'btnStyle' => ZButtonWidget::btnStyle['btn-success'],
                        'text' => Az::l('Оформить заказ'),
                        'class' => 'float-right mt-2 rounded',
                        'btnRounded' => false,
                    ]
                ]);
            } else {
                ?>
                <div class="mt-5">
                    <div class="text-center d-block">
                        <i class="fas fa-shopping-cart fa-10x text-light"></i>
                        <h3 class="mt-5 text-muted">
                            <?= Az::l('Ваша Корзина пуста') ?>
                        </h3>
                        <span class="mx-1 text-muted">
                            <?= Az::l('Отправляйтесь за покупками') ?>
                        </span>
                        <?php if ($this->userIsGuest()) : ?>
                            <a class="text-success" href="/core/user/user-auth/login-register.aspx">
                                <?= Az::l('или авторизуйтесь') ?>
                            </a>
                        <?php endif ?>
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
            <?php } ?>
        </div>
    </div>
</div>
<div class="mt-4">
    <?= ZFooterAllWidgetOrg::widget(); ?>
</div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>


<!--user/session-basket/main.aspx-->



