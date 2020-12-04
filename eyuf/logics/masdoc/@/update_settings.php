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
use zetsoft\models\core\CoreSetting;
use zetsoft\service\forms\Active;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\former\ZFormWidget;

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
$model = CoreSetting::findOne($id);


$active = new Active();
$active->type = Active::type['horizontal'];
$form = $this->activeBegin($active);


if ($this->modelSave($model))
    $this->urlRedirect(['/eyuf/logics/monitor/settings']);


echo ZFormWidget::widget([
    'model' => $model,
    'form' => $form,
]);

$this->activeEnd();

?>
