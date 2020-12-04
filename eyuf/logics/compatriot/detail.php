<?php

/**
 *
 *
 * Author:  Asror Zakirov
 * https://www.linkedin.com/in/asror-zakirov
 * https://www.facebook.com/asror.zakirov
 * https://github.com/asror-z
 *
 */

use zetsoft\dbitem\core\WebItem;
use zetsoft\models\App\eyuf\EyufCompatriot;
use zetsoft\service\forms\Active;
use zetsoft\system\Az;
use zetsoft\widgets\former\ZFormBuildWidget;
use zetsoft\widgets\former\ZFormWidget;
use zetsoft\widgets\themes\ZCardWidget;
use zetsoft\system\kernels\ZView;

/** @var ZView $this */
$action = new WebItem();
$action->title = Azl . 'Детали Соотечественники';
$action->icon = 'fa fa-graduation-cap';
$action->layout = true; $action->debug = false;
$this->paramSet(paramAction, $action);

$this->title();
$this->toolbar();

$id = $this->httpGet('id');

if (empty($id))
    return $this->alertDanger( Az::l('ID запроса отсутсвует'), Az::l('ID is Required'));


$model = EyufCompatriot::findOne($id);

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

