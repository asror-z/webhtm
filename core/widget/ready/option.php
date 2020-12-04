<?php

/**
 *
 *
 * Author:  Asror Zakirov
 * https://www.linkedin.com/in/asror-zakirov
 * https://www.facebook.com/asror.zakirov
 * https://github.com/asror-z
 *
 */


use kartik\form\ActiveForm;
use zetsoft\models\drag\DragFormDb;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\helpers\ZUrl;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\former\ZAjaxWidget;
use zetsoft\widgets\former\ZFormWidget;
use zetsoft\widgets\navigat\ZButtonWidget;

/** @var ZView $this */
$action = new WebItem();

$action->title = Azl . 'Настройка Опций Виджетов';
$action->icon = 'fa fa-rocket rss';
$action->type = WebItem::type['ajax'];

$class = $this->httpGet('widget');

$class = str_replace('/', '\\', $class);

$formDb = new DragFormDb();

if ($class === null || empty($class)) {
    echo('Виджет не Выбран!');
    die;
}

$addData = Az::$app->smart->widget->addData();
$widgetForm = Az::$app->smart->widget->widgetOptions($formDb, $class);
$mainForm = Az::$app->smart->widget->options($formDb, $class);

$configs = (new $class)->_config;
     
if ($this->httpGet('configs') !== null && $this->httpGet('configs') !== 'undefined')
    $configs = json_decode($this->httpGet('configs'), true, 512, JSON_THROW_ON_ERROR);

$mainForm->attributes = ZArrayHelper::merge($mainForm->attributes, $configs);
$widgetForm->attributes = ZArrayHelper::merge($widgetForm->attributes, $configs);
$addData->attributes = ZArrayHelper::merge($addData->attributes, $configs);

?>

<style>
    #reset {
        padding: 10px 25px;
        border: solid 2px #FF0000;
        color: #FF0000;
    }

    .switchinput {

    }

    #sendOptions {
        padding: 10px 25px;
        border: 2px solid #4cd137;
        color: #4cd137;
    }
    .select2-selection__clear{
        outline: none!important;
    }

</style>

<div class="container-fluid text-center">
    <div class="row">

        <div class="col-md-12">

            <?

            echo ZAjaxWidget::widget([
                'config' => [
                    'func' => 'sendOptions',
                    'dataType' => 'html',
                ],
                'event' => [
                    'success' => <<<JS
            function(response) {
                $('#widget').html(response);
            } 
JS,

                ]
            ]);

            ?>

            <div class="d-flex justify-content-between">

                <?
                echo ZButtonWidget::widget([
                    'id' => 'reset',
                    'config' => [
                        'confirm' => Az::l('Вы действительно хотите сюросить настройки'),
                        'btnType' => ZButtonWidget::btnType['submit'],
                        'pjax' => 0,
                        'hasIcon' => true,
                        'icon' => 'fas fa-trash-alt',
                        'btnRounded' => true,
                    ]
                ]);


                echo ZButtonWidget::widget([
                    'id' => 'sendOptions',
                    'config' => [
                        'btnType' => ZButtonWidget::btnType['submit'],
                        'pjax' => 0,
                        'hasIcon' => true,
                        'icon' => 'fas fa-check',
                        'btnRounded' => true,
                    ]
                ]);
                ?>

            </div>

            <?

            $form = ActiveForm::begin([
                'id' => 'activeForm'
            ]);

            echo ZFormWidget::widget([
                'model' => $widgetForm,
                'form' => $form,
                'config' => [
                    'topBtn' => false,
                    'botBtn' => false,
                ]

            ]);


            /*echo ZAccLayWidget::widget([
                'config' => [
                    'name' => Az::l('Опции Виджета  ') . bname($class),
                    'content' => ZFormWidget::widget([
                        'model' => $widgetForm,
                        'form' => $form,
                        'config' => [
                            'topBtn' => false,
                            'botBtn' => false,
                        ]

                    ])
                ]
            ]);*/

            /*
                    echo ZAccLayWidget::widget([
                        'config' => [
                            'name' => Az::l('Общие опции'),
                            'content' => ZFormWidget::widget([
                                'model' => $mainForm,
                                'form' => $form,
                                'config' => [
                                    'topBtn' => false,
                                    'botBtn' => false,
                                ]
                            ])
                        ]
                    ]);


                    echo ZAccLayWidget::widget([
                        'config' => [
                            'name' => Az::l('Добавить Данные'),
                            'content' => ZFormWidget::widget([
                                'model' => $addData,
                                'form' => $form,
                                'config' => [
                                    'topBtn' => false,
                                    'botBtn' => false,
                                ]
                            ])
                        ]
                    ]);*/


            ActiveForm::end();

            ?>

        </div>

    </div>
</div>


<script>
    $(document).on('change', 'input[type="text"]', function () {
        $('#sendOptions').click();
    });

    $(document).on('click', '.js-input-remove', function () {
        $('#sendOptions').click();
    });
</script>

