<?php

/**
 *
 *
 * Author:  JamshidIsmailov
 * https://www.linkedin.com/in/asror-zakirov
 * https://github.com/asror-z
 *
 */

use zetsoft\widgets\blocks\ZCollapseWidget;
use zetsoft\widgets\former\ZCheckDynaWidget;
use zetsoft\system\Az;

$minuss = Az::$app->tests->jamshidTest->minus(54,85);

$pluss = Az::$app->tests->jamshidTest->pluss(54,85);

$delit = Az::$app->tests->jamshidTest->delit(1250,25);

$increasing = Az::$app->tests->jamshidTest->increasing(125,25);

echo $minuss." ".$pluss." ".$delit. " ".$increasing;


