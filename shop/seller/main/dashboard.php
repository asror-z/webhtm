<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\models\shop\ShopOrder;
use zetsoft\models\shop\ShopProduct;
use zetsoft\models\shop\ShopReview;
use zetsoft\models\shop\ShopStatus;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\blocks\ZJqueryKnobWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\menus\ZMmenuWidgetSh;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;
use zetsoft\models\shop\ShopBrand;


/** @var ZView $this */


/**
 *
 * Action Params
 */

$action = new WebItem();

$action->title = Azl . 'Бренды';
$action->icon = 'fa fa-globe';
$action->type = WebItem::type['html'];




$this->paramSet(paramAction, $action);

$this->title();
$this->toolbar();


/**
 *
 * Start Page
 */

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
<style>
    .iframe-seller {
        border: none;
        min-height: 600px;
    }
</style>

<div id="page">

    <?

    /*require Root . '/webhtm/block/navbar/mainAdmin.php';
    require Root . '/webhtm/block/menu/menu-m.php';*/

   

    echo ZSessionGrowlWidget::widget();$model = new ShopOrder();
    $today = date('Y-m-d');

    ?>


    <div class="main-content pt-5" id="panel">
        <!-- Page content -->
        <div class="container-fluid mt-1">
            <div class="row">

                <div class="col-xl-8">
                    <div class="card">

                        <?php


                        $company_id = $this->userIdentity()->user_company_id;

                        if (empty($company_id))
                            $company_id = 210;


                        $model->configs->query = ShopOrder::find()
                            ->where(`user_company_ids @> ['$company_id']`);

                        $model->configs->nameOn = [
                            'id',
                            'name',
                        ];
                        $model->columns();
                        // vdd($model);
                        /** @var ZView $this */
                        echo ZDynaWidget::widget([
                            'model' => $model,
                            'config' => [
                                'updateUrl' => '{fullUrl}/process.aspx?shop_order_id={id}',
                                'actionButtons' => false,
                                'columnBefore' => false,
                                'spaArray' => [
                                    'update' => false,
                                    'create' => true,
                                ],
                                'spaHeight' => [
                                    'create' => '750px',
                                    'view' => '618px',
                                ],
                                'columnAfter' => false,
                            ],
                            'rightBtn' => [
                                'update' => [
                                    'content' => '',
                                    'options' => ['class' => 'btn-group p-1 mr-0 {btnSize} {iconSize}']
                                ],

                                'system' => [
                                    'content' => '',
                                    'options' => ['class' => 'btn-group p-1 mr-0 {btnSize} {iconSize}']
                                ],

                                'add-clone-delete' => [
                                    'content' => '{add}{clone}{delete}',
                                    'options' => ['class' => 'btn-group p-1 mr-0 {btnSize} {iconSize}']
                                ],

                                'filter-sort-id' => [
                                    'content' => '',
                                    'options' => ['class' => 'btn-group p-1 mr-0 {btnSize} {iconSize}']
                                ],

                                'statistics' => [
                                    'content' => '',
                                    'options' => ['class' => 'btn-group p-1 mr-0 {btnSize} {iconSize}']
                                ],

                                'export' => [
                                    'content' => '',
                                    'options' => ['class' => 'btn-group p-1 {btnSize} {iconSize}']
                                ],


                                'toggleData' => [
                                    'content' => '',
                                    'options' => ['class' => 'btn-group p-1 {btnSize} {iconSize}']
                                ],
                            ]
                        ]);

                        ?>

                    </div>

                    <div class="card mt-2">

                        <?php


                        $company_id = $this->userIdentity()->user_company_id;

                        if (empty($company_id))
                            $company_id = 210;

                        $product = new ShopProduct();
                        /*$product->query = ShopProduct::find()
                        ->where([
                          'user_company_id' => $company_id
                        ])->all();*/

                        $product->configs->nameOn = [
                            'id',
                            'user_company_id',
                            'name',
                            'shop_category_id'
                        ];

                        $product->columns();


                        /** @var ZView $this */
                        echo ZDynaWidget::widget([
                            'model' => $product,
                            'config' => [
                                'updateUrl' => '{fullUrl}/process.aspx?shop_order_id={id}',
                                'actionButtons' => false,
                                'columnBefore' => false,
                                'spaArray' => [
                                    'update' => false,
                                    'create' => true,
                                ],
                                'spaHeight' => [
                                    'create' => '750px',
                                    'view' => '618px',
                                ],
                                'columnAfter' => false,
                            ],
                            'rightBtn' => [
                                'update' => [
                                    'content' => '',
                                    'options' => ['class' => 'btn-group p-1 mr-0 {btnSize} {iconSize}']
                                ],

                                'system' => [
                                    'content' => '',
                                    'options' => ['class' => 'btn-group p-1 mr-0 {btnSize} {iconSize}']
                                ],

                                'add-clone-delete' => [
                                    'content' => '',
                                    'options' => ['class' => 'btn-group p-1 mr-0 {btnSize} {iconSize}']
                                ],

                                'filter-sort-id' => [
                                    'content' => '',
                                    'options' => ['class' => 'btn-group p-1 mr-0 {btnSize} {iconSize}']
                                ],

                                'statistics' => [
                                    'content' => '',
                                    'options' => ['class' => 'btn-group p-1 mr-0 {btnSize} {iconSize}']
                                ],

                                'export' => [
                                    'content' => '',
                                    'options' => ['class' => 'btn-group p-1 {btnSize} {iconSize}']
                                ],


                                'toggleData' => [
                                    'content' => '',
                                    'options' => ['class' => 'btn-group p-1 {btnSize} {iconSize}']
                                ],
                            ]
                        ]);

                        ?>

                    </div>
                </div>
                <div class="col-xl-4">

                    <div class="table-responsive">
                        <!-- Projects table -->
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                            <tr>
                                <th scope="col">Статистика</th>
                                <th scope="col"></th>
                                <th scope="col"></th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <th scope="row">
                                    Всего товаров
                                </th>

                                <td>
                                    <div class="d-flex align-items-center">
                                        <span class="mr-2"><?= ShopOrder::find()->count() ?></span>

                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <span class="mr-2">штук</span>

                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">
                                    Заказов сегодня
                                </th>

                                <td>
                                    <div class="d-flex align-items-center">
                                            <span class="mr-2">
                                                <?=

                                                 ShopOrder::find()->where([
                                                    'date' => $today
                                                 ])->count();
                                                ?>
                                               
                                            </span>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                            <span class="mr-2">
                                                <?php
                                                $price = ShopOrder::find()->where([
                                                    'date' => $today
                                                ])->all();
                                                $summa = 0;
                                                foreach ($price as $key => $item){
                                                    $summa += $item->price;
                                                }
                                                echo $summa;
                                                ?>
                                            </span>

                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">
                                    Заказов вчера
                                </th>

                                <td>
                                    <div class="d-flex align-items-center">
                                            <span class="mr-2">
                                                <?=
                                                ShopOrder::find()->where([
                                                    'date' => date('d-m-Y', strtotime('-1 days'))
                                                ])->count();
                                                ?>
                                            </span>

                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                            <span class="mr-2">

                                                <?php

                                                $price = ShopOrder::find()->where([
                                                    'date' => date('d-m-Y', strtotime('-1 days'))
                                                ])->all();
                                                $summa = 0;
                                                foreach ($price as $key => $item){
                                                    $summa += $item->price;
                                                }
                                                echo $summa;
                                                ?>

                                            </span>

                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <th scope="row">
                                    Отзывов сегодня
                                </th>

                                <td>
                                    <div class="d-flex align-items-center">
                                            <span class="mr-2">
                                                <?= ShopReview::find()->count() ?>
                                            </span>

                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <span class="mr-2"></span>

                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">
                                    Звонков сегодня
                                </th>

                                <td>
                                    <div class="d-flex align-items-center">
                                            <span class="mr-2">
                                                <?=
                                                ShopOrder::find()->where([
                                                    'date' => $today,
                                                    'status_callcenter' => 'new'
                                                ])->count();
                                                ?>
                                            </span>

                                    </div>
                                </td>

                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>
