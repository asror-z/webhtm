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
use zetsoft\system\helpers\ZArrayHelper;
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
use zetsoft\widgets\inputes\ZSelect2Widget;
use zetsoft\widgets\market\ZAnalyticsWidget;
use zetsoft\widgets\menus\ZMmenuWidget;
use zetsoft\widgets\menus\ZMmenuWidgetSh;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;
use zetsoft\models\shop\ShopBrand;
use zetsoft\widgets\themes\ZMarketAdminCardWidget;
use zetsoftspace\ZClassName;


/** @var ZView $this */


/**
 *
 * @license JaloliddinovSalohiddin
 * @author  OtabekNosirov
 * @license AkromovAzizjon
 * 
 */

$action = new WebItem();

$action->title = Azl . 'Панель администратора';
$action->icon = 'fa fa-globe';
$action->type = WebItem::type['html'];
$action->csrf = true;
$action->debug = true;



$this->paramSet(paramAction, $action);

$this->title();
$this->toolbar();
$status_client = [
    'accepted' => Az::l('Принят'),
    'count_order' => Az::l('Заказы'),
    'approved' => Az::l('Утвержденный'),
    'forming' => Az::l('Формируется'),
    'delivering' => Az::l('Доставляется'),
    'delivered' => Az::l('Доставлено'),
    'received' => Az::l('Получено'),
    'not_received' => Az::l('Не получено'),
    'not_delivered' => Az::l('Не доставлено'),
];



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
    $this->fileCss('/render/asrorz/css/material-dashboard.css');
    

    ?>
</head>
<body class="<?= ZWidget::skin['white-skin'] ?>">
<?php
$this->beginBody();
echo ZNProgressWidget::widget([]);

echo ZMmenuWidget::widget([
    'config' => [
        'isAll' => true,
    ]
]);
?>

<div id="page">
    <?php
    require Root . '/webhtm/block/header/main.php';
    require Root . '/webhtm/block/navbar/admin.php';

    echo ZSessionGrowlWidget::widget();

    ?>
    <div class="pt-2">
        <div class="container-fluid d-flex">
            <!--<div class="col-lg-3 col-md-3 col-sm-12 my-2 ">
                <?/*
                $stats = '';
                $info = Az::$app->market->order->getAllOrder();

                $infos = (array)$info;
                $statuses = [];

                foreach ($infos as $key => $value) {

                    $obj = new AnalyticStatusItem();
                    $obj->name = $key;
                    $obj->color = '#' . Az::$app->market->order->random_color();
                    $obj->amount = $value ?? 0;
                    $obj->status = $key;
                    $obj->url = '/shop/admin/shop-order/index.aspx?ShopOrder[status_client]=' . $key;
                    $statuses[] = $obj;
                    
                }

                echo ZAnalyticsWidget::widget([
                    'data' => $statuses
                ]);


                */?>
                <br>
                <div class="row">
                    <div class="col-md-12">
                        <?/*
                        echo ZChartFormWidget::widget([
                            'data' => $statuses,
                            'model' => new AnalyticStatusItem(),
                            'config' => [
                                'title' => Azl . ('Статусы'),
                                'name' => 'status',
                                'color' => true,
                                'colorname' => 'color',
                                'value' => 'amount',
                                'type' => ZChartFormWidget::type['pie'],
                                'theme' => ZChartFormWidget::theme['infographic'],
                                'actionButtons' => [
                                    'update',
                                    'delete',
                                    'view',
                                ],
                                'columnBefore' => [
                                    'serial',
                                    'sort',
                                    'checkbox',
                                    paramsAction,
                                ],
                                'columnAfter' => ['false']
                            ]
                        ]);
                        */?>
                    </div>
                </div>
            </div>-->
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="row my-1 mb-1">
                    <div class="col-md-12">
                        <div class="row">
                            <?
                            //$items = Az::$app->market->userStatistic->getStatsInfoByRole($this->userIdentity()->role);
                            $items = Az::$app->market->adminStatistic->adminInfo();
                            $arr = Az::$app->market->guestStatistic->getStatsValue();
                            $urls = Az::$app->market->guestStatistic->getStatsUrls();
                            $icons = Az::$app->market->guestStatistic->getStatsIcons();
                            foreach ($items as $key => $value) {
                                echo '<div class="col-md-3 col-sm-6 my-2">';
                                echo ZMarketAdminCardWidget::widget([
                                    'config' => [
                                        'percent' => $value,
                                        'title' => ZArrayHelper::getValue($arr, $key),
                                        'bg-color' => '#' .
                                            Az::$app->market->order->random_color(),
                                        'info' => 'Подробно',
                                        'icon' => ZArrayHelper::getValue($icons, $key),
                                        'infoUrl' => ZArrayHelper::getValue($urls, $key),
                                        'class' => 'text-white',
                                        'isPercent' => false,
                                        'theme' => true
                                    ]
                                ]);
                                echo '</div>';
                            }
                            ?>
                        </div>
                        <!-- <div class="col-md-12  d-flex justify-content-end mt-4">
                            <div class="w-25">
                                <?/*
                                echo ZSelect2Widget::widget([
                                    'data' => [3 => Az::l('За 3 дня'), 7 => Az::l('За неделю'), 30 => Az::l('За месяц')],
                                    'name' => 'daying',
                                    'id' => 'daying',
                                    'value' => 7,
                                ]);
                                */?>
                            </div>
                        </div>
                    </div>


                    <div class="col-md-12 mt-3">
                        <div class="w-100" id="diagramm">

                        </div>
                    </div>

                    <div class="col-md-12" id="diagramm1" style="height: 500px;overflow-y: scroll">

                    </div>-->
                        <div class="row pt-5">
                            <div class="col-md-4">
                                <div class="dashboard-card card-chart">
                                    <div class="card-header card-header-success">
                                        <div class="ct-chart" id="dailySalesChart"></div>
                                    </div>
                                    <div class="card-body">
                                        <h4 class="card-title">Daily Sales</h4>
                                        <p class="card-category">
                                            <span class="text-success"><i class="fa fa-long-arrow-up"></i> 55% </span> increase in today sales.</p>
                                    </div>
                                    <div class="card-footer">
                                        <div class="stats">
                                            <i class="material-icons">access_time</i> updated 4 minutes ago
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="dashboard-card card-chart">
                                    <div class="card-header card-header-warning">
                                        <div class="ct-chart" id="websiteViewsChart"></div>
                                    </div>
                                    <div class="card-body">
                                        <h4 class="card-title">Email Subscriptions</h4>
                                        <p class="card-category">Last Campaign Performance</p>
                                    </div>
                                    <div class="card-footer">
                                        <div class="stats">
                                            <i class="material-icons">access_time</i> campaign sent 2 days ago
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="dashboard-card card-chart">
                                    <div class="card-header card-header-danger">
                                        <div class="ct-chart" id="completedTasksChart"></div>
                                    </div>
                                    <div class="card-body">
                                        <h4 class="card-title">Completed Tasks</h4>
                                        <p class="card-category">Last Campaign Performance</p>
                                    </div>
                                    <div class="card-footer">
                                        <div class="stats">
                                            <i class="material-icons">access_time</i> campaign sent 2 days ago
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                
            </div>
        </div>
    </div>
    <? require Root . '\webhtm\block\footer\footerAdmin.php'; ?>
</div>


<?php $this->endBody() ?>
<script src="/render/asrorz/js/chartist.min.js"></script>
<script src="/render/asrorz/js/maladoy.js"></script>

<script>
    $(document).ready(function() {
        if ($('#dailySalesChart').length != 0 && $('#websiteViewsChart').length != 0) {
            /* ----------==========     Daily Sales Chart initialization For Documentation    ==========---------- */

            dataDailySalesChart = {
                labels: ['M', 'T', 'W', 'T', 'F', 'S', 'S'],
                series: [
                    [12, 17, 7, 17, 23, 18, 38]
                ]
            };

            optionsDailySalesChart = {
                lineSmooth: Chartist.Interpolation.cardinal({
                    tension: 0
                }),
                low: 0,
                high: 50, // creative tim: we recommend you to set the high sa the biggest value + something for a better look
                chartPadding: {
                    top: 0,
                    right: 0,
                    bottom: 0,
                    left: 0
                },
            }

            var dailySalesChart = new Chartist.Line('#dailySalesChart', dataDailySalesChart, optionsDailySalesChart);

            var animationHeaderChart = new Chartist.Line('#websiteViewsChart', dataDailySalesChart, optionsDailySalesChart);
        }

        if ($('#dailySalesChart').length != 0 || $('#completedTasksChart').length != 0 || $('#websiteViewsChart').length != 0) {
            /* ----------==========     Daily Sales Chart initialization    ==========---------- */

            dataDailySalesChart = {
                labels: ['M', 'T', 'W', 'T', 'F', 'S', 'S'],
                series: [
                    [12, 17, 7, 17, 23, 18, 38]
                ]
            };

            optionsDailySalesChart = {
                lineSmooth: Chartist.Interpolation.cardinal({
                    tension: 0
                }),
                low: 0,
                high: 50, // creative tim: we recommend you to set the high sa the biggest value + something for a better look
                chartPadding: {
                    top: 0,
                    right: 0,
                    bottom: 0,
                    left: 0
                },
            }

            var dailySalesChart = new Chartist.Line('#dailySalesChart', dataDailySalesChart, optionsDailySalesChart);

            md.startAnimationForLineChart(dailySalesChart);



            /* ----------==========     Completed Tasks Chart initialization    ==========---------- */

            dataCompletedTasksChart = {
                labels: ['12p', '3p', '6p', '9p', '12p', '3a', '6a', '9a'],
                series: [
                    [230, 750, 450, 300, 280, 240, 200, 190]
                ]
            };

            optionsCompletedTasksChart = {
                lineSmooth: Chartist.Interpolation.cardinal({
                    tension: 0
                }),
                low: 0,
                high: 1000, // creative tim: we recommend you to set the high sa the biggest value + something for a better look
                chartPadding: {
                    top: 0,
                    right: 0,
                    bottom: 0,
                    left: 0
                }
            }

            var completedTasksChart = new Chartist.Line('#completedTasksChart', dataCompletedTasksChart, optionsCompletedTasksChart);

            // start animation for the Completed Tasks Chart - Line Chart
            md.startAnimationForLineChart(completedTasksChart);


            /* ----------==========     Emails Subscription Chart initialization    ==========---------- */

            var dataWebsiteViewsChart = {
                labels: ['J', 'F', 'M', 'A', 'M', 'J', 'J', 'A', 'S', 'O', 'N', 'D'],
                series: [
                    [542, 443, 320, 780, 553, 453, 326, 434, 568, 610, 756, 895]

                ]
            };
            var optionsWebsiteViewsChart = {
                axisX: {
                    showGrid: false
                },
                low: 0,
                high: 1000,
                chartPadding: {
                    top: 0,
                    right: 5,
                    bottom: 0,
                    left: 0
                }
            };
            var responsiveOptions = [
                ['screen and (max-width: 640px)', {
                    seriesBarDistance: 5,
                    axisX: {
                        labelInterpolationFnc: function(value) {
                            return value[0];
                        }
                    }
                }]
            ];
            var websiteViewsChart = Chartist.Bar('#websiteViewsChart', dataWebsiteViewsChart, optionsWebsiteViewsChart, responsiveOptions);

            //start animation for the Emails Subscription Chart
            md.startAnimationForBarChart(websiteViewsChart);
        }
        // Javascript method's body can be found in assets/js/demos.js
        md.initDashboardPageCharts();

    });

    function getStat(el) {
        let sel = $(el);
        $.ajax({
            url: '/core/product/getStatByDay.aspx',
            method: 'GET',
            data: {
                'day': sel.val(),

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
