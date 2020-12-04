<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\dbitem\shop\ProductItem;
use zetsoft\models\place\PlaceCountry;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\market\ZFooterAllWidget;
use zetsoft\widgets\market\ZFooterAllWidgetOrg;
use zetsoft\widgets\market\ZMSwiperWidget;
use zetsoft\widgets\navigat\ZBreadcrumbsWidget;
use zetsoft\widgets\navigat\ZReadMoreWidget;
use zetsoft\widgets\notifier\ZJspanelWidget;
use zetsoft\widgets\animo\ZFakeLoaderNewWidget;

/**
 *
 * @license JaloliddinovSalohiddin
 * @license OtabekNosirov
 * @license AkromovAzizjon
 */
global $boot;
$boot->start('homePage');
/** @var ZView $this */
$action = new WebItem();

$action->title = Azl . 'Главная страница';
$action->icon = 'fa fa-area-chart';
$action->type = WebItem::type['html'];
$action->csrf = true;
$action->debug = true;
$action->layout = true;
$action->layoutFile = 'main';

$action->cache = false;

$action->call = [];

$action->cacheHttp = false;

$this->paramSet(paramAction, $action);

$this->title();
$this->toolbar();

?>


<div class="market-container" style="background: #fff">
    <div class="w-100 p-2 mt-2">
        <div class="row">
            <div class="col-md-12">
                <?
                $model = new PlaceCountry();

                echo ZDynaWidget::widget([
                    'model' => $model
                ]);
                ?>
            </div>
            <
        </div>


    </div>


</div>


