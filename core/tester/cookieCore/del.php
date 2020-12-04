<?php

/**
 *
 *
 * Author:  Asror Zakirov
 * https://www.linkedin.com/in/asror-zakirov
 * https://github.com/asror-z
 *
 */

use zetsoft\system\kernels\ZView;

/** @var ZView $this */
$this->cookieDel('test_identity');

echo 'deleted';
vd($this->cookieGet());
