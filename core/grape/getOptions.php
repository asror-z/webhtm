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
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\former\ZFormBuildWidget;
use zetsoft\widgets\former\ZFormWidget;
use zetsoft\widgets\former\ZGrapesJsWasdasdasfcsdvdfvbidget;
use zetsoft\widgets\navigat\ZButtonWidget;
use zetsoft\widgets\navigat\ZOnlyForGrapes;


$action = new WebItem();
$action->title = Azl . 'Grapes';
$action->icon = 'fal fa-calendar-edit';
$action->type = WebItem::type['ajaxFile'];
$action->csrf = true;
$action->cache = false;
$action->toolbar = false;
$action->debug = false;
$action->loader = false;
$action->call = null;
$action->cacheHttp = false;

$this->paramSet(paramAction, $action);

$this->title();
$this->toolbar();



$this->beginPage();
?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>

    <?php

    require Root . '/webhtm/block/metas/main.php';
    require Root . '/webhtm/block/assets/main.php';

    $this->head();

    ?>

</head>


<body class="<?= ZWidget::skin['white-skin'] ?>">

<?php

$this->beginBody();


$getConfigs = $this->httpGet('configs');
$widget = str_replace('/', '\\', $this->httpGet('param'));

if (!$widget) {echo('Виджет не Выбран!');die;}


?>
<h6 class="title-option">Настройка опций виджетов</h6>
<?

echo ZButtonWidget::widget([
    'id' => 'sendOptions',
    'config' => [
        'btnType' => ZButtonWidget::btnType['button'],
        'hidden' => false,
    ]
]);

$service = Az::$app->App->eyuf->grape;
$configs = json_decode($getConfigs, true, 512, JSON_THROW_ON_ERROR);

if (is_array($configs))
    $configs = ZArrayHelper::merge((new $widget())->_config, $configs);


$ajaxer = new Ajaxer();
$ajaxer->id = 'activeFormGrapes';
$ajaxer->childClass = 'my-2';
$form = $this->ajaxBegin($ajaxer);

$optionsForm = Az::$app->smart->widget->allOptions($widget, $configs);

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


$this->endBody() ?>

<style>
    #sendOptions {
        visibility: hidden;
    }

</style>

<script>

</script>

</body>
</html>

<?php $this->endPage() ?>

