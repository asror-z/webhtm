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

use zetsoft\dbitem\grap\GrapeBtnItem;
use zetsoft\dbitem\grap\GrapeDelimiterItem;
use zetsoft\models\menu\Menu;
use zetsoft\system\Az;
use zetsoft\widgets\former\ZViewWidget;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\former\ZFormWizardWidget;

/** @var ZView $this */
$action = new WebItem();

$action->title = Azl . 'Просмотр  Меню';
$action->icon = 'fa fa-credit-card';

$id = $this->httpGet('id');
$model = Menu::findOne($id);

echo ZViewWidget::widget([
    'model' => $model,

]);

$btns=[];

$button=new GrapeBtnItem();

$button->id='obdev1';
$button->icon='fa fa-compress';
$button->title='obdev-11';
$button->command='fa fa-compress';

