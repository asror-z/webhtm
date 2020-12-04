<?php

use rmrevin\yii\fontawesome\FA;
use yii\widgets\Pjax;
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
use zetsoft\service\forms\ZPjax;
use zetsoft\system\assets\ZColor;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\helpers\ZUrl;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\former\ZDatatableWidget;
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
use zetsoft\widgets\notifier\ZSweetAlert2Widget;
use zetsoft\widgets\themes\ZCardWidget;


/** @var ZView $this */

$action = new WebItem();

$action->title = Azl . 'Состояния заказов покупателей';
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

$ids = $this->sessionGet('savedOrders');

$orderItems = Az::$app->market->order->OrderItemsList($ids);

$orderStatus = Az::$app->market->order->getOrderStatus($ids);

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

        <?

        echo ZOrderStatusWidget::widget([
            'data' => $tabItems
        ]);
        ?>

        <?php if ($ids === null) : ?>

          <div class="mb-5 pt-3">
            <h4 class="mt-5 text-success">Товары</h4>

            <div class="row">
                <?

                $pjax = new ZPjax();
                $pjax->class = 'col-12';
                $pjax->id = 'dataTablePjaxId';

                $this->pjaxBegin($pjax);

                echo ZButtonWidget::widget(['config' => ['url' => '',
                    'hasIcon' => true,
                    'btnType' => ZButtonWidget::btnType['link'],
                    'btnStyle' => ZButtonWidget::btnStyle['none'],
                    'btnRounded' => false,
                    'pjax' => true,
                    'hidden' => true,
                    'title' => 'Обновление',
                    'ttSize' => ZButtonWidget::ttSize['small'],
                    'ttSide' => ZButtonWidget::ttSide['bottom'],
                    'btn' => false,
                    'class' => 'h-100 p-0 noHover',
                    'iconColor' => 'white',
                    'icon' => 'fp-13 fa fa-' . FA::_SYNC,],
                    'id' => 'refreshDataTable',]);

                $model = new ShopOrderItemDForm();
                //vdd($orderItems);
                echo ZDatatableWidgetNew::widget(['model' => $model,
                    'data' => $orderItems,
                    'config' => [//'searching' => false,
                        'paging' => false,]]);

                $this->pjaxEnd();
                //korzinani tozalash uchun
                echo $this->sessionDel('cart')
                ?>
            </div>
          </div>

        <?php endif ?>
    </div>

  </div>
  <div class="container d-flex">
    <a role="button" href="<?= $baseUrl ?>" class="btn btn-success ml-auto">
        <?= Az::l('Перейти на главную') ?>
    </a>
  </div>

</div>

<script>

$(document).ready(() => {
  //$('#refreshDataTable').click();
  $.pjax.reload({
    container: '#dataTablePjaxId',
    async: false,
  })
})

</script>

<?php
echo ZFooterAllWidgetOrg::widget([

]);
?>
<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>
