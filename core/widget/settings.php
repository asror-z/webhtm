<?php

use zetsoft\models\drag\DragFormDb;
use zetsoft\system\actives\ZAjaxForm;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\former\ZFormWidget;
use zetsoft\widgets\navigat\ZButtonWidget;
use zetsoft\widgets\navigat\ZGAccordionWidget;
use zetsoft\widgets\themes\ZCardWidget;

/** @var ZView $this */
$action = new WebItem();

$action->title = Azl . 'Настройка Опций Виджета ';
$action->icon = 'fa fa-rocket rss';
$action->type = WebItem::type['html'];

$modelId = $this->httpGet('modelId');

$formDb = DragFormDb::findOne($modelId);

if (!$formDb)
    $this->alertDanger( 'Остутствует параметр modelId', 'Ошибка');
$widget = $formDb->widget;

if (!$widget) {echo('Виджет не Выбран!'); die;}

$service = Az::$app->smart->widget;

# МОДЕЛЬ НАСТРОЕК КОНКРЕТНОГО ВИДЖЕТА
$widgetForm = $service->allOptions($widget);

$configs = (new $widget())->_config;

if ($formDb->options)
    $configs = $service->formDbFix($formDb->options, $widget);

?>

<div class="container-fluid">

    <div class="row">
        <div class="col-sm-6">
            <?

            ZCardWidget::begin([
                'config' => [
                    'title' => $this->title . bname($widget) . Az::l(' колонки ') . $formDb->name,
                    'type' => ZCardWidget::type['dynCard'],
                ]
            ]);

            $form = ZAjaxForm::begin([
                'id' => 'activeForm'
            ]);

            $basename = bname($widget);

            #КНОПКА SUBMIT ДЛЯ ФОРМЫ

            echo ZButtonWidget::widget([
                'id' => 'sendOptions',
                'config' => [
                    'hidden' => true
                ]
            ]);

            foreach ($widgetForm as $key => $value) {
                $value->attributes = ZArrayHelper::merge($value->attributes, $configs);

                echo ZGAccordionWidget::widget([
                    'config' => [
                        'content' => ZFormWidget::widget([
                            'model' => $value,
                            'form' => $form,
                            'config' => [
                                'topBtn' => false,
                                'botBtn' => false,
                            ]
                        ]),
                        'title' => $key,
                    ]
                ]);
            }


            ZAjaxForm::end();

            ZCardWidget::end();
            ?>
        </div>

        <div class="col-sm-6">
            <?
            ZCardWidget::begin([
                'config' => [
                    'title' => Az::l('Виджет ') . bname($widget),
                    'type' => ZCardWidget::type['dynCard'],
                ]
            ]);

            $configs = $service->settings($widget, $configs);

            ?>

            <div  id="widget">
                <?
                echo $widget::widget($configs);

                ?>
            </div>

            <?

            ZCardWidget::end();
            ?>
        </div>
    </div>

</div>




<style>

    #sendOptions {
        visibility: hidden;
    }
    .zgrapescheckbox{
        display: inline-flex;
        float: right;
    }

</style>

<script>

    $('#sendOptions').on('click', function () {
        $.ajax({
            type: 'GET',
            url: '/core/widget/widget.aspx?modelId=<?=$modelId?>&' + $('#activeForm').serialize(),
            success: function(response) {
                $('#widget').html(response);
            }
        });
    });

    $(document).on('change', 'input[type="text"]', function () {
        $('#sendOptions').click();
    });


</script>
