<?php
/** @var ZView $this */

$this->fileJs('https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js');
$this->fileJs('https://cdn.datatables.net/1.10.21/js/dataTables.uikit.min.js');
$this->fileJs('https://cdn.datatables.net/rowgroup/1.1.2/js/dataTables.rowGroup.min.js');
$this->fileJs('https://cdn.datatables.net/select/1.3.1/js/dataTables.select.min.js');
$this->fileJs('/render/cards/ZVMarketWidget/asset/main2.js');
$this->fileCss('https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.2/css/uikit.min.css');
$this->fileCss('https://cdn.datatables.net/1.10.21/css/dataTables.uikit.min.css');
$this->fileCss('https://cdn.datatables.net/select/1.3.1/css/select.dataTables.min.css');
?>
<?php

use zetsoft\system\Az;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\inputes\ZKStarRatingWidget;
use zetsoft\widgets\inputes\ZKTouchSpinWidget;
use zetsoft\widgets\market\ZSVGWidget;

?>
<table id="tableProduct" class="uk-table uk-table-hover uk-table-striped" style="width:100%">
    <thead>
    <tr>
        <th class="text-center">№</th>
        <th class="text-center">Логотип</th>
        <th class="text-center">Магазин</th>
        <th class="text-center">Рейтинг</th>
        <th class="text-center">Цена</th>
        <th class="text-center">Доставка</th>
        <th class="text-center">Оплата</th>
        <th class="text-center">Действии</th>
    </tr>
    </thead>
    <tbody>
    <tr class="align-middle">
        <td class="align-middle">1</td>
        <td style="width: 10%">
            <div class="d-flex flex-wrap">
                <img class="w-75 img-fluid" src="https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcRFthAQgQPTmU9dMxiAHEfCbce9C0iFJbhmefPNk9O2BOolNSn3&usqp=CAU" alt="">
            </div>

        </td>
        <td class="align-middle">
            <div class="text-center">
                <h3 class="mt-4 ml-2">
                    Nike
                </h3>
            </div>
        </td>
        <td class="align-middle">
            <div class="mt-4 text-center">
                <?
                echo ZKStarRatingWidget::widget([
                    'name' => 'gggfg',
                    'config' => [
                        'show' => false,
                        'class'=> '',
                        'icon' => '<i class="fas fa-star fp-15"></i>',

                    ]
                ]);
                ?>

                <p class="text-center">8 Отзыва</p>
            </div>
        </td>
        <td class="align-middle">
            <div class="d-flex align-items-center justify-content-center">

                <h6 class="mt-4">
                    <del>12.000 сум</del><span class="badge badge-danger ml-2 mb-2 ">-9%</span>  <br>
                    <?=$item->max_price?>
                    <?=$item->currency?>
                </h6>
            </div>
        </td>
        <td class="align-middle">
            <div class="d-flex">
                <i class="fad fa-truck-container fp-25 mt-3 ml-5"></i>
                <p class="text-muted fp-14 ml-3">Бесплатная доставка курером</p>
            </div>

        </td>

        <td class="align-middle">
            <p class="text-center">Наличкой - Картой</p>
        </td>

        <td class="align-middle">
            <div class="p-0">
                <button id="add-card-<?= $item->id ?>"
                        class="w-100 mx-0 add-card btn btn-outline-success <?= $item->cart_amount > 0 ? "d-none" : "" ?>"
                        data-catalog-id="<?= $item->catalogId ?>"
                        onclick="addToCart($(this))">
                    <?= Az::l('Добавить в корзину') ?>
                </button>

                <div id="input-<?= $item->id ?>" class="touch-main <?= $item->cart_amount > 0 ? " " : "d-none" ?>">
                    <div class="d-flex touch-main-children justify-content-center">
                        <div class="d-flex parent-clear w-75">
                            <?
                            echo ZKTouchSpinWidget::widget([
                                'name' => 'asds',
                                'config' => [
                                    'min' => '0',
                                    'buttonup_txt' => '<i class="fa fa-plus px-2"></i>',
                                    'buttondown_txt' => '<i class="fa fa-minus px-2"></i>',
                                    'buttonup_class' => 'btn btn-success fp-18 rounded-right p-1',
                                    'buttondown_class' => 'btn btn-success fp-18 rounded-left p-1',
                                    'class' => 'text-center clear-add-btn',
                                    'initVal' => '1'
                                ],
                                'event' => [
                                    'startupspin' => <<<JS
                                    function(){
                                     spinUp($item->id,$item->catalogId);
                                    }
JS,
                                    'startdownspin' => <<<JS
                                    function(){
                                     spinDown($item->id,$item->catalogId);
                                    }
JS,

                                ]

                            ]);
                            ?>
                        </div>
                        <div class="v-card-clear-add" data-catalog-id="<?= $item->catalogId ?>"
                             onclick="deleteFromCart($(this))">
                            <?
                            echo ZSVGWidget::widget([
                                'config' => [
                                    'type' => 'basket_delete',
                                ]
                            ])
                            ?>
                        </div>
                
            </div>
        </td>
    </tr>



    </tbody>
</table>


<script>
    $(document).ready( function () {
        $('#tableProduct').DataTable({
            select: false,
            autoWidth: false,
            paging:   true,
            ordering: true,
            info:     true
        });




        $('#add-card-<?= $item->id ?>').on("click", function () {
           $('#input-<?= $item->id ?>').removeClass('d-none');
           $(this).addClass('d-none');
        });
    });
</script>

