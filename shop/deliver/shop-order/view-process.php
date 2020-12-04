<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\service\forms\Ajaxer;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZViewWidget;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;
use zetsoft\models\place\PlaceCountry;


/** @var ZView $this */


/**
 *
 * Action Params
 */

$action = new WebItem();

$action->title = Azl . 'Просмотр Заказы';
$action->icon = 'fal fa-money-check-edit-alt';
$action->type = WebItem::type['ajax'];
$action->csrf = true;
$action->debug = true;



$this->paramSet(paramAction, $action);
?>

<div id="content" class="content-footer p-3">


    <div class="row">
        <div class="col-md-12">

            <?


            $id = $this->httpGet('id');
            $model = ShopOrder::findOne($id);

            echo ZViewWidget::widget([
                'model' => $model,

            ]);

            ?>

        </div>
    </div>


</div>
