<?php

use yii\helpers\FileHelper;
use zetsoft\system\kernels\ZAction;

$basePath = Root . '/upload/uploaz/';

$filePath = \Yii::$app->request->getRawBody();
FileHelper::removeDirectory($basePath . $filePath);

return '';
