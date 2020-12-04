<?php


use zetsoft\system\kernels\ZView;

/** @var ZView $this */

$user_id = $this->userIdentity()->id;
$code = $this->httpGet('code');

$user = User::findOne([
    'id' => $user_id,
    'verify_code' => $code
]);

if ($user === null)
    return null;

$user->configs->rulesAll = [
    [validatorSafe]
];
if ($user !== null) {
    $user->verified = true;
    if ($user->save()) {
        $this->cores->auth->login($user);
        return $this->urlRedirect('/logics/scholar/add-info.aspx');
    }

}

