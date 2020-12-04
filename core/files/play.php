<?php


/**
 *
 * Function  run
 * @param Models $model
 * @param $attribute
 * @return  bool
 * @throws \yii\base\Exception
 */

use Facebook\WebDriver\Exception\UnsupportedOperationException;
use League\Flysystem\FileNotFoundException;
use zetsoft\service\inputs\Fileinput;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\helpers\ZFileHelper;

$path = $this->httpGet('file');
$inline = $this->httpGet('inline', true);

$app = App;
//$path = Az::getAlias("@root/upload/excelz/bosya/{$path}");
       
if (!file_exists($path))
    throw new FileNotFoundException($path);

if (ZArrayHelper::isIn(ZFileHelper::extension($path), FileInput::blocked))
    throw new UnsupportedOperationException('Blocked File');

/*
 *   return $this->alertDanger( $path, Az::l('Файл отсутсвует на сервере'));
 *   return $this->alertDanger( $path, Az::l('Файл заблокирован'));
 **/

$fileName = bname($path);

$response = Az::$app->response;
$response->sendFile($path, $fileName)->send();

return true;
