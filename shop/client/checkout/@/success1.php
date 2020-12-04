<?php

use rmrevin\yii\fontawesome\FA;
use zetsoft\dbitem\core\WebItem;
use zetsoft\dbitem\data\TabItem;
use zetsoft\dbitem\shop\ProductItem;
use zetsoft\dbitem\shop\SingleProductItem;
use zetsoft\former\shop\ShopOrderItemDForm;
use zetsoft\former\shop\ShopOrderForm;
use zetsoft\models\place\PlaceAdress;
use zetsoft\models\shop\ShopOrder;
use zetsoft\models\user\User;
use zetsoft\service\forms\Active;
use zetsoft\service\forms\Ajaxer;
use zetsoft\system\assets\ZColor;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\helpers\ZUrl;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\former\ZDatatableWidgetNew;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\former\ZFormWidget;
use zetsoft\widgets\incores\ZMCheckboxWidget;
use zetsoft\widgets\inputes\ZHCheckboxWidget;
use zetsoft\widgets\market\ZFooterAllWidget;
use zetsoft\widgets\market\ZFooterAllWidgetOrg;
use zetsoft\widgets\market\ZInputSpinnerWidget;
use zetsoft\widgets\navigat\ZButtonWidget;
use zetsoft\widgets\navigat\ZOrderStatusWidget;
use zetsoft\widgets\navigat\ZOrderStatusWidget1;
use zetsoft\widgets\notifier\ZSweetAlert2Widget;
use zetsoft\widgets\themes\ZCardWidget;


/** @var ZView $this */

$action = new WebItem();

$action->title = Azl . 'Проверка покупки';
$action->icon = 'fa fa-area-chart';
$action->type = WebItem::type['html'];
$action->csrf = true;
$action->debug = true;

$action->cache = false;

$action->call = [
//    TagDependency::invalidate()
];
$action->cacheHttp = false;

$this->paramSet(paramAction, $action);

$this->title();
$this->toolbar();

/** @var ZView $this */


$this->beginPage();
?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" xmlns="http://www.w3.org/1999/html">
<head>
    <?php

    require Root . '/webhtm/block/metas/main.php';
    require Root . '/webhtm/block/assets/main.php';

    $this->head();

    ?>


</head>
<body class="<?= ZWidget::skin['white-skin'] ?>">

<?php

$baseUrl = $this->urlGetBase();
$this->beginBody();
require Root . '/webhtm/block/navbar/main.php';


?>

<?
$userId = $this->userIdentity()->id;
$orderId = $this->httpGet('id');

/** @var ShopOrder $model */
$model = ShopOrder::find()->where(['user_id' => $userId])->one();

$orderItems = Az::$app->market->order->OrderItemsList(196);

$orderStatus = Az::$app->market->order->getOrderStatus(169);

$tabItems = [];
$tabItem = new TabItem();
$tabItem->title = Az::l('Принят');
$tabItem->step = 1;
$tabItem->active = $orderStatus === ShopOrder::status_client['accepted'];
$tabItem->icon = 'fal fa-vote-yea fa-2x';
$tabItems[] = $tabItem;

$tabItem2 = new TabItem();
$tabItem2->label = Az::l('Формируется');
$tabItem2->step = 2;
$tabItem2->active = $orderStatus === ShopOrder::status_client['forming'];
$tabItem2->icon = 'fal fa-spinner fa-2x';
$tabItems[] = $tabItem2;

$tabItem3 = new TabItem();
$tabItem3->label = Az::l('Доставляется');
$tabItem3->step = 3;
$tabItem3->active = $orderStatus === ShopOrder::status_client['delivering'];
$tabItem3->icon = 'fal fa-truck fa-2x';
$tabItems[] = $tabItem3;

$tabItem4 = new TabItem();
$tabItem4->label = Az::l('Доставлено');
$tabItem4->step = 4;
$tabItem4->active = $orderStatus === ShopOrder::status_client['delivered'];
$tabItem4->icon = 'fal fa-truck-loading fa-2x';
$tabItems[] = $tabItem4;

$tabItem5 = new TabItem();
$tabItem5->label = Az::l('Получено');
$tabItem5->step = 5;
$tabItem5->active = $orderStatus === ShopOrder::status_client['received'];
$tabItem5->icon = 'fal fa-check-double fa-2x';
$tabItems[] = $tabItem5;

if (isset($item)) {
    $item = new ShopOrder();
    $item->id = 1;
    $item->name = 'dfsdqwe';

    $orderItems[] = $item;
}

$model = new ShopOrder();
$model->configs->nameOn = [
    'id',
    'name',
];
$model->columns();
?>
<style>
    .horizontal-line {
        top: 87%;
        left: 8%;
        width: 67%;
    }
    .vertical-line {
        top: 12%;
        left: 96.5%;
    }
    .step-number {
        width: 30px;
        height: 30px;
        z-index: 10;
    }
    .btn-container {
        width: 82%;
    }

</style>
<div class="container-fluid py-1 m-0">
    <?php if ($orderId !== 0) : ?>
        <div class="alert alert-success text-center" role="alert">
            Ваш заказ принят
        </div>
    <?php endif; ?>

    <div class="orders">
        <div class="container">
            <?php if ($orderId !== 0) : ?>
                <h5 class="text-success my-3">Мой Профиль / Мои заказы / Заказ № <?= $orderId ?> </h5>
            <?php else : ?>
                <h5 class="text-success my-3">Мой Профиль / Мои заказы / Последние заказы</h5>
            <?php endif; ?>

            <!--<div class="wizard pt-3">
                <div class="d-flex">
                    <ul class="nav nav-tabs border-0  position-relative" role="tablist">
                        <div class="border horizontal-line position-absolute w-75"></div>
                        <li role="presentation" class="active mr-5 px-3">
                            <a class="d-flex flex-column align-items-center text-decoration-none" href="#step1">
                                <i class="fal fa-vote-yea <? /*= $accepted ? 'text-success' : 'text-light' */ ?> fa-2x"></i>
                                <span class="<? /*= $accepted ? 'text-success' : 'text-light' */ ?> my-2">Принят</span>
                                <span class="<? /*= $accepted ? 'bg-success' : 'bg-light' */ ?> rounded-circle text-white text-center fp-18 step-number">1</span>
                            </a>
                        </li>
                        <li role="presentation" class="disabled mx-5 px-3">
                            <a class="d-flex flex-column align-items-center text-decoration-none" href="#step1"><i
                                        class="fal fa-spinner fa-2x <? /*= $forming ? 'text-success' : 'text-light' */ ?>"></i>
                                <span class="<? /*= $forming ? 'text-success' : 'text-light' */ ?> my-2">Формируется</span>
                                <span class="<? /*= $forming ? 'bg-success' : 'bg-light' */ ?> lighten-2 rounded-circle text-white text-center fp-18 step-number">2</span>
                            </a>
                        </li>
                        <li role="presentation" class="disabled mx-5 px-3">
                            <a class="d-flex flex-column align-items-center text-decoration-none" href="#step1">
                                <i class="fal fa-truck <? /*= $delivering ? 'text-success' : 'text-light' */ ?> fa-2x"></i>
                                <span class="<? /*= $delivering ? 'text-success' : 'text-light' */ ?> my-2">Доставляется</span>
                                <span class="<? /*= $delivering ? 'bg-success' : 'bg-light' */ ?> lighten-2 rounded-circle text-white text-center fp-18 step-number">3</span>
                            </a>
                        </li>
                        <li role="presentation" class="disabled mx-5 px-3">
                            <a class="d-flex flex-column align-items-center text-decoration-none" href="#step1"><i
                                        class="fal fa-truck-loading <? /*= $delivered ? 'text-success' : 'light' */ ?> fa-2x"></i>
                                <span class="<? /*= $delivered ? 'text-success' : 'text-light' */ ?> my-2">Доставлено</span>
                                <span class="<? /*= $delivered ? 'bg-success' : 'bg-light' */ ?> lighten-2 rounded-circle text-white text-center fp-18 step-number">4</span>
                            </a>
                        </li>
                        <li role="presentation" class="disabled ml-5 px-3">
                            <a class="d-flex flex-column align-items-center text-decoration-none" href="#step1"><i
                                        class="fal fa-check-double fa-2x <? /*= $recieved ? 'text-success' : 'text-light' */ ?>"></i>
                                <span class="<? /*= $recieved ? 'text-success' : 'text-light' */ ?> my-2">Получено</span>
                                <span class="<? /*= $recieved ? 'bg-success' : 'bg-light' */ ?> lighten-2 rounded-circle text-white text-center fp-18 step-number">5</span>
                            </a>
                        </li>
                        <button class="btn btn-success btn-md rounded align-self-end px-3"><i
                                    class="fas fa-redo mr-2"></i>Повторить заказ
                        </button>
                    </ul>

                </div>
            </div>-->

            <?

            echo ZOrderStatusWidget1::widget([
                'data' => $tabItems
            ]);
            ?>

            <div class="mb-5 pt-3">
                <h4 class="mt-5 text-success">Товары</h4>
                <div class="row">
                    <?

                    echo ZDatatableWidgetNew::widget([
                        'model' => new ShopOrderItemDForm(),
                        'data' => $orderItems,
                        'config' => [
                            'searching' => false,
                            'paging' => false,
                        ]
                    ]);
                    ?>
                </div>
            </div>

        </div>

    </div>
    <!-- <div class="container d-flex">
        <a role="button" href="<? /*= $baseUrl */ ?>" class="btn btn-success ml-auto">
            <? /*= Az::l('Перейти на главную') */ ?>
        </a>
    </div>-->

</div>

<?php
echo ZFooterAllWidgetOrg::widget([

]);
?>
<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>
