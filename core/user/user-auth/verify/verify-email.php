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

/** @var ZView $this */
$code = $this->httpGet('code');
$id = $this->httpGet('id');
$user = \zetsoft\models\user\User::findOne($this->sessionGet('registerUserEmail'));
if (!$user)
    $user = \zetsoft\models\user\User::findOne($id);
if ($code && $user) {
    if ($user->verified_email) {
        return $this->urlRedirect('/');
    }
    if ($user->verify_code === $code) {
        $user->verified_email = true;
        $user->verify_code = 0;
        Az::$app->cores->session->set('login', true, Auth::duration, $user->id);
        $user->save();
        $this->sessionDel('registerUserEmail');
        if ($user->role === 'seller') {
            return $this->urlRedirect("/shop/seller/settings/index.aspx?id={$user->user_company_id}");
        }
        return $this->urlRedirect('/');
    } else {
        print_r('Invalid key.');
        die();
    }
}
print_r('Not given full credentials');
die();
