<?php

use zetsoft\models\core\CoreSetting;
use zetsoft\models\App\eyuf\EyufRequest;
use zetsoft\service\forms\Active;
use zetsoft\system\Az;
use zetsoft\widgets\former\ZFormWidget;
use zetsoft\widgets\themes\ZCardWidget;
use zetsoft\models\App\eyuf\EyufCompatriot;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\former\ZFormBuildWidget;
use zetsoft\widgets\themes\ZColWidget;
use zetsoft\widgets\themes\ZRowWidget;
use zetsoft\dbitem\core\WebItem;

/** @var ZView $this */


$action = new WebItem();

$action->title = Azl . 'Создание Соотечественники';
$action->icon = 'fa fa-calendar-plus-o';
$action->layout = true;
$action->debug = false;

$this->paramSet(paramAction, $action);

$this->title();
$this->toolbar();

$id = $this->httpGet('id');
/** @var CoreSetting $model */

$model = CoreSetting::findOne($id);
if ($model === null)
    return;

$model->configs->readonly = [
    'name'
];
$model->columns();
if ($this->modelSave($model)) {
    /**
     *
     * Post save Actions
     */

    $this->urlRedirect(['setting', true]);
}
?>

<div class="row">
    <div class="col-md-12 col-12">
        <?

        $active = new Active();
        $active->type = Active::type['horizontal'];
        $form = $this->activeBegin($active);

        echo ZFormWidget::widget([
            'model' => $model,
            'form' => $form,
            'stepType' => ZFormBuildWidget::stepType['none'],
            'blockType' => ZFormBuildWidget::blockType['card'],
        ]);

        $this->activeEnd();
        ?>
    </div>
</div>
