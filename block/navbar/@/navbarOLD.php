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
       </span>
    <!-- Navbar brand -->

    <!-- Collapse button -->
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#basicExampleNav"
            aria-controls="basicExampleNav" aria-expanded="false" aria-label="Toggle navigation">
        <i class="fas fa-align-justify"></i>
    </button>


    <!-- Collapsible content -->
    <div class="collapse navbar-collapse" id="basicExampleNav">

        <ul class="navbar-nav my_left_ul">

            <li class="nav-item mx-auto d-flex">


                <div class="d-flex align-items-center">
                    <?

                    if (!Az::$app->utility->urlApp->isMain())
                        echo ZTopSearchWidget::widget([]);

                    ?>
                </div>

                <!--Easy View-->
                <div class="ml-1 mr-2 d-flex align-items-center">
                    <?
                    /*echo ZEasyViewWidget::widget([
                        'config' => [
                            'iconColor' => '#0d47a1',
                            'visible' => true,
                        ],
                    ]);*/
                    ?>
                </div>

                <?php
                Az::$app->forms->zPjax->begin();

                ?>
                <div class="vd_mega-menu-wrapper w-100 mr-2">
                    <div class="vd_mega-menu ">
                        <ul class="mega-ul d-flex w-100" style="height: 65px;">
                            <?
                            if (!$this->userIsGuest()) {

                                //Сообщение
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


                <div class="d-flex align-items-center mr-2">
                    <?

                    echo ZFlagIconWidget::widget([
                        'config' =>
                            [
                                'visible' => true
                            ]
                    ]);
                    ?>

                </div>

                <div class="d-flex">

                    <?

                    /** @var ZView $this */
                    if (!$this->userIsGuest()) {
                        echo ZCarolinaWidget::widget([
                            'config' => ['visible' => true],

                        ]);
                    } else {


                         /*
                          * Register Button  old version with name, phone
                          */
                        echo ZButtonWidget::widget([
                            'config' => [
                                'text' => Az::l('Регистрация'),
                                'icon' => 'fas fa-' . FA::_USER,
                                'btnType' => ZButtonWidget::btnType['button'],
                                'btnStyle' => ZButtonWidget::btnStyle['btn-primary'],
                                'class' => 'text-white'
                            ],
                            'event' => [
                                'click' => '$(registration).modal(\'show\')'
                            ]
                        ]);


                    }

                    /*
                     * Register Modal old version with name, phone
                     *
                     */
                   /* ZModalNewWidget::begin([
                        'id' => 'registration',
                        'config' => [
                            'title' => az::l('Регистрация в системе'),
                            'size' => ZModalNewWidget::size['lg']
                        ]
                    ]);
                    //require_once Root.'/webhtm/shop/cores/auth/register.php';
                    */?><!--
                    <div class="col-lg-12 col-md-8 col-sm-6" style="overflow: hidden;">



                        <iframe src="/shop/cores/auth/register-frame.aspx" height="750" width="100%" class="border-0"></iframe>
                    </div>
                    --><?php
/*                    ZModalNewWidget::end();*/


                    /*
                     * Login Modal
                     *
                     */
                    ZModalNewWidget::begin([
                        'id' => 'loginNavbar',
                        'config' => [
                            'title' => az::l('Вход в систему'),
                            'size' => ZModalNewWidget::size['lg']
                        ]
                    ]);
//                    require_once Root.'/webhtm/shop/cores/auth/register.php';
                    ?>
                    <div class="col-lg-12 col-md-8 col-sm-6 loginFrame">
                        <iframe src="/shop/cores/auth/login-frame.aspx" height="600" width="100%" class="border-0"
                                scrolling="no"></iframe>
                    </div>
                    <?php
                    ZModalNewWidget::end();


                    /*
                     *  Fast Register Modal
                     *
                     */
//                    print_r(Az::$app->cores->auth->user());
                    ZModalNewWidget::begin([
                        'id' => 'fastRegister',
                        'config' => [
                            'title' => AZ::l('Регистрация'),
                            'size' => ZModalNewWidget::size['lg']
                        ]
                    ]);

                    ?>
                    <div class="col-lg-12 col-md-8 col-sm-6" style="overflow: hidden;">
                        <iframe src="/cores/auth/fast-register-frame.aspx" height="550" width="100%"
                                class="border-0"></iframe>
                    </div>

                    <?php
                    ZModalNewWidget::end();

                    ?>

                    <?php
                    ZModalNewWidget::begin([
                        'id' => 'fastRegisterVendor',
                        'config' => [
                            'title' => AZ::l('Регистрация Vendor'),
                            'size' => ZModalNewWidget::size['lg']
                        ]
                    ]);
                    ?>
                    <div class="col-lg-12 col-md-8 col-sm-6" style="overflow: hidden;">
                        <iframe src="/cores/auth/fast-register-vendor.aspx" height="550" width="100%"
                                class="border-0"></iframe>
                    </div>

                    <?php
                    ZModalNewWidget::end();

                    ?>
                    <style>
                        .vd_mega-menu-wrapper .vd_mega-menu .mega-li{
                            margin-bottom: -44px;
                        }
                    </style>
                </div>
            </li>
        </ul>
    </div>
</nav>


