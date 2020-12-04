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
    $this->fileCss('/render/grapeAssets/ZedApp/css/style.css');
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

<div id="preloader">
    <div class="spinner"></div>
</div>
<!-- preloader area end -->
<!-- header area start -->
<header id="header">
    <div class="header-area">
        <div class="container">
            <div class="row">
                <div class="menu-area">
                    <div class="col-md-3 col-sm-12 col-xs-12">
                        <div class="logo">
                            <a href="index.html"><img src="assets/img/icon/logo.png" alt="Zeedapp - App Landing Template"></a>
                        </div>
                    </div>
                    <div class="col-md-9 hidden-xs hidden-sm">
                        <div class="main-menu">
                            <nav class="nav-menu">
                                <ul>
                                    <li class="active"><a href="#home">Home</a></li>
                                    <li><a href="#feature">Features</a></li>
                                    <li><a href="#screenshot">Screenshot</a></li>
                                    <li><a href="#pricing">Pricing</a></li>
                                    <li><a href="#team">Team</a></li>
                                    <li><a href="#download">Download</a></li>
                                    <li><a href="#blog">Blog</a></li>
                                    <li><a href="#contact">Contact</a></li>
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
<!-- slider area start -->
<section class="slider-area" id="home">
    <div class="container">
        <div class="col-md-6 col-sm-6 hidden-xs">
            <div class="row">
                <div class="slider-img">
                    <img src="assets/img/mobile/slider-left-img.png" alt="slider image">
                </div>
            </div>
        </div>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="row">
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
<!-- service area start -->
<div class="service-area">
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-sm-4 col-xs-12">
                <div class="service-single">
                    <img src="assets/img/service/service-img1.png" alt="service image">
                    <h2>Call service</h2>
                    <p>Take The initative to call</p>
                </div>
            </div>
            <div class="col-md-4 col-sm-4 col-xs-12 col-6">
                <div class="service-single">
                    <img src="assets/img/service/service-img2.png" alt="service image">
                    <h2>Active warning</h2>
                    <p>Timely detection of accidents</p>
                </div>
            </div>
            <div class="col-md-4 col-sm-4 col-xs-12 col-6">
                <div class="service-single">
                    <img src="assets/img/service/service-img3.png" alt="service image">
                    <h2>Care plan</h2>
                    <p>The care content is pushed</p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- service area end -->
<!-- about area start -->
<div class="about-area ptb--100">
    <div class="container">
        <div class="section-title">
            <h2>About App</h2>
            <p>Nemo enim ipsam voluptatem quia voluptas sit </p>
        </div>
        <div class="row d-flex flex-center">
            <div class="col-md-6 col-sm-6 hidden-xs">
                <div class="about-left-img">
                    <img src="assets/img/about/abt-left-img.png" alt="image">
                </div>
            </div>

            <div class="col-md-6 col-sm-6 col-xs-12 d-flex flex-center">
                <div class="about-content">
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed  eiuiosmod terttmpor incididunt ut labore et dolore magna aliqua. enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. doliuor in reprehenderit in voluptate velit esse  dolore eu fugiat nulla pariatur. cdatat non proident</p>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tuiempor incididunt ut labore et dolore magna aliqua. enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip</p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- about area end -->
<!-- feature area start -->
<section class="feature-area bg-gray ptb--100" id="feature">
    <div class="container">
        <div class="section-title">
            <h2>Features</h2>
            <p>Nemo enim ipsam voluptatem quia voluptas sit</p>
        </div>
        <div class="row">
            <div class="col-md-4 col-sm-6 col-xs-12">
                <div class="ft-content rtl">
                    <div class="ft-single">
                        <img src="assets/img/icon/feature/1.png" alt="icon">
                        <div class="meta-content">
                            <h2>Full Optional</h2>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, iumod tempor incididunt</p>
                        </div>
                    </div>
                    <div class="ft-single">
                        <img src="assets/img/icon/feature/2.png" alt="icon">
                        <div class="meta-content">
                            <h2>Unique Design</h2>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, iumod tempor incididunt</p>
                        </div>
                    </div>
                    <div class="ft-single">
                        <img src="assets/img/icon/feature/3.png" alt="icon">
                        <div class="meta-content">
                            <h2>Voice Maker</h2>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, iumod tempor incididunt</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 hidden-sm col-xs-12">
                <div class="ft-screen-img">
                    <img src="assets/img/mobile/ft-screen-img.png" alt="image">
                </div>
            </div>
            <div class="col-md-4 col-sm-6 col-xs-12">
                <div class="ft-content">
                    <div class="ft-single">
                        <img src="assets/img/icon/feature/4.png" alt="icon">
                        <div class="meta-content">
                            <h2>Easy Settings</h2>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, iumod tempor incididunt</p>
                        </div>
                    </div>
                    <div class="ft-single">
                        <img src="assets/img/icon/feature/5.png" alt="icon">
                        <div class="meta-content">
                            <h2>Flat Design</h2>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, iumod tempor incididunt</p>
                        </div>
                    </div>
                    <div class="ft-single">
                        <img src="assets/img/icon/feature/6.png" alt="icon">
                        <div class="meta-content">
                            <h2>Easy Download</h2>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, iumod tempor incididunt</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- feature area end -->
<!-- achivement area start -->
<div class="achivement-area ptb--100">
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-sm-3 col-xs-12">
                <div class="ach-single">
                    <div class="icon"><i class="fa fa-users"></i></div>
                    <p><span class="counter">10</span>k</p>
                    <h5>Happy Clients</h5>
                </div>
            </div>
            <div class="col-md-3 col-sm-3 col-xs-12">
                <div class="ach-single">
                    <div class="icon"><i class="fa fa-book"></i></div>
                    <span class="counter">978</span>
                    <h5>Projects complet</h5>
                </div>
            </div>
            <div class="col-md-3 col-sm-3 col-xs-12">
                <div class="ach-single">
                    <div class="icon"><i class="fa fa-coffee"></i></div>
                    <p><span class="counter">150</span>k</p>
                    <h5>Cups of coffee</h5>
                </div>
            </div>
            <div class="col-md-3 col-sm-3 col-xs-12">
                <div class="ach-single">
                    <div class="icon"><i class="fa fa-trophy"></i></div>
                    <span class="counter">100</span>
                    <h5>Winning awards</h5>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- achivement area end -->
<!-- screen slider area start -->
<section class="screen-area bg-gray ptb--100" id="screenshot">
    <div class="container">
        <div class="section-title">
            <h2>Screenshot</h2>
            <p>Nemo enim ipsam voluptatem quia voluptas sit</p>
        </div>
        <img class="screen-img" src="assets/img/mobile/screen-slider.png" alt="mobile screen">
        <div class="screen-slider owl-carousel">
            <div class="single-screen">
                <img src="assets/img/mobile/screen-slider/screen1.jpg" alt="mobile screen">
            </div>
            <div class="single-screen">
                <img src="assets/img/mobile/screen-slider/screen2.jpg" alt="mobile screen">
            </div>
            <div class="single-screen">
                <img src="assets/img/mobile/screen-slider/screen3.jpg" alt="mobile screen">
            </div>
            <div class="single-screen">
                <img src="assets/img/mobile/screen-slider/screen4.jpg" alt="mobile screen">
            </div>
            <div class="single-screen">
                <img src="assets/img/mobile/screen-slider/screen5.jpg" alt="mobile screen">
            </div>
            <div class="single-screen">
                <img src="assets/img/mobile/screen-slider/screen3.jpg" alt="mobile screen">
            </div>
            <div class="single-screen">
                <img src="assets/img/mobile/screen-slider/screen4.jpg" alt="mobile screen">
            </div>
        </div>
    </div>
</section>
<!-- screen slider area end -->
<!-- testimonial carousel area start -->
<div class="testimonial-area ptb--100">
    <div class="container">
        <div class="section-title">
            <h2>Client Says</h2>
            <p>Nemo enim ipsam voluptatem quia voluptas sit</p>
        </div>
        <div class="testimonial-slider owl-carousel">
            <div class="single-tst">
                <img src="assets/img/author/tst-author1.jpg" alt="author">
                <h4>John Doe</h4>
                <span>Founder</span>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis</p>
                <ul class="tst-social">
                    <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                    <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                    <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                    <li><a href="#"><i class="fa fa-dribbble"></i></a></li>
                    <li><a href="#"><i class="fa fa-ponterest"></i></a></li>
                </ul>
            </div>
            <div class="single-tst">
                <img src="assets/img/author/tst-author2.jpg" alt="author">
                <h4>John Doe</h4>
                <span>CEO</span>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis</p>
                <ul class="tst-social">
                    <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                    <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                    <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                    <li><a href="#"><i class="fa fa-dribbble"></i></a></li>
                    <li><a href="#"><i class="fa fa-ponterest"></i></a></li>
                </ul>
            </div>
            <div class="single-tst">
                <img src="assets/img/author/tst-author1.jpg" alt="author">
                <h4>John Doe</h4>
                <span>CEO</span>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis</p>
                <ul class="tst-social">
                    <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                    <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                    <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                    <li><a href="#"><i class="fa fa-dribbble"></i></a></li>
                    <li><a href="#"><i class="fa fa-ponterest"></i></a></li>
                </ul>
            </div>
            <div class="single-tst">
                <img src="assets/img/author/tst-author2.jpg" alt="author">
                <h4>John Doe</h4>
                <span>CEO</span>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis</p>
                <ul class="tst-social">
                    <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                    <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                    <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                    <li><a href="#"><i class="fa fa-dribbble"></i></a></li>
                    <li><a href="#"><i class="fa fa-ponterest"></i></a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- testimonial carousel area end -->
<!-- video area start -->
<div class="video-area ptb--100">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1 col-xs-12">
                <h2>Watch Video Demo</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco</p>
                <a class="expand-video" href="https://www.youtube.com/watch?v=8qs2dZO6wcc"><i class="fa fa-play"></i></a>
            </div>
        </div>
    </div>
</div>
<!-- video area end -->
<!-- pricing area start -->
<section class="pricing-area ptb--100" id="pricing">
    <div class="container">
        <div class="section-title">
            <h2>Pricing Plan</h2>
            <p>Nemo enim ipsam voluptatem quia voluptas sit</p>
        </div>
        <div class="row">
            <div class="col-md-4 col-sm-4 col-xs-12 col-6">
                <div class="single-price">
                    <div class="prc-head">
                        <span>Silver</span>
                        <h5><small>$</small>50/m</h5>
                    </div>
                    <ul>
                        <li>10 User</li>
                        <li>1 Year</li>
                        <li>512 Mb Memory</li>
                        <li>30GB SSD Disk</li>
                        <li>1 TB Transfer</li>
                        <li>6 Months Support</li>
                    </ul>
                    <a href="#">Order Now</a>
                </div>
            </div>
            <div class="col-md-4 col-sm-4 col-xs-12 col-6">
                <div class="single-price">
                    <div class="prc-head">
                        <span>Silver</span>
                        <h5><small>$</small>150/m</h5>
                    </div>
                    <ul>
                        <li>10 User</li>
                        <li>1 Year</li>
                        <li>512 Mb Memory</li>
                        <li>30GB SSD Disk</li>
                        <li>1 TB Transfer</li>
                        <li>6 Months Support</li>
                    </ul>
                    <a href="#">Order Now</a>
                </div>
            </div>
            <div class="col-md-4 col-sm-4 col-xs-12 col-6">
                <div class="single-price">
                    <div class="prc-head">
                        <span>Silver</span>
                        <h5><small>$</small>250/m</h5>
                    </div>
                    <ul>
                        <li>10 User</li>
                        <li>1 Year</li>
                        <li>512 Mb Memory</li>
                        <li>30GB SSD Disk</li>
                        <li>1 TB Transfer</li>
                        <li>6 Months Support</li>
                    </ul>
                    <a href="#">Order Now</a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- pricing area end -->
<!-- team area start -->
<section class="team-area bg-gray ptb--100" id="team">
    <div class="container">
        <div class="section-title">
            <h2>Our Amazing Team</h2>
            <p>Nemo enim ipsam voluptatem quia voluptas sit</p>
        </div>
        <div class="row">
            <div class="col-md-3 col-sm-6 col-xs-12 col-6">
                <div class="single-team">
                    <div class="team-thumb">
                        <img src="assets/img/team/team-img1.jpg" alt="image">
                    </div>
                    <h4>Jhon Deo</h4>
                    <span>Web Developer</span>
                    <ul class="tst-social">
                        <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                        <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                        <li><a href="#"><i class="fa fa-dribbble"></i></a></li>
                        <li><a href="#"><i class="fa fa-ponterest"></i></a></li>
                    </ul>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12 col-6">
                <div class="single-team">
                    <div class="team-thumb">
                        <img src="assets/img/team/team-img2.jpg" alt="image">
                    </div>
                    <h4>Jhon Deo</h4>
                    <span>Web Developer</span>
                    <ul class="tst-social">
                        <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                        <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                        <li><a href="#"><i class="fa fa-dribbble"></i></a></li>
                        <li><a href="#"><i class="fa fa-ponterest"></i></a></li>
                    </ul>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12 col-6">
                <div class="single-team">
                    <div class="team-thumb">
                        <img src="assets/img/team/team-img2.jpg" alt="image">
                    </div>
                    <h4>Jhon Deo</h4>
                    <span>Web Developer</span>
                    <ul class="tst-social">
                        <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                        <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                        <li><a href="#"><i class="fa fa-dribbble"></i></a></li>
                        <li><a href="#"><i class="fa fa-ponterest"></i></a></li>
                    </ul>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12 col-6">
                <div class="single-team">
                    <div class="team-thumb">
                        <img src="assets/img/team/team-img4.jpg" alt="image">
                    </div>
                    <h4>Jhon Deo</h4>
                    <span>Web Developer</span>
                    <ul class="tst-social">
                        <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                        <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                        <li><a href="#"><i class="fa fa-dribbble"></i></a></li>
                        <li><a href="#"><i class="fa fa-ponterest"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- team area end -->
<!-- call-action area start -->
<section class="call-to-action ptb--100" id="download">
    <div class="container">
        <div class="section-title text-white">
            <h2>Our Amazing Team</h2>
            <p>Nemo enim ipsam voluptatem quia voluptas sit</p>
        </div>
        <div class="download-btns btn-area text-center">
            <a href="#"><i class="fa fa-apple"></i>android story</a>
            <a href="#"><i class="fa fa-windows"></i>Windows story</a>
            <a href="#"><i class="fa fa-android"></i>android story</a>
        </div>
    </div>
</section>
<!-- call-action area end -->
<!-- blog area start -->
<section class="blog-post ptb--100" id="blog">
    <div class="container">
        <div class="section-title">
            <h2>Latest News</h2>
            <p>Nemo enim ipsam voluptatem quia voluptas sit</p>
        </div>
        <div class="row">
            <div class="col-md-4 col-sm-6 col-xs-12 col-6">
                <div class="single-post">
                    <a href="blog.html"><img src="assets/img/blog/blog-post-img.jpg" alt="blog image"></a>
                    <div class="blog-meta">
                        <ul>
                            <li><i class="fa fa-user"></i>John</li>
                            <li><i class="fa fa-comment"></i>Comments</li>
                            <li><i class="fa fa-calendar"></i>21 Feb 2018</li>
                        </ul>
                    </div>
                    <h2><a href="blog.html">There are many variations</a></h2>
                    <p>Lorem ipsum dolor sit amet,ut consectetur adipisicing elit,eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                </div>
            </div>
            <div class="col-md-4 col-sm-6 col-xs-12 col-6">
                <div class="single-post">
                    <a href="blog.html"><img src="assets/img/blog/blog-post-img1.jpg" alt="blog image"></a>
                    <div class="blog-meta">
                        <ul>
                            <li><i class="fa fa-user"></i>John</li>
                            <li><i class="fa fa-comment"></i>Comments</li>
                            <li><i class="fa fa-calendar"></i>21 Feb 2018</li>
                        </ul>
                    </div>
                    <h2><a href="blog.html">There are many variations</a></h2>
                    <p>Lorem ipsum dolor sit amet,ut consectetur adipisicing elit,eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                </div>
            </div>
            <div class="col-md-4 col-sm-6 col-xs-12 col-6">
                <div class="single-post">
                    <a href="blog.html"><img src="assets/img/blog/blog-post-img2.jpg" alt="blog image"></a>
                    <div class="blog-meta">
                        <ul>
                            <li><i class="fa fa-user"></i>John</li>
                            <li><i class="fa fa-comment"></i>Comments</li>
                            <li><i class="fa fa-calendar"></i>21 Feb 2018</li>
                        </ul>
                    </div>
                    <h2><a href="blog.html">There are many variations</a></h2>
                    <p>Lorem ipsum dolor sit amet,ut consectetur adipisicing elit,eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- blog area end -->
<!-- client area start -->
<div class="clinet-area bg-gray ptb--100">
    <div class="container">
        <div class="client-carousel owl-carousel">
            <img src="assets/img/client/client-img.png" alt="client image">
            <img src="assets/img/client/client-img1.png" alt="client image">
            <img src="assets/img/client/client-img2.png" alt="client image">
            <img src="assets/img/client/client-img3.png" alt="client image">
            <img src="assets/img/client/client-img1.png" alt="client image">
        </div>
    </div>
</div>
<!-- client area end -->
<!-- contact area start -->
<section class="contact-area ptb--100" id="contact">
    <div class="container">
        <div class="section-title">
            <h2>Contact Us</h2>
            <p>Nemo enim ipsam voluptatem quia voluptas sit</p>
        </div>
        <div class="row">
            <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="contact-form">
                    <form action="#">
                        <input type="text" name="name" placeholder="Enter Your Name">
                        <input type="text" name="email" placeholder="Enter Your Email">
                        <textarea name="msg" id="msg" placeholder="Your Message "></textarea>
                        <input type="submit" value="Send" id="send">
                    </form>
                </div>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="contact_info">
                    <div class="s-info">
                        <i class="fa fa-map-marker"></i>
                        <div class="meta-content">
                            <span>17 Bath Rd, Heathrow, Longford,Hounslow</span>
                            <span>TW7 1AB, UK</span>
                        </div>
                    </div>
                    <div class="s-info">
                        <i class="fa fa-mobile"></i>
                        <div class="meta-content">
                            <span>+0123 456 789 78</span>
                            <span>+0123 456 789 78</span>
                        </div>
                    </div>
                    <div class="s-info">
                        <i class="fa fa-paper-plane"></i>
                        <div class="meta-content">
                            <span>Support@domain.com</span>
                            <span>Example@Gmail.com</span>
                        </div>
                    </div>
                    <div class="c-social">
                        <ul>
                            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fa fa-behance"></i></a></li>
                            <li><a href="#"><i class="fa fa-dribbble"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- contact area end -->
<!-- footer area start -->
<footer>
    <div class="footer-area">
        <div class="container">
            <p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
                <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
        </div>
    </div>
</footer>
<!-- footer area end -->





<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>

