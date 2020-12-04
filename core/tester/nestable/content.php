<?php

/**
 *
 *
 * Author:  Asror Zakirov
 * https://www.linkedin.com/in/asror-zakirov
 * https://github.com/asror-z
 *
 */


/** @var ZView $this */

use zetsoft\models\place\PlaceAdress;
use zetsoft\models\place\PlaceCountry;
use zetsoft\models\user\User;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZUrl;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\former\ZCheckButtonWidget;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\market\ZMediaCardWidget;
use zetsoft\widgets\market\ZMyCardWidget;
use zetsoft\widgets\market\ZMyProductSummaryWidget;
use zetsoft\widgets\navigat\ZButtonWidget;


$this->title = Az::l('Проверки покупки');
$this->modelPost();
?>
<div class="pl-1">
    <div class="row">
        <div class="col-8 mt-5">
            <?php

            $obj = User::findOne(1);

            $model = new PlaceAdress();

            $model->configs->query = PlaceAdress::find()->
            where([
                'id' => $obj->core_adress_ids
            ]);
            $model->configs->nameOn = [
                'name',
                'location',
                'place_region_form',
                'contact',
                'address_info',
            ];
            echo ZDynaWidget::widget([
                'model' => $model,
                'theme' => ZDynaWidget::theme['panel-success'],
                'rightBtn' => [
                    'add-clone-delete' => [
                        'content' => "{add}",
                        'options' => ['class' => 'btn-group p-0 {btnSize} {iconSize}'],
                    ],
                    'filter-sort-id' => [
                        'options' => ['class' => 'd-none']
                    ],
                    'export' => [
                        'options' => ['class' => 'd-none']
                    ],
                    'exportAll' => [
                        'options' => ['class' => 'd-none']
                    ],
                    'exportExcel' => [
                        'options' => ['class' => 'd-none']
                    ],
                    'toggleData' => [
                        'options' => ['class' => 'd-none']
                    ],
                    'update' => [
                        'options' => ['class' => 'd-none']
                    ],

                ],
                'config' => [
                    'actionView' => false,
                    'actionEdit' => false,
                    'actionClone' => false,
                    'actionDetail' => false,
                    'columnExpand' => false,
                    'deleteUrl' => ZUrl::to('/core/product/deleteAddress'),
                    'createUrl' => '/customer/main/add-adress',
                    'columnFormula' => false,
                    'columnRelation' => false,
                    'checkBoxType' => ZDynaWidget::checkBoxType['radio'],
                    'panelIcon' => 'fas fa-chart-pie',

                    'tableOptions' => [
                        'class' => 'white'
                    ],
                    'footerRowOptions' => [
                        'class' => 'red'
                    ],
                    'captionOptions' => [
                        'class' => 'success'
                    ],
                    'headerRowOptions' => [
                        'class' => 'white'
                    ],
                    'bordered' => false,
                    'striped' => false,
                    'panelType' => 'success',
                    'checkboxColumnPos' => ZDynaWidget::columnPos['left'],
                    'actionColumnPos' => ZDynaWidget::columnPos['right'],
                ]

            ]);
            ?>
        </div>
        <div class="col-4">
            <?php
            /*   $buyButton = '';
               if (!empty(Az::$app->market->product->cartOrders()))*/
            $buyButton = ZCheckButtonWidget::widget([
                
                'config' => [
                    'title' => 'удалить?',
                    'grapes' => false,
                    'url' => '/core/product/saveOrder.aspx',
                    'class' => 'checkbox-' . $model->className,
                    'btnStyle' => ZButtonWidget::btnStyle['btn-outline-danger rounded-0'],
                    'btnRounded' => false,
                    'icon' => 'fas fa-trash-alt m-0',
                    'confirm' => false,
                    'modelClassName' => $this->modelClassName,
                    'failMessage' => Az::l("Вы должны выбрать адрес.")
                ]
            ]);

            echo ZMyProductSummaryWidget:: widget([
                'config' => [
                    'buyButton' => $buyButton
                ]
            ]);
            echo ZMyCardWidget::widget();

            ?>
        </div>
    </div>
</div>
