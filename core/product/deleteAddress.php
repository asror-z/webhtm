<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\models\user\User;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZView;
use zetsoft\system\module\Models;

/** @var ZView $this */
$action = new WebItem();

$action->title = Azl . 'Создание Веб-действия';
$action->icon = 'fa fa-globe';
$action->type = WebItem::type['ajax'];
$action->csrf = true;
$action->debug = true;



$this->paramSet(paramAction, $action);

$this->title();
$this->toolbar();

$id = $this->httpGet('id');
$modelClassName = $this->httpGet('modelClassName');
$modelClass = $this->bootFull($modelClassName);
/** @var Models $model */
$model = $modelClass::findOne($id);
$userId = 1;

//$userId = $this->userIdentity()->id;
// todo remove files from system if model has file column | by AD
if ($model->delete()) {
    $user = User::find()->where([
        'id' => $userId
    ])->one();
    if ($user) {
        $result = $user->core_adress_ids;
        foreach ($result as $key => $value) {
            if ($id == $value) {
                unset($result[$key]);
            }
        }

        $user->core_adress_ids = $result;
        $user->save();
    }
    $this->notifySuccess('Данные успешно удалены!', $this->modelInfo($model));
} else
    $this->notifyError('Ошибка прим удалении', $model->errors);

return  $this->urlRedirect('/client/checkout/check-out.aspx');
