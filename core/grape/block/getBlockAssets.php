<?php
/**
 *
 *
 * Author:  Asror Zakirov
 * https://www.linkedin.com/in/asror-zakirov
 * https://www.facebook.com/asror.zakirov
 * https://github.com/asror-z
 *
 */


use rmrevin\yii\fontawesome\FA;
use zetsoft\dbitem\core\WebItem;
use zetsoft\models\page\PageAction;
use zetsoft\models\core\CoreInput;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\helpers\ZVarDumper;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\former\ZFormWidget;

/** @var ZView $this */
$action = new WebItem();

$action->title = Azl . 'Grapes';
$action->icon = 'fal fa-area-chart';
$action->type = WebItem::type['ajax'];
$action->csrf = true;
$action->debug = true;



$this->paramSet(paramAction, $action);


$get = $this->httpGet('param');
$param = str_replace('/', '\\', $get);
$param = str_replace('zetsoft', '', $param) . '.php';

echo $this->requireAjaxFile(Root . $param);
