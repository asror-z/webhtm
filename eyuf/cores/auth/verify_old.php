<?php


use zetsoft\service\cores\Auth;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZView;

/** @var ZView $this */

$id = $this->httpGet('id');
$code = $this->httpGet('code');
$user = \zetsoft\models\user\User::findOne($this->sessionGet('registerUserEmail'));
if (empty($user))
    $user = User::findOne([
        'id' => $id,
    ]);

/*if ($user === null)
    return null;

$user->configs->rulesAll = [
    [validatorSafe]
];
if ($user !== null) {
    $user->verified = true;
    if ($user->save()) {



        $this->cores->auth->login($user);
        return $this->urlRedirect('/eyuf/logics/scholar/add-info.aspx');
    }

}*/

if ($code && $user) {
    if ($user->verified_email) {
        return $this->urlRedirect('/');
    }
    if ($user->verify_code === $code) {
        $user->verified_email = true;
        $user->verify_code = 0;
        Az::$app->cores->session->set('login', true, Auth::duration, $user->id);
        $user->save();

        return $this->urlRedirect('/core/user/verify/verify.aspx');
    } else {
        print_r('Invalid key.');
        die();
    }
}
print_r('Not given full credentials');
die();

