<?php

use kartik\alert\Alert;
use zetsoft\dbitem\core\WebItem;
use zetsoft\dbitem\App\eyuf\CurrencyItem;
use zetsoft\models\user\User;
use zetsoft\models\App\eyuf\EyufInvoice;
use zetsoft\models\App\eyuf\EyufScholar;
use zetsoft\system\assets\ZColor;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\former\ZFormWidget;
use zetsoft\widgets\former\ZViewWidget;
use zetsoft\widgets\notifier\ZKAlertWidget;
use zetsoft\widgets\themes\ZCardProfileWidget;
use zetsoft\widgets\themes\ZCardWidget;


/** @var ZView $this */
$action = new WebItem();

$action->layout = true; $action->debug = false;
$action->icon = 'fa fa-graduation-cap';


$action->title = Azl . 'Добавить расходы';
$action->icon = 'fa fa-institution';

$this->paramSet(paramAction, $action);

$this->title();
$this->toolbar();

$scholarId = $this->httpGet('scholarId');
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

    $this->urlRedirect([
        'invoice-index',
        'scholarId' => $scholarId
    ]);
}

?>

<div class="row">

    <div class="col-md-4">
        <?php

        $scholarId = $this->httpGet('scholarId');
        /** @var EyufScholar $scholar */
        $scholar = EyufScholar::findOne($scholarId);
        $user = User::findOne(['id' => $scholar->user_id]);


        if ($this->userIsGuest())
            return 'You have login to page';


        $imageUrl = $user->userPhoto();

        ZCardProfileWidget::begin([
            'config' => [
                'imageUrl' => $imageUrl,
                'color' => ZColor::color['primary-color'],
                'title' => $user->name,
            ]
        ]);

        if (!empty($scholar->status))
            echo 'Статус: ' . (new EyufScholar())->_status[$scholar->status];

        ZCardProfileWidget::end();


        $scholar_edu = EyufScholar::findOne($scholarId);

        $scholar_edu->configs->nameOn = [
            'currency'
        ];
        $scholar_edu->configs->nameOff = [
            'id'
        ];

        $scholar_edu->configs->filter = false;

        echo ZDynaWidget::widget([
            'model' => $scholar_edu,
            'rightBtn' => [
                'update' => [
                    'content' => '',
                    'options' => ['class' => 'btn-group p-1 mr-0 {btnSize} {iconSize}']
                ],

                'system' => [
                    'content' => '',
                    'options' => ['class' => 'btn-group p-1 mr-0 {btnSize} {iconSize}']
                ],
                'add-clone-delete' => [
                    'content' => '{add}{tabular}{clone}{delete}',
                    'options' => ['class' => 'btn-group p-1 mr-0 {btnSize} {iconSize}']
                ],
                'filter-sort-id' => [
                    'content' => '',
                    'options' => ['class' => 'btn-group p-1 mr-0 {btnSize} {iconSize}']
                ],
                'statistics' => [
                    'content' => '',
                    'options' => ['class' => 'btn-group p-1 mr-0 {btnSize} {iconSize}']
                ],
                'export' => [
                    'content' => '{jsonExcel}{export}',
                    'options' => ['class' => 'btn-group p-1 {btnSize} {iconSize}']
                ],
                'toggleData' => [
                    'content' => '{all}',
                    'options' => ['class' => 'btn-group p-1 {btnSize} {iconSize}']
                ],
                'filterPjax' => [
                    'content' => '',
                    'options' => ['class' => 'btn-group p-1 {btnSize} {iconSize}']
                ],
            ],
            'config' => [
                'createUrl' => '/logics/accounter/add-invoice.aspx?scholarId=' . $scholarId,
                'edit' => false,
                'topFilter' => false,
                'topSort' => false,
                'toolbar' => false,
                'columnCheckbox' => false,
                'search' => false,
                'actionDelete' => false,
                'actionClone' => false,
                'title' => 'Основные данные',
                'summary' => false,
                'titleCreate' => 'Добавить документ',
                'columnAction' => false,
                'columnRelation' => false,
            ]

        ]);

        echo ZViewWidget::widget([
            'model' => $scholar,
        ]);
        ?>

    </div>

    <div class="col-md-8">

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


        $currency = strtoupper($scholar->currency);
        /** @var CurrencyItem $item */
        $item = Az::$app->App->eyuf->excel->curr($scholar);

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
       console.log(sumValue);
       console.log(currentValue);
       endValue = sumValue / currentValue;
       $('#end_value').val(endValue.toFixed(2) + ' ' + valyutValue.toUpperCase());
    });

JS;

            $js = strtr($jsCode, [
                '{bank}' => $item->bank,
                '{cbu}' => $item->cbu,
            ]);

            $this->registerJs($js);

        }


        echo ZFormWidget::widget([
            'model' => $model,
            'form' => $form,
        ]);

        ZCardWidget::end();

        $this->activeEnd();

        ?>

    </div>
</div>

