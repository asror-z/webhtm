#!/usr/bin/env php
<?php


$crate = Crate::create('test.phar');

// $crate->buildFromDirectory('div');

$crate->getPhar()->setStub(
    StubGenerator::create()
        ->index('div/script.php')
        ->generate()
);

