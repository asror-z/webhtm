<?php

use zetsoft\former\core\CoreServiceForm;
use Nette\Utils\Json;
use zetsoft\dbitem\core\WebItem;
use zetsoft\system\actives\ZActiveRecord;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\system\module\Models;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\former\ZDynaWidgetRav;
use zetsoft\widgets\former\ZEditWidget;
use zetsoft\widgets\former\ZKEditableWidgetNorm;
use zetsoft\widgets\inputes\ZKSelect2Widget;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;
use zetsoft\models\place\PlaceCountry;


/** @var ZView $this */


/**
 *
 * Action Params
 */

$action = new WebItem();

$action->title = Azl . 'Страны';
$action->icon = 'fal fa-landmark';
$action->type = WebItem::type['html'];
$action->csrf = true;
$action->loader = false;
$action->debug = false;


$this->paramSet(paramAction, $action);

$this->title();
$this->toolbar();


/**
 *
 * Start Page
 */

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


<body class="<?= ZWidget::skin['white-skin'] ?>  p-4">

<?php

$this->beginBody();

?>
<div>

    <?php

    $configs = json_decode($this->httpPost('configs'), true);
    $columns = json_decode($this->httpPost('columns'), true);
    $cards = json_decode($this->httpPost('cards'), true);

    $modelName = $this->httpPost('modelName');
    $modelId = $this->httpPost('key');
    $modelClass = $this->bootFull($modelName);
    $attribute = $this->httpPost('attribute');
    $url = $this->httpPost('url');

    $service = Az::$app->smart->dyna;

    $configs = $service->getConfigDbItem($configs);
    $columns = $service->getColumnsDbItem($columns);

    $widgetClass = $this->httpPost('widgetClass');
    $widgetClass = str_replace('/', '\\', $widgetClass);

    $widgetOptions = [];
    $httpops = $this->httpPost('options');
    $opts = str_replace('\\', '\\\\', $httpops);
    if (!empty($this->httpPost('options')))
        $widgetOptions = \yii\helpers\Json::decode($opts, true);

    /** @var Models $modelClass */
    $model = $modelClass::findOne($modelId);
    $model->configs = $configs;
    $model->columns = $columns;
    $model->cards = $cards;

    $model->kernel();
    $column = $model->columns[$attribute];


    // vd($model->id);



    // vd($widgetOptions);

    echo ZEditWidget::widget([
        'model' => $model,
        'attribute' => $attribute,
        'id' => $this->httpPost('id'),
        'config' => [
            'index' => $this->httpPost('index'),
            'modelId' => $modelId,
          //  'widgetClass' => $widgetClass,
            'widgetClass' => $column->widget,
            'formId' => 'edit-form',
            'options' => $column->options,
        ],
    ]);


    ?>

</div>
<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>
