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

$shop_element_id = $this->httpGet('shop_element_id');

return $this->urlRedirect([
    'process',
    'id' => $this->httpGet('id')
]);
