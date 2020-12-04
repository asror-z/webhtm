<?php
/** @var ZView $this */

$this->fileJs('https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js');
$this->fileJs('https://cdn.datatables.net/rowgroup/1.1.2/js/dataTables.rowGroup.min.js');
$this->fileCss('https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css');

use FontLib\Table\Type\name;
use zetsoft\dbitem\App\eyuf\CheckboxItem;
use zetsoft\dbitem\shop\SingleProductItem;
use zetsoft\former\shop\ShopOrderForm;
use zetsoft\models\shop\ShopOrder;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\actions\ZEasySelectableWidget;
use zetsoft\widgets\actions\ZSortSelectableWidget;
use zetsoft\widgets\actions\ZSortSelectableWidgetAz;
use zetsoft\widgets\former\ZFormWidget;
use zetsoft\widgets\incores\ZMCheckboxGroupWidget;
use zetsoft\widgets\incores\ZMCheckboxWidget;
use zetsoft\widgets\inptest\ZSelectable2Widget;
use zetsoft\widgets\inputes\ZBootstrapItemRadioGroupWidget;
use zetsoft\widgets\inputes\ZHRadioButtonGroupWidget;
use zetsoft\widgets\inputes\ZPriceFormatWidget1;
use zetsoft\widgets\inputes\ZRadioGroupWidget;
use zetsoft\widgets\inputes\ZRadioListWidget;
use zetsoft\widgets\market\ZInputSpinnerWidget;


//vdd($item->company_name)
$checkboxItems = [];
$checkboxItem = new CheckboxItem();
$checkboxItem->icon = '<img width="60" class="img-fluid" src="https://www.calc.ru/imgs/articles/596-3dd4436d599fdf830a5f8ea45495b4ed.jpg" alt="sum">';
$checkboxItem->title = '';
$checkboxItem->text = 'Наличный расчет';
$checkboxItems [] = $checkboxItem;

$checkboxItem = new CheckboxItem();
$checkboxItem->icon = '<img width="60" class="img-fluid" src="https://www.norma.uz/img/3a/fe/b41dfe1a1e097ca094dd632f32fa.png" alt="sfasf">';
$checkboxItem->title = '';
$checkboxItem->text = 'UzCard tooltip';
$checkboxItems [] = $checkboxItem;

$checkboxItem = new CheckboxItem();
$checkboxItem->icon = '<img width="50" class="img-fluid" src="https://nuz.uz/uploads/posts/2019-04/thumbs/1555519524_9832b1e7d050fdec979807eaa4da.jpg" alt="sfasf">';
$checkboxItem->title = '';
$checkboxItem->text = 'Humo tooltip';
$checkboxItems [] = $checkboxItem;

echo ZPriceFormatWidget1::widget([
    'config' => [
        'priceClassName' => 'format-sum'
    ]
]);

$deliver = 0;
$sum = 0;
?>

<div class="d-block boxShadow">
    <h4 class="text-success" align="center">Состав заказа</h4>
    <div class="w-100 mb-3 boxShadowInto p-2" style="height: 400px; overflow-y: scroll;">

        <table class="row-border" style="width:100%;">
            <tbody>
            <? foreach ($items as $item) :
                $deliver += $item->delivery_price;
                $sum += $item->total_price;
                ?>
                <tr>
                    <td>
                        <div class="">
                            <table>
                                <tr class="border-bottom-0">
                                    <th class="fp-20">
                                        <?= $item->company_name; ?>
                                    </th>
                                    <th></th>
                                    <th></th>
                                </tr>

                                <? foreach ($item->items as $product) :
                                    ?>
                                    <tr class="border-bottom table">
                                        <td class="" colspan="2">
                                            <div class="d-flex">
                                                <img width="100px" class="img-fluid mr-3"
                                                     src=<?= $product->images[0] ?> alt="">
                                                <div class="">
                                                    <p class="fp-16 m-0"><?= $product->name ?></p>
                                                    <span><?= $product->amount . ' ' . $product->measure ?></span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <p class="fp-16 m-0 loat-right format-sum"
                                               style="min-height: 36px"> <?= $product->new_price . ' ' . $product->currency
                                                ?>
                                            </p>
                                        </td>
                                    </tr>
                                <? endforeach; ?>

                                <tr class="border-bottom">
                                    <td></td>
                                    <td class="font-weight-normal text-center">Стоимость продуктов</td>
                                    <td class="font-weight-bold float-right">
                                        <p class="fp-14 font-weight-bold m-0 float-right format-sum">
                                            <?= $item->total_price . ' ' . $product->currency ?>
                                        </p>
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

    <div class="p-3 border-bottom w-100">

        <div class="mt-2 d-flex justify-content-around pr-5 pl-5 mr-5 ml-5">
            <?

            /*$model = new ShopOrderForm();
            $model->configs->nameOn = [
                'payment_type'
            ];
            $model->configs->options = [
                'payment_type' => [
                    'data' => $checkboxItems
                ]
            ];
            $model->columns();
            echo ZFormWidget::widget([
                'model' => $model,
                'form' => $form,
                'config' => [
                    'topBtn' => false,
                    'botBtn' => false,
                ]
            ]);*/
            $payment_types = (new ShopOrder())->_payment_type;

            echo ZBootstrapItemRadioGroupWidget::widget([
                'data' => $checkboxItems,
                'config' => [
                    'imgSize' => ZBootstrapItemRadioGroupWidget::size['4'],
                    'borderType' => ZBootstrapItemRadioGroupWidget::borderType['border-primary'],
                    'InputClass' => 'paymentRadioGroup',
                ]
            ])
            ?>
        </div>
        <div class="d-block pl-5 pr-5">

            <p class="d-flex justify-content-between">
                <span>Сумма доставки:</span>
                <font>
                    <span class="text-bold fp-20 format-sum"><?= $deliver ?></span><span><?= $product->currency ?></span>
                </font
            </p>

            <p class="d-flex justify-content-between">
                <span>Сумма продуктов:</span>
                <font>
                    <span class="text-bold fp-20 format-sum"><?= $sum ?></span><span><?= $product->currency ?></span>
                </font
            </p>

            <p class="d-flex justify-content-between">
                <span>Общая сумма:</span>

                <font>
                    <span class="text-bold fp-20 format-sum font-weight-bold"><?= $sum + $deliver ?></span>
                    <span><?= $product->currency ?></span>
                </font>
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


        <input disabled id="buttononclickdisable" type="submit" value="Оформить заказ"
               class="btn btn-block btn-success rounded checking-btn"/>


    </div>
</div>
<script>
    $('input:checkbox').change(function () {
        if (this.checked) {
            console.log('checked');
            $('#buttononclickdisable').removeAttr('disabled')
        } else {
            $('#buttononclickdisable').attr('disabled', 'disabled')
            //$('#sendOrder').submit();
            console.log('not checked')
        }
    });
</script>










