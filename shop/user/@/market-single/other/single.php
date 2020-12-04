<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\dbitem\shop\CompanyCardItem;
use zetsoft\dbitem\data\TabItem;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\market\ZReviewWidget;
use zetsoft\widgets\menus\ZMetisMenuWidget;
use zetsoft\widgets\navigat\ZBreadcrumbsWidget;
use zetsoft\widgets\navigat\ZBreadCrumbWidget;
use zetsoft\widgets\navigat\ZSmartTabWidget;
use zetsoft\widgets\navigat\ZYandexTabWidget;

$action = new WebItem();

$action->title = Azl . 'Категория';
$action->icon = 'fa fa-area-chart';
$action->type = WebItem::type['html'];
$action->csrf = true;
$action->debug = true;



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


    $this->head();

    ?>

</head>
<body class="<?= ZWidget::skin['white-skin'] ?> borderzz">
<?php

$this->beginBody();
require Root . '/webhtm/block/header/main.php';
require Root . '/webhtm/block/navbar/main.php';
?>

<div class="container-fluid bg-white">

    <div class="row py-3">
        
        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="row">
                <div class="col-md-12">
                        <?

                        $items = new CompanyCardItem();
                        $items->name = "Nike";
                        $items->image = "https://content.nike.com/content/dam/one-nike/globalAssets/social_media_images/nike_swoosh_logo_black.png";
                        $items->title = "Lorem ipsum dolor amit set lorem ipsum dolor sit amit get set header measure name lorem ipsum dolor sit amit lorem ipsum dolor sit amet lorem ipsum dolor sit amet lorem ipsum dolor sit amet";

                        ?>
                         
                        <div class="col-md-12">

                                <div class="col-md-6 ml-auto mr-auto company-info">
                                
                                    <div class="text-center">
                                        <h1>Компания</h1>
                                    </div>

                                     <div class="d-flex">

                                        <div>
                                            <img src="<?=$items->image?>" width="150px" height="150px" class="img-fluid ml-2">

                                        </div>

                                         <h1 class="text-center fp-40 mt-5 ml-5"><?= $items->name?></h1>


                                         <div class="company-icons ml-auto mt-3">

                                             <i class="fal fa-heart fa-2x text-muted mt-5"></i>
                                             <span>Моя избранная комапания</span>

                                         </div>
                                     </div>

                                  <!--   <div class="col-md-12">
                                          <button class="btn btn-md btn-outline-dark float-right">Больше информаци о компании</button>
                                     </div>-->

                                </div>
                                
                        </div>

                </div>

            </div>
            <div class="row">

                <div class="col-lg-12 col-md-12 col-sm-12 col-12">

                    <div class="ml-auto mr-auto">
                        <?
                        echo ZYandexTabWidget::widget([
                            'data' => [
                                'Информация' => '',
                                'Продукты' => '',
                                'Отзивы' => '',
                                'Вопросы и Ответы' => '',
                            ]
                        ]);
                        ?>
                    </div>


                </div>

            </div>
        </div>


    </div>



</div>



<style>
   
    
</style>

<?php $this->endBody() ?>

</body>
</html>

<?php
$this->endPage()
?>




