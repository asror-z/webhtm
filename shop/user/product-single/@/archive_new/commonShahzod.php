<?php

use zetsoft\dbitem\data\ALLApp;
use zetsoft\dbitem\data\Form;
use zetsoft\dbitem\shop\MultiProductItem;
use zetsoft\dbitem\shop\ProductItem;
use zetsoft\dbitem\shop\PropertyItem;
use zetsoft\former\shop\ShopCompanyCardForm;
use zetsoft\service\forms\Active;
use zetsoft\service\forms\ZPjax;
use zetsoft\system\assets\ZColor;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\widgets\former\ZFormWidget;
use zetsoft\widgets\incores\ZMCheckboxGroupWidget;
use zetsoft\widgets\incores\ZMCheckboxGroupWidgetAz;
use zetsoft\widgets\inputes\ZInputWidget;
use zetsoft\widgets\market\ZZoomWpWidget;
use zetsoft\widgets\market\ZZoomWpWidget1;
use zetsoft\widgets\navigat\ZButtonWidget;
use zetsoft\dbitem\core\WebItem;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;

/** @var ZView $this */
$action = new WebItem();

$action->title = Azl . 'Описание';
$action->icon = 'fa fa-area-chart';
$action->type = WebItem::type['html'];
$action->csrf = true;
$action->debug = true;

$action->cache = false;
$action->cacheHttp = false;

$this->paramSet(paramAction, $action);

$this->title();
$this->toolbar();

$product_id = $this->httpGet('id');

if ($product_id === null)
{
    echo '<div class="text-muted">'.Az::l('Вам нужно перейти на эту страницу, выбрав определенный продукт. Пожалуйста, выберите продукт обратно на главную страницу.').'</div>';
    return null;
}

/** @var ProductItem[] $product */

$product = Az::$app->market->product->product($product_id, null, true);

if ($product === null)
{
    echo '<div class="text-muted">'.Az::l('В настоящее время невозможно отобразить информацию об этом продукте. Пожалуйста, вернитесь на домашнюю страницу и попробуйте выбрать продукт снова.').'</div>';
    return null;
}


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

require Root . '/webhtm/block/header/main.php';
require Root . '/webhtm/block/navbar/main.php';


echo $this->require( '/render/market/ZYandexSingleProductHeaderWidget/ready/single-product-header.php', [
    'product_id' => $product_id ?? ''
]);

echo $this->require( '/webhtm/shop/user/product-single/block/yandexTab.php', [
    'id' => $product_id,
    'type' => 'product'
]);



?>
<div class="row">
    <div class="col-md-12">
        <div class="card-title">
            <div class="row p-1">
                <div class="col-3 m-1">
                    <?php
                    echo ZZoomWpWidget::widget([
                        'data' => $product->images
                    ]);

/*                    echo $this->require( '/render/cards/ZZoomWidget/ready/zoom.php', [
                        'product' => $product
                    ])
                    */?>
                </div>
                <div class="col-5 row">
                    <div class="col-6">
                    <div class="fp-18"><?php echo Az::l('Свойства продукта'); ?></div>
                        <?php


                        $active = new Active();
                        $active->id = 'formModal';
                        $active->class = 'pl-2';
                        $form = $this->activeBegin($active);
                        $app = new ALLApp();

                        foreach ($product->properties as $key => $property_group) {
                            $string_n = [];
                            $column1 = new Form();
                            $column1->title = $property_group->name;
                            $column1->widget = ZMCheckboxGroupWidget::class;
                            $column1->options = [
                                'data' => $string_n,
                                'config' => [
                                    'type' => ZMCheckboxGroupWidget::type['MaterialRadioButton'],

                                    'title' => $property_group->name
                                ],


                            ];
                            $array[] = $property_group->items;


                            foreach ($property_group->items as $option) {
                                $string_n[] = $option;
                            }

                            $column1->value = array_key_first($property_group->items);
                            $column1->data = $property_group->items;
                            $column1->rules = [['zetsoft\\system\\validate\\ZRequiredValidator']];
                            $app->columns['key' . $key] = $column1;

                        }

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
                            ],
                            'event' => [
                                'formChange' => <<<JS
                        function (event) {
                           
                            $.ajax({
                                method: 'POST',
                                url: '/core/product/getCompanyD.aspx',
                                data: $('#formModal').serialize(),
                                beforeSend:function(){
                                    $('.lds-roller').show();
                                },
                                success: function(response) {
                                     $('#market').html(response);
                                 
                                }
                            });
                         
                          
                        }
JS

                            ]
                        ]);

                        $this->activeEnd();
                        ?>
                    </div>


                    <div class="col-6">
                        <div class="fp-18"><?php echo Az::l('Коротко о товаре'); ?></div>
                        <ul class="pl-4 mb-0">
                            <?
                            $count = 0;
                            foreach ($product->properties as $key => $value):

                                ?>

                                <li class="font-weight-normal text-muted fp-16">
                                    <?= $value->name . ' - ';
                                    echo implode(', ', $value->items);
                                    ?>
                                </li>

                            <? endforeach; ?>
                        </ul>

                        <!-- <div class="mt-3">
                            <a href="#tab-2">Показать больше...</a>
                        </div>
                        <div class="mt-1">
                            <a href="#tab-5">Задать вопрос о товаре</a>
                        </div>
                        <div>
                            <a href="<? /*= $product->categoryUrl ?: '/shop/user/common-market/market.aspx' */ ?>"
                               data-pjax="0"
                            >Все товары <span
                                        class="font-weight-bold"><? /*= $product->brand */ ?></span> </a>
                        </div>-->

                        <a href="<?= $product->categoryUrl ?>">
                            <div style='height: 50px; background-image: url("<?= $product->brandImage ?>"); background-size: contain; background-repeat: no-repeat'
                                 class="brand-image"></div>
                        </a>
                    </div>



                </div>
                <div class="col-4" >
                    <div class="font-weight-normal fp-18 d-flex justify-content-center"><?= Az::l('Популярные предложения из магазинов');?></div>
                    <div id="market" class="d-flex flex-column justify-content-center text-muted">

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php

echo $this->require( '/webhtm/block/SingleProduct/footer.php');
?>






<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>
