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
use zetsoft\widgets\inputes\ZSelect2Widget;
use zetsoft\widgets\market2\ZWishCardWidget;
use zetsoft\widgets\navigat\ZButtonWidget;
use zetsoft\widgets\notifier\ZModalNewWidget;
use zetsoft\widgets\themes\ZCarolinaWidget;
use zetsoft\widgets\themes\ZFriendRequestsWidget;
use zetsoft\widgets\themes\ZMessageWidget;
use zetsoft\widgets\themes\ZNotifyWidget;
use zetsoft\widgets\iconers\ZLangPickerWidget;
use zetsoft\widgets\navigat\ZLanguagePickerWidget;
use \zetsoft\widgets\market\ZLangWidget;



?>
<!--Navbarco-->
<section class="top-bar2">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="top-left d-flex">
                    <div class="lang-box">
                        <?
                            //echo ZLangWidget::widget();
                        ?>
                    </div>
                    <div class="mny-box">
                        <span>USD<i class="fa fa-angle-down"></i></span>
                        <ul class="list-unstyled">
                            <li>USD</li>
                            <li>GBP</li>
                            <li>EUR</li>
                        </ul>
                    </div>
                    <div class="call-us">
                        <p><img src="images/phn.png" alt="">78 150 00 00</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="top-right text-right">
                    <ul class="list-unstyled list-inline">
                        <li class="list-inline-item"><a href=""><img src="images/user.png" alt="">My Account</a></li>
                        <li class="list-inline-item"><a href=""><img src="images/wishlist.png" alt="">Wishlist</a></li>
                        <li class="list-inline-item"><a href=""><img src="images/checkout.png" alt="">Checkout</a></li>
                        <li class="list-inline-item"><a href=""><img src="images/login.png" alt="">Login</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>


