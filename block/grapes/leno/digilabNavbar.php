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

    // require Root . '/webhtm/block/metas/main.php';
    // require Root . '/webhtm/block/assets/main.php';

    $this->head();
    $this->fileCss('/render/grapeAssets/assetsSneky/vendori/bootstrap/bootstrap.min.css');
    $this->fileCss('/render/grapeAssets/assetsSneky/vendori/themify-icons/themify-icons.css');
    $this->fileCss('/render/grapeAssets/assetsSneky/vendori/owl-carousel/owl.theme.default.min.css');
    $this->fileCss('/render/grapeAssets/assetsSneky/vendori/owl-carousel/owl.carousel.min.css');
    $this->fileCss('/render/grapeAssets/assetsSneky/vendori/Magnific-Popup/magnific-popup.css');
    $this->fileCss('/render/grapeAssets/assetsSneky/css/style.css');



    ?>

</head>


<body class="<?= ZWidget::skin['white-skin'] ?>">

<?php

$this->beginBody();

echo ZNProgressWidget::widget([]);

?>

<!--================ Header Menu Area start =================-->
<header class="header_area">
    <div class="main_menu">
        <nav class="navbar navbar-expand-lg navbar-light">
            <div class="container box_1620">
                <a class="navbar-brand logo_h" href="index.html"><img src="img/logo.png" alt=""></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <div class="collapse navbar-collapse offset" id="navbarSupportedContent">
                    <ul class="nav navbar-nav menu_nav justify-content-end">
                        <li class="nav-item active"><a class="nav-link" href="index.html">Home</a></li>
                        <li class="nav-item"><a class="nav-link" href="about.html">About</a></li>
                        <li class="nav-item"><a class="nav-link" href="menu.html">Menu</a>
                        <li class="nav-item"><a class="nav-link" href="chef.html">Chef</a>

                        <li class="nav-item submenu dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                               aria-expanded="false">Blog</a>
                            <ul class="dropdown-menu">
                                <li class="nav-item"><a class="nav-link" href="blog.html">Blog Single</a></li>
                                <li class="nav-item"><a class="nav-link" href="blog-details.html">Blog Details</a></li>
                            </ul>
                        </li>
                        <li class="nav-item"><a class="nav-link" href="contact.html">Contact</a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
</header>
<!--================Header Menu Area =================-->


<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.min.js"></script>
<script src="/render/grapeAssets/assetsSneky/vendori/bootstrap/bootstrap.bundle.min.js"></script>
<script src="/render/grapeAssets/assetsSneky/vendori/owl-carousel/owl.carousel.min.js"></script>
<script src="/render/grapeAssets/assetsSneky/vendori/nice-select/jquery.nice-select.min.js"></script>
<script src="/render/grapeAssets/assetsSneky/vendori/Magnific-Popup/jquery.magnific-popup.min.js"></script>
<script src="/render/grapeAssets/assetsSneky/js/jquery.ajaxchimp.min.js"></script>
<script src="/render/grapeAssets/assetsSneky/js/mail-script.js"></script>
<script src="/render/grapeAssets/assetsSneky/js/main.js"></script>
<script src="/render/grapeAssets/assetsSneky/js/popper.min.js"></script>
<script src="/render/grapeAssets/assetsSneky/vendori/bootstrap/bootstrap.min.js"></script>

<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>

