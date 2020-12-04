<?php

/**
 *
 *
 * Author:  Asror Zakirov
 * https://www.linkedin.com/in/asror-zakirov
 * https://github.com/asror-z
 *
 */

use zetsoft\system\Az;

/*$sessions = Az::$app->session;
$sessions->removeAll();*/

$session = Yii::$app->session;
$session->remove('language');
$session->close();

echo 'deleted';
