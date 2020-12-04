<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\models\page\PageAction;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\former\ZGrapesJsWidget;
use zetsoft\widgets\former\ZGrapesJsWidgetRav;
use zetsoft\widgets\former\ZGrapesJsWidgetRav2;
use zetsoft\widgets\former\ZGrapesJsWidgetRavNorm;
use zetsoft\widgets\former\ZGrapesJsWidgetRavshan2;
use zetsoft\widgets\former\ZGrapesJsWidgetRavshan;
use zetsoft\widgets\former\ZGrapesJsWidgetRavshanPro;
use zetsoft\widgets\notifier\ZSweetAlert2Widget;

$action = new WebItem();

$action->title = Azl . 'Конструктор';
$action->icon = 'fal fa-landmark';
$action->type = WebItem::type['html'];
$action->csrf = true;
$action->debug = false;



$this->paramSet(paramAction, $action);

$this->title();
$this->toolbar();


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


    /** @var ZView $this */
    //$this->fileCss('/block/assets/ALL/all.css');

    $this->head();

    ?>

    <title></title>
</head>

<body class="<?= ZWidget::skin['white-skin'] ?>">

<?php

$this->beginBody();

Az::$app->controller->layout = 'grapes';
$service = Az::$app->App->eyuf->grapes;

$path = $service->getViewPath($this->httpGet('key'));
$assets = $this->viewAsset($path);

$scripts = $service->getPathAssets($assets, 'scripts');
$styles = $service->getPathAssets($assets);

$page = $this->requireAjaxFilePreg($path);

preg_match_all('/<style>(.*?)<\/style>/s', $page, $match);
$cssArray = ZArrayHelper::getValue($match, 1);

$css = '';
foreach ($cssArray as $array) {
    $css .= $array;
}

ZGrapesJsWidgetRav2::begin([
    'config' => [
        'css' => $css,
        'saveFile' => $path,
        'scripts' => $scripts,
        'styles' => $styles,
        'categories' => [
            'columns',
            'blocks',
            'former',
            'inputes',
        ],
    ]
]);

echo $page;

ZGrapesJsWidgetRav2::end();

$this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>


