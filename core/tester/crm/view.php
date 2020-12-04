<?php

/**
 *
 *
 * Author:  Asror Zakirov
 * https://www.linkedin.com/in/asror-zakirov
 * https://github.com/asror-z
 *
 */
use zetsoft\models\drag\DragConfig;
use zetsoft\models\user\ChatGroup;
use zetsoft\models\App\eyuf\Card;
use zetsoft\widgets\former\ZViewWidget;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\former\ZFormWizardWidget;

/** @var ZView $this */


$action->title = Azl . 'Просмотр  Системные формы';
$action->icon = 'fa fa-rocket rss';
$action->debug = true;
$this->csrf = true;
$action->type = WebItem::type['html'];

$id = $this->httpGet('id');
$model = Card::findOne($id);

echo ZViewWidget::widget([
    'model' => $model,
    
]);
