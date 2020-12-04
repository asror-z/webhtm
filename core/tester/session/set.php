<?php

session_start();

$_SESSION['cache1'] = 'mycache';


echo $_SESSION['cache1'];











/*$session = Yii::$app->session;
$session->open();
$session->set('language', 'en-TR1');
$session->set('asd', 'en-TS2');
$session->set('dasdqw', 'en-TT3');
$session->set('asdsadasda', 'en-TU4');
$session->set('vbvnbv', 'en-TV5');
$session->set('zzzzfdbc', 'en-TW6');
$session->set('qweqeeee', 'en-TX7');
$session->set('poijmy', 'en-TY8');
$session->set('thdbbf', 'en-TZ9');

vd($session->isActive);
vd($session->id);
vd($session);*/
