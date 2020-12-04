<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\former\ZGrapesJsWidgetRavshan;
use zetsoft\widgets\inputes\ZKSelect2Widget;

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
$action->loader  = false;
$action->call = null;
$action->cacheHttp = false;

$this->paramSet(paramAction, $action);

$this->title();
$this->toolbar();

$this->paramSet('widget', true);

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

    ?>

</head>


<body class="<?= ZWidget::skin['white-skin'] ?>">

<?php

$this->beginBody();

$path = str_replace('/', '\\', $url) . '.php';
$path = Root . '/webhtm/' . $path;

$pageArray = $this->requirePartGrape($path);
$file = ZArrayHelper::getValue($pageArray, 'file');
$scripts = ZArrayHelper::getValue($pageArray, 'scripts');
$links = ZArrayHelper::getValue($pageArray, 'links');

ZGrapesJsWidgetRavshan::begin([
    'config' => [
        'buttonsEx' => [
            
        ],
        'scripts' => $scripts,
        'links' => $links,
        'saveFile' => $path,
        'href' => $url
    ]
]);

echo $file;

ZGrapesJsWidgetRavshan::end();

$this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>
