<?php

use kartik\grid\DataColumn;
use zetsoft\dbitem\core\WebItem;
use zetsoft\former\cpas\CpasTrackForm;
use zetsoft\models\track\TizerTrackerStats;
use zetsoft\models\shop\ShopOrder;
use zetsoft\system\Az;
use zetsoft\system\column\ZKDataColumn;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\actions\ZFilterWidget;use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\inputes\ZHInputWidget;
use zetsoft\widgets\menus\ZMmenuWidget;
use zetsoft\widgets\menus\ZMmenuWidgetSh;
use zetsoft\widgets\navigat\ZButtonWidget;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;
use zetsoft\models\track\CpasTeaser;


/** @var ZView $this */


/**
 *
 * Action Params
 */

$action = new WebItem();

$action->title = Azl . Az::l('');
$action->icon = 'fal fa-graduation-cap';
$action->type = WebItem::type['html'];
$action->csrf = true;

if ($this->httpGet('spa'))
    $action->debug = true;



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

    $this->head();

    ?>

</head>


<body class="<?= ZWidget::skin['white-skin'] ?>">

<?php

$this->beginBody();

echo ZNProgressWidget::widget([]);
if (!$this->httpGet('spa'))
    echo ZMmenuWidget::widget();
?>

<div id="page">

    <?
    if (!$this->httpGet('spa'))
        require Root . '/webhtm/block/navbar/admin.php';

    echo ZSessionGrowlWidget::widget();?>
    <div id="content" class="content-footer p-3">


        <div class="row">
            <div class="col-md-12">

                <?
                $id = $this->httpGet('id');

                $model = new CpasTrackerStats();
                $model->configs->query = CpasTrackerStats::find()->where(['tizer_tracker_id' => $id]);
                $model->configs->nameOff = [
                    'name',
                    'tizer_tracker_id'
                ];

                $model->configs->before = [
                    'country' => [
                        [
                            'class' => ZKDataColumn::class,
                            'label' => Az::l('Статус заказа'),
                            'width' => '100px',
                            'value' => function ($model, $key, $index, DataColumn $dataColumn) {
                                $return = Az::l('Нет заказа');
                                $shopOrder = ShopOrder::findOne($model->shop_order_id);
                                if ($shopOrder !== null) {
                                    if ($shopOrder->status_callcenter === ShopOrder::status_callcenter['cancel']) {
                                        $return = (new ShopOrder())->_status_callcenter['cancel'];
                                    }
                                    if ($shopOrder->status_accept === ShopOrder::status_accept['completed']) {
                                        $return = Az::l('Апрув');
                                    }
                                    if ($shopOrder->status_callcenter === ShopOrder::status_callcenter['approved']) {
                                        $return = Az::l('Принятые');
                                    }
                                    if ($shopOrder->status_callcenter === ShopOrder::status_callcenter['new'] || $shopOrder->status_callcenter === ShopOrder::status_callcenter['ring'] || $shopOrder->status_callcenter === ShopOrder::status_callcenter['autodial']) {
                                        $return = Az::l('В ожидание');
                                    }
                                    if ($shopOrder->status_accept === ShopOrder::status_callcenter['incorrect']) {
                                        $return = Az::l('Треш');
                                    }
                                }
                                return "<b>$return</b>";
                            }
                        ],

                    ]
                ];

                $model->configs->hasPlaceholder = false;
                $model->columns();
                /** @var ZView $this */
                echo ZDynaWidget::widget([
                    'model' => $model,
                    'config' => [
                        'columnBefore'  => [
                            'serial',
                            'sort',
                  
                        ]
                    ],
                    'rightNameEx' => [
                        'update',
                        'add-clone-delete',
                        'filter-sort-id',
                    ]
                ]);

                ?>

            </div>
        </div>


    </div>
    <!--    --><? //= $this->require( '/webhtm\block\footer\mplace\footerAll.php') ?>
</div>


<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>
