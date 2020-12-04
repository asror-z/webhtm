<?php

/**
 *
 *
 * Author:  Asror Zakirov
 * https://www.linkedin.com/in/asror-zakirov
 * https://github.com/asror-z
 *
 */

use zetsoft\dbitem\data\Form;
use zetsoft\models\place\PlaceAdress;

use zetsoft\system\assets\ZColor;
use zetsoft\system\Az;
use zetsoft\system\column\ZKEditableColumn;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\bozor\ZAdressWidget;
use zetsoft\widgets\former\ZFormWidget;
use zetsoft\widgets\former\ZEditKartikWidget;
use zetsoft\widgets\incores\ZIRadioGroupWidget;
use zetsoft\widgets\incores\ZMRadioWidget;
use zetsoft\widgets\inptest\ZImageCheckboxGroupWidget;
use zetsoft\widgets\inputes\ZKTimePickerWidget;
use zetsoft\widgets\navigat\ZLiloAccordionWidget;
use zetsoft\widgets\navigat\ZPillWidget;
use zetsoft\widgets\notifier\ZKPopoverXWidget;

use zetsoft\widgets\places\ZYandexWidget;
use zetsoft\widgets\themes\ZCardWidget;
use zetsoft\widgets\themes\ZTabWidget;

$action->type = WebItem::type['ajax'];

?>
     <div class="row">
     <div class="col-6">
         <?php
         $model = new PlaceAdress();

         if ($this->modelSave($model))
         {

             /**
              *
              * Post save Actions
              */

             $this->urlRedirect(['index', true]);
         }
        

                 $form = $this->activeBegin();

                 ZCardWidget::begin([
                     'config' => [
                         'title' => $this->title,
                         'type' => ZCardWidget::type['dynCard'],
                     ]
                 ]);

                 echo ZFormWidget::widget([
                     'model' => $model,
                     'form' => $form,
                 ]);

                 ZCardWidget::end();

                 $this->activeEnd();

                 ?>




         ?>

     </div>
     <div class="col-6">
<?php

echo ZYandexWidget::widget([
    'config' => [
        'trafficControl' => true,
        'routeButtonControl' => true,
        'zoomControl' => true,
        'searchControl' => true,
        'typeSelector' =>  true,
        'geolocationControl' => true,
        'fullscreenControl' => true,
        'customControl' => true,
        'rulerControl' => true,

    ],
]);

   ?>
     </div>
     </div>
=======
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\former\ZFormWidget;

//$action->type = WebItem::type['ajax'];

$form = $this->activeBegin();
$model =new CoreAdress();

echo ZFormWidget::widget([
    'model' => $model,
    'form' => $form
]);

$this->activeEnd();
>>>>>>> parent of 7ac1fdfbb... 20-05-2020_17-50-19
