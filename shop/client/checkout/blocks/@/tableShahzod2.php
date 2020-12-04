<?php
/** @var ZView $this */

$this->fileJs('https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js');
$this->fileJs('https://cdn.datatables.net/rowgroup/1.1.2/js/dataTables.rowGroup.min.js');


$this->fileCss('https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css');
?>




<?php

use zetsoft\former\shop\ShopCheckOutForm;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\former\ZDatatableWidgetNew;
use zetsoft\widgets\images\ZImageWidget;
use zetsoft\widgets\incores\ZMCheckboxWidget;
use zetsoft\widgets\market\ZInputSpinnerWidget;

//vdd($item->company_name)

if (!isset($items)) {
    $item = new ShopCheckOutForm();
    $item->id = 1;
    $item->name = "Nimadir mahsulot";
    $item->photo = "https://images.pexels.com/photos/1095550/pexels-photo-1095550.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500";
    $item->company = "Company name";
    $item->price = 10000;
    $item->amount = 50;
    $item->measure = 'kg';
    $item->currency = '$';

    $items[] = $item;
    $items[] = $item;
    $items[] = $item;
    $items[] = $item;
    $items[] = $item;
    $items[] = $item;
}

$model = new ShopCheckOutForm();

/** @var ShopCheckOutForm $model */
$model->name = function ($model, $item, $attribute, $column) {
    $html = <<<HTML
<div class="d-flex">
      <div class="">{image}</div>
      <div class="">
                    <p class="fp-20 m-0">{name}</p>
                    <div class="font-weight-medium price-format">{amount} {measure} x {price} {currency}</div>
                </div>
                </div>
HTML;

    return strtr($html, [
        '{name}' => $item->name,
        '{amount}' => $item->amount,
        '{price}' => $item->price,
        '{measure}' => $item->measure,
        '{currency}' => $item->currency,
        '{image}' => ZImageWidget::widget([
            'value' => $item->photo,
            'config' => [
                'width' => '100px',
                'class' => 'img-fluid mr-3'
            ]
        ])
    ]);

};
$model->configs->nameOn = [
    'name',
];

$model->columns();

echo ZDatatableWidgetNew::widget([
    'model' => $model,
    'data' => $items,
    'config' => [
        'headClass' => 'd-none'
    ]
]);


?>
<script>

    var checker = document.getElementById('');

    if ($(".form-check-input:checked")) {
        //$('#zakazsend').prop('disabled', true);
    } else {
        //$('#zakazsend').prop('disabled', false);
    }


    $(document).ready(function () {
        var t = $('#tableCheck').DataTable({
            "paging": true,
            'searching': false,
            "ordering": false,
            "info": false,
            "pagingType": "first_last_numbers",
            order: [[2, 'asc']],
            rowGroup: {
                dataSrc: 2
            },
            "language": {
                "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Russian.json"
            },

            //fnDrawCallback: -> $("#selector thead").remove()
        });

    });


</script>
<style>
    .dataTables_length {
        display: none;

    }

    .dataTables_wrapper {
        padding: 8px;
        background-color: #ffffff;
        /* -webkit-box-shadow: 0 0 30px rgba(0,0,0,.08); */
        -moz-box-shadow: 0 0 30px rgba(0, 0, 0, .08);
        box-shadow: 0 0 30px rgba(0, 0, 0, .08);
    }
</style>

