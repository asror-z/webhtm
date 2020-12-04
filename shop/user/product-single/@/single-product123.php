<?php

use rmrevin\yii\fontawesome\FA;
use zetsoft\dbitem\data\ALLApp;
use zetsoft\dbitem\data\Form;
use zetsoft\dbitem\data\TabItem;
use zetsoft\service\forms\Active;
use zetsoft\system\assets\ZColor;
use zetsoft\system\Az;
use zetsoft\widgets\former\ZFormWidget;
use zetsoft\widgets\incores\ZGrapesCheckboxWidget;
use zetsoft\widgets\incores\ZMCheckboxGroupWidget;
use zetsoft\widgets\inptest\ZHRadioWidget;
use zetsoft\widgets\inputes\ZHRadioButtonGroupWidget;
use zetsoft\widgets\inputes\ZImageCheckboxGroupWidget;
use zetsoft\widgets\inputes\ZInputWidget;
use zetsoft\widgets\inputes\ZKStarRatingWidget;
use zetsoft\widgets\inputes\ZRadioButtonGroup;
use zetsoft\widgets\inputes\ZRadioGroupWidget;
use zetsoft\widgets\inputes\ZRadioGroupWidget2;
use zetsoft\widgets\market\ZMiniCardWidget;
use zetsoft\widgets\market\ZProductPropertyWidget;
use zetsoft\widgets\market\ZZoomWpWidget;
use zetsoft\widgets\navigat\ZButtonWidget;
use zetsoft\widgets\navigat\ZSmartTabWidget;
use zetsoft\widgets\themes\ZTabWidget;
use function Dash\get;

/*
 * Template
 * /render/market/XeMart%20-%20Ecommerce%20Template/html/05-single-product.html
 * */


/*$product_id = $this->httpGet('id');*/

$product_id = 8;



$product = Az::$app->market->product->product($product_id);


?>

<div class="container card h-auto">

    <div class="pt-4 pb-4 pl-5 pr-5">
        <div class="d-flex">


            <div class="pl-5 w-100">
                <h6 class="text-uppercase font-weight-bold"><?php echo $product->categoryName ?></h6>

                <div class="d-flex">
                    <div class="w-100 col-md-6 p-0">
                        <?php
                        $active = new Active();
                        $active->id = 'formModal';
                        $form = $this->activeBegin($active); ?>

                        <h5 class="font-weight-bold"><?= Az::l('Характеристика') ?></h5>

                        <?php

                        $app = new ALLApp();
                        echo "<div class='row'><div class='col-md-4'>";

                        foreach ($product->properties as $key => $property) {

                            $string_n = [];
                            $column1 = new Form();
                            $column1->title = $property->name;
                            $column1->widget = ZRadioGroupWidget2::class;
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
                                'botBtn' => true,
                            ]

                        ]);
                        $this->activeEnd();
                        ?>
                    </div>

                    <div class="col-md-6 border" id="market-panel"></div>
                </div>
            </div>
        </div>
        <br>
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


