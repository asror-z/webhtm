<?php


use zetsoft\system\Az;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\ajaxify\ZStatusWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\iconers\ZLangPickerWidget;
use zetsoft\widgets\iconers\ZLangPickerWidgetDropdown;
use zetsoft\widgets\inputes\ZSelect2LangWidget;
use zetsoft\widgets\menus\ZMmenuWidget;

if (!$this->userIsGuest()) ZStatusWidget::widget([]);
/** @var ZView $this */
$baseUrl = $this->urlGetBase();

$this->fileJs('/render/asrorz/market/js/navbar.js');

echo ZNProgressWidget::widget([]);


?>
<div class="sticky-top">
    <div class="shadow-sm d-flex justify-content-center justify-content-lg-between flex-wrap ml-1 bg-white"
         style="z-index: 999;">
        <div class="d-flex justify-content-between" style="min-height: 40px">
            <div class="d-flex">
                <div class="mr-2 d-flex align-items-center">
                   <span id="hamburger" class="Sticky text-muted">
                    <a class="logos mburger mburger--collapse" href="#menu">
					<b><h1 style="color: #0a0a0a">Doft Admin</h1></b>
					<b></b>
					<b></b>
                   </a>
                    </span>
                </div>
            </div>

        </div>


        <div class="d-flex align-items-center">


            <div class="mr-3">
                <?php
                require Root . '/webhtm/doft/user/balance.php';
                ?>
            </div>

            <!--<div class="mr-3">
                <?php
            /*                require Root . '/webhtm/block/navbar/currencyCheckbox.php';
                            */ ?>
            </div>-->
            <div >
                <label for="cars">Zetsoft LLC:</label>
                <select name="cars" id="cars">
                    <option value="volvo">Volvo</option>
                    <option value="saab">Saab</option>
                    <option value="opel">Opel</option>
                    <option value="audi">Audi</option>
                </select>
            </div>
            <div class=" p-0 pr-1 mr-5">

                <?


                if (!$this->userIsGuest()) ZStatusWidget::widget([]);
                ?>

            </div>
            <div class="RegisterBlockCarolinaRegisterBtn p-0 pr-1 mr-5 border-right">

                <?= $this->require( '/webhtm/block/register/registerAdmin.php'); ?>

            </div>

            <div class="RegisterBlockCarolinaRegisterBtn p-0">

                <? /*= $this->require( '/webhtm/block/register/register.php'); */ ?>

            </div>
            <div>
                <?php
                if ($this->userIsGuest()) {

                    ?>
                    <a href="/cpas/user/login-register.aspx" class="hint--bottom" aria-label="Вход"><i
                            class="fal fa-sign-out grey-text fp-25 mr-3"></i> </a>

                    <?

                } else {

                    ?>
                    <a href="/cpas/user/user-auth/logout.aspx" class="hint--bottom" aria-label="Выход"><i
                            class="fal fa-sign-out grey-text fp-25 mr-3"></i> </a>
                    <?

                }
                ?>
            </div>

        </div>


    </div>
</div>








