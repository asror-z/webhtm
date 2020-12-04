<?php


?>



<?php


use zetsoft\dbitem\core\WebItem;
use zetsoft\models\shop\ShopOrder;
use zetsoft\models\shop\ShopOrderItem;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\former\ZDynaWidgetRav;
use zetsoft\widgets\former\ZViewWidget;
use zetsoft\models\shop\ShopShipment;


/**
 *
 * Action Params
 */

$action = new WebItem();

$action->type = WebItem::type['ajax'];
$action->csrf = true;
$action->debug = false;



$this->paramSet(paramAction, $action);

/** @var ZView $this */
$keys = $this->httpPost('checkKeys');
if ($keys){
    foreach ($keys as $key) {
        $model = ShopOrder::findOne($key);
        $model->status_logistics = ShopOrder::status_logistics['on_complecting'];
        $model->configs->rules = [[validatorSafe]];
        $model->save();

    }
}

