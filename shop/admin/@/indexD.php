<?php

use zetsoft\dbitem\core\WebItem;
use yii\bootstrap\Html;
use zetsoft\dbitem\stats\AnalyticStatusItem;
use zetsoft\former\chart\ChartForm;
use zetsoft\former\chart\ChartFormAdmin;
use zetsoft\former\chart\ChartFormAnalytic;
use zetsoft\models\shop\ShopOrder;
use zetsoft\models\shop\ShopStatus;
use zetsoft\service\market\GuestStatistic;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\blocks\ZJqueryKnobWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\charts\ZChartFormWidget;
use zetsoft\widgets\charts\ZChartFormWidgetJaxongir;
use zetsoft\widgets\charts\ZChartJsPieWidget;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\inputes\ZKSelect2Widget;
use zetsoft\widgets\market\ZAnalyticsWidget;
use zetsoft\widgets\menus\ZMmenuWidget;
use zetsoft\widgets\menus\ZMmenuWidgetD;
use zetsoft\widgets\menus\ZMmenuWidgetSh;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;
use zetsoft\models\shop\ShopBrand;
use zetsoft\widgets\themes\ZMarketAdminCardWidget;


/** @var ZView $this */


/**
 *
 * Action Params
 */

$action = new WebItem();

$action->title = Azl . 'Бренды';
$action->icon = 'fa fa-globe';
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
    $this->head();
    ?>
</head>
<body class="<?= ZWidget::skin['white-skin'] ?>">
<?php
$this->beginBody();
echo ZNProgressWidget::widget([]);

require Root . '/webhtm/block/header/main.php';

echo ZMmenuWidgetD::widget([
    //'data' => $this->cores->menus->create('mmenu'),
    'config' => [
        'isAll' => true,
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
    echo ZSessionGrowlWidget::widget();

    ?>
    <nav id="menu">
        <div>
            <div class="zetsoft pt-2">
                <div class="container-fluid d-flex">
                    <div class="col-lg-3 col-md-3 col-sm-12 my-2">
                        <?
                        $status_client = [
                            'accepted' => Az::l('Принят'),
                            'count_order' => Az::l('Заказы'),
                            'forming' => Az::l('Формируется'),
                            'delivering' => Az::l('Доставляется'),
                            'delivered' => Az::l('Доставлено'),
                            'received' => Az::l('Получено'),
                            'not_received' => Az::l('Не получено'),
                            'not_delivered' => Az::l('Не доставлено'),
                        ];
                        //$companyId = $this->userIdentity()->user_company_id;

                        $companyId = 17;
                        $info = Az::$app->market->order->getInfoOrder(17);
                        $infos = (array)$info;
                        $statuses = [];
                        foreach ($infos as $key => $value) {
                            $obj = new AnalyticStatusItem();
                            $obj->name = $key;
                            $obj->color = '#' . Az::$app->market->order->random_color();
                            $obj->amount = $value ?? 0;
                            $obj->status = $status_client[$key];
                            $statuses[] = $obj;
                        }
                        //vdd($statuses);
                        echo ZAnalyticsWidget::widget([
                            'data' => $statuses
                        ]);
                        ?>
                        <br>
                        <div class="row">
                            <div class="col-md-12">
                                <?
                                echo ZChartFormWidgetJaxongir::widget([
                                    'data' => $statuses,
                                    'config' => [
                                        'title' => Azl . ('Статусы'),
                                        'name' => 'status',
                                        'color' => true,
                                        'colorname' => 'color',
                                        'value' => 'amount',
                                        'type' => ZChartFormWidget::type['pie'],
                                        'theme' => ZChartFormWidget::theme['macarons'],]
                                ]);
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-12">
                        <div class="row my-1 mb-1">
                            <div class="col-md-12">
                                <div class="row">
                                    <?
                                    //$items = Az::$app->market->userStatistic->getStatsInfoByRole($this->userIdentity()->role);
                                    $items = Az::$app->market->adminStatistic->adminInfo();
                                    $arr = Az::$app->market->userStatistic->getStatsValue();
                                    $urls = Az::$app->market->userStatistic->getStatsUrls();
                                    $icons = Az::$app->market->userStatistic->getStatsIcons();
                                    foreach ($items as $key => $value) {
                                        echo '<div class="col-md-3 col-sm-6 my-2">';
                                        echo ZMarketAdminCardWidget::widget([
                                            'config' => [
                                                'percent' => $value,
                                                'title' => $arr[$key],
                                                'bg-color' => '#' . Az::$app->market->order->random_color(),
                                                'info' => 'Подробно',
                                                'icon' => $icons[$key],
                                                'infoUrl' => $urls[$key],
                                                'class' => 'text-white',
                                                'isPercent' => false
                                            ]
                                        ]);
                                        echo '</div>';
                                    }
                                    ?>
                                </div>
                            </div>

                            <div class="col-md-12  d-flex justify-content-end">
                                <div class="w-25">
                                    <?
                                    echo ZKSelect2Widget::widget([
                                        'data' => [3 => Az::l('За 3 дня'), 7 => Az::l('За неделю'), 30 => Az::l('За месяц')],
                                        'name' => 'select day',
                                        'id' => 'selectDay',
                                        'value' => 7,
                                        'config' => [
                                            'theme' => ZKSelect2Widget::theme['bootstrap']
                                        ]
                                    ]);
                                    ?>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="w-100" id="diagramm">

                                </div>
                            </div>

                            <div class="col-md-12" id="diagramm1" style="height: 500px;overflow-y: scroll">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</div>

<? require Root . '\webhtm\block\footer\footerAdmin.php' ?>
<?php $this->endBody() ?>
<script>
    function getStat(el) {
        let sel = $(el);
        $.ajax({
            url: '/core/product/getStatByDay.aspx',
            method: 'GET',
            data: {
                'day': sel.val(),
                'companyId':<?=$companyId?>
            },
            success: function (data) {
                $('#diagramm').html(data)
            },
            error: function (e) {
                console.log(e)
            }
        })
        $.ajax({
            url: '/core/product/getStatByDay1.aspx',
            method: 'GET',
            data: {
                'day': sel.val(),
                'companyId':<?=$companyId?>
            },
            success: function (data) {
                $('#diagramm1').html(data)
            },
            error: function (e) {
                console.log(e)
            }
        })
    }

    $(document).ready(function () {
        getStat('#selectDay')
    })

    $('#selectDay').on('change', function () {
        getStat(this);
    })

</script>
</body>
</html>

<?php $this->endPage() ?>
