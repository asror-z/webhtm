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


<body class="<?= ZWidget::skin['white-skin'] ?>">

<?php

$this->beginBody();

?>

<!--card section start -->

    <div class="container-fluid">
        <div class="row">

            <div class="col-md-12">
                <div class="container">

                    <div class="row pt-4">
                        <a href="#" class="btn btn-sm btn-outline-primary ml-auto">All</a>
                        <a href="#" class="btn btn-sm btn-outline-primary">Popular</a>
                        <a href="#" class="btn btn-sm btn-outline-primary">eCommerse</a>
                        <a href="#" class="btn btn-sm btn-outline-primary">Magazins</a>
                        <a href="#" class="btn btn-sm btn-outline-primary mr-auto">SinglePages</a>
                    </div>

                </div>
            </div>

        </div>
        <div class="row">
            
            <div class="col-md-12 p-5">

                <div class="d-flex justify-content-center flex-wrap">

                    <div class="col-md-5 templates">
                        <div class="col-md-12 h-100 border ml-2 grapeTemps" style="background: url('https://cdn2.editmysite.com/images/landing-pages/global/features/Website-Templates/designed-templates@2x.png'); background-size: 100%;">

                            <div class="cardTitles">
                                <p>Best</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-5 templates">
                        <div class="col-md-12 h-100 border ml-2 grapeTemps" style="background: url('https://www.downloadwebsitetemplates.co.uk/wp-content/uploads/2015/12/screenshot.jpg'); background-size: 100%;">

                            <div class="cardTitles">
                                <p>Best</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-5 templates">
                        <div class="col-md-12 h-100 border ml-2 grapeTemps" style="background: url('https://templatemo.com/screenshots/templatemo_401_sprint.jpg'); background-size: 100%;">

                            <div class="cardTitles">
                                <p>Best</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-5 templates">
                        <div class="col-md-12 h-100 border ml-2 grapeTemps" style="background: url('https://templatemo.com/screenshots/templatemo_396_smoothy.jpg'); background-size: 100%;">

                            <div class="cardTitles">
                                <p>Best</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-5 templates">
                        <div class="col-md-12 h-100 border ml-2 grapeTemps" style="background: url('https://uicookies.com/wp-content/uploads/2019/02/free-responsive-html5-website-templates-1000x750.jpg'); background-size: 100%;">
                            <div class="cardTitles">
                                <p>Best</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-5 templates">
                        <div class="col-md-12 h-100 border ml-2 grapeTemps" style="background: url('https://cdn2.editmysite.com/images/landing-pages/global/features/Website-Templates/designed-templates@2x.png'); background-size: 100%;">

                            <div class="cardTitles">
                                <p>Best</p>
                            </div>
                        </div>
                    </div>


                </div>

            </div>
        </div>
        
    </div>

<!-- card section end -->

<?php
$this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>
