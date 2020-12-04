<?php

/**
 * Author:  Asror Zakirov
 * https://www.linkedin.com/in/asror-zakirov
 * https://www.facebook.com/asror.zakirov
 * https://github.com/asror-z
 *
 */

use zetsoft\dbitem\core\WebItem;
use zetsoft\service\forms\Active;
use zetsoft\service\forms\Ajaxer;
use zetsoft\system\Az;
use zetsoft\widgets\former\ZFormBuildWidget;
use zetsoft\widgets\former\ZFormWidget;
use zetsoft\widgets\navigat\ZButtonWidget;
use zetsoft\widgets\navigat\ZOnlyForGrapes;


$action = new WebItem();
$action->title = Azl . 'Grapes';
$action->icon = 'fal fa-calendar-edit';
$action->type = WebItem::type['partFile'];
$action->csrf = true;
$action->cache = false;
$action->toolbar = false;
$action->debug = false;
$action->call = null;
$action->cacheHttp = false;

$this->paramSet(paramAction, $action);

$this->title();
$this->toolbar();
$this->fileCss('/render/asrorz/mdb/css/mdb.min.css');

$getConfigs = $this->httpGet('configs');
$widget = str_replace('/', '\\', $this->httpGet('param'));

if (!$widget) {
    echo('Виджет не Выбран!');
    die;
}

$service = Az::$app->smart->widget;

$configs = json_decode($getConfigs, true) ?? (new $widget())->_config;
$optionsForm = $service->allOptions($widget, $configs);

?>

<div class="container-fluid">
    <h6 class="title-option">Настройка опций виджетов</h6>
    <?

    $formOptions = new Ajaxer();
    $formOptions->id = 'activeFormGrapes';
    $formOptions->childClass = 'my-2';

    $form = $this->ajaxBegin($formOptions);

    $basename = bname($widget);

    echo ZButtonWidget::widget([
        'id' => 'sendOptions',
        'config' => [
            'hidden' => true,
        ]
    ]);
    foreach ($optionsForm as $key => $model) {

        $model->setAttributes($configs);

        echo ZOnlyForGrapes::widget([
            'config' => [
                'title' => $key,
                'content' => ZFormWidget::widget([
                    'model' => $model,
                    'form' => $form,
                    'config' => [
                        'topBtn' => false,
                        'botBtn' => false,
                    ],
                ]),
            ]
        ]);

    }

    $this->ajaxEnd();

    ?>

</div>

<style>

    #sendOptions {
        visibility: hidden;
    }

    .container-fluid {
        padding-left: 0 !important;
        padding-right: 0 !important;
    }

    .title-option {
        margin-left: 10px;

    }

</style>

<script>
    $('input[type="text"]').on('change', function () {
        $('#sendOptions').click();
    });
</script>
