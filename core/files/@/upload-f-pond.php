<?php

/**
 *
 *
 * Author:  Asror Zakirov
 *
 * https://www.linkedin.com/in/asror-zakirov
 * https://www.facebook.com/asror.zakirov
 * https://github.com/asror-z
 *
 */

namespace zetsoft\webs\files;


use Ramsey\Uuid\Exception\UnsupportedOperationException;
use yii\helpers\FileHelper;
use yii\web\UploadedFile;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\kernels\ZAction;
use zetsoft\system\module\Models;

$modelClassName = $this->httpGet('modelClassName');
$attribute = $this->httpGet('attribute');

$files = UploadedFile::getInstancesByName("{$modelClassName}[{$attribute}]");

$userId = Az::$app->cores->auth->identity->id;

$pathTmp = Az::getAlias("@webroot/temps/{$modelClassName}/{$attribute}/{$userId}/");
if (!empty($files)) {

    $fileList = [];
    FileHelper::createDirectory($pathTmp, $mode = 775, $recursive = true);

    foreach ($files as $file) {

        if (ZArrayHelper::isIn($file->extension, self::blocked))
            throw new UnsupportedOperationException('File type is not allowed');

        $fileName = $file->basename . '.' . $file->extension;
        if ($file->saveAs($pathTmp . $fileName)) {
            $fileList[] = $fileName;
        } else {
            return false;
        }
    }
}// END IF

return true;
