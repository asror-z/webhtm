<?php


use zetsoft\former\chat\ChatAnswerForm;
use zetsoft\former\deps\DepsDataForm;
use zetsoft\former\test\TestLaptopForm;
use zetsoft\former\card\CardModelForm;
use zetsoft\former\deps\DepsdropIdeal;
use zetsoft\former\eyuf\EyufNeedForm;
use zetsoft\former\eyuf\ProductTest;
use zetsoft\former\shop\shopSizeForm;
use zetsoft\former\ALL\test\Test23Form;
use zetsoft\models\drag\DragConfigDb;
use zetsoft\models\page\PageAction;
use zetsoft\models\core\CoreInput;
use zetsoft\service\forms\Active;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZHTML;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\former\ZFormWidget;
use kartik\builder\Form;
use zetsoft\widgets\former\ZMultiWidgetNorm;
use zetsoft\widgets\inputes\ZKSelect2Widget;
use zetsoft\widgets\inputes\ZKTouchSpinWidget;
use zetsoft\widgets\former\ZMultiWidget;


$modelId = $this->httpPost('modelId');
$obj = DragConfigDb::findOne($modelId);

if ($obj)
    $modelName = $this->bootfull($obj->class_name);
else
    $modelName =  PageAction::class;


    

/** @var ZView $this */

$form = $this->activeBegin();
$model = new CoreInput();
if ($this->modelSave($model))
$this->modelPost();



echo ZFormWidget::widget([
    'model' => $model,
    'form' => $form,
    'rows' => [
        [
            'attributes' => [       // 2 column layout
                'jsonb_6' => [
                    'type' => Form::INPUT_WIDGET,
                    'widgetClass' => ZMultiWidget::class,
                    'options' => [
                        'config' => [

                            'formClass' => CardModelForm::class,
                            'class' => 'modelsAttribute',
                        ]
                    ]
                ],

            ]
        ],
    ]
]);

$this->activeEnd();


$attributes = Az::$app->smart->widget->getModelAttributes();
$arr = $attributes[$modelName];

$arr = json_encode($arr);

?>

<script>

    var data = <?=$arr?>;
    var selects = document.querySelectorAll('.modelsAttribute');

    function setSelect2(select2) {

        console.log(selects)

        if (select2.val().length < 1 || !select2.val()) {

            var option = '';
            option += '<option value=""><\/option>'
            for (const value in data) {
                option += '<option value="' + value + '">' + data[value] + '<\/option>'
            }

            select2.html(option);

        }

    }

    $(document).on('select2:opening', '.modelsAttribute', function () {

        setSelect2($(this));

    });


</script>


<?php



