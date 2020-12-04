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
    $this->fileCss('https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/css/bootstrap.min.css');
    $this->fileCss('https://cdn.jsdelivr.net/npm/jquery-ui-css@1.11.5/jquery-ui.min.css');
    $this->fileCss('https://cdn.jsdelivr.net/npm/owl.carousel@2.3.4/dist/assets/owl.carousel.min.css');
    $this->fileCss('https://cdn.jsdelivr.net/npm/slicknav@1.0.8/dist/slicknav.min.css');
    $this->fileCss('https://cdn.jsdelivr.net/npm/magnific-popup@1.1.0/dist/magnific-popup.css');
    $this->fileCss('https://cdn.jsdelivr.net/npm/jquery.mb.ytplayer@3.3.3/dist/css/jquery.mb.YTPlayer.min.css');
    $this->fileCss('/render/grapeAssets/ZedApp/css/styleSlider.css');
    $this->fileCss('/render/grapeAssets/ZedApp/css/responsive.css');
   // $this->fileCss('/render/grapeAssets/ZedApp/css/typography.css');

    $this->fileJs('https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.min.js');
    $this->fileJs('https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.min.js');
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

<!-- slider area start -->
<section class="slider-area d-flex align-items-center" id="home">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-sm-6 hidden-xs">
                <div class="row">
                    <div class="slider-img">
                        <img src="/render/grapeAssets/ZedApp/img/slider-left-img.png" alt="slider image">
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="slider-inner text-right">
                    <h2>Who Else Wants To User</h2>
                    <h5>And Use Our Zeed App !</h5>
                    <a class="expand-video" href="https://www.youtube.com/watch?v=8qs2dZO6wcc"><i class="fa fa-play"></i>Watch the video</a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- slider area end -->





<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>

