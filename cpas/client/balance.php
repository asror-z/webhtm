<?php
/**
 * @author: Jahongir Qudratov
 *
 */

use zetsoft\models\cpas\CpasFinance;
use zetsoft\models\pays\PaysWithdraw;
use zetsoft\system\Az;

$userId = $this->userIdentity()->id;
$user = \zetsoft\models\user\User::findOne($userId);
$userBalance = $user->balance;
if ($userBalance === null)
    $userBalance = 0;
$holds = PaysWithdraw::find()
    ->where([
        'user_id' => $userId
            ])
    ->andWhere(['status' => 'hold'])
    ->all();

$amount = 0;
foreach ($holds as $hold)
{
    $amount1 = (int)$hold->amount;
    $amount += $amount1;
}

?>

<li class="nav-item d-none d-sm-inline-block">
    <a href="#" class="nav-link balance-text"><?= Az::l('Баланс')?> : <?= $userBalance?> $</a>
</li>
<li class="nav-item d-none d-sm-inline-block">
    <a href="#" class="nav-link balance-text"><?= Az::l('Холд')?> : <?= $amount?> $</a>
</li>

