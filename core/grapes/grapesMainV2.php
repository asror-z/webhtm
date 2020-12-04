<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\former\ZGrapesJsWidgetMaladoy;
use zetsoft\widgets\iconers\ZLangPickerWidget;


/** @var ZView $this */

/**
 *
 * Action Params
 */

$action = new WebItem();

$action->title = Azl . 'Grapes';
$action->icon = 'fal fa-calendar-edit';
$action->type = WebItem::type['html'];
$action->csrf = true;
$action->cache = false;
$action->toolbar = false;
$action->debug = false;
$action->call = null;
$action->cacheHttp = false;

$this->paramSet(paramAction, $action);

$this->title();

$this->paramSet('widget', true);

/**
 *
 * Start Page
 */


$this->beginPage();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="<?= Yii::$app->language ?>">
<head>

    <?php

    require Root . '/webhtm/block/metas/main.php';
    require Root . '/webhtm/block/assets/main.php';

    $this->head();

    $this->fileCss('/render/former/ZGrapesJsWidget/newAssets/grapesMainTest.css');
   
    ?>
    
</head>

<body class="<?= ZWidget::skin['white-skin'] ?>" onload="initialize()">

<?php

$this->beginBody();

?>



<!--

* Landing
* @author Fozil Zayniddinov

-->
<section class="header">
    <nav class="navbar navbar-expand-lg navbar-light mx-5">
        <div class="my-2 my-lg-0">
            <a class="navbar-item mx-3 h5" href="#">Home</a>
            <a class="navbar-item mx-3 h5" href="#">About</a>
            <a class="navbar-item mx-3 h5" href="#">Contact</a>
        </div>
        <div class="mx-auto">
            <a class="navbar-brand brand-text" href="#">ZGrapes</a>
        </div>
        <div class="my-2 my-lg-0">
            <button class="btn btn-dark my-2 my-sm-0 px-5" type="submit">Start Now</button>
        </div>
        </div>
    </nav>
</section>
<section class="main">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h1 class="main-title">Introduce Your Product Quickly & Effectively</h1>
                <p class="lead main-text">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Harum magni voluptatum corporis, ab perferendis ratione aspernatur accusantium ea pariatur? Deleniti, omnis accusantium pariatur labore temporibus necessitatibus ipsam saepe adipisci officiis?</p>
                <div class="buttons d-flex mt-5">
                    <button class="btn btn-dark px-5 mr-5">Start Now</button>
                    <button class="btn btn-outline-dark px-5">Learn More</button>
                </div>
            </div>
            <div class="col-md-6 imgBox">
                <img class="img-main" src="/render/former/ZGrapesJsWidget/asset/icon/d1.svg" alt="svg image">
            </div>
        </div>
    </div>
</section>

<!-- header-section ended  -->

<!-- info-section started  -->

<section class="info">
    <div class="container">
        <div class="row">
            <div class="col-md-7">
                <h2 class="info-title">Light, Fast & Powerful</h2>
                <p class="lead info-text">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Harum magni voluptatum corporis, ab perferendis ratione aspernatur accusantium ea pariatur? Deleniti, omnis accusantium pariatur labore temporibus necessitatibus ipsam saepe adipisci officiis?</p>
                <div class="blocks d-flex mt-5">
                    <div class="icon">
                        <i class="fab fa-sketch"></i>
                        <h4>Title Goes Here</h4>
                        <p class="lead icon-text">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Cupiditate itaque aspernatur!
                        </p>
                    </div>
                    <div class="icon">
                        <i class="fab fa-sketch"></i>
                        <h4>Title Goes Here</h4>
                        <p class="lead icon-text">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Cupiditate itaque aspernatur!
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <img src="/render/former/ZGrapesJsWidget/asset/icon/d2.svg" alt="info image">
            </div>
        </div>
    </div>
</section>

<!-- info-section ended  -->

<!-- info-about started  -->

<section class="about">
    <div class="container">
        <div class="row mt-5 box">
            <div class="col-md-6">
                <img class="about-img" src="/render/former/ZGrapesJsWidget/asset/icon/d3.svg" alt="svg image">
            </div>
            <div class="col-md-6 text">
                <h2 class="about-title">Light, Fast & Powerful</h2>
                <p class="lead about-text">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Harum magni voluptatum corporis, ab perferendis ratione aspernatur accusantium ea pariatur? <br> Deleniti, omnis accusantium pariatur labore temporibus necessitatibus ipsam saepe adipisci officiis?</p>
            </div>
        </div>
        <div class="row mt-5 box">
            <div class="col-md-6 text">
                <h2 class="about-title">Light, Fast & Powerful</h2>
                <p class="lead about-text">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Harum magni voluptatum corporis, ab perferendis ratione aspernatur accusantium ea pariatur? <br> Deleniti, omnis accusantium pariatur labore temporibus necessitatibus ipsam saepe adipisci officiis?</p>
            </div>
            <div class="col-md-6">
                <img class="about-img" src="/render/former/ZGrapesJsWidget/asset/icon/d4.svg" alt="svg image">
            </div>
        </div>
        <div class="row mt-5 box">
            <div class="col-md-6 text">
                <img class="about-img" src="/render/former/ZGrapesJsWidget/asset/icon/d5.svg" alt="svg image">
            </div>
            <div class="col-md-6">
                <h2 class="about-title">Light, Fast & Powerful</h2>
                <p class="lead about-text">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Harum magni voluptatum corporis, ab perferendis ratione aspernatur accusantium ea pariatur? <br> Deleniti, omnis accusantium pariatur labore temporibus necessitatibus ipsam saepe adipisci officiis?</p>
                <button class="btn btn-dark px-4 mt-4">Purchase Now</button>
            </div>
        </div>
    </div>
</section>

<!-- info-about ended  -->

<!-- info-pricing ended  -->

<section class="pricing">
    <div class="container w-100">
        <div class="pricing-content">
            <h3 class="pricing-title">A Price To Suit Everyone</h3>
            <p class="lead pricing-text">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Fugit natus repellendus nostrum perspiciatis numquam accusantium distinctio ipsa, numquam accusantium distinctio ipsa, corrupti quis eveniet.</p>

            <div class="price">
                <h2>$40</h2>
                <p>UI Design Kit</p>
            </div>

            <div class="price-buy">
                <p>See, one price. Simple</p>
                <button class="btn btn-dark px-5">Purchase Now</button>
            </div>
        </div>
    </div>
</section>

<!-- info-pricing ended  -->

<footer class="footer">

    <div class="footer-content">
        <p class="lead">&copy;2020 ZetSoft</p>
        <h3 class="brand">Landie</h3>
        <button class="btn btn-dark px-5">Learn More</button>
    </div>
    <hr>
    <div class="footer-navbar mx-5 px-5">
        <div class="footer-links">
            <a href="#" class="link">Home</a>
            <a href="#" class="link">About</a>
            <a href="#" class="link">Contact</a>
        </div>
        <div class="footer-icons">
            <i class="fab fa-facebook-f"></i>
            <i class="fab fa-linkedin-in"></i>
            <i class="fab fa-twitter"></i>
            <i class="fab fa-youtube"></i>
            <i class="fab fa-instagram"></i>
        </div>
    </div>
</footer>







<?php
$this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>
