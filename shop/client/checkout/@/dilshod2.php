<?php

use kop\y2sp\ScrollPager;
use nirvana\infinitescroll\InfiniteScrollPager;
use rmrevin\yii\fontawesome\FA;
use yii\caching\TagDependency;
use yii\grid\DataColumn;
use yii\widgets\LinkPager;
use zetsoft\dbitem\core\WebItem;
use zetsoft\models\place\PlaceAdress;
use zetsoft\models\core\CoreAdvancedItem;
use zetsoft\models\shop\ShopOrder;
use zetsoft\models\user\User;
use zetsoft\system\Az;
use zetsoft\system\column\ZDataColumn;
use zetsoft\system\column\ZKDataColumn;
use zetsoft\system\column\ZLinkPager;
use zetsoft\system\column\ZPagination;
use zetsoft\system\column\ZRadioColumn;
use zetsoft\system\column\ZScrollPager;
use zetsoft\system\column\ZScrollPagerD;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\helpers\ZUrl;
use zetsoft\system\helpers\ZVarDumper;
use zetsoft\system\kernels\ZView;

use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\cards\ZAzCardWidget;
use zetsoft\widgets\cards\ZMyCardWidget1;
use zetsoft\widgets\former\ZCheckButtonWidget;
use zetsoft\widgets\former\ZCheckButtonWidgetRavshan;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\former\ZListViewWidget;
use zetsoft\widgets\market\ZFooterAllWidget;
use zetsoft\widgets\market\ZMenuWidgetAbdulloh;
use zetsoft\widgets\market\ZMSwiperDbWidget;
use zetsoft\widgets\market\ZMSwiperWidget;
use zetsoft\widgets\market\ZMyProductSummaryWidget;
use zetsoft\widgets\menus\ZSidebarWidget;
use zetsoft\widgets\navigat\ZButtonWidget;
use zetsoft\widgets\themes\ZCardWidget;


/** @var ZView $this */
$action = new WebItem();

$action->title = Azl . 'Проверки покупки';
$action->icon = 'fa fa-area-chart';
$action->type = WebItem::type['html'];
$action->csrf = true;
$action->debug = true;

$action->cache = false;

$action->call = [
//    TagDependency::invalidate()
];
$action->cacheHttp = false;

$this->paramSet(paramAction, $action);

$this->title();
$this->toolbar();

/** @var ZView $this */
$this->beginPage();
?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>

    <?php

    require Root . '/webhtm/block/metas/main.php';
    require Root . '/webhtm/block/assets/main.php';

  /*  echo ZSidebarWidget::widget([]);*/

    $this->head();

    ?>

</head>
<body class="<?= ZWidget::skin['white-skin'] ?>">

<?php

/*$pagination = new ZPagination([
    'pageSize' => 5,
    'totalCount' => 10
]);*/
//vdd($pagination);
/*$pagination->getLink($this->moduleId, $this->controlId, $this->actionId);     */
$model = Az::$app->market->product->allProducts();
$id = $this->myId();
\yii\widgets\Pjax::begin();

echo ZListViewWidget::widget([
    'data' => $model,
    'id' => $id,
    'config' => [
        'pager' => [
            'class' => ScrollPager::class,
            'enabledExtensions' => [
                ZScrollPagerD::EXTENSION_SPINNER,
                ZScrollPagerD::EXTENSION_PAGING,
                ZScrollPagerD::EXTENSION_NONE_LEFT,
            ],
            'linkPager' => [
                'class' => ZLinkPager::class,
            ],
            'eventOnRendered' => 'window.setTimeout(function() {$(window).scroll();}, 500);',
        ],
        'itemView' => static function($model, $key, $index, $widget) {
            return ZCardWidget::widget([
                'config' => [
                     'content' => $model->name
                ]
            ]);
        }
    ]
]);
\yii\widgets\Pjax::end();
?>

<?php
/*echo ZFooterAllWidget::widget([

]);*/
?>
<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>
