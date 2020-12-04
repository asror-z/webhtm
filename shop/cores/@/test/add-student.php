<?php

use zetsoft\system\Az;
use zetsoft\widgets\former\ZFormWidget;
use zetsoft\widgets\themes\ZCardWidget;
use zetsoft\models\App\eyuf\EyufStudent;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\former\ZFormWizardWidget;
use zetsoft\widgets\themes\ZColWidget;
use zetsoft\widgets\themes\ZRowWidget;


/** @var ZView $this */
$action = new WebItem();

$action->title = Azl . 'Создание student';
$action->icon = 'fa fa-line-chart';

$id = $this->httpGet('id');
$model = new EyufStudent();

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
