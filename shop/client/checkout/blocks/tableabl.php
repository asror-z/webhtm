<?php
/** @var ZView $this */

$this->fileJs('https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js');
$this->fileJs('https://cdn.datatables.net/1.10.21/js/dataTables.uikit.min.js');
$this->fileJs('https://cdn.datatables.net/rowgroup/1.1.2/js/dataTables.rowGroup.min.js');
$this->fileJs('https://cdn.datatables.net/select/1.3.1/js/dataTables.select.min.js');
$this->fileCss('https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.2/css/uikit.min.css');
$this->fileCss('https://cdn.datatables.net/1.10.21/css/dataTables.uikit.min.css');
$this->fileCss('https://cdn.datatables.net/select/1.3.1/css/select.dataTables.min.css');
?>




<?php

use zetsoft\system\kernels\ZView;
use zetsoft\widgets\market\ZInputSpinnerWidget;

?>
<table id="tableCheck" class="uk-table uk-table-hover uk-table-striped" style="width:100%">
    <thead>
    <tr>
        <th>№</th>
        <th>Вид Товара</th>
        <th>Название</th>
        <th>Company</th>
        <th>Количество</th>
        <th>Цена</th>
        <th>Сумма Доставки</th>
        <th>Всего</th>
        <th>Действии</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td>1</td>
        <td class="w-25">
            <img class="w-50 img-fluid" src=<?=$item->images[0]?> alt="">
        </td>
        <td>
            <div>
                <h6 class="mt-1">
                        <?=$item->name?>
                </h6>
            </div>
            <div class="d-flex align-items-center justify-content-center">
                <h6 class="font-weight-medium price-format"><?$item->new_price?> <?$item->currency?></h6>
            </div>
        </td>
        <td>
            <h6>Nike</h6>
        </td>
        <td>
           <h6>10 шт</h6>
        </td>
        <td>
            <div class="d-flex align-items-center justify-content-center">

                <h6>
                    <?=$item->new_price?>
                    <?=$item->currency?>
                </h6>
            </div>
        </td>
        <td>
           
        </td>
        <td>
            <h6>200.000 сум</h6>
        </td>
        <td>
            <div class="p-0" style="width: 22px; height: 30px; position: relative;">
                <a  data-catalogid="{catalog_id}" class="delete_product_from_cart"><i class="small far fa-trash-alt fp-25 text-success" style="position:absolute; left: 1px"></i>
                </a>
            </div>
        </td>
    </tr>
    <tr>
        <td>2</td>
        <td class="w-25">
            <img class="w-50 img-fluid" src=<?=$item->images[0]?> alt="">
        </td>
        <td>
            <div>
                <h6 class="mt-1">
                        <?=$item->name?>
               
                </h6>
            </div>
            <div class="d-flex align-items-center justify-content-center">
                <h6 class="font-weight-medium price-format"><?$item->new_price?> <?$item->currency?></h6>
            </div>
        </td>
        <td>
           <h6>Nike</h6>
        </td>
        <td>
            <h6>5 шт</h6>
        </td>
        <td>
            <div class="d-flex align-items-center justify-content-center">
                <h6>
                    <?=$item->new_price?>
                    <?=$item->currency?>
                </h6>
            </div>
        </td>
        <td>
            <h6>10.000 сум</h6>
        </td>
        <td>
            <h6>200.000 сум</h6>
        </td>
        <td>
            <div class="p-0" style="width: 22px; height: 30px; position: relative;">
                <a  data-catalogid="{catalog_id}" class="delete_product_from_cart"><i class="small far fa-trash-alt fp-25 text-success" style="position:absolute; left: 1px"></i>
                </a>
            </div>
        </td>
    </tr>
    <tr>
        <td>3</td>
        <td class="w-25">
            <img class="w-50 img-fluid" src=<?=$item->images[0]?> alt="">
        </td>
        <td>
            <div>
                <h6 class="mt-1">
                        <?=$item->name?>
                   
                </h6>
            </div>
            <div class="d-flex align-items-center justify-content-center">
                <h6 class="font-weight-medium price-format"><?$item->new_price?> <?$item->currency?></h6>
            </div>
        </td>
        <td>
            <h6>Adidas</h6>
        </td>
        <td>
            <h6>1 шт</h6>
        </td>
        <td>
            <div class="d-flex align-items-center justify-content-center">
                <!--<span class="mb-2 mr-1">{currency_left}</span>-->
                <h6>
                    <?=$item->new_price?>
                    <?=$item->currency?>
                </h6>
            </div><!---->
        </td>
        <td>

        </td>
        <td>
            <h6>320.000 сум</h6>
        </td>
        <td>
            <div class="p-0" style="width: 22px; height: 30px; position: relative;">
                <a  data-catalogid="{catalog_id}" class="delete_product_from_cart"><i class="small far fa-trash-alt fp-25 text-success" style="position:absolute; left: 1px"></i>
                </a>
            </div>
        </td>
    </tr>
    <tr>
        <td>4</td>
        <td class="w-25">
            <img class="w-50 img-fluid" src=<?=$item->images[0]?> alt="">
        </td>
        <td>
            <div>
                <h6 class="mt-1">
                        <?=$item->name?>
                 
                </h6>
            </div>
            <div class="d-flex align-items-center justify-content-center">
                <h6 class="font-weight-medium price-format"><?$item->new_price?> <?$item->currency?></h6>
            </div>
        </td>
        <td>
            <h6>Adidas</h6>
        </td>
        <td>
            <h6>5 шт</h6>
        </td>
        <td>
            <div class="d-flex align-items-center justify-content-center">
                <h6>
                    <?=$item->new_price?>
                    <?=$item->currency?>
                </h6>
            </div>
        </td>
        <td>
           <h6>16.000 сум</h6>
        </td>
        <td>
            <h6>320.000 сум</h6>
        </td>
        <td>
            <div class="p-0" style="width: 22px; height: 30px; position: relative;">
                <a  data-catalogid="{catalog_id}" class="delete_product_from_cart"><i class="small far fa-trash-alt fp-25 text-success" style="position:absolute; left: 1px"></i>
                </a>
            </div>
        </td>
    </tr>
   
   
    </tbody>
</table>


<script>        
    $(document).ready( function () {
        $('#tableCheck').DataTable({
            order: [[3, 'asc']],
            rowGroup: {
                dataSrc: 3
            },
            select: true,
            autoWidth: false,
            paging:   true,
            ordering: true,
            info:     true
        });
    });
</script>
