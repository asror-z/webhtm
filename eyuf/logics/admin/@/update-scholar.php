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

use zetsoft\models\core\CoreSetting;
use zetsoft\service\forms\Active;
use zetsoft\widgets\former\ZFormWidget;


$id = $this->httpGet('id');
$model = \zetsoft\models\App\eyuf\EyufScholar::findOne($id);

$active = new Active();
$active->type = Active::type['horizontal'];
$form = $this->activeBegin($active);


if ($this->modelSave($model))
    $this->urlRedirect(['/logics/monitor/settings']);


echo ZFormWidget::widget([
    'model' => $model,
    'form' => $form,
]);

$this->activeEnd();

?>
