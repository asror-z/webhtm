<?php

/**
 * Author:  Nurmukhammadov Shakhrizod
 */

use zetsoft\models\core\CoreTransact;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZView;

/** @var ZView $this */
$modelName = $this->httpGet('modelName');
if ($modelName) {
    Az::$app->cores->tranz->flush($modelName, Az::$app->cores->session->getCookieSession());
}
return $this->urlRedirectReturn();
