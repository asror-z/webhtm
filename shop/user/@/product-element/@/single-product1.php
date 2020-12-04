<?php

use rmrevin\yii\fontawesome\FA;
use zetsoft\dbitem\shop\ProductItem;
use zetsoft\dbitem\data\ALLApp;
use zetsoft\dbitem\data\Form;
use zetsoft\dbitem\data\TabItem;
use zetsoft\service\forms\Active;
use zetsoft\system\assets\ZColor;
use zetsoft\system\Az;
use zetsoft\widgets\former\ZFormWidget;
use zetsoft\widgets\incores\ZMCheckboxGroupWidget;
use zetsoft\widgets\inputes\ZHRadioButtonGroupWidget;
use zetsoft\widgets\inputes\ZImageCheckboxGroupWidget;
use zetsoft\widgets\inputes\ZInputWidget;
use zetsoft\widgets\inputes\ZKStarRatingWidget;
use zetsoft\widgets\inputes\ZKTouchSpinWidget;
use zetsoft\widgets\inputes\ZMImageRadioGroupWidget;
use zetsoft\widgets\inputes\ZRadioButtonGroup;
use zetsoft\widgets\inputes\ZRadioGroupWidget;
use zetsoft\widgets\market\ZMiniCardWidget;
use zetsoft\widgets\market\ZProductPropertyWidget;
use zetsoft\widgets\market\ZReviewWidget;
use zetsoft\widgets\market\ZSVGWidget;
use zetsoft\widgets\market\ZZoomWpWidget;
use zetsoft\widgets\menus\ZSidebarWidget;
use zetsoft\widgets\navigat\ZButtonWidget;
use zetsoft\widgets\navigat\ZSlimScrollWidget;
use zetsoft\widgets\navigat\ZSmartTabWidget;
use zetsoft\widgets\themes\ZTabWidget;
use zetsoft\dbitem\core\WebItem;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\market\ZFooterAllWidget;

/** @var ZView $this */
$action = new WebItem();

$action->title = Azl . 'Главная страница';
$action->icon = 'fa fa-area-chart';
$action->type = WebItem::type['ajax'];
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

$item = new ZProductItem();

$this->beginPage();
?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>

    <?php

   echo $this->require( '/webhtm/block/metas/main.php');
    echo $this->require( '/webhtm/block/assets/main.php');
    $this->head();

    ?>

</head>
<body class="<?= ZWidget::skin['white-skin'] ?>">

<?php

$this->beginBody();


/*
 * Template
 * /render/market/XeMart%20-%20Ecommerce%20Template/html/05-single-product.html
 * */
$product_id = 19;

$reviews = Az::$app->market->review->getReviewByProductId($product_id);
$reviewItem = '';
foreach ($reviews as $review) {
    $reviewItem = $review;
}


/** @var ZProductItem[] $product */
$product = Az::$app->market->product->product($product_id);

?>


    <div class="container-fluid card h-auto">

        <div class="pt-4 pb-4 pl-5 pr-5">
        <div class="d-flex">

            <div class="">
                <?php

                Az::$app->market->wish->writeViewed($product_id);
                ?>
                <?php echo ZZoomWpWidget::widget([
                    'data'=> $product->image
                ]) ?>
            </div>

            <div class="col-md-8">
                <div class="row">
                    <div class="col-md-5 mr-auto">
                        <h6 class="text-uppercase font-weight-bold fp-20"><?php echo $product->name ?></h6>
                    </div>

                    <div class="col-md-4 d-flex ml-auto">

                        <a class="text-muted fz-12 mb-1" onclick="add_wish_list(8,$(this),true)">
                            <i class="fa fa-heart fa-2x <?= $product->in_wish ? 'text-danger' : '' ?>"></i>
                        </a>

                        <a class="text-muted fz-12 ml-4 mb-1" onclick="add_compare_list(8,$(this),false)">
                            <i class="far fa-chart-bar fa-2x <?= $product->in_compare ? 'text-success' : '' ?>"></i>
                        </a>

                    </div>
                </div>


                <table class="table w-100">

                    <tr>
                        <th class="d-flex">

                            <div>
                                <img width="35" height="40" src="/render/market/ZGlotrCardWidget/medal_new.svg">
                            </div>
                            <div class="ml-3">
                                <?php
                                echo ZKStarRatingWidget::widget([
                                    'name' => 'name',
                                    'value' => 3,
                                    'config' => [
                                        'show' => false,
                                        'icon' => '<i class="fas fa-star"></i>',
                                        'size' => 'xs',
                                        'isDisplayOnly' => true,
                                        'iStars' => 5,
                                    ]
                                ]);
                                ?>
                            </div>
                            <div class="ml-3">
                                <!--<span>
                                    ( <?/*= $reviewItem->rating */?>&nbsp;<?/*= Az::l('Отзыва') */?> )
                                </span>-->
                            </div>
                        </th>
                    </tr>

                </table>

                <div class="row">
                    <div class="col-md-4 p-0">
                        <div class="col-md-12 text-center d-flex">
                            <p class="fp-30 text-success ml-4"><?= $product->min_price ?></p>
                            <p class="text-success fp-25">-</p>
                            <p class="fp-30 text-success"><?= $product->max_price ?></p>
                        </div>
                        <div class="col-md-12 mt-2 d-flex text-center">
                            <p class="fp-23 text-light ml-5"><?= $product->currency ?></p>
                            <p class="fp-23 text-light ml-2">за 1</p>
                            <p class="fp-23 text-light ml-2"><?= $product->measure ?></p>
                        </div>
                        <?php
                        $active = new Active();
                        $active->id = 'formModal';
                        $active->class = 'pl-2';
                        $form = $this->activeBegin($active);
                        $app = new ALLApp();
                        echo "<div class='row'><div class='col-md-6'>";

                        foreach ($product->properties as $key => $property) {

                            $string_n = [];
                            $column1 = new Form();
                            $column1->title = $property->name;
                            $column1->widget = ZMImageRadioGroupWidget::class;
                            $column1->options = [
                                'data' => $string_n,
                                'config' => [
                                    'checkMarkPosition' => ZMImageRadioGroupWidget::checkMarkPosition['top-left'],
                                    'checkMarkSize' => '20px',
                                    'url' => ZMImageRadioGroupWidget::imageUrl['none'],
                                    'title' => $property->name
                                ]
                            ];
                            $array[] = $property->items;

                            if ($array === '' || $array === null) {
                                $array = ['0'];
                            }

                            foreach ($property->items as $option) {
                                $string_n[] = $option;
                            }
                            $column1->value = array_key_first($property->items);
                            $column1->data = $property->items;
                            $column1->rules = [['zetsoft\\system\\validate\\ZRequiredValidator']];
                            $app->columns['key' . $key] = $column1;

                        }

                        echo '</div></div>';


                        $column = new Form();
                        $column->title = $product->id;
                        $column->widget = ZHInputWidget::class;
                        $column->options = [
                            'config' => [
                                'type' => ZInputWidget::type['hidden']
                            ]
                        ];
                        $column->value = $product->id;
                        $catalogId = $product->id;

                        $app->columns['product_id'] = $column;

                        $app->cards = [];
                        $model = Az::$app->forms->former->model($app);

                        echo ZFormWidget::widget([
                            'model' => $model,
                            'form' => $form,
                            'config' => [
                                'topBtn' => false,
                                'botBtn' => false,
                            ]
                        ]);

                        $this->activeEnd();
                        ?>
                    </div>
                    <div class="col-md-7 h-100">
                    <h1 class="bold fp-30">Предложение магазинов</h1>

                    <?
                    ZSlimScrollWidget::begin([
                        'config' => [
                            'begin' => true,
                            'alwaysVisible' => false,
                            'width' => '400px',
                            'height' => '400px',
                            'class' => ''
                        ]
                    ]);
                    ?>
                    <div class="col-md-8 h-25 market-company d-none" id="market-panel">
                        <div class="sk-chase" id="test">
                            <div class="sk-chase-dot"></div>
                            <div class="sk-chase-dot"></div>
                            <div class="sk-chase-dot"></div>
                            <div class="sk-chase-dot"></div>
                            <div class="sk-chase-dot"></div>
                            <div class="sk-chase-dot"></div>
                        </div>
                    </div>
                    <div class="data d-none">

                    </div>
                    <? ZSlimScrollWidget::end() ?>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="row my-5">
            <div class="col-md-12">
                <?php
                $tabs = [];
                $item = new TabItem();
                $item->title = 'Информация';
                $item->content = ZProductPropertyWidget::widget([
                    'data' => $product->allProperties,
                ]);
                $item->class = 'p-1';
                $item->pushUrl = true;
                $tabs[] = $item;
                $item = new TabItem();
                $item->title = 'Характеристика';
                $item->content = $product->text;
                $item->class = 'pt-3';
                $tabs[] = $item;
                $item = new TabItem();
                $item->title = 'Отзывы';
                $item->content =

                    ZReviewWidget::widget([
                        'config' => [
                            'data' => $reviews
                        ]
                    ]);

                $item->class = 'pt-3';
                $tabs[] = $item;
                $item = new TabItem();
                $item->title = 'Вопросы и Ответы';
                $item->content = '';
                $item->class = 'p-1';
                $tabs[] = $item;


                echo ZTabWidget::widget([
                    'data' => $tabs,
                    'config' => [
                        'type' => ZTabWidget::type['classic'],
                        'mdTabColor' => ZTabWidget::mdTabColor['white'],
                        'classicTabColor' => ZTabWidget::classicTabColor['tabs-grey'],
                        'mdPills' => true,
                        'tabPanelId' => 'tab-panel-id',
                        'contentPanelId' => 'content-panel-id',
                    ],
                ]);
                ?>
            </div>
        </div>


        <script>
            window.onload = () => {
                loadData();
            };

            let radioBtns = document.querySelectorAll('input[type="radio"]');
            radioBtns.forEach(item => {
                item.addEventListener('click', (event) => {
                    loadData();
                })
            });

            function loadData() {
                $.ajax({
                    url: '/core/product/getCompany.aspx',
                    type: 'GET',
                    data: $("#formModal").serialize(),
                    success: function (data) {
                        $('.data').html(data);
                        $('.market-company').removeClass('d-none');
                        $('.data').addClass('d-none');
                        setTimeout(function () {
                            $('.market-company').addClass('d-none');
                            $('.data').removeClass('d-none');
                        }, 3000)


                    }
                });
            }


        </script>

        <?php
        echo ZFooterAllWidget::widget([

        ]);
        ?>
        <?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>
