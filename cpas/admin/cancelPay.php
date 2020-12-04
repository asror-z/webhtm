<?php

use kartik\grid\DataColumn;
use zetsoft\models\cpas\CpasOffer;
use zetsoft\models\cpas\CpasStream;
use zetsoft\models\cpas\CpasStreamItem;
use zetsoft\models\pays\PaysWithdraw;
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
$user = \zetsoft\models\user\User::findOne($model->user_id);
if (empty($user))
    return $this->urlRedirect([
        '/cpas/admin/payout',
    ]);
    
$user->balance += $model->amount;
$user->save();

$model->status = PaysWithdraw::status['no'];

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




