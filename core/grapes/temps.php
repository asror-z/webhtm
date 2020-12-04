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
    $this->fileCss('https://cdn.jsdelivr.net/npm/@ciar4n/izmir@1.0.1/izmir.min.css');

   
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

<section>
    <div class="container">

        <div class="row">
                <div class="col-md-6">
                    <figure class="c4-izmir c4-border-corners-1 c4-gradient-bottom-left c4-image-zoom-out" style="--primary-color: #16A085; --secondary-color: #F4D03F;--border-width: 6px;">
                        <img src="https://images.unsplash.com/photo-1598620510939-1ee365b7ba12?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1050&q=80" alt="Sample Image">
                        <figcaption class="c4-layout-center-center">
                            <div class="c4-izmir-icon-wrapper c4-fade c4-delay-300">
                                <div class="d-flex flex-column">
                                    <i class="fas fa-plus fa-3x"></i>
                                </div>
                            </div>
                        </figcaption>
                    </figure>
                </div>

                <div class="col-md-6">
                    <figure class="c4-izmir c4-border-corners-1 c4-gradient-bottom-left c4-image-zoom-out" style="--primary-color: #16A085; --secondary-color: #F4D03F;--border-width: 6px;">
                        <img src="https://images.unsplash.com/photo-1598620510939-1ee365b7ba12?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1050&q=80" alt="Sample Image">
                        <figcaption class="c4-layout-center-center">
                            <div class="c4-izmir-icon-wrapper c4-fade c4-delay-300">
                                <i class="fas fa-plus fa-3x"></i>
                            </div>
                        </figcaption>
                    </figure>
                </div>
                <div class="col-md-6">
                    <figure class="c4-izmir c4-border-corners-1 c4-gradient-bottom-left c4-image-zoom-out" style="--primary-color: #16A085; --secondary-color: #F4D03F;--border-width: 6px;">
                        <img src="https://images.unsplash.com/photo-1598620510939-1ee365b7ba12?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1050&q=80" alt="Sample Image">
                        <figcaption class="c4-layout-center-center">
                            <div class="c4-izmir-icon-wrapper c4-fade c4-delay-300">
                                <div class="d-flex flex-column">
                                    <i class="fas fa-plus fa-3x"></i>
                                </div>
                            </div>
                        </figcaption>
                    </figure>
                </div>

                <div class="col-md-6">
                    <figure class="c4-izmir c4-border-corners-1 c4-gradient-bottom-left c4-image-zoom-out" style="--primary-color: #16A085; --secondary-color: #F4D03F;--border-width: 6px;">
                        <img src="https://images.unsplash.com/photo-1598620510939-1ee365b7ba12?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1050&q=80" alt="Sample Image">
                        <figcaption class="c4-layout-center-center">
                            <div class="c4-izmir-icon-wrapper c4-fade c4-delay-300">
                                <i class="fas fa-plus fa-3x"></i>
                            </div>
                        </figcaption>
                    </figure>
                </div>
            </div>
    </div>
</section>


<?php

$this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>
