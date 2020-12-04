<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\service\forms\Ajaxer;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZUrl;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZFormWidget;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;
use zetsoft\widgets\themes\ZCardWidget;
use zetsoft\models\shop\ShopShipment;


/** @var ZView $this */


/**
 *
 * Action Params
 */

$action = new WebItem();

$action->title = Azl . 'Редактирование Заказы к доставке';


$action->icon = 'fal fa-birthday-cake';
$action->type = WebItem::type['ajax'];
$action->csrf = true;
$action->debug = true;



$this->paramSet(paramAction, $action);
?>

<div class="row">
    <div class="col-md-12 col-12">

        <?

        $id = $this->httpGet('id');
        $model = ShopShipment::findOne($id);

        if ($this->httpPost('ShopShipment')) {
            $model->setAttributes($this->httpPost('ShopShipment'));
            $model->save();
        }

        $active = new Ajaxer();
        $active->formAction = ZUrl::to([
            'update-process',
            'id' => $this->httpGet('id')
        ]);
        $active->success = <<<JS
        function() {
          
            $('#ShopShipment-modal').modal('hide')
            $('#ShopShipment_Grid_Reset').click()
          
        }
JS;

        $form = $this->ajaxBegin($active);

        echo ZFormWidget::widget([
            'model' => $model,
            'form' => $form,
        ]);

        $this->ajaxEnd();

        ?>

    </div>
</div>

