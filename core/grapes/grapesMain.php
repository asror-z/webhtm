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

    $this->fileCss('/render/former/ZGrapesJsWidget/newAssets/grapesMain.css');
   
    ?>
    
</head>


<body class="<?= ZWidget::skin['white-skin'] ?>" onload="initialize()">

<?php

$this->beginBody();

?>

<!--header section start -->
<section class="header">
    <div class="container-fluid">
      
        <div class="row">
            <div class="col-md-12 m-0 p-0 ">

                <nav class="navbar navbar-expand-lg ">
                    
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav ml-5 mt-2
                         mr-auto">
                            <li class="nav-item mr-4">
                                <a class="nav-link fp-20" href="#">Home</a>
                            </li>
                            <li class="nav-item mr-4">
                                <a class="nav-link fp-20" href="#">About</a>
                            </li>
                            <li class="nav-item mr-4">
                                <a class="nav-link fp-20" href="#">Contact</a>
                            </li>
                        </ul>

                        <div class="main-Logo">
                             <p>ZGrapes</p>
                        </div>

                        <div class="main-StartBtn">
                            <a href="#" class="btn btn-block">Get Started</a>
                        </div>

                    </div>
                </nav>

            </div>
        </div>
    </div>
</section>
<!-- header section end -->

<!-- main section start -->

<section class="main">

    <div class="container-fluid">

        <div class="row">

            <div class="col-md-12">

                <div class="mainDiv col-md-6">

                    <div class="main-titles col-md-12">

                        <p class="main-text">
                            Create a Website With ZGrapes <br>
                            Lorem ipsum dolor sit amet.
                        </p>
                        <p class="main-title">
                            Discover the platform that gives you the freedom to create, design,<br> manage and develop your web presence exactly the way you want.
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Assumenda, facere. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Id, iste?    
                        </p>

                    </div>

                    <div class="col-md-12 d-flex p-0 m-0 main-btns">

                        <div class="col-md-5">
                            <a href="#" class="btn btn-block btn-dark">Start Now</a>
                        </div>

                        <div class="col-md-5">
                            <a href="#" class="btn btn-block btn-outline-dark">Learn More</a>
                        </div>

                    </div>

                </div>

                <div class="mainBack">
                    <img src="">
                </div>

            </div>


        </div>


    </div>

</section>

<!-- main section end -->











<?php
$this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>
