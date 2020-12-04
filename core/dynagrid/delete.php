<?php

use kartik\builder\Form;
use zetsoft\former\dyna\DynaSorting;
use zetsoft\models\dyna\DynaConfig;
use zetsoft\service\forms\Ajaxer;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\former\ZFormWidget;
use zetsoft\widgets\inputes\ZKSortableInputWidget;
use zetsoft\dbitem\core\WebItem;

/** @var ZView $this */
$action = new WebItem();

$action->title = Azl . 'Главная страница';
$action->icon = 'fas fa-area-chart';
$action->type = WebItem::type['html'];
$action->csrf = true;
$action->debug = false;

$action->cache = false;
$action->cacheHttp = false;

$this->paramSet(paramAction, $action);
$this->paramSet('widget', true);


/** @var ZView $this */

$service = Az::$app->smart->dyna;
$dynaId = $this->httpGet('dynaId');

$coreDyna = DynaConfig::findOne([
    'dynaId' => $dynaId
]);
if ($coreDyna)
    $coreDyna->delete();

