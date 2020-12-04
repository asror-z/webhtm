<?php

use yii\helpers\FileHelper;
use yii\web\UploadedFile;
use zetsoft\system\kernels\ZAction;

$basePath = Root . '/upload/uploaz/';
$post = \Yii::$app->request->post();
reset($post);
$fileName = key($post);
$attribute = \Yii::$app->request->post($fileName);

if (is_array($attribute)) {
    reset($attribute);
    $key = key($attribute);
    $fileName .= '[' . $key . ']' . (is_array($attribute[$key]) ? '[0]' : '');
}

$file = UploadedFile::getInstanceByName($fileName);

$filePath = \Yii::$app->security->generateRandomString();
FileHelper::createDirectory($basePath . $filePath);

$file->saveAs($this->basePath . $filePath . '/' . $file->name);

return $filePath;
