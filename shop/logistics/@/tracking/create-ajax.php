<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\service\forms\Active;
use zetsoft\service\forms\Ajaxer;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZUrl;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZFormBuildWidget;
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

$action->title = Azl . 'Создание Заказы к доставке';
$action->icon = 'fal fa-birthday-cake';
$action->type = WebItem::type['ajax'];
$action->csrf = true;
$action->debug = true;



$this->paramSet(paramAction, $action);
?>

<div id="content" class="content-footer p-3">

    <div class="row">
        <div class="col-md-12 col-12">

            <?


            $formId = $this->httpGet('formId');
            $model = new ShopShipment();

            if ($this->httpPost('ShopShipment')) {
                $model->setAttributes($this->httpPost('ShopShipment'));
                if ($model->save()) {
                    $this->urlRedirect([
                        'process',
                        'id' => $model->id
                    ]);
                }
            }

            $active = new Ajaxer();
            $active->id = $formId;
            $active->formAction = ZUrl::to(['create-process']);
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


</div>
