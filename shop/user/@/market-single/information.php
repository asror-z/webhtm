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


 $userCompany = Az::$app->market->company->getCompanyById($id);

if (!isset($userCompany)) {

    $userCompany = new UserCompanyItem();
    $userCompany->name = 'Bonito Kids';
    $userCompany->phone = '+123 459 68 25';
    $userCompany->id = 2;
    $userCompany->photo = [
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
if($userCompany !== null)
    echo $this->require( '/render/market/ZYandexSingleProductHeaderWidget/ready/single-company-header.php');
?>

<div id="content" class="container-fluid">
    <?php
    if($userCompany !== null)
    echo $this->require( '/webhtm/shop/user/market-single/block/yandexTab.php')
    ?>
    <div class="tags row">
        <div class=" col-lg-12 pt-3">

            <style>
                .tags{
                    background-image: url('/render/asrorz/images/Back1.png');
                    background-size:98% 100%;
                    background-repeat: no-repeat;
                    background-position: center;
                }

            </style>

            <?php

            if (empty($userCompany))
                     echo $this->require( '/render/behruz/behruz404.php' ,[
                    'category'=>'Category']);
            else {

               ?>
              <h5 class="text-center h2">
                        <?= $userCompany->title; ?>

              </h5>




                 <?
            }
            ?>

        </div>
        <div class="col-lg-10 mt-0">
            <h5><?=Az::l('Описание')?></h5>
            <?=
                $userCompany->text;
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








