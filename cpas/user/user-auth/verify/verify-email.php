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
$id = $this->httpGet('id');
$code = $this->httpGet('code');
$user = \zetsoft\models\user\User::findOne($this->sessionGet('registerUserEmail'));
//vdd($user);
//vd($code);
//vd($id);
//vd($this->sessionGet('registerUserEmail'));
//vdd($user);
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
        
        return $this->urlRedirect('/');
    } else {
        print_r('Invalid key.');
        die();
    }
}
print_r('Not given full credentials');
die();
