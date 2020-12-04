<?php

use zetsoft\system\Az;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\former\ZFormWidget;
use zetsoft\widgets\navigat\ZButtonWidget;



$form = $this->activeBegin();

?>


<div class="d-flex">
    <div>
        <?php

        $model_d->configs->hasLabel = false;

        /** @var ZView $this */

        echo ZFormWidget::widget([
            'model' => $model_d,
            'form' => $form,
            'config' => [
                'topBtn' => false,
                'botBtn' => false,
            ],
        ]);


        ?>
    </div>
    <div>
        <?php
   /*     echo ZButtonWidget::widget([
            'config' => [
                'text' => Az::l('Фильтровать'),
                'btnType' => ZButtonWidget::btnType['submit'],
                'btnRounded' => false,
                'btnStyle' => 'text-success',
                'btnSize' => 'btn-ml',
                //  'class' => 'p-1 pl-3 pr-3',

            ]
        ]);*/

        ?>

    </div>
    <div>
        <?php
   /*     echo ZButtonWidget::widget([
            'config' => [
                'text' => Az::l('Очистить фильтр'),
                'btnType' => ZButtonWidget::btnType['button'],
                'btnRounded' => false,
                'btnStyle' => 'text-info',
                'btnSize' => 'btn-ml',
                //    'class' => 'p-1 pl-3 pr-3',
            ],
            'event' => [
                'click' => <<<JS
                $.ajax({
                    type: 'POST',
                    url: '/core/product/rangeClear.aspx',

                    success: function (response) {
                        location.reload();
                    },
                });
                                            
JS
            ],
        ]);
*/

        ?>
    </div>
</div>

<?php
$this->activeEnd();
?>

<style>
    #zdynamicmodel-period {
        display: grid;
        padding-top: 4px;
        border-radius: 4px;
    }

    .form-group {
        margin-bottom: 0 !important;
    }
</style>

