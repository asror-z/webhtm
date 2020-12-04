<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\models\shop\ShopStatus;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\menus\ZMmenuWidget;
use zetsoft\widgets\mplace\ZCaleandarWidget;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;
use zetsoft\widgets\themes\ZMarketAdminCardWidget1;
use \zetsoft\widgets\charts\ZChartJsWidget;


/** @var ZView $this */


/**
 *
 *
 * @author  UmidAbdurakhmonov
 * Sherzod Mangliyev
 *
 */

$action = new WebItem();

$action->title = Azl . 'Панель администратора';
$action->icon = 'fa fa-globe';
$action->type = WebItem::type['html'];
$action->csrf = true;
$action->debug = true;
$action->layout = true;
$action->layoutFile = 'admin';


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


?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-8">
                <div class="row mt-3">
                    <div class="col-12 mb-3 d-flex">
                        <?

                        $items = Az::$app->market->adminMainStatic->adminInfo();
                        $arr = Az::$app->market->guestStatistic->getStatsValue();
                        $urls = Az::$app->market->guestStatistic->getStatsUrls();
                        $icons = Az::$app->market->guestStatistic->getStatsIcons();

                        foreach ($items as $key => $value) {
                            echo '<div class="col-md-3 col-sm-6 my-2">';
                            echo ZMarketAdminCardWidget1::widget([
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
                    <div class="col-12 mb-3 px-2">
                        <?
                        echo ZChartJsWidget::widget([
                            'config' => [
                                'type' => ZChartJsWidget::type['line'],
                            ]
                        ]);

                        ?>
                    </div>

                </div>

            </div>
            <div class="col-4">
                <div class="row mt-3">
                    <div class="col-12 mb-3">
                        <?
                        echo ZCaleandarWidget::widget();
                        ?>
                    </div>
                    <div class="col-12 mb-3 ">
                        <?
                        echo ZChartJsWidget::widget([
                            'config' => [
                                'type' => ZChartJsWidget::type['bar'],
                                'colors' => ZChartJsWidget::colors['#3355ff'],

                            ]
                        ]);
                        ?>
                    </div>
                </div>
            </div>
        </div>

    </div>



<style>
    #scrollbar::-webkit-scrollbar-track
    {
        -webkit-box-shadow: inset 0 0 6px rgba(51,51,51,0.2);

        background-color: #fff;
    }

    #scrollbar::-webkit-scrollbar
    {
        width: 8px;
        background-color: #fff;
    }

    #scrollbar::-webkit-scrollbar-thumb
    {
        background-color: #37f;
    }

</style>
