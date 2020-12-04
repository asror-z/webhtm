<?php


?>


<?php


use zetsoft\dbitem\core\WebItem;
use zetsoft\models\ware\WareEnterItem;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\system\module\Models;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZViewWidget;
use zetsoft\models\ware\WareEnter;


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
$modelClassName = $this->httpPost('modelClassName');
$modelName = $this->bootFull($modelClassName);
/** @var Models $modelName */

$checkKeys = $this->httpPost('checkKeys');

foreach ($checkKeys as $checkKey) {

    $model = $modelName::findOne($checkKey);
    $model->delete();

}

return $this->urlRedirect([
    'process',
    'ware_enter_id' => $this->httpGet('ware_enter_id')
]);
