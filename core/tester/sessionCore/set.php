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
$this->sessionSet('test_order', rand(1,100));
$this->sessionSet('test2', rand(1,100));
$this->sessionSet('test3', rand(1,100));
$this->sessionSet('test4', rand(1,100));
$this->sessionSet('test5', rand(1,100));

echo 'Data set';
vd($this->sessionGet('test_order'));
vd($this->sessionGet('test2'));
vd($this->sessionGet('test3'));
vd($this->sessionGet('test4'));
vd($this->sessionGet('test5'));

