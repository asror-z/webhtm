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
use zetsoft\models\place\PlaceCountry;
use zetsoft\models\drag\DragFormDb;
use zetsoft\models\core\CoreInput;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\helpers\ZUrl;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\former\ZAjaxWidget;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\former\ZFormWidget;
use zetsoft\widgets\navigat\ZAccLayWidget;
use zetsoft\widgets\navigat\ZButtonWidget;
use zetsoft\widgets\themes\ZCardWidget;

/** @var ZView $this */
$action = new WebItem();

$action->title = Azl . 'Настройка Опций Виджетов';
$action->icon = 'fa fa-rocket rss';
$action->type = WebItem::type['html'];

$modelId = $this->httpGet('modelId');
$savedOpts = $this->httpPost('savedOpts');
$formDb = DragFormDb::findOne($modelId);
$class = $formDb->widget;

if ($class === null || empty($class)) {
    echo('Виджет не Выбран!');
    die;
}


$addData = Az::$app->smart->widget->addData();
$addModel = Az::$app->smart->widget->addModel();
$widgetForm = Az::$app->smart->widget->widgetOptions($formDb);
$mainForm = Az::$app->smart->widget->options($formDb);

$options = $formDb->options;
if (empty($formDb->options))
    $options = (new $class)->_config;

$mainForm->attributes = ZArrayHelper::merge($mainForm->attributes, $options);
$widgetForm->attributes = ZArrayHelper::merge($widgetForm->attributes, $options);
$addData->attributes = ZArrayHelper::merge($addData->attributes, $options);
$addModel->attributes = ZArrayHelper::merge($addModel->attributes, $options);

?>

<div class="row">

    <div class="col-md-4">

        <?

        ZCardWidget::begin([
            'config' => [
                'title' => Az::l('Настройка Опций ') . '  -  ' . bname($class) . Az::l(' для колонки ') . ' - ' . $formDb->name,
                'type' => ZCardWidget::type['dynCard'],
            ]
        ]);

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
                'config' => [
                    'confirmTitle' => 'Подтверждение о сбросе',
                    'hasConfirm' => true,
                    'confirm' => Az::l('Вы действительно хотите сюросить настройки Виджета ') . '  -  ' . bname($class) . Az::l(' для колонки ') . ' - ' . $formDb->name,
                    'btnType' => ZButtonWidget::btnType['submit'],
                    'text' => Az::l('Сбросить настройки'),
                    'pjax' => 0,
                    'url' => ZUrl::to([
                        '/core/widget/reset',
                        'modelId' => $modelId
                    ]),
                    'btnStyle' => ZButtonWidget::btnStyle['btn-outline-primary'],
                    'btnRounded' => false,
                ]
            ]);


            echo ZButtonWidget::widget([
                'id' => 'sendOptions',
                'config' => [
                    'btnType' => ZButtonWidget::btnType['submit'],
                    'text' => Az::l('Применить'),
                    'pjax' => 0,
                    'btnStyle' => ZButtonWidget::btnStyle['btn-outline-primary'],
                    'btnRounded' => false,
                ],
                'event' => [
                    'click' => <<<JS
        function (event) {
            sendOptions("/core/widget/widget.aspx?modelId={$modelId}&" +   $('#activeForm').serialize());
               e.preventDefault();
        } 
JS,
                ]
            ]);
            ?>

        </div>

        <?

        $form = ActiveForm::begin([
            'id' => 'activeForm'
        ]);

        echo ZAccLayWidget::widget([
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
        ]);

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
        ]);


        echo ZAccLayWidget::widget([
            'config' => [
                'name' => Az::l('Add Model'),
                'content' => <<<HTML
        <div id="attribute">
HTML .
                    ZFormWidget::widget([
                        'model' => $addModel,
                        'form' => $form,
                        'config' => [
                            'topBtn' => false,
                            'botBtn' => false,
                        ]
                    ])
                    . <<<HTML
        </div>
HTML

            ]
        ]);

        ActiveForm::end();
        ZCardWidget::end();

        ?>

    </div>

    <div id="widget" class="col-md-8">

        <?
        ZCardWidget::begin([
            'config' => [
                'title' => Az::l('Виджет   ') . '  -   ' . bname($class),
                'type' => ZCardWidget::type['dynCard'],
            ]
        ]);





        ZCardWidget::end();

        ?>

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


