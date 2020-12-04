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

use zetsoft\models\App\eyuf\EyufScholar;
use zetsoft\widgets\former\ZViewWidget;

$id = $this->httpGet('id');

if (empty($id))
    return null;

$model = EyufScholar::findOne($id);

echo ZViewWidget::widget([
    'model' => $model,
]);
