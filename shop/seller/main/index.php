<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\dbitem\data\TabItem;
use zetsoft\models\shop\ShopOrder;
use zetsoft\models\shop\ShopProduct;
use zetsoft\models\shop\ShopReview;
use zetsoft\models\shop\ShopStatus;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZUrl;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\menus\ZMmenuWidget;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;
use zetsoft\widgets\themes\ZTabWidget;


/** @var ZView $this */

/**
 *
 * Action Params
 */

$action = new WebItem();

$action->title = Azl . 'Панель организации';
$action->icon = 'fa fa-globe';
$action->type = WebItem::type['html'];
$action->csrf = true;
$action->debug = false;
$action->layout = true;
$action->layoutFile = 'admin';

$this->paramSet(paramAction, $action);

$this->title();
$this->toolbar();

$model = new ShopOrder();
$today = date('Y-m-d');

?>
    <div id="content pt-5">

        <div class="col-md-12 col-12">
            <div class="container-fluid p-5">
                <div class="row w-100 col-md-12 col-12">
                    <?php
                    $tabData = [];

                    $tabs = new TabItem();
                    $tabs->label = Az::l('Аналитика');
                    $tabs->content = "
                    <div class='row'>
                    <div class=\"col-xl-8\">
                        <div class=\"card bg-transparent\">
                            <div class=\"card-header bg-transparent\">
                                <div class=\"row align-items-center\">
                                    <div class=\"col\">
                                        <h5 class=\"h3 text-dark mb-0\">
                                            Объем продаж</h5>
                                    </div>
                                    <div class=\"col\">
                                        <ul class=\"nav nav-pills justify-content-end\">
                                            <li class=\"nav-item mr-2 mr-md-0\" data-toggle=\"chart\"
                                                data-target=\"#chart-sales-dark\"
                                                data-update='{\"data\":{\"datasets\":[{\"data\":[0, 20, 10, 30, 15, 40, 20, 60, 60]}]}}'>
                                                <a href=\"#\" class=\"nav-link bg-transparent py-2 px-3 text-dark active\"
                                                   data-toggle=\"tab\">
                                                    <span class=\"d-none d-md-block\">Месяц</span>
                                                    <span class=\"d-md-none\">M</span>
                                                </a>
                                            </li>
                                            <li class=\"nav-item\" data-toggle=\"chart\" data-target=\"#chart-sales-dark\"
                                                data-update='{\"data\":{\"datasets\":[{\"data\":[0, 20, 5, 25, 10, 30, 15, 40, 40]}]}}'>
                                                <a href=\"#\" class=\"nav-link bg-transparent text-dark py-2 px-3\"
                                                   data-toggle=\"tab\">
                                                    <span class=\"d-none d-md-block\">Неделя</span>
                                                    <span class=\"d-md-none\">W</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class=\"card-body\">
                                <!-- Chart -->
                                <div class=\"chart\">
                                    <!-- Chart wrapper -->
                                    <canvas id=\"chart-sales-dark\" class=\"chart-canvas\"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                  <div class=\"col-xl-4\">
                        <div class=\"card\">
                            <div class=\"card-header bg-transparent border-0\">
                                <div class=\"row align-items-center\">


                                </div>
                            </div>
                            <div class=\"card\">
                                <div class=\"card-header bg-transparent\">
                                    <div class=\"row align-items-center\">
                                        <div class=\"col\">
                                            <h6 class=\"text-uppercase text-muted ls-1 mb-1\">Производительность</h6>
                                            <h5 class=\"h3 mb-0\">
                                                Всего заказов</h5>
                                        </div>
                                    </div>
                                </div>
                                <div class=\"card-body\">
                                    <!-- Chart -->
                                    <div class=\"chart\">
                                        <canvas id=\"chart-bars\" class=\"chart-canvas\"></canvas>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>    
</div>
                ";

                    $tabData[] = $tabs;

                    $orderItemsSrc = ZUrl::to([
                        '/shop/seller/main/dashboard'
                    ]);

                    $tabs = new TabItem();
                    $tabs->label = Az::l('Статистика');
                    $tabs->content = "<iframe id='seller' style='border: none; overflow: hidden' class='iframe-seller' width='100%' height='800px' src='$orderItemsSrc'></iframe>";

                    $tabData[] = $tabs;

                    echo ZTabWidget::widget([
                        'data' => $tabData,
                        'config' => [
                            'type' => ZTabWidget::type['classic'],
                            'mdTabColor' => ZTabWidget::mdTabColor['white'],
                            'classicTabColor' => ZTabWidget::classicTabColor['tabs-white'],
                        ]
                    ])
                    ?>
                </div>
            </div>
        </div>
    </div>

<script src="/render/asrorz/js/Chart.min.js"></script>
<script src="/render/asrorz/js/Chart.extension.js"></script>
<script src="/render/asrorz/js/argon.js"></script>

