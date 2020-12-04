<?php
/**
 * @author: Shahzod Gulomqodirov
 *
 */

use zetsoft\models\shop\ShopCatalog;
use zetsoft\system\Az;
use zetsoft\widgets\former\ZEditRavWidget;
use zetsoft\widgets\inputes\ZCurrencyRadioWidget;

$user = $this->userIdentity();

//vdd($user);
?>
    <h5 class="mx-4 text-muted">
        BALANCE: $
        <?
        echo $user->balance ? $user->balance : 0;
        ?>
    </h5>

<?php
