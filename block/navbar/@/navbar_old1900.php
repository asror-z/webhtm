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
use zetsoft\system\Az;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\actions\ZEasyViewWidget;
use zetsoft\widgets\former\ZTopSearchWidget;
use zetsoft\widgets\iconers\ZFlagiconWidget;
use zetsoft\widgets\market\ZMSearchWidget;
use zetsoft\widgets\navigat\ZButtonWidget;
use zetsoft\widgets\notifier\ZModalNewWidget;
use zetsoft\widgets\themes\ZCarolinaWidget;
use zetsoft\widgets\themes\ZFriendRequestsWidget;
use zetsoft\widgets\themes\ZMessageWidget;
use zetsoft\widgets\themes\ZNotifyWidget;

?>
<!--Navbarco-->

<nav class="navbar navbar-expand-sm navbar-dark ilon-mask siticky-navbar">

        <span id="hamburger" class="Sticky">
            <a href="#menu" class="mburger mburger--collapse">
                <b></b>
                <b></b>
                <b></b>
            </a>
<<<<<<< HEAD:block/navbar/other/navbar_old1900.php
       </span>

    <div class="nav-item mt-2">
        <?
        echo ZMSearchWidget::widget();
        ?>
=======
        </div>
        <div class="logo col-2">
            <a href="<?= $baseUrl ?>" class="zetshopLogo">
                &nbsp;&nbsp;<img src="/render/asrorz/img/shoppingLogo.jpg" width="50"/>
            </a>
        </div>
        <div class="ZMSearchWidgetDiv col-8">
            <?
            echo ZMSearchWidget::widget();
            ?>
        </div>
>>>>>>> parent of 7ac1fdfbb... 20-05-2020_17-50-19:block/navbar/navbar2.php
    </div>

    <!-- Collapse button -->
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#basicExampleNav"
            aria-controls="basicExampleNav" aria-expanded="false" aria-label="Toggle navigation">
        <i class="fas fa-align-justify"></i>
    </button>

    <!-- Collapsible content -->
    <div class="collapse navbar-collapse" id="basicExampleNav">

        <ul class="navbar-nav my_left_ul ml-auto">

            <li class="nav-item mx-auto d-flex">

                <?php
                Az::$app->forms->zPjax->begin();
                ?>
                <div class="vd_mega-menu-wrapper w-100 mr-2">
                    <div class="vd_mega-menu ">
                        <ul class="mega-ul d-flex w-100" style="height: 65px;">
                            <?
                            if (!$this->userIsGuest()) {
                                /** @var ZView $this */

                                echo ZMessageWidget::widget([
                                    'config' => [
                                        'icon' => 'fas fa-' . FA::_ENVELOPE,
                                        'viewButtonTitle' => 'view all',
                                        'title' => Az::l('Сообщение'),
                                        'class' => 'Message',
                                    ]
                                ]);

//                                echo ZNotifyWidget::widget([
//                                    'config' => [
//                                        'icon' => 'fas fa-' . FA::_BELL,
//                                        'title' => Az::l('Уведомления'),
//                                    ]
//                                ]);

                                echo ZFriendRequestsWidget::widget([
                                    'config' => [
                                        'icon' => 'fas fa-' . FA::_USERS,
                                        'title' => Az::l('Запросы на добавление в друзья'),
                                    ]
                                ]);
                            }
                            ?>
                        </ul>
                    </div>
                </div>
                <?php
                Az::$app->forms->zPjax->end();
                ?>

<<<<<<< HEAD:block/navbar/other/navbar_old1900.php

=======
>>>>>>> parent of 7ac1fdfbb... 20-05-2020_17-50-19:block/navbar/navbar2.php
                <div class="d-flex align-items-center mr-2">
                    <?

                    echo ZFlagIconWidget::widget([
                        'config' =>
                            [
                                'visible' => true
                            ]
                    ]);
                    ?>
<<<<<<< HEAD:block/navbar/other/navbar_old1900.php
=======
                </div>
                <div class="d-flex align-items-center mr-2">
                    <?
                    echo ZCartReviewWidget::widget()
                    ?>
>>>>>>> parent of 7ac1fdfbb... 20-05-2020_17-50-19:block/navbar/navbar2.php
                    <!-- wish list button -->
                <!--    <div class="topNavbarIcons">
                        <div class="cart-box ml-auto text-center">
                            <div class="d-flex">
                                <div class="wsh-box cart-btn">
                                    <a href="/customer/wish/index.aspx"
                                       id="showCartBtn"
                                       data-toggle="tooltip"
                                       data-placement="top"
                                    >
                                        <i class="far fa-heart"></i>
                                        <span id="wish_list"><?php /*if (is_array(Az::$app->cores->session->get('wishList'))) echo count(Az::$app->cores->session->get('wishList')); else echo 0; */?></span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="topNavbarIcons">
                        <div class="cart-box ml-auto text-center">
                            <div class="d-flex">
                                <div class="wsh-box cart-btn">
                                    <a href="/shop/user/compare/index.aspx"
                                       id="showCartBtn"
                                       data-toggle="tooltip"
                                       data-placement="top"
                                    >
                                        <i class="fa fa-random"></i>

                                        <span id="compare_list"><?php /*if (is_array(Az::$app->cores->session->get('compare'))) echo count(Az::$app->cores->session->get('compare')); else echo 0; */?></span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>-->

                </div>

                <div class="RegisterBlockCarolinaRegisterBtn mt-1">

                    <?

                    /** @var ZView $this */
                    if (!$this->userIsGuest())
                        echo ZCarolinaWidget::widget(['config' => ['visible' => true],]);
                    else
                        echo ZButtonWidget::widget([
                            'config' => [
                                'text' => Az::l('Войти'),
                                'btnType' => ZButtonWidget::btnType['link'],
                                'btnStyle' => ZButtonWidget::btnStyle['btn-light'],
                                'class' => 'text-dark',
                                'btnRounded' => false,
                                'url' => '/shop/cores/auth/login.aspx',
                                'btnPaddingBottom' => ZButtonWidget::btnScale['0'],
                            ]
                        ]);
                    ?>
                    <style>
                        .vd_mega-menu-wrapper .vd_mega-menu .mega-li {
                            margin-bottom: -44px;
                        }
                    </style>
                </div>
            </li>
        </ul>
    </div>
</nav>


