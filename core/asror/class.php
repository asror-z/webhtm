<?php


use yii\helpers\Url;
use yii\web\JsExpression;
use zetsoft\system\actives\ZModel;
use zetsoft\system\actives\ZAjaxForm;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\former\ZFormWidget;


/** @var ZView $this */
/** @var ZModel $model */


$exec = $this->httpGet('exec');
$type = $this->httpGet('type'); // module | control | action

Az::$app->cores->appPage->type = $type;
Az::$app->cores->appPage->run();

Az::$app->forms->modelz->form($model);

?>
<div class="container-fluid">
    <div class="row">
        <div class="col-6">


            <?php
            Az::$app->forms->active->enableLabel = true;
            Az::$app->forms->active->labelSpan = 4;

            /** @var string $class */
            /** @var int $modelId */
            /** @var string $control */
            $form = ZAjaxForm::begin([
                'id' => 'classActive',
                'action' => [
                    '/core/grapes/option',
                    'id' => $modelId,
                    'control' => $control
                ],
                'ajaxSubmitOptions' => [
                    'success' => new JsExpression('function(response) {
                        console.log(response)
                        $("#option").html(response); 
        }'),
                ]
            ]);
            ?>

            <?= ZFormWidget::widget([
                'id' => 'classOpts',
                'model' => $model,
                'form' => $form,
                'nameOn' => [
                    'class'
                ],
                'config' => [
                    'btnName' => 'Опции',
                    'isCnt' => false,
                    'type' => ZFormWidget::type['all'],
                    'submitBtn' => true,
                ]
            ]);

            ZAjaxForm::end();

            ?>


        </div>

        <div class="col-6">
            <div id="widget"></div>
        </div>
    </div>

</div>
