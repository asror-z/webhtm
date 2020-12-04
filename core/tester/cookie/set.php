<?php

/**
 *
 *
 * Author:  Asror Zakirov
 * https://www.linkedin.com/in/asror-zakirov
 * https://github.com/asror-z
 *
 */

use zetsoft\system\kernels\ZView;

/** @var ZView $this */

// get the cookie collection (yii\web\CookieCollection) from the "response" component
$options = [
    'domain' => "",
    'expire' => null,
    'path' => "/",
    'secure' => false,
    'httpOnly' => true,
    'sameSite' => null,
    /*'b' => [
        'domain' => "",
        'expire' => null,
        'path' => "/",
        'secure' => false,
        'httpOnly' => true,
        'sameSite' => null,
    ],
    'c' => [
        'domain' => "",
        'expire' => null,
        'path' => "/",
        'secure' => false,
        'httpOnly' => true,
        'sameSite' => null,
    ],*/
];

// add a new cookie to the response to be sent
$this->cookieSet('a_'.rand(1, 100), 'abs'.rand(1, 100), $options);
echo 'success';
$bw = $this->cookieGet();
echo 'request cookies:';
vd($bw);
