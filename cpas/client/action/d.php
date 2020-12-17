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


$post = $this->httpPost();
$id = $this->httpGet('id');
$modelClassName = $this->httpGet('modelClassName');
$modelClass = $this->bootFull($modelClassName);

/** @var Models $model */
$model = $modelClass::findOne($id);
if($model) {
    $modelId = $model->id;
    $modelItems = \zetsoft\models\cpas\CpasStreamItem::find()->where(['cpas_stream_id' => $modelId])->all();
    foreach ($modelItems as $item) {
        $item->delete();
    }
    $model->delete();
}

// todo remove files from system if model has file column | by AD
return $this->urlRedirect('/cpas/client/flows.aspx');
if ($model->delete()) {
    $this->notifySuccess('Данные успешно удалены!', $this->modelInfo($model));
} else
    $this->notifyError('Ошибка прим удалении', $model->errors);
return $this->urlRedirect(['/cpas/client/flows'], false);

?>
<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>
