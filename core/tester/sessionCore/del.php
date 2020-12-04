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
$this->sessionDel('test_order');

echo 'Session cleaned';
vd($this->sessionGet('test_order'));
vd($this->sessionGet('test2'));
vd($this->sessionGet('test3'));
vd($this->sessionGet('test4'));
vd($this->sessionGet('test5'));
