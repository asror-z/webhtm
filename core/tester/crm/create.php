<?php

use zetsoft\models\user\ChatGroup;
use zetsoft\models\App\eyuf\Card;
use zetsoft\widgets\former\ZFormWidget;
use zetsoft\widgets\themes\ZCardWidget;
use zetsoft\models\drag\DragConfig;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\former\ZFormWizardWidget;
use zetsoft\widgets\themes\ZColWidget;
use zetsoft\widgets\themes\ZRowWidget;

/** @var ZView $this */


$action->title = Azl . 'Создание Системные формы';

$action->icon = 'fa fa-rocket rss';
$action->debug = true;
$this->csrf = true;
$action->type = WebItem::type['html'];


$id = $this->httpGet('id');
$model = new ChatGroup();

if ($this->modelSave($model))
{

    /**
     *
     * Post save Actions
     */

    $this->urlRedirect(['index', true]);
}
?>


<div class="row">
    <div class="col-md-12 col-12">

        <?

        $form = $this->activeBegin();

        ZCardWidget::begin([
            'config' => [
                'title' => $this->title,
                'type' => ZCardWidget::type['dynCard'],
            ]
        ]);

        echo ZFormWidget::widget([
            'model' => $model,
            'form' => $form,
        ]);

        ZCardWidget::end();

        $this->activeEnd();

        ?>

    </div>
</div>
