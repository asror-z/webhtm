<?php

use zetsoft\dbitem\core\NotifyItem;
use zetsoft\models\auto\ChatNotify;
use zetsoft\system\helpers\ZJsonHelper;
use zetsoft\system\kernels\ZView;

/**
 *
 *
 * Author:  Asror Zakirov
 * https://www.linkedin.com/in/asror-zakirov
 * https://www.facebook.com/asror.zakirov
 * https://github.com/asror-z
 *
 */

$id = $this->httpGet('id');

 = true;
$action->icon =false;
$action->type = WebItem::type['ajax'];::type['part'];


$notify = ChatNotify::find()
    ->count();

if ($id !== null)
    $notify = $notify * $id;

$notifyItem = new NotifyItem();
$notifyItem->name = 'sadf';
$notifyItem->text = '131313131';

echo ZJsonHelper::encode($notifyItem);
