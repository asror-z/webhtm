<?php


use zetsoft\system\column\ZKDataColumn;

use kartik\widgets\Alert;
use zetsoft\dbitem\data\ZForm;
use zetsoft\models\App\eyuf\EyufDocument;
use zetsoft\models\App\eyuf\EyufScholar;

use zetsoft\system\helpers\ZUrl;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\navigat\ZButtonWidget;
use zetsoft\widgets\notifier\ZKAlertWidget;


$id = $this->httpGet('id');

/** @var EyufDocument $model */
/** @var ZView $this */


$model = EyufDocument::findOne($id);
$model->status = false;

if ($model->save())
    $this->urlRedirect('/logics/monitor/doc-list-accept.aspx?id=' . $model->getEyufScholar()->id);


