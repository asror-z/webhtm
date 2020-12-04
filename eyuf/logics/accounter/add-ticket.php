<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\models\App\eyuf\EyufInvoice;
use zetsoft\models\App\eyuf\EyufScholar;
use zetsoft\models\App\eyuf\EyufTicket;
use zetsoft\service\forms\Active;
use zetsoft\system\assets\ZColor;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\former\ZFormWidget;
use zetsoft\widgets\former\ZViewWidget;
use zetsoft\widgets\themes\ZCardProfileWidget;
use zetsoft\widgets\themes\ZCardWidget;


/** @var ZView $this */
$action = new WebItem();

$action->title = Azl . 'Добавить авиабилет';
$action->icon = 'fa fa-institution';
$action->layout = true;
$action->debug = false;

$this->paramSet(paramAction, $action);

$this->title();
$this->toolbar();

//$scholarId = $this->userIdentity()->id;
$scholarId = $this->httpGet('scholarId');
$scholar = EyufScholar::findOne($scholarId);

/** @var EyufInvoice $model */
$model = new EyufTicket();

$model->eyuf_scholar_id = $scholarId;
$model->kernel();
$model->configs->readonly = [
    'eyuf_scholar_id' => true
];


?>

<div class="row">

    <div class="col-md-12">

        <?
        
        $active = new Active();
        $active->type = Active::type['horizontal'];
        $form = $this->activeBegin($active);

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

        if ($this->modelSave($model)) {
            $this->paramSet(paramIframe, true);
            $this->urlRedirect([
                'invoice-index',
                'scholarId' => $scholarId
            ]);
        }


        $this->activeEnd();

        ?>
    </div>
</div>

