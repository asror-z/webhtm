<?php

/** @var ZView $this */

use zetsoft\dbitem\core\WebItem;
use zetsoft\system\kernels\ZView;


/**
 *
 * Action Params
 */

$action = new WebItem();

$action->title = Azl . 'Веб-действия';
$action->icon = 'fa fa-pie-chart';
$action->type = WebItem::type['html'];
$action->csrf = true;
$action->debug = true;



$this->paramSet(paramAction, $action);

$this->title();
$this->toolbar();

$email;$comment;$captcha;
$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
$comment = filter_input(INPUT_POST, 'comment', FILTER_SANITIZE_STRING);
$captcha = filter_input(INPUT_POST, 'token', FILTER_SANITIZE_STRING);
if(!$captcha){
    echo '<h2>Please check the the captcha form.</h2>';
    exit;
}
$secretKey = "6LcDHLwZAAAAAPmVSpkTjKtmp8AxxMzCPnAM-uuU";
$ip = $_SERVER['REMOTE_ADDR'];

// post request to server
$url = 'https://www.google.com/recaptcha/api/siteverify';
$data = array('secret' => $secretKey, 'response' => $captcha);

$options = array(
    'http' => array(
        'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
        'method'  => 'POST',
        'content' => http_build_query($data)
    )
);
$context  = stream_context_create($options);
$response = file_get_contents($url, false, $context);
$responseKeys = json_decode($response,true);
header('Content-type: application/json');
if($responseKeys["success"]) {
    echo json_encode(array('success' => 'true'));
} else {
    echo json_encode(array('success' => 'false'));
}
