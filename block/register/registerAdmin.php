<?php

/**
 *
 *
 * Author:  Asror Zakirov
 * https://www.linkedin.com/in/asror-zakirov
 * https://github.com/asror-z
 *
 */

use zetsoft\dbdata\auth\RoleData;
use zetsoft\system\kernels\ZView;


/** @var ZView $this */

$userName = $this->userIdentity()->title;
$userRole = $this->userRole();

$roles = (new RoleData())->lang();

foreach ($roles as $key => $value) {
    if ($key === $userRole) {
        $userRole = $value;
    }
}

if ($this->userIsGuest()) {

    ?>
    <a href="#" class="d-none"><i class="fa fa-user fe-15 pr-2 grey-text"></i></a>
    <?php

} else {

    ?>
    <div class="row mr-2">
        <div class="mt-1 p-0">
            <p class="m-0 p-0 text-center fp-13 text-muted"><?= $userName ?></p>
            <p class="m-0 p-0 text-center fp-13 text-muted"><?= $userRole ?></p>
        </div>
        <a href="/core/user/user-profile/profile-settings.aspx" class="hint--bottom position-relative mt-3"
           aria-label="Мой профиль">
            <span class="fal fa-user ml-2 fp-30 pr-2 grey-text"></span>
            <div id="status" class="counter badge badge-success mr-1">&nbsp;</div>
        </a>
    </div>
    <?
}
?>

<style>
    #status {
        top: -20px !important;
        padding: 3px 4px;
        border-radius: 50%;
        width: 11px;
        height: 11px;
        right: -8px;
    }
</style>
