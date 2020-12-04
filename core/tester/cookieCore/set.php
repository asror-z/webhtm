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
use zetsoft\system\kernels\ZView;

/** @var ZView $this */

$data = [
    'name' => "test_data",
    'value' => "test val",
];

Az::$app->response->cookies->add(new \yii\web\Cookie($data));

echo 'success';
vd(Az::$app->request->cookies);
