<?php


use zetsoft\models\ALL\CoreAction;
use zetsoft\models\ALL\CoreCompany;
use zetsoft\models\ALL\CoreContacts;
use zetsoft\models\ALL\CoreGroup;
use zetsoft\models\ALL\CoreInput;
use zetsoft\models\ALL\CoreManual;
use zetsoft\models\ALL\CoreNews;
use zetsoft\models\user\User;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZStringHelper;
use zetsoft\system\helpers\ZUrl;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\former\ZDynaCheckWidget;
use zetsoft\widgets\former\ZCheckConfirmWidget2OLD;
use zetsoft\widgets\former\ZDynaWidget;

/** @var ZView $this */

$action->title = Azl . 'Контакты';

$action->icon = 'fa fa-cropLength';



$modelClassName = $this->httpGet('modelClassName');
$modelClass = $this->bootFull($modelClassName);
$keys = $this->httpPost('keys');
//vdd($keys);

$keysExp = explode('|', $keys);
$something = '_somethingNew';
$lastID = 0;

if ($keysExp)
    foreach ($keysExp as $id) {
        if ($id) {
            $oldModel = $modelClass::findOne($id);
            $oldModel->name .= $something;
            $oldModel->save();
        }
    }

return $this->urlRedirect($this->urlGetBack());










