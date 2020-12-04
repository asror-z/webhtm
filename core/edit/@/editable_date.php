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

    $modelName = $this->httpGet('modelClassName');
    $modelId = $this->httpGet('key');
    $modelClass = $this->bootFull($modelName);
    $attribute = $this->httpGet('attribute');
    $url = $this->httpGet('url');

    /** @var Models $modelClass */
    $model = $modelClass::findOne($modelId);
              
    $model->columns();


    echo ZEditWidget::widget([
        'model' => $model,
        'attribute' => $attribute,
        'id' => $this->httpGet('id'),
        'config' => [
            'index' => $this->httpGet('index'),
            'modelId' => $modelId,
            'formId' => 'edit-form',
        ],
    ]);

    ?>

</div>
<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>
