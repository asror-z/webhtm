<?php

use kartik\grid\DataColumn;
use zetsoft\models\cpas\CpasOffer;
use zetsoft\models\cpas\CpasStream;
use zetsoft\models\cpas\CpasStreamItem;
use zetsoft\models\pays\PaysWithdraw;
use zetsoft\service\App\eyuf\User;
use zetsoft\system\assets\ZColor;
use zetsoft\system\Az;
use zetsoft\system\column\ZKDataColumn;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\helpers\ZUrl;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\navigat\ZButtonWidget;
use zetsoft\widgets\themes\ZCardWidget;


$id = $this->httpGet('id');
$model = PaysWithdraw::findOne($id);
$model->status = PaysWithdraw::status['ok'];
$model->configs->rules = [
    [
        validatorSafe
    ]
];
if ($model->save())
    $this->urlRedirect([
        '/cpas/admin/payout',

    ]);

?>



