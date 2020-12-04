<?php

use zetsoft\models\App\eyuf\EyufScholar;
use zetsoft\service\forms\Active;
use zetsoft\system\Az;
use zetsoft\widgets\former\ZFormWidget;
use zetsoft\widgets\themes\ZCardWidget;
use zetsoft\models\App\eyuf\Account;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\former\ZFormBuildWidget;
use zetsoft\widgets\themes\ZColWidget;
use zetsoft\widgets\themes\ZRowWidget;
use zetsoft\dbitem\core\WebItem;


/** @var ZView $this */

$action = new WebItem();

$action->title = Azl . 'Редактирование  Бугалтер';
$action->icon = 'fa fa-line-chart';


$action->layout = true; $action->debug = false;
$action->layoutFile = 'mainFrame';

$this->paramSet(paramAction, $action);

$this->title();
$this->toolbar();

$id = $this->httpGet('id');
$model = EyufScholar::findOne($id);


if ($this->modelSave($model)) {
    $this->paramSet(paramIframe, true);
    $this->urlRedirect(['index', true]);
}

?>


<div class="row">
    <div class="col-md-12 col-12">

        <?

        $active = new Active();
        $active->type = Active::type['horizontal'];
        $form = $this->activeBegin($active);

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
