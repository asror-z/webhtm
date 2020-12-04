<?php

use zetsoft\models\pays\PaysCurrency;
use zetsoft\models\App\eyuf\EyufScholar;
use zetsoft\widgets\former\ZFormWidget;
use zetsoft\widgets\themes\ZCardWidget;
use zetsoft\models\App\eyuf\EyufInvoice;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\former\ZFormBuildWidget;
use zetsoft\widgets\themes\ZColWidget;
use zetsoft\widgets\themes\ZRowWidget;
use zetsoft\dbitem\core\WebItem;


/** @var ZView $this */

$action = new WebItem();

$action->title = Azl . 'Добавить расходы';
$action->icon = 'fa fa-institution';


$action->layout = true; $action->debug = false;


$this->paramSet(paramAction, $action);

$this->title();
$this->toolbar();$scholarId = $this->httpGet('scholarId');
$scholar = EyufScholar::find()
    ->where([
        'id' => $scholarId
    ])
    ->one();
/*$id = */

/** @var EyufInvoice $model */
$model = new EyufInvoice();
$model->eyuf_scholar_id = $scholarId;
$model->configs->nameOff = [
    'user_id',
    'eyuf_scholar_id'
];



if ($this->modelSave($model)) {

    $model = EyufInvoice::findOne($model->id);
    $currency = $model->getPaysCurrency();

    $model->price_cbu = (int)$currency->cbu * (int)$model->price;
    $model->price_buy = (int)$currency->buy * (int)$model->price;
    $model->price_sell = (int)$currency->sell * (int)$model->price;

    if ($model->save())
        $this->urlRedirect([
            'invoice-index',
            'userId' => 97
        ]);
}

?>


<div class="row">
    <div class="col-md-12 col-12">

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

        $this->activeEnd();

        ?>

    </div>
</div>
