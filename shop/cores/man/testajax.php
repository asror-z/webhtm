<?php

use zetsoft\models\App\eyuf\Manual;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\former\ZFormWizardWidget;
use zetsoft\widgets\themes\ZColWidget;
use zetsoft\widgets\themes\ZRowWidget;


/** @var ZView $this */
$action = new WebItem();

$action->title = Azl . 'Создание Справочник';

$action->icon = 'fa fa-chrome';

$action->icon =false;
$action->type = WebItem::type['html'];

$id = $this->httpGet('id');

/*
print_r([
    'sadfsadf' => 'asdfas',
    'sadfsadf' => 'asdfas',
    'sadfsadf' => 'asdfas',
]);*/

