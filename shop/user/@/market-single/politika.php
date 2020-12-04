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
use zetsoft\dbitem\user\UserCompanyItem;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\images\ZNanoGalery2Widget;
use zetsoft\widgets\navigat\ZYandexTabWidget;

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

$id = $this->httpGet('id');

$policy = Az::$app->market->company->getCompanyById($id);

if (null === $policy) {

    $policy = new UserCompanyItem();
    $policy->name = 'Bonito Kids';
    $policy->phone = '+123 459 68 25';
    $policy->id = 2;
    $policy->photo = [
        'https://images.app.goo.gl/LAM8jMfbrBmACyyk8',
        'https://images.app.goo.gl/rfWhPYEEdUwsYNgX9',
        'https://images.app.goo.gl/rfWhPYEEdUwsYNgX9',
        'https://images.app.goo.gl/rfWhPYEEdUwsYNgX9',  
    ];
}

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


require Root . '/webhtm/block/header/main.php';
require Root . '/webhtm/block/navbar/main.php';
if($policy !== null) 
echo $this->require( '/render/market/ZYandexSingleProductHeaderWidget/ready/single-company-header.php');

?>

<div id="content" class="container-fluid">
    <?php
    
     if($policy !== null) {
         echo $this->require( '/webhtm/shop/user/market-single/block/yandexTab.php',);
     }
    ?>
    <div class="row">
        <div class="col-lg-12">

            <?php

            if (empty($this->httpGet('id'))  )
                    /* echo $this->require( '/webhtm/shop/user/market-single/block/IdIsRequired.php');*/
                     echo $this->require( '/render/behruz/behruz404.php' ,[
                    'category'=>'Category']);
            else {

               ?>
                   <div class="p-3 text-justify">
                       <?
                       
                       echo $policy->policy;
                       ?>

                   </div>



                 <?
            }
            ?>

        </div>
    </div>
</div>

<div>
    <?=
    $this->require( '/webhtm/block/SingleProduct/footer.php');
    ?>
</div>

<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>








