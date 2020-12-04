<?php


?>



<?php


use zetsoft\dbitem\core\WebItem;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZViewWidget;
use zetsoft\models\shop\ShopOrder;


/**
 *
 * Action Params
 */

$action = new WebItem();

$action->type = WebItem::type['ajax'];
$action->csrf = true;
$action->debug = false;



$this->paramSet(paramAction, $action);


?>
<div class="row">
    <div class="col-md-12 col-12">

        <?


        /** @var  ZView $this */
        //$id = $this->httpGet('id' );
        $id = $this->httpPost('expandRowKey');

        ?>
        
        <iframe src="/cruds/shop-order-item/index.aspx?id=<?=$id ?>" width="100%" height="500"></iframe>

    </div>
</div>



