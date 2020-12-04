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
use zetsoft\widgets\iconers\ZLangPickerWidget;
use zetsoft\widgets\menus\ZMmenuWidget;
use zetsoft\widgets\navigat\ZButtonWidget;
use zetsoft\widgets\notifier\ZModalNewWidget;
use zetsoft\widgets\themes\ZCarolinaWidget;
use zetsoft\widgets\themes\ZFriendRequestsEyufWidget;
use zetsoft\widgets\themes\ZMessageEyufWidget;
use zetsoft\widgets\themes\ZNotifyEyufWidget;


echo ZMmenuWidget::widget([
    'config' => [
        'theme' => ZMmenuWidget::theme['eyuf'],
        'content' => '<div class="zlogo">
                <img src="/render/asrorz/images/logo.jpg" width="100px">
            </div>',
    ]
]);

?>
<!--Navbarco-->

<div class="sticky-top">

    <?
    /** @var ZView $this */

    $this->paramSet(paramChangeReloadId, 'navbar');
    $this->pjaxBegin();

    ?>

    <nav class="navbar navbar-expand-sm navbar-dark ilon-mask siticky-navbar navbar-eyuf">

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

            <!-- Links -->
            <ul class="navbar-nav right-navbar-items mr-auto ">

            </ul>

            <ul class="navbar-nav my_left_ul">

                <li class="nav-item mx-auto d-flex">


                    <div class="ml-1 mr-2 d-flex align-items-center">
                        <?
                        echo ZTopSearchWidget::widget();
                        ?>

                    </div>

                    <!--Easy View-->
                    <div class="ml-1 mr-2 d-flex align-items-center">
                        <?
                        echo ZEasyViewWidget::widget([
                            'config' => [
                                'iconColor' => '#0d47a1',
                                'visible' => true,
                            ],
                        ]);
                        ?>
                    </div>


                    <div class="vd_mega-menu-wrapper mr-2">
                        <div class="vd_mega-menu pull-right">
                            <ul class="mega-ul">
                                <?
                                if (!$this->userIsGuest()) {


                                    echo ZMessageEyufWidget::widget([
                                        'config' => [
                                            'icon' => 'fas fa-' . FA::_ENVELOPE,
                                            'viewButtonTitle' => 'view all',
                                            'title' => Az::l('Сообщение'),
                                        ]
                                    ]);

                                    //    $this->pjaxBegin();

                                    echo ZNotifyEyufWidget::widget([
                                        'config' => [
                                            'icon' => 'fas fa-' . FA::_BELL,
                                            'title' => Az::l('Уведомления'),
                                        ]
                                    ]);

                                    //  $this->pjaxEnd();

                                    echo ZFriendRequestsEyufWidget::widget([
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


                    <div class="d-flex align-items-center mr-2">

                        <?
                        echo ZLangPickerWidget::widget()
                        ?>


                    </div>

                    <div>

                        <?


                        if (!$this->userIsGuest()) {
                            echo ZCarolinaWidget::widget([
                                'config' => ['visible' => true],

                            ]);
                        } else {
                            /*
                             * Fast Register Button
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
                                    'click' => '$("#fastRegister").modal(\'show\')'
                                ]
                            ]);
                            /*
                        * Login Button
                        */
                            echo ZButtonWidget::widget([
                                'config' => [
                                    'text' => Az::l('Вход'),
                                    'hasIcon' => false,
                                    'btnType' => ZButtonWidget::btnType['button'],
                                    'icon' => 'fas fa-' . FA::_SIGN_IN_ALT,
                                    'btnStyle' => ZButtonWidget::btnStyle['btn-primary'],
                                    'class' => 'text-white',
                                    //'iconSizePx' => '20'

                                ],
                                'event' => [
                                    'click' => '$("#loginNavbar").modal(\'show\')'
                                ]
                            ]);

                        }

                        /*
                         * Register Modal
                         *
                         */
                        ZModalNewWidget::begin([
                            'id' => 'registration',
                            'config' => [
                                'title' => az::l('Регистрация в системе'),
                                'size' => ZModalNewWidget::size['lg']
                            ]
                        ]);

                        ?>
                        <div class="col-lg-12 col-md-8 col-sm-6" style="overflow: hidden;">

                            <iframe src="/eyuf/cores/auth/register-frame.aspx" height="750" width="100%"
                                    class="border-0"></iframe>
                        </div>
                        <?php
                        ZModalNewWidget::end();


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
                        //require_once Root.'/viewers/eyuf/cores/auth/register.php';
                        ?>
                        <div class="col-lg-12 col-md-8 col-sm-6" style="overflow: hidden;">
                            <iframe src="/eyuf/cores/auth/login-frame.aspx" height="600" width="100%" class="border-0"
                                    scrolling="no"></iframe>
                        </div>
                        <?php
                        ZModalNewWidget::end();


                        /*
                         *  Fast Register Modal
                         *
                         */
                        ZModalNewWidget::begin([
                            'id' => 'fastRegister',
                            'config' => [
                                'title' => AZ::l('Регистрация'),
                                'size' => ZModalNewWidget::size['lg']
                            ]
                        ]);

                        ?>
                        <div class="col-lg-12 col-md-8 col-sm-6" style="overflow: hidden;">
                            <iframe src="/eyuf/cores/auth/fast-register-frame.aspx" height="550" width="100%"
                                    class="border-0"></iframe>
                        </div>

                        <?php
                        ZModalNewWidget::end();

                        ?>
                    </div>


                </li>
            </ul>
        </div>
    </nav>
    <?

    $this->pjaxEnd();

    ?>

</div>


