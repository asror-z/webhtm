<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\models\App\eyuf\EyufRequest;
use zetsoft\service\forms\Active;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\former\ZFormBuildWidget;

/** @var ZView $this */
$action = new WebItem();

$action->title = Azl . 'Создание Потребности';
$action->icon = 'fa fa-dashboard';
$action->debug = false;

$action->layout = true;
$action->debug = false;
$action->layoutFile = 'mainFrame';

$this->paramSet(paramAction, $action);

$this->title();
$this->toolbar();

$model = new EyufRequest();

$model->configs->nameAuto = false;
$model->configs->nameValidatorUnique = false;

$model->configs->nameOff = [
    'value',
];

$model->columns();

if ($this->modelSave($model)) {
    $this->paramSet(paramIframe, true);
    $this->urlRedirect(['index']);
}
?>

<div class="row">
    <div class="col-md-12 col-12">

        <?

        $active = new Active();

        $form = $this->activeBegin($active);

        echo ZFormBuildWidget::widget([
            'model' => $model,
            'form' => $form,
            'config' => [
                'stepType' => ZFormBuildWidget::stepType['none'],
                'blockType' => ZFormBuildWidget::blockType['card'],
            ]
        ]);

        $this->activeEnd();

        ?>

    </div>
</div>
