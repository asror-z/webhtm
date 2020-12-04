<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\models\chat\ChatNotify;
use zetsoft\models\place\PlaceAdress;
use zetsoft\models\shop\ShopOrder;
use zetsoft\models\shop\ShopProduct;
use zetsoft\models\user\User;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZArrayWidget;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\market\ZCategoryWidget;
use zetsoft\widgets\menus\ZMenuItemWidget;
use zetsoft\widgets\navigat\ZReadMoreWidget;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;
use zetsoft\models\test\Test5;
use zetsoft\system\Az;
  

/** @var ZView $this */


/**
 *
 * Action Params
 */

$action = new WebItem();

$action->title = Azl . 'testd';
$action->icon = 'fa fa-database';
$action->type = WebItem::type['html'];
$action->csrf = true;
$action->debug = true;



$this->paramSet(paramAction, $action);

$this->title();
$this->toolbar();



/**
 *
 * Start Page
 */
/*vdd(PlaceAdress::find()->all());
Az::$app->maps->map->core(2,4);
vdd(Az::$app->smart->direct->test());
Az::$app->search->activeData->query = User::find();
Az::$app->search->activeData->pagination = [
    'defaultPageSize' => 3,
    'page' => 2,
    //'pageSizeLimit' => [2,4],
];
Az::$app->search->activeData->sort = ['defaultOrder' => [
    'id' => SORT_ASC,]];
$all = Az::$app->search->activeData->run();
vdd($all);*/
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

echo ZNProgressWidget::widget([]);

?>

<div id="page">

    <?

    require Root . '/webhtm/block/navbar/main.php';

    echo ZSessionGrowlWidget::widget();?>

    <div id="content" class="content-footer p-3">

        <div class="row">
            <div class="col-md-12 col-12">
                <div class="col-12 border border-light rounded">
                    <h4 class="mt-2">
                        <?= Az::l('Смежные категории') ?>
                    </h4>
                <?
                 

               // $model = new Test5();

                /** @var ZView $this */
               /* echo ZDynaWidget::widget([
                    'model' => $model,
                ]);*/
              // $item=Az::$app->market->category->generateDBMenuItems(3);
               // $item=Az::$app->market->category->getMenuItem();
                 //vdd($item);
               /* echo ZMenuItemWidget::widget([
                    'config' => [
                        'menuItem' => $item,

                    ]
                ]);*/
               /* echo ZReadMoreWidget::widget([
                    'config' => [
                        'parentclass' => 'menu-container',
                        'itemInSummary' => 5,
                        'itemClass' => 'mode',
                    ]
                ]);
                $data = Az::$app->utility->notify->getNotify();

                $badge = Az::$app->utility->notify->getBadge();
               

                $shop_products = collect(ShopProduct::find()->asArray()->all());
                $vd=$shop_products->where('id', 981)->first();*/
                vdd(Az::$app->market->cart->cartOrders());
                vdd(Az::$app->market->product->product(2, null, true));
                $form=Az::$app->market->adminStatistic->AdminExpence("2020-06-23 ","2020-06-24 12:38");
                 $model=new ShopOrder();
                $model->configs->nameOn = [
                    'text',
                    
                ];
                $model->configs->edit = false;
                $model->configs->filter = false;
                $model->configs->readonly=true;
                $model->columns();
                  vdd(Az::$app->market->adminStatistic->CourierList());
               echo ZDynaWidget::widget([
                'data' =>$form,
                'model'=>$model
                ]);

                ?>

            </div>
            </div>
        </div>


    </div>

</div>


<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>
