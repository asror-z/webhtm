<?php

use zetsoft\models\App\eyuf\EyufScholar;
use zetsoft\service\forms\Active;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\former\ZFormBuildWidget;
use zetsoft\widgets\former\ZFormWidget;
use zetsoft\widgets\themes\ZCardWidget;
use zetsoft\dbitem\core\WebItem;

/** @var ZView $this */

$action = new WebItem();

$action->title = Azl . 'Создание Потребности';
$action->icon = 'fa fa-dashboard';
$action->debug = false;

$action->layout = true; $action->debug = false;
$action->layoutFile = 'mainFrame';

$this->paramSet(paramAction, $action);

$this->title();
$this->toolbar();





/*
 *             /** @var CoreSetting $setting */
/*  $setting = CoreSetting::findOne([
      'name' => $configs->columns
  ]);*/

/*  if ($setting !== null)
      if (!empty($setting->value)) {*/

/*
$id = $this->httpGet('id');*/


/*$fill = EyufRequest::findOne($id);
if ($fill === null)
    return $this->alertDanger( $id, 'EyufRequest Not Exists');*/

$model = new EyufScholar();
$model->columns();

if ($this->modelSave($model)) {

    /**
     *
     * Post save Actions
     */

    //$this->paramSet(paramIframe, true);
    $this->paramSet(paramIframe, true);
    $this->urlRedirect(['index', true]);
 
}
?>

<div class="row">
    <div class="col-md-12 col-12">

        <?php

        $active = new Active();
        $active->type = Active::type['horizontal'];
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
