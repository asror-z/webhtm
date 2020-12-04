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
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\former\ZViewWidget;

/** @var ZView $this */

$action = new WebItem();

$action->title = Azl . 'Monitor view';
$action->icon = 'fa fa-cropLength';


$action->layout = true; $action->debug = false;
$action->layoutFile = 'mainFrame';

$this->paramSet(paramAction, $action);

$this->title();
$this->toolbar();
$id = $this->httpGet('id');
$model = CoreSetting::findOne($id);

echo ZViewWidget::widget([
    'model' => $model,
]);
