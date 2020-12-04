<?php

/*
 * @license: SherzodMangliyev
 *
 */

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
$action->type = WebItem::type['ajax'];
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

    //require Root . '/webhtm/block/assets/main1.php';

    $this->head();


    ?>

</head>

<body class="<?= ZWidget::skin['white-skin'] ?>">

<?php

$this->beginBody();

echo ZNProgressWidget::widget([]);


$html = <<<HTML
        <li data-type="widget" data-drag-type="widget" data-widget="{widget}" class="widgets" data-search="{title}" style="background-image: url('/render/former/ZVvvebJsWidget/assets/libs/builder/icons/products.svg'); background-repeat: no-repeat;)">
            
               <a href="#" class="fp-11">{title}</a>
            
        </li>
HTML;


$categories = PageWidgetType::find()->all();

foreach ($categories as $category) {

    $widgets = Az::$app->App->eyuf->grape->getWidgetsByCategory($category);
    $content = '';
    foreach ($widgets as $widget):
        //vdd($widget);
        $content .= strtr($html, [
            '{title}' => $widget->title,
            '{icon}' => $widget->icon,
            '{widget}' => $widget->name
        ]);

    endforeach;

    ?>


    <?php

    if (empty($content))
        echo '';
    else
        echo \zetsoft\widgets\navigat\ZOnlyForVveb::widget([
            'config' => [
                'content' => $content,
                'title' => $category->name,
                'dataSection' => $category->name
            ]
        ]);


    ?>

    <?php
}

?>

<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>
