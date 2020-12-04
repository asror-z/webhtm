<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
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
    $this->fileCss('/render/grapeAssets/styleComponents/cloudBanner.css');
    $this->fileJs('../../../../../render/grapeAssets/scriptComponents/moonlightBanner.js');



    ?>

</head>


<body class="<?= ZWidget::skin['white-skin'] ?>">

<?php

$this->beginBody();

echo ZNProgressWidget::widget([]);

?>

<div class="cbp-body-banner">
    <div class="cbp-banner">
        <div id="text">ZetSoft</div>
        <div class="cbp-clouds">
            <img src="../../../../../render/grapeAssets/styleComponents/img/cloud1.png" style="--i:1">
            <img src="../../../../../render/grapeAssets/styleComponents/img/cloud2.png" style="--i:2">
            <img src="../../../../../render/grapeAssets/styleComponents/img/cloud3.png" style="--i:3">
            <img src="../../../../../render/grapeAssets/styleComponents/img/cloud4.png" style="--i:4">
            <img src="../../../../../render/grapeAssets/styleComponents/img/cloud5.png" style="--i:5">
            <img src="../../../../../render/grapeAssets/styleComponents/img/cloud1.png" style="--i:10">
            <img src="../../../../../render/grapeAssets/styleComponents/img/cloud2.png" style="--i:9">
            <img src="../../../../../render/grapeAssets/styleComponents/img/cloud3.png" style="--i:8">
            <img src="../../../../../render/grapeAssets/styleComponents/img/cloud4.png" style="--i:7">
            <img src="../../../../../render/grapeAssets/styleComponents/img/cloud5.png" style="--i:6">
        </div>
    </div>
</div>



<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>


