<?php

use zetsoft\models\user\User;
use zetsoft\system\kernels\ZView;

/** @var ZView $this */

$user_id = $this->httpGet('user_id');
$code = $this->httpGet('code');



$user = User::findOne([
    'id' => $user_id,
    'verify_code' => $code
]);

if ($user === null)
    return null;

$user->configs->rules = [
    [validatorSafe]
];
if ($user !== null) {
    $user->verified_email = true;
    if ($user->save()) {
        Az::$app->cores->auth->login($user);
        return $this->urlRedirect('/logics/scholar/add-info.aspx');
    }

}

