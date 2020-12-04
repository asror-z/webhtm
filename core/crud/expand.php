<?php


?>



<?php


use zetsoft\dbitem\core\WebItem;
use zetsoft\system\helpers\ZInflector;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZViewWidget;


/**
 *
 * Action Params
 */

$action = new WebItem();

$action->type = WebItem::type['ajax'];
$action->csrf = true;
$action->debug = false;
$action->loader = false;
$action->debug = true;


$this->paramSet(paramAction, $action);


?>
<div class="row">
    <div class="col-md-12">

        <?

        $modelClassName = $this->httpGet('modelClassName');

        if (empty($modelClassName))
            $modelClassName = ZInflector::camelize($this->urlData(1));

        $modelClass = $this->bootFull($modelClassName);

        $id = $this->httpPost('expandRowKey');
        $model = $modelClass::findOne($id);

        echo ZViewWidget::widget([
            'model' => $model,
        ]);
        ?>

    </div>
</div>



