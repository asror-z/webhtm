<?php


use yii\web\JsExpression;
use zetsoft\system\actives\ZModel;
use zetsoft\system\actives\ZAjaxForm;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\former\ZFormWidget;


/** @var ZView $this */
/** @var ZModel $model */
Az::$app->forms->modelz->form($model);

?>
<div class="container-fluid">
    <div class="row">
        <div class="col-6">

            <script>
                $(document).ready(function () {
                    $('input[type=text]').change(function () {
                        $('#option-submitButton').click();
                    });
                });
            </script>

            <?php
            Az::$app->forms->active->enableLabel = true;
            Az::$app->forms->active->labelSpan = 4;

            /** @var string $class */
            $form = ZAjaxForm::begin([
            'id' => 'optionActive',
                'action' => [
                    '/core/grapes/widget',
                ],
                'ajaxSubmitOptions' => [

                    'success' => new JsExpression('function(response) {
                        console.log(response)
                        $("#widget").html(response); 
        }'),
                ]
            ]);
            ?>

            <?= ZFormWidget::widget([
                'id' => 'option',
                'model' => $model,
                'form' => $form,
                'config' => [
                    'btnName' => 'Виджет',
                    'isCnt' => false,
                    'type' => ZFormWidget::type['all'],
                    'submitBtn' => true,
                ]
            ]);

            ZAjaxForm::end();

            ?>
        </div>

    </div>

</div>
