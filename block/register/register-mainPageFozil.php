<?php

/**
 *
 *
 * Author:  Asror Zakirov
 * https://www.linkedin.com/in/asror-zakirov
 * https://github.com/asror-z
 *
 */

use zetsoft\system\Az;
use zetsoft\widgets\market\ZSVGWidget;
use zetsoft\widgets\navigat\ZButtonWidget;
use zetsoft\widgets\themes\ZCarolinaWidget;
use zetsoft\widgets\themes\ZSignUpWidget;

if ($this->userIsGuest()){
    /*echo ZButtonWidget::widget([
        'config' => [
            'text' => Az::l('Вход | Регистрация'),
            'btnRounded' => true,
            'btn' => true,
            'btnStyle' => ZButtonWidget::btnStyle['btn-outline-success'],
            'btnType' => ZButtonWidget::btnType['link'],
            'url' => '/core/user/user-auth/login-register.aspx',
            'hasIcon' => false,
            'class' => 'z-depth-1 rounded text-muted',
        ]
    ]);*/

    ?>
    <style>
        .signin-cart {
            margin: 0;
            background: #fff;
            width: 300px;
            position: absolute;
            right: 0.5%;
            border-radius: 3px;
            z-index: 1200;
        }

        .signin-cart{
            top: 92%;
        }


        .signin-cart, .signin-cart-header {
            border-bottom: 1px solid #E8E8E8;
            padding-bottom: 15px;
        }

        .signin-link:hover{
            background-color: #f5f5f5;
        }

        /*.signin-cart:after {*/
        /*    bottom: 100%;*/
        /*    left: 85%;*/
        /*    border: solid transparent;*/
        /*    content: " ";*/
        /*    height: 0;*/
        /*    width: 0;*/
        /*    position: absolute;*/
        /*    pointer-events: none;*/
        /*    border-bottom-color: #eee;*/
        /*    border-width: 8px;*/
        /*    margin-left: -8px;*/
        /*}*/
    </style>
    <a id="signIn" class="text-decoration-none text-muted hint--left p-0" aria-label="Вход | Регистрация" ><i class="fal fa-user fp-28"></i></a>

    <div class="signin-cart z-depth-1" style="display: none">
        <div class="signin-cart-header py-2">
            <p class="text-center fe-12 p-2">Добро пожаловать на MarketPlace</p>
            <div class="d-flex flex-column p-0 px-2">
                <a href="#" class="btn btn-block btn-primary py-2">Войти</a>
                <div class="d-flex justify-content-center login-div mt-2">
                    <span class="lead mt-2">Войти через:</span>
                    <div class="d-flex justify-content-center align-items-center">
                        <a href="#" class="openAuth btn-floating btn-sm btn-fb" type="button" role="button">
                            <i class="fab fa-facebook"></i>
                        </a>
                        <a href="#" class="openAuth btn-floating btn-sm btn-tw" type="button" role="button">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="openAuth btn-floating btn-sm btn-gplus" type="button" role="button">
                            <i class="fab fa-google"></i>
                        </a>

                    </div>
                </div>
            </div>
            <hr>
            <div class="d-flex flex-column p-0 px-2">
                <span class="lead my-2">Новый покуптель?</span>
                <a href="/core/user/user-auth/login-register.aspx" class="btn btn-block btn-success py-2">Регистрация</a>
            </div>
        </div>
        <div class="d-flex flex-column my-2">
            
            <a href="#" class="text-black-50 fe-10 py-2 px-3 signin-link"><i class="fal fa-shopping-bag fp-18 mr-2"></i><span class="ml-1">Мои заказы</span> </a>
            <a href="#" class="text-black-50 fe-10 py-2 px-3 signin-link"><i class="fal fa-heart fp-18 mr-2"></i><span class="ml-1">Мои желания</span> </a>
            <a href="#" class="text-black-50 fe-10 py-2 px-3 signin-link"><i class="fal fa-hotel fp-18 mr-2"></i>Любимые магазины</a>
        </div>


    </div>
<?php

}
else

    echo ZSignUpWidget::widget([

    ]);
 /*  echo ZButtonWidget::widget([
        'config' => [
            'text' => Az::l('Выход'),
            'icon' => 'fas fa-sign-in-alt',
            'btnRounded' => true,
            'btn' => true,
            'btnStyle' => ZButtonWidget::btnStyle['btn-outline-danger'],
            'btnType' => ZButtonWidget::btnType['link'],
            'url' => '/core/user/user-auth/logout.aspx',
            'hasIcon' => true,
            'class' => 'z-depth-1 rounded',
        ]
    ]);*/
