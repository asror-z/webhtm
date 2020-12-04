<?php

/**
 *
 *
 * Author:  Asror Zakirov
 * https://www.linkedin.com/in/asror-zakirov
 * https://www.facebook.com/asror.zakirov
 * https://github.com/asror-z
 *
 */

use zetsoft\models\ALL\CoreCountry;
use zetsoft\models\App\eyuf\EyufInvoice;
use zetsoft\models\App\eyuf\EyufInvoiceType;
use zetsoft\models\App\eyuf\InvoiceType;
use zetsoft\models\App\eyuf\EyufScholar;
use zetsoft\system\Az;
use zetsoft\system\column\ZKDataColumn;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\navigat\ZButtonWidget;
use zetsoft\dbitem\core\WebItem;

/** @var ZView $this */

$action = new WebItem();

$action->title = Azl . 'Таблица с расходом';
$action->icon = 'fal fa-print';


$action->layout = true;
$action->debug = false;


$this->paramSet(paramAction, $action);

$this->title();
$this->toolbar();

$model = new EyufScholar();
$model->configs->edit = false;


$where[] = EyufScholar::status['stipend'];
$where[] = EyufScholar::status['accounter'];


$invoicesAll = collect(EyufInvoice::find()->all());

$invoices = [];

$invoices[] = [
    'class' => ZKDataColumn::class,
    'label' => Az::l('Все расходы'),
    'value' => function ($model, $key, $index, ZKDataColumn $dataColumn) use ($invoicesAll) {

        /** @var EyufInvoice $invoice */

        $all = 0;

        $invoicesAll = $invoicesAll->where(
            'eyuf_scholar_id', ZArrayHelper::getValue($model, 'id')
        );

        if ($invoicesAll !== null)
            foreach ($invoicesAll as $invoice) {
                $all += (int)$invoice->price;
            }

        return $all;
    },
    
];

$invoices[] = [
    'class' => ZKDataColumn::class,
    'label' => Az::l('Все расходы ') . '(Bалюта)',
    'value' => function ($model, $key, $index, ZKDataColumn $dataColumn) use ($invoicesAll) {

        /** @var EyufInvoice $invoice */
        
        /*$invoices = EyufInvoice::findAll([
            'eyuf_scholar_id' => $model->id,
        ]);*/

       $invoices = $invoicesAll->where(
            'eyuf_scholar_id', ZArrayHelper::getValue($model, 'id')
       );

        $all = 0;
        if ($invoices !== null)
            foreach ($invoices as $invoice) {
                $all += (int)$invoice->dollar;

            }

        return $all;
    }
];

$types = EyufInvoiceType::find()->all();
//vdd($types);

foreach ($types as $type) {

    $invoices[] =
        [
            'class' => ZKDataColumn::class,
            'label' => $type->name,
            'value' => function ($model, $key, $index, ZKDataColumn $dataColumn) use ($type, $invoicesAll) {

                /** @var EyufInvoice $invoice */
                /*$invoice = EyufInvoice::findOne([
                    'eyuf_invoice_type_id' => $type['id'],
                    'eyuf_scholar_id' => ZArrayHelper::getValue($model, 'id'),
                ]);*/

                $invoice = $invoicesAll->where(
                        'eyuf_invoice_type_id', ZArrayHelper::getValue($type, 'id')
                    )
                    ->where(
                        'eyuf_scholar_id', ZArrayHelper::getValue($model, 'id')
                    )
                    ->first();

                if ($invoice !== null) {
                    return $invoice->price;
                } else
                    return 0;

            }
        ];


    $invoices[] =
        [
            'class' => ZKDataColumn::class,
            'label' => $type->name . " (Валюта)",
            'value' => function ($model, $key, $index, ZKDataColumn $dataColumn) use ($type, $invoicesAll) {
                /** @var EyufInvoice $invoice */
                $invoice = $invoicesAll->where(
                    'eyuf_invoice_type_id', ZArrayHelper::getValue($type, 'id')
                )
                    ->where(
                        'eyuf_scholar_id', ZArrayHelper::getValue($model, 'id')
                    )
                    ->first();
                if ($invoice !== null)
                    return $invoice->dollar;
                else
                    return 0;
            }
        ];

    $model->configs->query = EyufScholar::find()->where([
        'status' => $where,
    ]);
}

$invoices[] =  [
    'class' => ZKDataColumn::class,
    'label' => Az::l('Расходы'),
    'width' => '100px',
    'value' => function ($model, $key, $index, ZKDataColumn $dataColumn) {
        return ZButtonWidget::widget([
            'config' => [
                'text' => Az::l('Расходы'),
                'btnRounded' => false,
                'btnSize' => ZButtonWidget::btnSize['btn-md'],
                'btnStyle' => ZButtonWidget::btnStyle['btn-outline-link'],
                /* 'url' => ZUrl::to('/eyuf/logics/needer/update.aspx?id=' . $model->id)*/
            ],
            'event' => [
                //start|NurbekMakhmudov|2020-10-23
                'click' => <<<JS
      function (event) {
                            window.open('/eyuf/logics/accounter/invoice-index.aspx?scholarId={$model['id']}', '_blank');
                        }
JS,
                //end|NurbekMakhmudov|2020-10-23

                /*
                'click' => <<<JS
function (event) {
                    window.open('/eyuf/logics/accounter/invoice-index.aspx?scholarId={$model->id}', '_blank');
                }
JS,                     */


            ]
        ]);
    }
];
//$allInvoices = ZArrayHelper::merge($myInvoice, $invoices);

//vdd($invoices);

$model->configs->after = [
    'title' => $invoices
];

/** @var ZView $this */
$user = $this->userIdentity();


?>

<div class="row">
    <div class="col-12">

        <?

        $this->pjaxBegin();

        echo ZDynaWidget::widget([
            'model' => $model,
            'rightBtn' => [
                'update' => [
                    'content' => '',
                    'options' => ['class' => 'btn-group p-1 mr-0 {btnSize} {iconSize}']
                ],
                'clear_update' => [
                    'content' => '{clear_update}',
                    'options' => ['class' => 'btn-group p-1 mr-0 {btnSize} {iconSize}']
                ],
                'system' => [
                    'content' => '',
                    'options' => ['class' => 'btn-group p-1 mr-0 {btnSize} {iconSize}']
                ],
                'add-clone-delete' => [
                    'content' => '{tabular}{clone}{delete}',
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
                'title' => Az::l('Cтипендианты'),
                'topCreate' => false,
                'actionDelete' => false,
                'actionClone' => false,
                'edit' => false,
                'columnAction' => false,
                'search' => true,
                'perfectScrollbar' => true,
                'viewUrl' => '/eyuf/logics/accounter/currency-view.aspx?id={id}',
                'pjax' => false

            ],

        ]);

        $this->pjaxEnd();

        ?>

    </div>
</div>


