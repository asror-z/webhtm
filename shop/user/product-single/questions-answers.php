<?php

use rmrevin\yii\fontawesome\FA;
use zetsoft\dbitem\shop\MultiProductItem;
use zetsoft\dbitem\shop\ProductItem;
use zetsoft\dbitem\shop\PropertyItem;
use zetsoft\dbitem\chat\ReviewItem;

use zetsoft\system\Az;
use zetsoft\dbitem\core\WebItem;
use zetsoft\system\helpers\ZUrl;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\navigat\ZButtonWidget;
use zetsoft\widgets\notifier\ZModalWidgetRavshan;

/** @var ZView $this */
$action = new WebItem();

$action->title = Azl . 'Вопросы и ответы';
$action->icon = 'fa fa-area-chart';
$action->type = WebItem::type['html'];
$action->csrf = true;
$action->debug = false;
$action->cache = false;
$action->cacheHttp = false;

$this->paramSet(paramAction, $action);

$this->title();
$this->toolbar();

$product_id = $this->httpGet('id');

if ($product_id === null)
    echo 'Product Id is Required';

$reviews = Az::$app->market->review->getReviewByProductId($product_id);

if (!isset($reviews) || $reviews === null)

    $reviews = new ReviewItem();


$role = $this->userRole();

if ($role === 'user')
    $button = ZButtonWidget::widget([
        'config' => [
            'text' => Az::l('Задать вопрос'),
            'btnRounded' => false,
            'btnStyle' => 'btn-outline-success',
            'btnSize' => 'btn-sm',
            'class' => 'small p-1 pl-2 pr-2',
            'url' => Zurl::to(['/core/user/user-auth/login-register',
                'returnUrl'=>'/shop/user/product-single/questions-answers',
            ]),
        ],
    ]);
else
    $button = ZButtonWidget::widget([
        'config' => [
            'text' => Az::l('Задать вопрос'),
            'btnRounded' => false,
            'btnStyle' => 'btn-outline-success',
            'btnSize' => 'btn-sm',
            'class' => 'small p-1 pl-2 pr-2',
        ],
        'event' => [
            'click' =>'function(){$("#form-modal").modal(\'show\')}',
        ]
    ]);


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

<?
$this->beginBody();

require Root . '/webhtm/block/header/mainM.php';
require Root . '/webhtm/block/navbar/main.php';
echo $this->require( '/render/market/ZYandexSingleProductHeaderWidget/ready/single-product-header_javohir.php');
?>
<div id="content" class="container-fluid">
    <div class="row">

        <div class="col-12 mb-3">
            <?


            echo $this->require( '/webhtm/shop/user/product-single/block/yandexTab.php', [
                'id' => $product_id,
                'type' => 'product',

            ]);
            ?>
        </div>
        <div class="col-12">
            <div class="d-flex justify-content-center">
                <?php
                if($product_id)
                    echo $button;
                else
                    echo Az::l('We could not find' );
                ?>
            </div>
        </div>
        <div class="col-12">
            <?
            echo $this->require( '/webhtm/shop/user/product-single/block/question-answer.php',
                ['product_id' => $product_id]);
            ?>
        </div>


    </div>


</div>


<?php


ZModalWidgetRavshan::begin([
    'id' => 'form',
    'config'=>[
        'isFooter' => false,
        'isBtn' => false,
        'title' => Az::l('Написать Отзыв'),
    ],
]);

if($product_id)
echo $this->require( '/webhtm/shop/user/item-question/question-new.php',
    ['type' => 'question','product_id' => $product_id]);



ZModalWidgetRavshan::end();



echo $this->require( '/webhtm/block/SingleProduct/footer.php');
?>



<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>

