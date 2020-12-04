<?php

use zetsoft\system\Az;

$allGet = Az::$app->utility->execs->itemHttp();
return Az::$app->utility->execs->addQueue($allGet);
