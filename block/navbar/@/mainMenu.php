<?php




use zetsoft\models\core\ShopBrand;
use zetsoft\models\core\CoreCategory;
use zetsoft\system\kernels\ZView;

use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZExpandableSearchWidgetJ;
use zetsoft\widgets\market\ZSVGWidget;


/** @var ZView $this */
$baseUrl = $this->urlGetBase();

$this->fileJs('/render/asrorz/market/js/navbar.js');

echo ZNProgressWidget::widget([]);
?>

<div class="shadow-sm sticky-top" >
    <div class="navbar navbar-light d-flex justify-content-center justify-content-lg-between flex-wrap">
        <div class="d-flex justify-content-between" style="max-height: 40px">
            <div class="d-flex">
                <div class="mr-2">
                    <a class="logos zLoader" href="<?= $baseUrl ?>">
                        <?
                        echo ZSVGWidget::widget([
                            'config' => [
                                'type' => ZSVGWidget::type['MarketPlace'],
                            ]
                        ])
                        ?>
                    </a>
                </div>
                <div class="d-flex align-items-end " id="h1">
                    <button class="navbar-toggler grey-text" type="button" id="menu_show">
                        <i class="fas fa-bars fr-16"></i>
                    </button>
                    <div class="mt-5 pt-3 fixed-top col-3"
                         style="position: absolute;left: 0px;display: none"
                         id="navbar_menu">
                        <?

                        if (!empty($this->httpGet('category_id')))
                            echo zetsoft\widgets\market\ZMenuWidget::widget([
                                'config' => [
                                    'open' => true,
                                    //'name' => 'Категории',
                                    'mode' => 'shop',
                                    'class_position' => '',
                                    'menu-widget' => 'menu-widget bg-white text-left py-2',
                                ],
                            ]);
                        else
                            echo zetsoft\widgets\market\ZMenuWidget::widget([
                                'config' => [
                                    'open' => true,
                                    //'name' => 'Категории',
                                    'mode' => 'shop',
                                    'class_position' => '',
                                    'menu-widget' => 'menu-widget bg-white text-left py-2',
                                ],
                            ]);

                        ?>
                    </div>
                </div>
            </div>
            <div class="d-none d-md-block">
                <div class="d-flex ml-5">
                    <?
                    echo ZExpandableSearchWidgetJ::widget();
                    ?>
                </div>
            </div>

        </div>


        <div class="d-flex align-items-center">
            <?= $this->require( '/webhtm/block/navbar/pjaxMessNotFrien.php') ?>


            <div class="d-flex align-items-center viewWidgetClass">

                <?= $this->require( '/webhtm/block/navbar/cartWishCompareView.php') ?>

            </div>

            <div class="RegisterBlockCarolinaRegisterBtn p-0">

                <?= $this->require( '/webhtm/block/register/register.php'); ?>

            </div>

        </div>


    </div>
</div>






