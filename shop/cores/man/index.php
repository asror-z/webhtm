<?php

use rmrevin\yii\fontawesome\FA;
use yii\caching\TagDependency;
use yii\helpers\ArrayHelper;
use zetsoft\dbitem\core\WebItem;
use zetsoft\models\place\PlaceAdress;
use zetsoft\models\core\CoreAdvancedItem;


use zetsoft\models\faqs\Faqs;
use zetsoft\models\faqs\FaqsType;
use zetsoft\models\faqs\FaqsManual;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\cards\ZAzCardWidget;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\market\ZFooterAllWidget;
use zetsoft\widgets\market\ZMenuWidgetAbdulloh;
use zetsoft\widgets\market\ZMSwiperDbWidget;
use zetsoft\widgets\market\ZMSwiperWidget;
use zetsoft\widgets\menus\ZMmenuWidget;
use zetsoft\widgets\menus\ZMmenuWidgetSh;
use zetsoft\widgets\menus\ZSidebarWidget;
use zetsoft\widgets\navigat\ZAccLayWidgetNew;
use zetsoft\widgets\navigat\ZLiloAccordionWidget;
use zetsoft\widgets\navigat\ZMarketDropdownWidget;
use zetsoft\widgets\themes\ZCardWidget;


/** @var ZView $this */
$action = new WebItem();

$action->title = Azl . 'EyufManual';
$action->icon = 'fa fa-area-chart';
$action->type = WebItem::type['html'];
$action->csrf = true;
$action->debug = true;
$action->cache = false;
$action->cacheHttp = false;

/** @var ZView $this */
$this->paramSet(paramAction, $action);

$this->title();
$this->toolbar();

$this->beginPage();
?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>

    <?php

    require Root . '/webhtm/block/metas/main.php';
    require Root . '/webhtm/block/assets/main.php';
    //require Root . '/webhtm/block/header/main.php';
    //require Root . '/webhtm/block/navbar/main.php';

    $this->head();

    ?>

</head>
<body class="<?= ZWidget::skin['white-skin'] ?>">

<?= $this->beginBody();
echo ZMmenuWidget::widget([
    //'data' => $this->cores->menus->create('mmenu'),
    'config' => [
        'theme' => 'white',
        'content.img.width' => 230,
        'iconbar.top' => [
            "<a href='#/'><i class='fa fa-home'></i>cc</a>",
            "<a href='#/'><i class='fa fa-home'></i>cc</a>",
        ],
        'iconbar.bottom' => [
            "<a href='#/'><i class='fa fa-home'></i>aa</a>",
            "<a href='#/'><i class='fa fa-home'></i>cc</a>",
        ],
        'all.border' => ZMmenuWidget::border['border-full'],
        'menu-effect-slide' => true,
    ],
]);
?>
<div id="page">
 
<?
require Root . '/webhtm/block/navbar/admin.php';
$model = new FaqsManual();
$model->configs->edit = false;
$model->configs->filter = false;
$model->columns();


/** @var ZView $this */
echo ZDynaWidget::widget([
    'model' => $model,
    'rightNameEx' => [
        'system'
    ],
    'config' => [
        'search' => false,
        'actionButtons' => [
            'view',
        ],
        'columnBefore' => [
            'serial',
            'action',
            ],
        'columnAfter' => [],
        'hasToolbar' => false,

    ]
]);

?>
<br>
</div>
<?= ZFooterAllWidget::widget(); ?>
<?php $this->endBody() ?>
<script>
    $(document).ready(function () {
        $('tr.tr-dynawidget td').removeClass('kv-align-center');
    });
</script>
</body>
</html>
<?php $this->endPage() ?>
