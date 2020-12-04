<?php


use zetsoft\dbitem\core\WebItem;
use zetsoft\models\dyna\DynaConfig;
use zetsoft\models\page\PageAction;
use zetsoft\system\actives\ZActiveRecord;
use zetsoft\dbitem\data\TabItem;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZUrl;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\former\ZListWidget;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;
use zetsoft\widgets\navigat\ZSmartTabWidget;
use zetsoft\widgets\themes\ZTabForDynaWidget;

$action = new WebItem();

$action->title = Azl . 'Страны';
$action->icon = 'fal fa-landmark';
$action->type = WebItem::type['html'];
$action->csrf = true;
$action->debug = false;

$action->cache = false;
$action->loader = false;

$action->call = null;
$action->cacheHttp = false;

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

?>

<div id="page">

    <?

    echo ZSessionGrowlWidget::widget();?>

    <div id="content" class="content-footer p-3">
        <?php


        /* @var ZActiveRecord $model */
        $modelName = $this->bootFull($this->httpGet('model'));

        $dynaId = $this->httpGet('dynaId');
        $url = $this->httpGet('url');

        $service = Az::$app->smart->dyna;
        $model = new $modelName();

        $coreDyna = DynaConfig::findOne([
            'dynaId' => $dynaId
        ]);

        $theme = str_replace('panel-', '', $this->httpGet('theme'));

        $tabData = [];

        $variantUrl = ZUrl::to([
            '/core/dynagrid/variant',
            'modelName' => $this->httpGet('model'),
            'theme' => $theme,
            'dynaId' => $dynaId,
            'url' => $url,
        ]);

        $tab = new TabItem();
        $tab->title = Az::l('Варианты');
        $tab->content = "<iframe src='$variantUrl' width='100%' style='height: 80vh; border: none'></iframe>";
        $tabData[] = $tab;


        $filterUrl = ZUrl::to([
            '/core/dynagrid/filter',
            'modelName' => $this->httpGet('model'),
            'theme' => $theme,
            'dynaId' => $dynaId,
            'url' => $url,
        ]);

        $tab = new TabItem();
        $tab->title = Az::l('Фильтр');
        $tab->content = "<iframe src='$filterUrl' width='100%' style='height: 80vh; border: none'></iframe>";
        $tabData[] = $tab;


        $tab = new TabItem();
        $tab->title = Az::l('Атрибуты');
        $tab->content = $this->require( '/webhtm/core/dynagrid/columns.php', [
            'modelName' => $this->httpGet('model'),
            'theme' => $theme,
            'dynaId' => $dynaId,
            'url' => $url,
        ]);

        $tabData[] = $tab;


        $tab = new TabItem();
        $tab->title = Az::l('Параметры');
        $tab->content = $this->require( '/webhtm/core/dynagrid/configs.php', [
            'modelName' => $this->httpGet('model'),
            'theme' => $theme,
            'id' => $dynaId,
            'url' => $url,
        ]);

        $tabData[] = $tab;


        $tab = new TabItem();
        $tab->title = Az::l('Колонки');
        $tab->content = $this->require( '/webhtm/core/dynagrid/sorting.php', [
            'modelName' => $this->httpGet('model'),
            'theme' => $theme,
            'dynaId' => $dynaId,
            'configs' => $this->httpPost('configs'),
            'url' => $url,
        ]);
        $tabData[] = $tab;


        echo ZSmartTabWidget::widget([
            'data' => $tabData,
        ]);

        ?>


        <script>



        </script>

    </div>

</div>
<style>
    #content-panel-id {
        padding: 0;
    }

    .bootstrap-switch .bootstrap-switch-handle-on, .bootstrap-switch .bootstrap-switch-handle-off, .bootstrap-switch .bootstrap-switch-label {
        padding: 0 !important;
        width: 50%;
    }

    .nav-item {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        width: 20% !important;
    }
</style>

<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>



