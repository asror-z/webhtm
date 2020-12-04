<?php


use zetsoft\models\App\eyuf\EyufScholar;
use zetsoft\service\cores\Auth;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZView;

/** @var ZView $this */

$id = $this->httpGet('id');
$code = $this->httpGet('code');
/*$user = \zetsoft\models\user\User::findOne($this->sessionGet('registerUserEmail'));
if (empty($user))*/
    $user = \zetsoft\models\user\User::findOne($id);

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
    //vdd($user->verified_email);
    if ($user->verified_email) {
        Az::$app->cores->auth->setLogin($user->id, Auth::duration);
        return $this->urlRedirect('/');
    }
    if ($user->verify_code === $code) {
        $user->verified_email = true;
        $user->verify_code = 0;
        $scholar = EyufScholar::find()->where(['email' => $user->email])->one();
        $scholar->user_id = $user->id;
        $scholar->email = $user->email;
        $scholar->status = 'register';
        $scholar->save();
        
        Az::$app->cores->auth->setLogin($user->id, Auth::duration);
        $user->configs->rules = validatorSafe;
        $user->columns();
        $user->save();

        $title = 'Информация';
        $data = 'Пользователь верифицирован' . $user->name;

        $this->notifyInfo($title, $data, RoleData::admin);

        return $this->urlRedirect('/core/user/verify/verify.aspx');
    } else {
        print_r('Invalid key.');
        die();
    }
}
print_r('Not given full credentials');
die();

