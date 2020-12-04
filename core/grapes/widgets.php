<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\models\page\PageBlocksType;
use zetsoft\models\page\PageWidget;
use zetsoft\models\page\PageWidgetType;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\navigat\ZOnlyForGrapes;
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

    $this->fileCss('/render/former/ZGrapesJsWidget/newAssets/grapesMain.css');
    $this->fileCss('https://cdn.jsdelivr.net/npm/@ciar4n/izmir@1.0.1/izmir.min.css');

    ?>

    <style>
        .uniCardSrc {
            text-align: center;
            margin: auto;
        }

        .figureCard {
            width: 400px;
            height: 200px;
        }
    </style>

</head>

<body class="<?= ZWidget::skin['white-skin'] ?>">

<?php

$this->beginBody();

echo ZNProgressWidget::widget([]);

?>

<div class="container-fluid p-0 mr-0">
    <div class="d-flex flex-wrap justify-content-center">

        <?php


        $html = <<<HTML
<div class="col-md-12 mt-5 widgets fill fill-{widget}" data-widget="{widget}" draggable="true">
        <div class="titleCard">

        </div>
        <figure class="c4-izmir c4-border-corners-1 c4-image-zoom-out c4-gradient-bottom figureCard col-md-12">
            <figcaption class="c4-layout-top-left">
                <div class="c4-reveal-down text-center w-100">
                    <p>{title}</p><br>
                    <i class="{icon} fp-30">

                    </i>
                </div>
        </figure>
    </div>
HTML;


        $categories = PageWidgetType::find()->all();

        foreach ($categories as $category) {

            $widgets = Az::$app->App->eyuf->grape->getWidgetsByCategory($category);
            $content = '';
            foreach ($widgets as $widget):

                $content .= strtr($html, [
                    '{title}' => $widget->title,
                    '{icon}' => $widget->icon,
                    '{id}' => $widget->name,
                    '{image}' => $widget->img,
                    '{widget}' => $widget->name
                ]);

            endforeach;

            ?>


            <div class="col-md-12">
                <?php

                if (empty($content))
                    echo '';
                else
                    echo ZOnlyForGrapes::widget([
                        'config' => [
                            'content' => $content,
                            'title' => $category->name,
                            'bodyClass' => 'd-flex justify-content-around',
                        ]
                    ]);


                ?>
            </div>
            <?php
        }

        ?>

    </div>
</div>


<script>

</script>

<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>
