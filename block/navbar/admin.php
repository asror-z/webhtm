<?php


use zetsoft\system\kernels\ZView;
use zetsoft\widgets\ajaxify\ZStatusWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;

/*if (!$this->userIsGuest()) ZStatusWidget::widget([]);*/
/** @var ZView $this */
$baseUrl = $this->urlGetBase();

$this->fileJs('/render/asrorz/market/js/navbar.js');

echo ZNProgressWidget::widget([]);
?>

<div class="sticky-top">
    <div class="navbar  d-flex justify-content-center justify-content-lg-between flex-wrap ml-1">
        <div class="d-flex justify-content-between" style="max-height: 40px">
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
            <div class="d-none d-md-block">
                <!-- <div class="d-flex ml-5">
                    <? /*
                    echo ZExpandableSearchWidgetJ::widget();
                    */ ?>
                </div>-->
            </div>

        </div>


        <div class="d-flex align-items-center">
            <div class=" p-0 pr-1 mr-5">

                <?

                //$model = $this->userIdentity();
                //                $model = \zetsoft\models\user\User::findOne(107);
                //
                //                if ($model->role === 'operator')
                //                echo ZEditKartikWidget::widget([
                //                    'model' => $model,
                //                    'attribute' => 'status',
                //                    'config' => [
                //                        'asPopover' => true,
                //                        'widgetClass' => ZMImageRadioWidget::class,
                //                        'options' => [
                //                            'data' => [
                //                                'dnd' => 'dnd',
                //                                'lunch' => 'lunch',
                //                                'online' => 'online'
                //                            ],
                //                        ],
                //                        'placement' => ZEditKartikWidget::placement['ALIGN_LEFT_TOP'],
                //                    ],
                //                    'event' => [
                //                        'editableSuccess' => <<<JS
                //        function(event, val, form, data) {
                //        localStorage.setItem('test', val);
                //        }
                //JS,
                //
                //                    ]

                //                ]);
              /*  if (!$this->userIsGuest()) ZStatusWidget::widget([]);*/
                ?>

            </div>
            <div class="RegisterBlockCarolinaRegisterBtn p-0 pr-1 mr-5 border-right">

                <?= $this->require( '/webhtm/block/register/registerAdmin.php'); ?>

            </div>
            <?
            
            //echo $this->require( '/webhtm/block/navbar/pjaxMessNotFrienAdmin.php')

            ?>

            <a href="#" role="button" id="calculator" class="hint--bottom" aria-label="Калькулятор"><i
                        class="fal fa-calculator grey-text fp-23 mt-1 mr-3"></i></a>

            <?

            if ($this->userIsGuest()) {

                ?>
                <a href="/core/user/user-auth/login-register.aspx" class="hint--bottom" aria-label="Вход"><i
                            class="fal fa-sign-out grey-text fp-25 mr-3"></i> </a>

                <?
                
            } else {

                ?>
                <a href="/core/user/user-auth/logout.aspx" class="hint--bottom" aria-label="Выход"><i
                            class="fal fa-sign-out grey-text fp-25 mr-3"></i> </a>
                <?

            }

            ?>


        </div>

    </div>
</div>


<script>
    /*$(document).ready(function () {

        $('#calculator').on("click", function () {
            window.open('Calculator:///');
        });

    });*/
</script>






