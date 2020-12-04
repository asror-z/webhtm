<?php

use zetsoft\system\Az;
use zetsoft\widgets\former\ZFormWidget;
use zetsoft\widgets\themes\ZCardWidget;
use zetsoft\models\faqs\FaqsManual;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\former\ZFormWizardWidget;
use zetsoft\widgets\themes\ZColWidget;
use zetsoft\widgets\themes\ZRowWidget;

/** @var ZView $this */


$action->title = Azl . 'Создание Справочника';

$action->icon = 'fa fa-graduation-cap';

$action->debug = true;
$action->type = WebItem::type['ajax'];


$id = $this->httpGet('id');
$model = new FaqsManual();



if ($this->modelSave($model))
{

    /**
     *
     * Post save Actions
     */

    $this->urlRedirect(['index', true]);
}
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
