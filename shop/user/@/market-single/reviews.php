<?php

/**
 *
 *
 * Author:  Asror Zakirov
 * https://www.linkedin.com/in/asror-zakirov
 * https://github.com/asror-z
 *
 */

use FontLib\Table\Type\name;
use zetsoft\dbitem\chat\ReviewItem;
use zetsoft\dbitem\core\WebItem;
use zetsoft\dbitem\shop\ProductItem;
use zetsoft\dbitem\shop\PropertyItem;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\helpers\ZUrl;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\navigat\ZYandexTabWidget;
use zetsoft\widgets\navigat\ZButtonWidget;
use zetsoft\widgets\notifier\ZModalWidgetD;
use zetsoft\widgets\notifier\ZModalWidgetRavshan;

/** @var ZView $this */
$action = new WebItem();

$action->title = Azl . 'Отзывы';
$action->icon = 'fa fa-area-chart';
$action->type = WebItem::type['ajax'];
$action->csrf = true;
$action->debug = true;

$action->cache = false;
$action->cacheHttp = false;

$this->paramSet(paramAction, $action);

$this->title();
$this->toolbar();

$item = new ProductItem();

$company_id = $this->httpGet('id');

$role = $this->userRole();

if ($role === 'user')
    $button = ZButtonWidget::widget([
        'config' => [
            'text' => Az::l('Оставить Отзыв'),
            'btnRounded' => false,
            'btnStyle' => 'btn-outline-success',
            'btnSize' => 'btn-sm',
            'class' => 'small p-1 pl-2 pr-2',
            'url' => Zurl::to(['/core/user/user-auth/login-register',
                'returnUrl'=>'\user\market-single\reviews',
            ]),
        ],
    ]);
else
    $button = ZButtonWidget::widget([
        'config' => [
            'text' => Az::l('Оставить Отзыв'),
            'btnRounded' => false,
            'btnStyle' => 'btn-outline-success',
            'btnSize' => 'btn-sm',
            'class' => 'small p-1 pl-2 pr-2',
        ],
        'event' => [
            'click' =>'function(){$("#form-modal").modal(\'show\')}',
        ]
    ]);


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


$this->fileJs('/webhtm/shop/user/market-single/asset/new.js');


require Root . '/webhtm/block/header/main.php';
require Root . '/webhtm/block/navbar/main.php';
echo $this->require( '/render/market/ZYandexSingleProductHeaderWidget/ready/single-company-header.php');

?>

<div class="container-fluid">
    
    <?php
    echo $this->require( '/webhtm/shop/user/market-single/block/yandexTab.php',
        [

            'company_id' => $company_id,
            'type' => 'company'
        ]
    )
    ?>
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-center">
                <?php
                if($company_id)
                    echo $button;
                else
                    echo Az::l('Id is required');
                ?>
            </div>
        </div>
        <div class="col-lg-12">

            <?php
            if($company_id)
                echo $this->require( '/webhtm/shop/user/item-review/review-product.php', ['product_id' => $company_id]);
            ?>

        </div>
    </div>
</div>

<div>
    <?=
    $this->require( '/webhtm/block/SingleProduct/footer.php');
    ?>
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

if($company_id)
echo $this->require( '/webhtm/shop/user/item-review/review-product-new.php',
    ['product_id' => $company_id, 'review_type' => 'product']);



ZModalWidgetRavshan::end();?>

<?php $this->endBody() ?>

</body>
</html>
<?php $this->endPage() ?>








