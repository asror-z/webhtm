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

     require Root . '/webhtm/block/metas/main.php';
     require Root . '/webhtm/block/assets/main.php';

    $this->head();
    $this->fileCss('https://cdn.jsdelivr.net/npm/jquery-ui-css@1.11.5/jquery-ui.min.css');
    $this->fileCss('https://cdn.jsdelivr.net/npm/owl.carousel@2.3.4/dist/assets/owl.carousel.min.css');
    $this->fileCss('https://cdn.jsdelivr.net/npm/slicknav@1.0.8/dist/slicknav.min.css');
    $this->fileCss('https://cdn.jsdelivr.net/npm/magnific-popup@1.1.0/dist/magnific-popup.css');
    $this->fileCss('https://cdn.jsdelivr.net/npm/jquery.mb.ytplayer@3.3.3/dist/css/jquery.mb.YTPlayer.min.css');
    $this->fileCss('/render/grapeAssets/ZedApp/css/style.css');
    $this->fileCss('/render/grapeAssets/ZedApp/css/responsive.css');
   // $this->fileCss('/render/grapeAssets/ZedApp/css/typography.css');

    
    $this->fileJs('https://cdn.jsdelivr.net/npm/jquery-ui-dist@1.12.1/jquery-ui.min.js');
    $this->fileJs('https://cdn.jsdelivr.net/npm/slicknav@1.0.8/dist/jquery.slicknav.min.js');
    $this->fileJs('https://cdn.jsdelivr.net/npm/owl.carousel@2.3.4/dist/owl.carousel.min.js');
    $this->fileJs('https://cdn.jsdelivr.net/npm/magnific-popup@1.1.0/dist/jquery.magnific-popup.min.js');
    $this->fileJs('https://cdn.jsdelivr.net/npm/counterup@1.0.2/jquery.counterup.min.js');
    $this->fileJs('https://cdn.jsdelivr.net/npm/waypoints@4.0.1/lib/jquery.waypoints.min.js');
    $this->fileJs('/render/grapeAssets/ZedApp/js/theme.js');
    $this->fileJs('https://cdn.jsdelivr.net/npm/jquery.mb.ytplayer@3.3.3/dist/jquery.mb.YTPlayer.min.js');



    ?>

</head>


<body class="<?= ZWidget::skin['white-skin'] ?>">

<?php

$this->beginBody();

echo ZNProgressWidget::widget([]);

?>

    <!-- header area start -->
    

    <header id="header">
    <div class="header-area">
        <div class="container">
            <div class="row">
                <div class="menu-area col-lg-12">
                    <div class="col-md-3 col-sm-12 col-xs-12">
                        <div class="logo">
                            <a href="index.html"><img src="/render/grapeAssets/ZedApp/img/logo.png" alt="Zeedapp - App Landing Template"></a>
                        </div>
                    </div>
                    <div class="col-md-9 hidden-xs hidden-sm">
                        <div class="main-menu">
                            <nav class="nav-menu">
                                <ul class="p-0 m-0">
                                    <li class="active mb-0"><a class="text-decoration-none pl-0" href="#home">Home</a></li>
                                    <li class="mb-0"><a class="text-decoration-none pl-0" href="#feature">Features</a></li>
                                    <li class="mb-0"><a class="text-decoration-none pl-0" href="#screenshot">Screenshot</a></li>
                                    <li class="mb-0"><a class="text-decoration-none pl-0" href="#pricing">Pricing</a></li>
                                    <li class="mb-0"><a class="text-decoration-none pl-0" href="#team">Team</a></li>
                                    <li class="mb-0"><a class="text-decoration-none pl-0" href="#download">Download</a></li>
                                    <li class="mb-0"><a class="text-decoration-none pl-0" href="#blog">Blog</a></li>
                                    <li class="mb-0"><a class="text-decoration-none pl-0" href="#contact">Contact</a></li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                    <div class="col-sm-12 col-xs-12 visible-sm visible-xs">
                        <div class="mobile_menu"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
    <!-- header area end -->





<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>

