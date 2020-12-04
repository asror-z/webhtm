<?php


global $boot;

use zetsoft\system\Az;

return Az::$app->auth->openAuth->run();
