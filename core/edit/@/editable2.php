<?php

use zetsoft\dbitem\core\WebItem;
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


<body class="<?= ZWidget::skin['white-skin'] ?> pt-3 <!--p-4-->">

<?php

$this->beginBody();

?>
<div>

    <?php

    $get = $this->httpGet();

    $modelName = ZArrayHelper::getValue($get, 'modelName');
    $modelId = ZArrayHelper::getValue($get, 'modelId');
    $attribute = ZArrayHelper::getValue($get, 'attribute');
    $id = ZArrayHelper::getValue($get, 'id');
    $index = ZArrayHelper::getValue($get, 'index');
    $widgetClass = ZArrayHelper::getValue($get, 'widgetClass');
    $editableUrl = ZArrayHelper::getValue($get, 'editableUrl');
    $successChange = ZArrayHelper::getValue($get, 'successChange');

    $modelClass = $this->bootFull($modelName);


    /** @var Models $model */
    $model = $modelClass::findOne($modelId);
    $model->columns();

    $options = $this->httpGet('options');
    $options = json_decode($options, true, 512, JSON_THROW_ON_ERROR);

    $depends = $this->httpGet('depends');

    echo ZEditWidget::widget([
        'model' => $model,
        'attribute' => $attribute,
        'id' => $id,
        'config' => [
            'editableUrl' => $editableUrl,
            'successChange' => $successChange,
            'index' => $index,
            'modelId' => $modelId,
            'widgetClass' => $widgetClass,
            'formId' => 'edit-form',
            'options' => $options,
            'depends' => $depends
        ],
    ]);


    ?>

</div>
<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>
