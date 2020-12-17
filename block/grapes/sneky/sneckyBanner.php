<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;



/** @var ZView $this */

/**
 *
 * Action Params
 */

$action = new WebItem();
$action->title = Azl . Az::l('create');
$action->icon = 'fal fa-calendar-edit';
$action->type = WebItem::type['html'];
$action->csrf = 1;
$action->cache = false;
$action->toolbar = false;
$action->debug = false;
$action->call = null;
$action->loader = false;
$action->cacheHttp = false;

/**@var ZView $this */


$this->paramSet(paramAction, $action);

/**
 *
 * Start Page
 */


$this->beginPage();
?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    
    <?php
    
    $this->head();
    $this->fileCss('/render/grapeAssets/assetsSneky/vendors/bootstrap/bootstrap.min.css');
    $this->fileCss('/render/grapeAssets/assetsSneky/vendors/themify-icons/themify-icons.css');
   
    $this->fileCss('/render/grapeAssets/assetsSneky/vendors/Magnific-Popup/magnific-popup.css');
    $this->fileCss('/render/grapeAssets/assetsSneky/css/style.css');



    ?>

</head>


<body class="<?= ZWidget::skin['white-skin'] ?>">

<?php

$this->beginBody();

echo ZNProgressWidget::widget([]);

?>



<!--================Hero Banner Section start =================-->
<section class="hero-banner">
    <div class="hero-wrapper">
        <div class="hero-left">
            <h1 class="hero-title">Foods the <br> most precious things</h1>
            <div class="d-sm-flex flex-wrap">
                <a class="button button-hero button-shadow" href="#">Book Now</a>
            </div>
            <ul class="hero-info d-none d-lg-block">
                <li>
                    <img src="/render/grapeAssets/assetsSneky/img/banner/fas-service-icon.png" alt="">
                    <h4>Fast Service</h4>
                </li>
                <li>
                    <img src="img/banner/fresh-food-icon.png" alt="">
                    <h4>Fresh Food</h4>
                </li>
                <li>
                    <img src="img/banner/support-icon.png" alt="">
                    <h4>24/7 Support</h4>
                </li>
            </ul>
        </div>
        <ul class="social-icons d-none d-lg-block">
            <li><a href="#"><i class="ti-facebook"></i></a></li>
            <li><a href="#"><i class="ti-twitter"></i></a></li>
            <li><a href="#"><i class="ti-instagram"></i></a></li>
        </ul>
    </div>
</section>
<!--================Hero Banner Section end =================-->


<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.min.js"></script>
<script src="/render/grapeAssets/assetsSneky/vendors/bootstrap/bootstrap.bundle.min.js"></script>
<script src="/render/grapeAssets/assetsSneky/vendors/owl-carousel/owl.carousel.min.js"></script>
<script src="/render/grapeAssets/assetsSneky/vendors/nice-select/jquery.nice-select.min.js"></script>
<script src="/render/grapeAssets/assetsSneky/vendors/Magnific-Popup/jquery.magnific-popup.min.js"></script>
<script src="/render/grapeAssets/assetsSneky/js/jquery.ajaxchimp.min.js"></script>
<script src="/render/grapeAssets/assetsSneky/js/mail-script.js"></script>
<script src="/render/grapeAssets/assetsSneky/js/main.js"></script>

<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>

