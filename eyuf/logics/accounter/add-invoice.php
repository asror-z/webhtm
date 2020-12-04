<?php

use kartik\alert\Alert;
use rmrevin\yii\fontawesome\FA;
use zetsoft\dbitem\App\eyuf\CurrencyItem;
use zetsoft\models\user\User;
use zetsoft\models\App\eyuf\EyufInvoice;
use zetsoft\models\App\eyuf\EyufScholar;
use zetsoft\service\forms\Active;
use zetsoft\service\forms\ZPjax;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\former\ZAjaxWidget;
use zetsoft\widgets\former\ZFormBuildWidget;
use zetsoft\widgets\notifier\ZKAlertWidget;
use zetsoft\widgets\themes\ZCardWidget;
use zetsoft\dbitem\core\WebItem;

/** @var ZView $this */
$action = new WebItem();
$action->title = Azl . 'Добавить расходы';
$action->icon = 'fa fa-institution';
$action->layout = true;
$action->debug = false;
$this->paramSet(paramAction, $action);
$this->title();
$this->toolbar();

?>

<div class="row">
    <div class="col-md-6">
        <?php

        $scholarId = $this->httpGet('scholarId');

        $scholar_edu = EyufScholar::find()->where(['id' => $scholarId])->one();
        
        ?>

    </div>

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

        $currency = strtoupper($scholar_edu->currency);

        /** @var CurrencyItem $item */
        $item = Az::$app->App->eyuf->excel->curr($scholar_edu);
        
        if (empty($item->bank) || empty($item->cbu)) {
            echo ZKAlertWidget::widget([
                'config' => [
                    'type' => Alert::TYPE_DANGER,
                    'title' => '&nbsp' . '&nbsp' . 'Предупреждение !',
                    'body' => Az::l('Необходимо выбрать валюту!'),
                    'icon' => 'fas fa-exclamation-circle',
                    'delay' => 0,
                    'isShowSeparator' => true,
                ]
            ]);


        } else {

            $jsCode = <<<JS


        var bankArray = {bank};
        var cbuArray = {cbu};
        var sampleArray = {};
        var kursValue = $('#kurs_ban_cbu').val();
        var selectValue = '';
        var valyutValue = '';
        var sumValue = '';
        var endValue = '';
                                 
        
        $('#eyufinvoice-convert').on('change', function() {
           
           kursValue = $(this).val();
           
           console.log(kursValue)
           
           if (kursValue === 'bank') {
                 sampleArray = cbuArray;
           }
           else{
                 sampleArray = bankArray
           }
           
        });
    
    
        $('#eyufinvoice-price').on('keyup', function() {
            
           if (kursValue === 'cbu'){
                sampleArray = cbuArray;
           }
           else{
                sampleArray = bankArray;
           }
        
           selectValue = kursValue;
           
           console.log(sampleArray)
            
           sumValue = $(this).val();
           endValue = sumValue / sampleArray;
            
           $('#eyufinvoice-dollar').val(endValue.toFixed(2) + ' ' + valyutValue);
            
        });

JS;

            $js = strtr($jsCode, [
                '{bank}' => $item->bank,
                '{cbu}' => $item->cbu,
            ]);

            $this->registerJs($js);

        }

        /** @var EyufInvoice $model */

        $model = new EyufInvoice();

        $model->eyuf_scholar_id = $scholarId;
        $model->configs->nameOff = [
            'user_id',
            'eyuf_scholar_id'
        ];
        $model->configs->rules = validatorSafe;
        $model->configs->changeSave = true;
        $model->configs->changeReload = true;
        $this->paramSet(paramChangeReloadId, 'invoice-create');
        $model->columns();

        echo ZFormBuildWidget::widget([
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
    <div class="col-md-12 py-5">
        <div class="px-5">


        </div>
    </div>
</div>

