<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\dbitem\data\TabItem;
use zetsoft\models\ware\WareAccept;
use zetsoft\models\ware\WareReturn;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZUrl;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\navigat\ZButtonWidget;
use zetsoft\widgets\navigat\ZSmartTabWidget;
use zetsoft\widgets\themes\ZTabWidget;

/** @var ZView $this */

/**
 *
 * Action Params
 */
$action = new WebItem();
$action->title = Azl . 'Редактирование';
/*Поступление товаров в склад*/
$action->icon = 'fal fa-film';
$action->type = WebItem::type['html'];
$action->layout = true;
$action->layoutFile = 'admin';
$this->paramSet(paramAction, $action);
?>

<div class="row my-5">
    <div class="col-md-12">
        <?php
        
        //start: MurodovMirbosit
        
        $ware_accept_id = $this->httpGet('ware_accept_id');

        $ware_accept = WareAccept::findOne($ware_accept_id);
        
        $isReadonly = false;
        if ($ware_accept->closed) {
            $isReadonly = true;
        }
        
        $tabData = [];

        $readonly = false;
        if ($ware_accept->status === WareAccept::status['accept'] || $isReadonly || $ware_accept->status === WareAccept::status['generate_doc']) {
            $readonly = true;
        }

        $returnSrc = ZUrl::to([
            '/shop/logistics/ware-accept/return',
            'ware_accept_id' => $ware_accept_id,
        ]);

        $returnItemSrc = ZUrl::to([
            '/shop/logistics/ware-accept/return-items',
            'ware_accept_id' => $ware_accept_id,
        ]);

        $tab = new TabItem();
        $tab->title = Az::l('Возвраты');
        $tab->content = "<iframe id='return' class='iframe-return' width='100%' height='800px' src='$returnSrc'></iframe>";

        $tabData[] = $tab;

        $tab = new TabItem();
        $tab->title = Az::l('Товары возврата');
        $tab->content = "<iframe id='return-items' class='iframe-return-items' width='100%' height='800px' src='$returnItemSrc'></iframe>";

        $tabData[] = $tab;

        echo ZTabWidget::widget([
            'data' => $tabData,
        ]);
        //end

        ?>
    </div>
</div>

