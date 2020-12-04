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


/** @var ProductItem[] $product */

$product = Az::$app->market->product->product($product_id, null, true);


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

$pjax = new ZPjax();
$this->pjaxBegin($pjax);


?>
<div class="row">
    <div class="col-md-12">
        <div class="card-title">
            <!-- --><? /* $this->pjaxBegin(); */ ?>
            <?
            if (!is_array($this->sessionGet('catalogForm'))) {
                $session = [];
                foreach ($product->properties as $props) {
                    $session[] = array_key_first($props->items);
                }
                //vd($session);
                $this->sessionSet('catalogForm', $session);
            };
            ?>
            <div class="row">
                <div class="col-4">
                    <?php
                    echo $this->require( '/render/cards/ZZoomWidget/ready/zoom.php', [
                        'product' => $product
                    ])
                    ?>
                </div>
                <div class="col-4">
                    <?php


                    $active = new Active();
                    $active->id = 'formModal';
                    $active->class = 'pl-2';
                    $form = $this->activeBegin($active);
                    $app = new ALLApp();
                    ?>
                    <button type="submit" id="dilshod">dws</button>
                    <?php
                    $post = Az::$app->cores->session->get('commonD');
                    if ($post === null)  $post = [];
                    vd($post);

                    foreach ($product->properties as $key => $property_group) {
                        $value = null;

                        if (!empty($post) || $post !== null) {
                            $value = ZArrayHelper::getValue($post, 'key' . $key);

                        }
                        vd('key' . $key);
                        vd($value);
                        $string_n = [];
                        $column1 = new Form();
                        $column1->title = $property_group->name;
                        $column1->widget = ZMCheckboxGroupWidget::class;
                        $column1->options = [
                            'data' => $string_n,
                            'config' => [
                                'type' => ZMCheckboxGroupWidget::type['MaterialRadioButton'],
                                // 'checkMarkPosition' => ZMCheckboxGroupWidget::checkMarkPosition['top-left'],
                                // 'checkMarkSize' => '20px',
                                // 'url' => ZMCheckboxGroupWidget::imageUrl['none'],
                                'title' => $property_group->name
                            ],
                            'value' => [$value]

                        ];
                        $array[] = $property_group->items;

                        if ($array === '' || $array === null) {
                            $array = ['0'];
                        }

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

                    if ($this->formModel($model)) {

                    }

                    if ($model->httpPost()) {
                        $filter = $model->httpPost('ZDynamicModel');
                        vd($filter);
                        Az::$app->cores->session->set('commonD',$filter);
                    }


                    //$model = Az::$app->market->filter->singleProductForm(422) ;

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
        e.preventDefault();
        $("#dilshod").click(); 
       }
JS

                        ]
                    ]);

                    $this->activeEnd();
                    ?>
                </div>
                <div class="col-4">
                    <?php
                    vd($this->httpPost('ZDynamicModel'));
                    $get = $post;

                    $productId = ZArrayHelper::getValue($get, 'product_id');
                    unset($get['product_id']);
                    $set = Az::$app->market->cart->getcatalogsByElement($productId, $get);
                    if (is_array($set))
                        foreach ($set as $magazin) {
                            //$i++;
                            //if($i>3)continue;
                            echo $this->require( '/webhtm/shop/user/product-single/block/components/companyCard.php', [
                                'item' => $magazin
                            ]);
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php

$this->pjaxEnd();
echo $this->require( '/webhtm/block/SingleProduct/footer.php');
?>






<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>
