<?php

use zetsoft\models\pays\PaysCurrency;
use zetsoft\system\helpers\ZJsonHelper;
use zetsoft\widgets\former\ZFormWidget;
use zetsoft\widgets\themes\ZCardWidget;
use zetsoft\models\App\eyuf\EyufInvoice;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\former\ZFormWizardWidget;
use zetsoft\widgets\themes\ZColWidget;
use zetsoft\widgets\themes\ZRowWidget;


/** @var ZView $this */
$action = new WebItem();

$action->title = Azl . 'Создание Расходы';
$action->icon = 'fa fa-crosshairs';

$id = $this->httpGet('id');
$model = new EyufInvoice();

if ($this->modelSave($model)) {

    /**
     *
     * Post save Actions
     */

    $this->urlRedirect(['index', true]);
}

?>


<div class="row">
    <div class="col-md-12 col-12">


        <?php

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

<?php

$currency = PaysCurrency::find()
    ->limit(1)
    ->one();


$bank = ZJsonHelper::encode($currency->bank);
$cbu = ZJsonHelper::encode($currency->cbu);

$jsCode = <<<JS

    var bankArray = {bank};
    var cbuArray = {cbu};
    var sampleArray = {};
    var kursValue = $('#kurs_ban_cbu').val();
    var selectValue = '';
    var currentValue = '';
    var valyutValue = '';
    var sumValue = '';
    var endValue = '';
    
    $('#kurs_ban_cbu').on('change', function() {
       kursValue = $('#kurs_ban_cbu').val(); 
    });

    $('#currency_value').on('change', function () {
    
        console.log(kursValue);
    
        if (kursValue === 'bank')
            sampleArray = bankArray;
        else
            sampleArray = cbuArray;
            
        console.log(sampleArray);
    
        selectValue = $('#currency_value').val();
        var attrValue = '1 ' + selectValue.toUpperCase() + ' = ' + sampleArray[selectValue] + ' SUM';
        $('#current_value').attr('value', attrValue);
        
        $('#current_value').attr('data-current', sampleArray[selectValue]);
        $('#current_value').attr('data-valyut', selectValue);
        
        valyutValue = $('#current_value').attr('data-valyut');
        currentValue = $('#current_value').attr('data-current');
    });
    
    $('#currency_in_sum').on('keyup', function() {
       sumValue = $('#currency_in_sum').val();
       endValue = sumValue / currentValue;
       $('#end_value').val(endValue.toFixed(2) + ' ' + valyutValue.toUpperCase());
    });

JS;


$js = strtr($jsCode, [
    '{bank}' => $bank,
    '{cbu}' => $cbu,
]);

$this->registerJs($js);


?>
