<?php


use zetsoft\system\kernels\ZView;
use zetsoft\widgets\ajaxify\ZStatusWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\iconers\ZLangPickerWidgetDropdown;
use zetsoft\widgets\menus\ZMmenuWidget;

if (!$this->userIsGuest()) ZStatusWidget::widget([]);
/** @var ZView $this */
$baseUrl = $this->urlGetBase();


echo ZNProgressWidget::widget([]);


if (!$this->httpGet('spa'))
    echo ZMmenuWidget::widget([
        'config' => [
            'content' => '<h2 class="display-3 font-weight-bold text-white-50">Arbit</h2>
',
            'theme' => ZMmenuWidget::theme['dark'],
            'expandedUse' => true,
            'content.img.width' => 230,
            'iconbar.top' => [
                "<a href='#/'><i class='fa fa-home'></i>cc</a>",
                "<a href='#/'><i class='fa fa-home'></i>cc</a>",
            ],
            'iconbar.bottom' => [
                "<a href='#/'><i class='fa fa-home'></i>aa</a>",
                "<a href='#/'><i class='fa fa-home'></i>cc</a>",
            ],
            'all.border' => ZMmenuWidget::border['border-full'],
            'menu-effect-slide' => true,
        ],
    ]);
?>
<div class="sticky-top">
    <div class="shadow-sm d-flex justify-content-between align-items-center bg-white"
         style="z-index: 999;">

        <div class="d-flex justify-content-between align-items-center" style="min-height: 40px">
            <div class="d-flex">
                <div class="mr-2 d-flex align-items-center">
                   <span id="hamburger" class="Sticky text-muted">
                    <a class="logos mburger mburger--collapse" href="#menu">
					<b></b>
					<b></b>
					<b></b>
                   </a>
                    </span>
                </div>
            </div>
            <div class="mr-3">
                <?php
                if(!$this->userIsGuest()){
                require Root . '/webhtm/cpas/client/balance.php';
                }
                ?>
            </div>
        </div>


        <div class="d-flex align-items-center">




            <div class="mr-3">
                <?php
                            require Root . '/webhtm/block/navbar/currencyCheckbox.php';
                             ?>
            </div>
            <div class="choose-lang">
                <?php
                echo ZLangPickerWidgetDropdown::widget([
                        'config' => [
                                'text' => true,
                        ]
                ]);

                ?>
            </div>
            <div class=" p-0 pr-1 mr-5">

                <?
                
                if (!$this->userIsGuest())
                    ZStatusWidget::widget([]);
                ?>

            </div>
            <div class="RegisterBlockCarolinaRegisterBtn p-0 pr-1 mr-3 border-right">

                <?= $this->require( '/webhtm/block/register/registrArbit.php'); ?>

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
                                class="fal fa-sign-out grey-text fp-25"></i> </a>
                    <?

                }
                ?>
            </div>

        </div>


    </div>
</div>








