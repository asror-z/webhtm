<?php

use yii\caching\TagDependency;
use yii\grid\DataColumn;
use zetsoft\dbitem\core\WebItem;
use zetsoft\models\place\PlaceAdress;
use zetsoft\models\core\CoreAdvancedItem;
use zetsoft\models\shop\ShopOrder;
use zetsoft\models\user\User;
use zetsoft\system\Az;
use zetsoft\system\column\ZDataColumn;
use zetsoft\system\column\ZKDataColumn;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\helpers\ZUrl;
use zetsoft\system\helpers\ZVarDumper;
use zetsoft\system\kernels\ZView;

use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\cards\ZAzCardWidget;
use zetsoft\widgets\former\ZCheckButtonWidget;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\market\ZFooterAllWidget;
use zetsoft\widgets\market\ZMenuWidgetAbdulloh;
use zetsoft\widgets\market\ZMSwiperDbWidget;
use zetsoft\widgets\market\ZMSwiperWidget;
use zetsoft\widgets\market\ZMyProductSummaryWidget;
use zetsoft\widgets\menus\ZSidebarWidget;
use zetsoft\widgets\navigat\ZButtonWidget;


/** @var ZView $this */
$action = new WebItem();

$action->title = Azl . 'Проверки покупки';
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
<html lang="<?= Yii::$app->language ?>">
<head>

    <?php

    require Root . '/webhtm/block/metas/main.php';
    require Root . '/webhtm/block/assets/main.php';

    echo ZSidebarWidget::widget([]);

    $this->head();

    ?>

</head>
<body class="<?= ZWidget::skin['white-skin'] ?>">

<?php

$this->beginBody();
?>

<div class="pl-1 m-5">
    <div class="row col-12">
        <div class="col-9 p-0 ">
            <?php

            $obj = User::findOne(1);

            $model = new PlaceAdress();

            $model->configs->query = PlaceAdress::find()->
            where([
                //'id' => $obj->core_adress_ids
            ]);
            $model->configs->nameOn = [
                'name',

            ];


            $addButton = ZButtonWidget::widget([
                'config' => [
                    'text' => Az::l('Добавить адрес'),
                    'btnStyle' => ZButtonWidget::btnStyle['btn-success'],
                    'url' => ZUrl::to(['/customer/main/add-adress'])
                ]
            ]);
            echo ZDynaWidget::widget([
                'model' => $model,

                'rightBtn' => [
                    'add-clone-delete' => [
                        'content' => "{add}",
                        'options' => ['class' => ''],
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
                    'theme' => ZDynaWidget::theme['panel-success'],
                    'actionView' => false,
                    'actionEdit' => true,
                    'actionClone' => false,
                    'actionDetail' => false,
                    'columnExpand' => false,
                    'deleteUrl' => ZUrl::to('/core/product/deleteAddress'),
                    'updateUrl' => '/customer/main/add-adress',
                    'columnFormula' => false,
                    'columnRelation' => false,
                    'columnRadio' => true,
                    'columnCheckbox' => false,
                    'checkBoxType' => ZDynaWidget::checkBoxType['radio'],
                    

                    'tableOptions' => [
                        'class' => 'p-0 m-0 rounded-circle table-wrapper-scroll-y my-custom-scrollbar'
                    ],
                    'footerOptions' => [
                        'class' => 'd-none'
                    ],
                    /*'captionOptions' => [
                        'class' => 'd-none'
                    ],*/
                    /*'headerRowOptions' => [
                        'class' => 'd-none'
                    ],*/
                    'bordered' => false,
                    'striped' => false,
                    'panelType' => 'success',
                    'checkboxColumnPos' => ZDynaWidget::columnPos['left'],
                    'actionColumnPos' => ZDynaWidget::columnPos['right'],
                    'search' => false,
                    'filter' => false,
                    'headerIcon' => '',
                    'actionButtons' => [
                        'update',
                        'delete',

                    ],

                ],
                'replace' => [
                    '{add}' => $addButton
                ]

            ]);
            ?>
        </div>
        <div class="col-3">
            <div>
                <div class="col-12 position-fixed card-cascade  w-25">
                    <?php
                    /*   $buyButton = '';
                       if (!empty(Az::$app->market->product->cartOrders()))*/
                    $buyButton = ZCheckButtonWidget::widget([

                        'config' => [
                            'grapes' => false,
                            'url' => '/core/product/saveOrder.aspx',
                            'class' => 'checkbox-' . $model->className,
                            'btnStyle' => ZButtonWidget::btnStyle['btn-success'],
                            'btnRounded' => false,
                            'icon' => '',
                            'hasIcon' => false,
                            'text' => 'Заказать',
                            'confirm' => false,
                            'modelClassName' => $this->modelClassName,
                            'failMessage' => Az::l("Пожалуйста, выберите адрес доставки.")
                        ]
                    ]);

                    echo ZMyProductSummaryWidget::widget([
                        'config' => [
                            'buyButton' => $buyButton
                        ]
                    ]);


                    ?>
                </div>
            </div>

        </div>
    </div>
    <div class="row col-12">
        <!--<div class="col-4">
            <?php
        /*
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

                    echo ZMyProductSummaryWidget::widget([
                        'config' => [
                            'buyButton' => $buyButton
                        ]
                    ]);


                    */ ?>
        </div>-->
        <div class="col-9 p-0">
            <?php
            //echo ZMyCardWidget::widget();
            ?>
        </div>
    </div>
</div>


<script>
    /*var main = document.querySelectorAll('.tr-dynawidget');
    var tr_items  = '';
    for (var i = 0; i < main.length; i++) {
        tr_items =  main[i]
    }

    tr_items.on('click', function () {
        console.log('1');
    });*/

    $('.tr-dynawidget').on('click', function () {
        var main = $(this);

    });
    ``

</script>
<?php
echo ZFooterAllWidget::widget([

]);
?>
<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>
