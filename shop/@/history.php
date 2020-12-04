<?php

use kartik\grid\GridView;
use zetsoft\dbitem\core\WebItem;
use zetsoft\dbitem\data\TabItem;
use zetsoft\models\shop\ShopOrderItem;
use zetsoft\system\Az;
use zetsoft\system\column\ZExpandRowColumn;
use zetsoft\system\column\ZLinkPager;
use zetsoft\system\helpers\ZUrl;
use zetsoft\system\kernels\ZView;
use zetsoft\models\shop\ShopOrder;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\market\ZFooterAllWidget;
use zetsoft\widgets\menus\ZMetisMenuWidget;
use zetsoft\widgets\navigat\ZSmartTabWidget;

/** @var ZView $this */
$action = new WebItem();

$action->title = Azl . 'Категория';
$action->icon = 'fa fa-area-chart';
$action->type = WebItem::type['html'];
$action->csrf = true;
$action->debug = true;



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

    $this->head();

    ?>

</head>
<body class="<?= ZWidget::skin['white-skin'] ?>">
<?php

$this->beginBody();

require Root . '/webhtm/block/navbar/main.php';
require Root . '/render/menus/ZSidebarWidget/ready/main.php';

?>


<section class="main-sectio">
    <div class="container-fluid mt-2">
        <div class="row mt-3">
            <div class="col-xl-3 col-lg-4 col-md-4 col-sm-4 media-category">
                <?
                echo ZMetisMenuWidget::widget([
                    'config' => [
                        'open' => true,
                        //'name' => 'Категории',
                        'mode' => 'shop',
                        'theme' => ZMetisMenuWidget::theme['bozor2'],
                        'nameOn' => [
                            'My profile',
                        ],
                        'MenuOpen' => false,

                    ],
                ]);

                ?>
            </div>
            <div class="col-xl-8 col-lg-5">

                <h3 class="py-2 text-muted">Мои заказы</h3>
                <?
                $orders = ShopOrder::find()->select(['id','total_price', 'status'])->all();
                $model = new ShopOrder();
                $model->configs->nameOn = [
                    'total_price',
                    'status'
                ];

                $model->columns();

                $finished = ZDynaWidget::widget([
                    'model' => $model,
                    'config' => [
                        'title' => '',
                        'columnAction' => false,
                        'headerIcon' => '',
                        'titleSummary' => false,
                        'search' => false,
                        'hasToolbar' => false,
                        'columnCheckbox' => false,
                        'columnRelation' => false,
                        'panelType' => ZDynaWidget::panelType['active'],
                        'panelTemplate' =>"{panelBefore}{items}{panelAfter}{panelFooter}",
                        'idColumnTitle' => 'Заказ №',
                        'pagerClass' => [
                            'class' => ZLinkPager::class,
                            'activePageCssClass' => 'bg-success rounded-sm ',
                            'pageCssClass' => '',
                            'prevPageCssClass' => '',
                            'nextPageCssClass' => '',

                        ],
                    ]
                ]);

                $orderitems = ShopOrderItem::find()->select(['id'])->all();
                /*$modelitem = new ShopOrderItem();
                $modelitem->configs->nameOn = [

                ];
                 $modelitem->query = ShopOrderItem::find()
                                    ->where([

                                    ]);*/

                $modelitem = Az::$app->market->company->getNewOrderItems(11);

                /*$modelitem = Az::$app->market->company->getNewOrderItems($this->userIdentity()->id);*/
                //$modelitem->column();

                $active = ZDynaWidget::widget([
                    'model' => $modelitem,
                    'config' => [
                        'title' => '',
                        'columnAction' => false,
                        'headerIcon' => '',
                        'titleSummary' => false,
                        'search' => false,
                        'hasToolbar' => false,
                        'columnCheckbox' => false,
                        'columnRelation' => false,
                        'panelType' => ZDynaWidget::panelType['active'],
                        'panelTemplate' =>"{panelBefore}{items}{panelAfter}{panelFooter}",
                        'idColumnTitle' => 'Заказ №',
                        'pagerClass' => [
                            'class' => ZLinkPager::class,
                            'activePageCssClass' => 'bg-success rounded-sm ',
                            'pageCssClass' => '',
                            'prevPageCssClass' => '',
                            'nextPageCssClass' => '',

                        ],
                        'columnExpand' => [
                            'class' => ZExpandRowColumn::class,
                            'attribute' => 'expand',
                            'value' => function ($model, $key, $index) {
                                return GridView::ROW_COLLAPSED;
                            },
                            /*'detail' => function ($model, $key, $index, $column) {
                                return Az::$app->controller->renderPartial('detail', ['model' => $model, 'key' => $key]);
                            },*/
                            'detailUrl' => ZUrl::to(['expand'])

                        ],
                    ]
                ]);

                $items = [
                    Az::l('Активные заказы') => $active,
                    Az::l('Завершенные заказы') => $finished,
                ];

                $content = [];
                foreach ($items as $key => $value) {
                    $tabItem = new TabItem();
                    $tabItem->title = $key;
                    $tabItem->content = $value;
                    $content[] = $tabItem;
                }

                echo ZSmartTabWidget::widget([
                    'config' => [
                        'theme' => ZSmartTabWidget::Theme['Classic'],
                        'animation' => ZSmartTabWidget::Animation['slide-swing'],
                        'orientation' => ZSmartTabWidget::Orientation['horizontal'],
                        'justified' => true,
                        'isAjax' => ZSmartTabWidget::isAjax['false'],
                        'class' => 'border-0'
                    ],
                    'data' => $content,

                ]);
                ?>
            </div>


        </div>

    </div>
</section>
<?php
echo ZFooterAllWidget::widget([

]);
?>
<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>

