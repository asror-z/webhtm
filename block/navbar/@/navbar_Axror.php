<?php

/**
 *
 *
 * Author:  Asror Zakirov
 * https://www.linkedin.com/in/asror-zakirov
 * https://www.facebook.com/asror.zakirov
 * https://github.com/asror-z
 *
 */

use rmrevin\yii\fontawesome\FA;
use zetsoft\models\shop\ShopCatalog;
use zetsoft\service\forms\ZPjax;
use zetsoft\system\assets\ZColor;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\actions\ZEasyViewWidget;
use zetsoft\widgets\former\ZTopSearchWidget;
use zetsoft\widgets\iconers\ZFlagiconWidget;
use zetsoft\widgets\inputes\ZKSelect2Widget;
use zetsoft\widgets\cards\ZCartViewWidget;
use zetsoft\widgets\market\ZMenuWidget;
use zetsoft\widgets\market\ZMenuWidgetAbdulloh;
use zetsoft\widgets\market\ZMSearchWidget;

//use zetsoft\widgets\market\ZSearchNavbarWidget;
use zetsoft\widgets\former\ZExpandableSearchWidgetJ;
use zetsoft\widgets\market\ZSVGWidget;
use zetsoft\widgets\menus\ZSidebarWidget;
use zetsoft\widgets\navigat\ZButtonWidget;
use zetsoft\widgets\notifier\ZModalNewWidget;
use zetsoft\widgets\themes\ZCarolinaWidget;
use zetsoft\widgets\themes\ZFriendRequestsWidget;
use zetsoft\widgets\themes\ZMessageWidget;
use zetsoft\widgets\themes\ZNotifyWidget;
use zetsoft\widgets\themes\ZSignUpWidget;
use zetsoft\widgets\themes\ZSignUpWidget2;

/** @var ZView $this */
$baseUrl = $this->urlGetBase();


echo ZSidebarWidget::widget([]);

?>

<head>

    <?php

    require Root . '/webhtm/block/metas/main.php';
    require Root . '/webhtm/block/assets/main.php';

    $this->head();

    ?>

</head>

<div class="container-fluid">
    <div class="row">
        <nav class="navbar d-flex navbar-expand-lg ilon-mask">
            <div class="col-md-3 col-sm-4 p-2 text-center">
                <div class="logo-main">
                    <a class="logos" href="<?= $baseUrl ?>">
                        <?
                        echo ZSVGWidget::widget([
                            'config' => [
                                'type' => ZSVGWidget::type['MarketPlace'],
                            ]
                        ])
                        ?>
                    </a>
                </div>

                <div class="sticky-menus d-none">
                    <?
                    echo ZSVGWidget::widget([
                        'config' => [
                            'type' => ZSVGWidget::type['MarketPlace'],
                        ]
                    ])
                    ?>
                </div>


            </div>
            <button class="navbar-toggler mt-2" type="button" data-toggle="collapse" data-target="#market"
                    aria-controls="market" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fas fa-bars"></i>
            </button>


            <div class="col-3 p-2 d-none d-lg-block">
                <div>
                    <?
                    echo ZExpandableSearchWidgetJ::widget();
                    ?>
                </div>
            </div>
            <div class="collapse navbar-collapse col-md-6 col-sm-8" id="market">

                <ul class="navbar-nav ml-auto">
                    <li class="nav-item d-flex justify-content-end">

                        <?= $this->require( '/webhtm/block/navbar/pjaxMessNotFrien.php') ?>

                        <div class="d-flex align-items-center mt-2 mr-2 viewWidgetClass">

                            <?= $this->require( '/webhtm/block/navbar/cartWishCompareView.php') ?>

                        </div>

                        <div class="RegisterBlockCarolinaRegisterBtn pr-4">

                            <?= $this->require( '/webhtm/block/reister/ALL/register_Axror.php') ?>

                        </div>
                    </li>
                </ul>


            </div>

        </nav>
    </div>
</div>


<script>


</script>



