<?php

/**
 *
 *
 * Author:  Asror Zakirov
 * https://www.linkedin.com/in/asror-zakirov
 * https://github.com/asror-z
 *
 */

use zetsoft\dbitem\core\WebItem;
use zetsoft\dbitem\App\eyuf\CheckboxItem;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\actions\ZSortSelectableWidget;
use zetsoft\widgets\incores\ZMCheckboxWidget;


$action = new WebItem();

$action->csrf = true;
$action->debug = true;
$action->cache = false;
$action->call = null;
$action->cacheHttp = false;

$this->paramSet(paramAction, $action);

$action->type = WebItem::type['ajax'];



$checkboxItems = [];
$checkboxItem = new CheckboxItem();
$checkboxItem->icon = '<img width="60" height="auto" src="https://lh3.googleusercontent.com/proxy/-KTCxFzhcNPu5lmuFzPV1wkeKd70w5v5j3wvtcEEpNR-tgO5YOIsWJpAW_dcMnRQK8qwJdonIhcTBfKdDaFGRIY" alt="sum">';
$checkboxItem->title = '';
$checkboxItem->text = 'Наличный расчет';
$checkboxItems [] = $checkboxItem;

$checkboxItem = new CheckboxItem();
$checkboxItem->icon = '<img width="60" height="auto" src="https://www.norma.uz/img/3a/fe/b41dfe1a1e097ca094dd632f32fa.png" alt="sfasf">';
$checkboxItem->title = '';
$checkboxItem->text = 'UzCard tooltip';
$checkboxItems [] = $checkboxItem;

$checkboxItem = new CheckboxItem();
$checkboxItem->icon = '<img width="60" height="auto" src="https://nuz.uz/uploads/posts/2019-04/thumbs/1555519524_9832b1e7d050fdec979807eaa4da.jpg" alt="sfasf">';
$checkboxItem->title = '';
$checkboxItem->text = 'Humo tooltip';
$checkboxItems [] = $checkboxItem;
$product = '';

/** @var ZView $this */
$id = $this->httpGet('id');

$items = Az::$app->market->cart->cartOrders($id);


//vdd($items);
$sum = 0;

?>


    <div class="d-block">
        <div class="w-100 mb-5" style="height: 400px; overflow-y: scroll;">

            <table class="" style="width:100%;">
                <tbody>
                <? foreach ($items as $item) :
                    $sum += $item->total_price;
                    ?>
                    <tr>
                        <td>
                            <div class="">
                                <table>
                                    <tr>
                                        <th class="fp-16">
                                            <?= $item->company_name; ?>
                                        </th>
                                        <th></th>
                                        <th></th>
                                    </tr>

                                    <? foreach ($item->items as $product) :

                                        ?>
                                        <tr class=" table">
                                            <td class="" colspan="2">
                                                <div class="d-flex">
                                                    <img width="100px" class="img-fluid mr-3"
                                                         src=<?= $product->images[0] ?> alt="">
                                                    <div class="">
                                                        <p class="fp-16 m-0"
                                                           style="min-height: 36px"><?= $product->name ?></p>
                                                        <span><?= $product->amount . ' ' . $product->measure ?></span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <p class="fp-16 m-0"
                                                   style="min-height: 36px"> <?= $product->new_price . '' . $product->currency ?></p>
                                            </td>
                                        </tr>
                                    <? endforeach; ?>

                                    <tr class="-0">
                                        <td></td>
                                        <td class="font-weight-bold">Сумма доставки</td>

                                        <td class="font-weight-bold" colspan="3">
                                            <?= $item->delivery_price ?? '3' ?>
                                        </td>

                                    </tr>

                                    <tr class="">
                                        <td></td>
                                        <td class="font-weight-bold">Обшая сумма</td>
                                        <td class="font-weight-bold">
                                            <?= $item->total_price ?>
                                        </td>
                                    </tr>

                                </table>
                            </div>

                        </td>
                    </tr>
                <? endforeach; ?>
                </tbody>
            </table>

        </div>

        <div class="pl-3 pr-3  w-100">

            <div class="mt-2 d-block">

                <?
                echo ZSortSelectableWidget::widget([
                    'data' => $checkboxItems,
                    'config' => [
                        'cols' => ZSortSelectableWidget::cols['3'],
                    ]
                ])
                ?>
            </div>
            <div class="d-flex justify-content-between">

                <p class="fp-20">Итого:

                    <span class="text-bold fp-20 float-right"><?= $sum . ' ' . $product->currency ?></span>
                </p>
            </div>

            <div class="col-lg-12 col-md-12 col-sm-12 col-12 d-flex p-1 justify-content-lg-between checkbox-main">

                <?
                echo ZMCheckboxWidget::widget([
                    'config' => [
                        'class' => 'checkCheckboxx',
                        'placeholder' => ''
                    ]
                ])
                ?>
                <p class="ml-3">
                    Нажимая "Оформить заказ", я соглашаюсь с <a href="#" class="link">публичным договором оферты</a>
                </p>

            </div>


            <button disabled id="buttononclickdisable" class="btn btn-block btn-success rounded checking-btn">
                Оформить заказ
            </button>
        </div>
    </div>
    <script>
        $('input:checkbox').change(function () {
            if (this.checked) {
                console.log('checked');
                $('#buttononclickdisable').removeAttr('disabled')
            } else {
                $('#buttononclickdisable').attr('disabled', 'disabled')
                console.log('not checked')
            }
        });
    </script>

<?php


//echo $this->require( '/webhtm/shop/client/checkout/blocks/Shahzod.php', ['items' => $items]);

