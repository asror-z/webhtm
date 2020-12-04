<?php

/**
 *
 *
 * Author:  Shakhrizod Nurmukhammadov
 *
 */

use zetsoft\models\user\UserCompany;
use zetsoft\service\cores\Auth;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZView;
use zetsoft\models\user\User;

/** @var ZView $this */
$id = $this->userIdentity()->id;
$code = $this->httpGet('code');
$user = User::findOne($this->sessionGet('registerUserEmail'));



if (!$user)
    $user = User::findOne($id);
if ($code && $user) {
    if ($user->verified_email) {
        return $this->urlRedirect('/');
    }
    if ($user->verify_code === $code) {
        $user->verified_email = true;
        $user->verify_code = 0;
        Az::$app->cores->session->set('login', true, Auth::duration, $user->id);
        $user->save();
        
        return $this->urlRedirect(['/eyuf/logics/scholar/add-info']);
    } else {
        print_r('Invalid key.');
        die();
    }
}
print_r('Not given full credentials');
die();
