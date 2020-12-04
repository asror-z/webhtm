<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\former\ZGrapesJsWidgetMaladoy;
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

$dfPath = $this->httpGet('path');
$path = Root . '/webhtm/' . $dfPath;

$path = str_replace('/', '\\', $path) . '.php';

$pageArray = $this->requirePartGrape($path);
$file = ZArrayHelper::getValue($pageArray, 'file');
$scripts = ZArrayHelper::getValue($pageArray, 'scripts');
$links = ZArrayHelper::getValue($pageArray, 'links');

ZGrapesJsWidgetRustam::begin([
    'config' => [
        'buttonsEx' => [

        ],
        'scripts' => $scripts,
        'links' => $links,
        'saveFile' => $path,
    ]
]);

echo $file;

ZGrapesJsWidgetRustam::end();

$this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>
