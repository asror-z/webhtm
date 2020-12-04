<?php
/** @var ZView $this */

$this->fileJs('https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js');
$this->fileJs('https://cdn.datatables.net/rowgroup/1.1.2/js/dataTables.rowGroup.min.js');
$this->fileCss('https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css');

use FontLib\Table\Type\name;
use zetsoft\dbitem\App\eyuf\CheckboxItem;
use zetsoft\dbitem\shop\SingleProductItem;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\actions\ZEasySelectableWidget;
use zetsoft\widgets\actions\ZSortSelectableWidget;
use zetsoft\widgets\actions\ZSortSelectableWidgetAz;
use zetsoft\widgets\incores\ZMCheckboxGroupWidget;
use zetsoft\widgets\incores\ZMCheckboxWidget;
use zetsoft\widgets\inptest\ZSelectable2Widget;
use zetsoft\widgets\inputes\ZHRadioButtonGroupWidget;
use zetsoft\widgets\inputes\ZRadioGroupWidget;
use zetsoft\widgets\inputes\ZRadioListWidget;
use zetsoft\widgets\market\ZInputSpinnerWidget;

//vdd($item->company_name)
$checkboxItems = [];
$checkboxItem = new CheckboxItem();
$checkboxItem->icon = '<img width="60" height="auto" src="https://www.google.com/url?sa=i&url=https%3A%2F%2Fru.depositphotos.com%2Fstock-photos%2F%25D0%25B4%25D0%25BE%25D0%25BB%25D0%25BB%25D0%25B0%25D1%2580-%25D1%2581%25D1%2588%25D0%25B0.html&psig=AOvVaw1SP0CS35vAEqafkNbJ4wbH&ust=1592561308803000&source=images&cd=vfe&ved=0CAIQjRxqFwoTCKC97qqPi-oCFQAAAAAdAAAAABAJ" alt="sum">';
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
vdd($items)
?>

<div class="d-block">
    <div class="w-100 mb-5" style="height: 400px; overflow-y: scroll;">

        <table class="row-border" style="width:100%;">
            <tbody>
            <? $sum = 0; ?>
            <? foreach ($items as $product) :
                //$sum += $product->new_price;
                //$total = $sum * $product->amount;
                //$comname = $product->company_name;
                ?>
                <tr>
                    <td>
                        <div class="">
                            <table>
                                <tr>
                                    <th class="fp-16">
                                        <?= $product->company_name; ?>
                                    </th>
                                    <th></th>
                                    <th></th>
                                </tr>


                                <tr class="border-bottom mb-1 mt-1">
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


                                <tr class="border-bottom-0">
                                    <td></td>
                                    <td class="font-weight-bold">Сумма доставки</td>

                                    <td class="font-weight-bold" colspan="3">
                                        120
                                    </td>

                                </tr>

                                <tr class="border-bottom">
                                    <td></td>
                                    <td class="font-weight-bold">Обшая сумма</td>
                                    <td class="font-weight-bold">
                                        

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

    <div class="pl-3 pr-3 border-bottom w-100">

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

                <!--<span class="text-bold fp-20 float-right"><?/*= $total . ' ' . $product->currency */?></span>-->
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









