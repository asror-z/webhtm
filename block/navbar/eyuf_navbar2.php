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
use yii\widgets\Pjax;
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

        <!-- Links -->
        <ul class="navbar-nav right-navbar-items mr-auto ">
            <!--
            <li class="nav-item leftNavbarItem active ">
                <a class="nav-link" href="#"><i class="fa fa-home bg"></i> Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item leftNavbarItem" >
                <a class="nav-link" href="#"><i class="fa fa-cog bg" ></i>Features</a>
            </li>
            <li class="nav-item leftNavbarItem">
                <a class="nav-link" href="#"><i class="fas fa-dollar-sign bg"></i>Pricing</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Dropdown link
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    <li><a class="dropdown-item" href="#">Action</a></li>
                    <li><a class="dropdown-item" href="#">Another action</a></li>
                    <li><a class="dropdown-item dropdown-toggle firstSubmenu" href="#">Submenu</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Submenu action</a></li>
                            <li><a class="dropdown-item" href="#">Another submenu action</a></li>


                            <li><a class="dropdown-item dropdown-toggle" href="#">Subsubmenu</a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="#">Subsubmenu action aa</a></li>
                                    <li><a class="dropdown-item" href="#">Another subsubmenu action</a></li>
                                </ul>
                            </li>
                            <li><a class="dropdown-item dropdown-toggle" href="#">Second subsubmenu</a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="#">Subsubmenu action bb</a></li>
                                    <li><a class="dropdown-item" href="#">Another subsubmenu action</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li><a class="dropdown-item dropdown-toggle firstSubmenu" href="#">Submenu</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Submenu action 2</a></li>
                            <li><a class="dropdown-item" href="#">Another submenu action 2</a></li>


                            <li><a class="dropdown-item dropdown-toggle" href="#">Subsubmenu</a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="#">Subsubmenu action 1 3</a></li>
                                    <li><a class="dropdown-item" href="#">Another subsubmenu action 2 3</a></li>
                                </ul>
                            </li>
                            <li><a class="dropdown-item dropdown-toggle" href="#">Second subsubmenu 3</a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="#">Subsubmenu action 3 </a></li>
                                    <li><a class="dropdown-item" href="#">Another subsubmenu action 3</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                </ul>
            </li>

            <? /*
           /*  echo ZNavbarWidget::widget([
             'id' => 1

             ]);*/
            ?>

 -->
        </ul>

        <ul class="navbar-nav my_left_ul">

            <li class="nav-item mx-auto mt-2 d-flex">


                <div class="d-flex align-items-center">
                    <?

                    
                        echo ZTopSearchWidget::widget([]);

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

                <?php
                Pjax::begin();

                ?>
                <div class="vd_mega-menu-wrapper mr-2">
                    <div class="vd_mega-menu pull-right">
                        <ul class="mega-ul">
                            <?
                            if (!$this->userIsGuest()) {

                                //Сообщение
                                /** @var ZView $this */

                                echo ZMessageWidget::widget([
                                    'config' => [
                                        'icon' => 'fas fa-' . FA::_ENVELOPE,
                                        'viewButtonTitle' => 'view all',
                                        'title' => Az::l('Сообщение'),
                                    ]
                                ]);

                                echo ZNotifyWidget::widget([
                                    'config' => [
                                        'icon' => 'fas fa-' . FA::_BELL,
                                        'title' => Az::l('Уведомления'),
                                    ]
                                ]);

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
                Pjax::end();
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

                <div>

                    <?


                    /** @var ZView $this */
                    if (!$this->userIsGuest()) {
                        echo ZCarolinaWidget::widget([
                            'config' => ['visible' => true],

                        ]);
                    } else {
                        /*
                         * Register Button
                         */
                        /*   echo ZButtonWidget::widget([
                               'config' => [
                                   'text' => az::l('Регистрация'),
                                   'icon' => 'fas fa-' . FA::_USER,
                                   'btnType' => ZButtonWidget::btnType['button'],
                                   'btnStyle' => ZButtonWidget::btnStyle['btn-primary'],
                                   'class' => 'text-white'
                               ],
                               'event' => [
                                   'click' => '$(registration).modal(\'show\')'
                               ]
                           ]);    */

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
                                'click' => '$(fastRegister).modal(\'show\')'
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
                                /*'icon' => 'fas fa-' . FA::_SIGN_IN_ALT,*/
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
                    //require_once Root.'/viewers/eyuf/cores/auth/register.php';
                    ?>
                    <div class="col-lg-12 col-md-8 col-sm-6" style="overflow: hidden;">



                        <iframe src="/cores/auth/register-frame.aspx" height="750" width="100%" class="border-0"></iframe>
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
                        <iframe src="/cores/auth/login-frame.aspx" height="600" width="100%" class="border-0"
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
                        <iframe src="/cores/auth/fast-register-frame.aspx" height="550" width="100%"
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


