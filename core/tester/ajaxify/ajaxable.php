<?php
/** @var ZView $this */

use zetsoft\system\kernels\ZView;

if ($this->httpIsAjax()) {
    $email = $this->httpGet('email');
    vdd($email);
}
