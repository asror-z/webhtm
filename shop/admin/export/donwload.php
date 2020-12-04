<?php

/**
 *
 *
 * Author:  Bahodir
 * https://www.linkedin.com/in/asror-zakirov
 * https://github.com/asror-z
 *
 */

use zetsoft\system\Az;

/** @var ZView $this */
$type = $this->httpGet('type');
if ($type == 'priyomki')
    $jsonfile = Az::$app->jsonb->exportToJson->priyomkiJson();
elseif ($type == 'zakazi_operatorov')
    $jsonfile = Az::$app->jsonb->exportToJson->zakaziOperatorovJson();

Az::$app->response->sendFile($jsonfile);


