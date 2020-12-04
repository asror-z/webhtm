<?php

use zetsoft\system\Az;
use zetsoft\widgets\former\ZFormWidget;
use zetsoft\widgets\themes\ZCardWidget;
use zetsoft\models\App\eyuf\EyufNeed;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\former\ZFormBuildWidget;
use zetsoft\widgets\themes\ZColWidget;
use zetsoft\widgets\themes\ZRowWidget;
use zetsoft\dbitem\core\WebItem;


/** @var ZView $this */

$action = new WebItem();

$action->title = Azl . 'Редактирование  Потребности';
$action->icon = 'fa fa-dashboard';


$action->layout = true; $action->debug = false;


$this->paramSet(paramAction, $action);

$this->title();
$this->toolbar();






$id = $this->httpGet('id');
$model = EyufNeed::findOne($id);


if ($this->modelSave($model))
    $this->urlRedirect(['index', true]);

?>


<div class="row">
    <div class="col-md-12 col-12">

        <?

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

    </div>
</div>
