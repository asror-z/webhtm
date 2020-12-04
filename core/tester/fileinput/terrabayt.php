<?php

use kartik\builder\Form;
use vkabachenko\filepond\widget\FilepondWidget;
use yii\helpers\Html;
use zetsoft\models\test\TestFile2;
use zetsoft\system\helpers\ZHTML;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\former\ZFormWidget;
use zetsoft\widgets\inputes\ZFileInputWidget;

//$model = $this->modelGet(\zetsoft\models\core\CoreInput::class, 5);
//$model = $this->modelGet(TestFile2::class, 3);
$model = new TestFile2();
/** @var ZView $this */

$items = \zetsoft\system\Az::$app->forms->modelz->data();
$form = $this->activeBegin();
$this->modelSave($model);

echo ZFormWidget::widget([
    'model' => $model,
    'form' => $form,
    'rows' => [
        [
            'attributes' => [
                'single' => [ 
                    'type' => Form::INPUT_WIDGET,
                    'widgetClass' => ZFileInputWidget::class,
                    'options'=>[
                        'config' => [
                            'placeholder'=>'json_2  2',
                            'hasIcon' => true,
                            'icon'=>'fas fa-user'
                        ]
                    ],
                ],
            ]
        ],
    ],
]);

$this->activeEnd();

