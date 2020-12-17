<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\system\module\Models;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZFormBuildWidget;
use zetsoft\widgets\former\ZFormWidget;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;
use zetsoft\widgets\themes\ZCardWidget;
use zetsoft\models\shop\ShopBrand;



/** @var ZView $this */


/**
 *
 * Action Params
 */

$action = new WebItem();

$action->title = Azl . 'Создание Бренды';
$action->icon = 'fa fa-globe';
$action->type = WebItem::type['html'];
$action->csrf = false;
$action->debug = false;



$this->paramSet(paramAction, $action);



/**
 *
 * Start Page
 */

$this->beginPage();
?>




<body class="<?= ZWidget::skin['white-skin'] ?>">

<?php

$this->beginBody();
ZArrayHelper::setValue(Az::$app->params, 'is_clone', true);

$id = $this->httpGet('id');
$modelClassName = $this->httpGet('modelClassName');

/** @var Models $modelClass */
$modelClass = $this->bootFull($modelClassName);
//vdd($modelClass);

$model = $this->modelClone($modelClass, $id);



    $modelId = $model->id;
    $modelItems = \zetsoft\models\cpas\CpasStreamItem::find()->where(['cpas_stream_id' => $id])->all();
    foreach ($modelItems as $item)
    {
        $itemClass = $this->bootFull($item->className);

        $cloneItem = $this->modelClone($itemClass, $item->id);
        $cloneItem->cpas_stream_id = $modelId;
        $cloneItem->save();

    }
    $this->notifySuccess('Данные успешно склонированы!', $this->modelInfo($model));
    return $this->urlRedirect(['/cpas/client/flows'], false);



?>




<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>
