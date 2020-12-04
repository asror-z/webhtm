<?php

use PhpOffice\PhpSpreadsheet\Shared\OLE\PPS\Root;
use zetsoft\dbitem\core\WebItem;
use zetsoft\models\page\PageBlocks;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZGrapesJsWidgetBosya;
use zetsoft\widgets\former\ZGrapesJsWidgetRav;
use zetsoft\widgets\former\ZGrapesJsWidgetRavshan;


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
$action->loader = false;
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

echo ZNProgressWidget::widget([]);

$blockId = $this->httpGet('blockId');
$block = PageBlocks::findOne($blockId);
$path = Root . '/webhtm/block/' . $block->name;
$path = str_replace('\\', '/', $path) . '.php';

$pageArray = $this->requirePartGrape(Root . '/webhtm/core/grape/block.php', [
    'path' => $path
]);
$file = ZArrayHelper::getValue($pageArray, 'file');
$scripts = ZArrayHelper::getValue($pageArray, 'scripts');
$links = ZArrayHelper::getValue($pageArray, 'links');

ZGrapesJsWidgetRavshan::begin([
    'config' => [
        'buttonsEx' => [
            'gotoPage'
        ],
        'scripts' => $scripts,
        'links' => $links,
        'saveFile' => $path,
    ]
]);

echo $file;

ZGrapesJsWidgetRavshan::end();

$this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>
