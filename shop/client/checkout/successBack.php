<?php

use rmrevin\yii\fontawesome\FA;
use zetsoft\dbitem\core\WebItem;
use zetsoft\dbitem\shop\OrderItem;
use zetsoft\dbitem\shop\ProductItem;
use zetsoft\dbitem\shop\SingleProductItem;
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
$model = ShopOrder::find()->where(["user_id" => $userId]);

/*$noModel = new ShopOrder();
$noModel->date_deliver = '20.20.20';
$noModel->date_transfer = '20.20.20';
$noModel->name = '20.20.20';*/


/*if(!isset($item)) {
    $item = new ShopOrder();
    $item->id = 1;
    $item->name = 'dfsdqwe';*/

$data = Az::$app->market->orderXolmat->getUserOrderList();
 //vdd($data);
/*$model = new ShopOrder();
$model->configs->nameOn = [
    'id',
    'name',
];
$model->columns();*/
?>
<style>
    .horizontal-line {
        top: 87%;
        left: 5%;
    }
    .step-number{
        width: 30px;
        height: 30px;
        z-index: 10;
    }
</style>
<div class="container-fluid py-1 m-0">
    <div class="alert alert-success">
        <h1 class="text-center">
            <?= Az::l('Ваш заказ принять') ?>
        </h1>

    </div>

    <div class="orders">
        <div class="container">
            <h3 class="text-success mb-3">Мой Профиль / Мои заказы / Заказ № 123156 </h3>
            <div class="wizard pt-3">
                <div class="d-flex">
                     <ul class="nav nav-tabs border-0  position-relative" role="tablist">
                         <div class="border horizontal-line position-absolute w-75"></div>
                         <li role="presentation" class="active mr-5 px-3">
                             <a class="d-flex flex-column align-items-center text-decoration-none" href="#step1">
                             <i class="fas fa-vote-yea text-success fa-3x"></i>
                             <span class="text-success my-2">Принят</span>
                             <span class="bg-success rounded-circle text-white text-center fp-18 step-number">1</span>
                             </a>
                         </li>
                         <li role="presentation" class="disabled mx-5 px-3">
                             <a class="d-flex flex-column align-items-center text-decoration-none" href="#step1"><i class="fas fa-spinner fa-3x text-light"></i>
                             <span class="text-muted my-2">Формируется</span>
                                 <span class="grey lighten-2 rounded-circle text-white text-center fp-18 step-number">2</span>
                             </a>
                         </li>
                         <li role="presentation" class="disabled mx-5 px-3">
                             <a class="d-flex flex-column align-items-center text-decoration-none" href="#step1">
                             <i class="fas fa-truck text-light fa-3x"></i>
                                 <span class="text-muted my-2">Доставляется</span>
                                 <span class="grey lighten-2 rounded-circle text-white text-center fp-18 step-number">3</span>
                             </a>
                         </li>
                         <li role="presentation" class="disabled mx-5 px-3">
                             <a class="d-flex flex-column align-items-center text-decoration-none" href="#step1"><i class="fas fa-truck-loading text-light fa-3x"></i>
                                 <span class="text-muted my-2">Доставлено</span>
                                 <span class="grey lighten-2 rounded-circle text-white text-center fp-18 step-number">4</span>
                             </a>
                         </li>
                         <li role="presentation" class="disabled ml-5 px-3">
                             <a class="d-flex flex-column align-items-center text-decoration-none" href="#step1"><i class="fas fa-check-double fa-3x text-light"></i>
                                 <span class="text-muted my-2">Получено</span>
                                 <span class="grey lighten-2 rounded-circle text-white text-center fp-18 step-number">5</span>
                             </a>
                         </li>
                         <button class="btn btn-success align-self-end px-4"><i class="fas fa-redo mr-2"></i>Repeat Order</button>
                    </ul>

                </div>
            </div>
                
            <div class="mt-5 pt-3">
                <h2 class="mt-5 text-success">Orders to shop</h2>
                <div class="row">
                        <?
                        echo ZDatatableWidgetNew::widget([
                            'data' => $data,
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
    <a role="button" href="<?= $baseUrl ?>" class="btn btn-success mx-auto">
        <?= Az::l('Перейти на главную') ?>
    </a>
</div>


<?php
echo ZFooterAllWidgetOrg::widget([

]);
?>
<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>
