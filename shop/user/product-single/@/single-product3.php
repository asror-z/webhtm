<?php

use rmrevin\yii\fontawesome\FA;
use zetsoft\dbitem\core\WebItem;
use zetsoft\dbitem\data\ALLApp;
use zetsoft\dbitem\data\Form;
use zetsoft\dbitem\data\TabItem;
use zetsoft\service\forms\Active;
use zetsoft\system\assets\ZColor;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZUrl;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZAjaxWidget;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\former\ZFormWidget;
use zetsoft\widgets\inputes\ZInputWidget;
use zetsoft\widgets\inputes\ZMImageRadioGroupWidget;
use zetsoft\widgets\market\ZProductPropertyWidget;
use zetsoft\widgets\market\ZZoomWpWidget;
use zetsoft\widgets\navigat\ZButtonWidget;
use zetsoft\widgets\navigat\ZSlimScrollWidget;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;
use zetsoft\models\page\PageAction;
use zetsoft\widgets\themes\ZTabWidget;


/** @var ZView $this */


/**
 *
 * Action Params
 */

$action = new WebItem();

$action->title = Azl . 'Веб-действия';
$action->icon = 'fa fa-pie-chart';
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
        <?

        $product_id = 18;

        

        $product = Az::$app->market->product->product($product_id);


        ?>

        <div class="container-fluid card h-auto">

            <div class="pt-4 pb-4 pl-5 pr-5">
                <div class="d-flex">

                    <div class="">
                        <?php /*echo ZZoomWidget::widget([
                    'data' => $product->image
                ]) */

                        Az::$app->cores->wish->writeViewed($product_id);
                        ?>
                        <?php echo ZZoomWpWidget::widget([
                            /*'data'=> $product->image*/
                        ]) ?>
                    </div>

                    <div class="pl-5 w-100">
                        <h6 class="text-uppercase font-weight-bold"><?php echo $product->categoryName ?></h6>

                        <table class="table w-100">

                            <tr>
                                <th class="d-flex">

                                    <div>
                                        <img width="35" height="40" src="/render/market/ZGlotrCardWidget/medal_new.svg">
                                    </div>
                                    <div class="text-center">
                                        <?php
                                        //                                echo ZKStarRatingWidget::widget([
                                        //                                    'name' => 'name',
                                        //                                    'value' => 3,
                                        //                                    'config' => [
                                        //                                        'show' => true,
                                        //                                        'icon' => '<i class="fas fa-star mt-1"></i>',
                                        //                                        'size' => 'xs',
                                        //                                        'isDisplayOnly' => true,
                                        //                                        'iStars' => 5,
                                        //                                    ]
                                        //                                ]);
                                        ?>
                                        <br><span>(2 отзыва)</span>
                                    </div>

                                </th>
                                <td><p class="mt-3">Oптом и розница</p></td>
                                <td class="align-middle">

                                    <?

                                    $wish = Az::$app->market->product->inWish($product_id);
                                    $compare = Az::$app->market->product->inCompare($product_id);

                                    ?>

                                    <a class="text-muted fz-12" onclick="add_wish_list(8,$(this),true)">
                                        <i class="fa fa-heart fa-2x p-1 <?= $wish ? 'text-danger' : '' ?>"></i>
                                    </a>
                                    <span class="fz-18 text-black-50 text-center p-1 mt-1 ">
                                <?= Az::l('Избранное') ?>
                            </span>

                                </td>

                                <td class="align-middle">
                                    <a class="text-muted fz-12" onclick="add_compare_list(8,$(this),false)">
                                        <i class="fa fa-chart-bar fa-2x p-2 <?= $compare ? 'text-success' : '' ?>"></i>
                                    </a>
                                    <span class="fz-18 text-black-50 text-center p-1 mt-1">
                                <?= Az::l('Сравнить') ?>
                            </span>
                                </td>
                            </tr>

                        </table>

                        <div class="d-flex">
                            <div class="col-md-4 p-0">
                                <?php
                                $active = new Active();
                                $active->id = 'formModal';
                                $form = $this->activeBegin($active); ?>
                                <h5 class="font-weight-bold"><?= Az::l('Характеристика') ?></h5>

                                <?php

                                $app = new ALLApp();
                                echo "<div class='row'><div class='col-md-12'>";

                                foreach ($product->properties as $key => $property) {

                                    $string_n = [];
                                    $column1 = new Form();
                                    $column1->title = $property->name;
                                    $column1->widget = ZMImageRadioGroupWidget::class;
                                    $column1->options = [
                                        'data' => $string_n
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
                                echo "</div></div>";


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
                            <div class="d-block mr-5 text-center  p-2">
                                <div class="text-success text-left font-weight-normal fz-24 p-1 pl-0">
                                    <?= Az::$app->cores->company->getPriceString($product->price, $product->currency) ?>
                                </div>
                                <div class="text-black-50 text-left fz-16 p-1 pl-0">сум. за 1 шт.</div>
                                <div class="text-left fz-18 text-denger mb-4 p-1 pl-0">
                                    <del>
                                        <?
                                        echo Az::$app->cores->company->getPriceString($product->price_old, $product->currency);
                                        ?>
                                    </del>
                                </div>
                            </div>
                            <div class="">
                                <?
                                ZSlimScrollWidget::begin([
                                    'config' => [
                                        'begin' => true,
                                        'width' => '400px',
                                        'height' => '200px',
                                    ]
                                ]);
                                ?>
                                <div class="col-md-12" id="market-panel"></div>
                                <?

                                ZSlimScrollWidget::end();

                                echo ZButtonWidget::widget([
                                    'config' => [
                                        'class' => 'd-none hiddenButton',
                                        'text' => Az::l('Добавить в корзину'),
                                        'btnStyle' => ZColor::btnStyle['btn-outline-success'],
                                        'btnRounded' => false,
                                        'btnType' => ZButtonWidget::btnType['button'],
                                        'type' => ZAjaxWidget::type['get'],
                                        'ajax' => true,
                                        'url' => ZUrl::to(["/core/product/setToCart"]),
                                        'dataType' => 'html',
                                        'data' => "$('#compForm').serialize()",
                                        'icon' => 'mr-1 fa fa-' . FA::_SHOPPING_CART,
                                        'hasIcon' => true
                                    ],
                                    'event' => [
                                        'success' => 'function (data) {
                                $(\'#cart_total_amount\').html(data);
                            }'
                                    ]
                                ]);
                                ?>
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
                        $item->class = 'p-1';
                        $tabs[] = $item;
                        $item = new TabItem();
                        $item->title = 'Отзывы';
                        $item->content = '';
                        $item->class = 'p-1';
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
                                $('#market-panel').html(data);
                            }
                        });
                    }


                </script>


                ?>
            </div>
        </div>
        <?php $this->endBody() ?>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
