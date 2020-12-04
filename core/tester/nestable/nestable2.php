<?php

/**
 *
 *
 * Author:  Asror Zakirov
 * https://www.linkedin.com/in/asror-zakirov
 * https://github.com/asror-z
 *
 */


/** @var ZView $this */

use zetsoft\models\place\PlaceCountry;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\market\ZMediaCardWidget;

$action->title = Azl . 'Веб-действия';

$action->icon = 'fa fa-cubes';
$action->debug = true;
$action->type = WebItem::type['ajax'];::type['part'];


$model = new PlaceCountry();
$attribute = 'name';


//$aa = $this->httpPost();
$data = json_decode(file_get_contents('php://input'));

$result = str_replace('\\', '', $data);

Az::$app->tests->nestable->setNestable($result);
//vd($result);


?>

