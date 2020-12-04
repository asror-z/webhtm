<?php


use zetsoft\dbitem\core\WebItem;
use zetsoft\models\page\PageAction;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\former\ZDynaWidget;

/*  This will clear seesion of RangePicer in Filter - Javohir*/

/** @var ZView $this */
$action = new WebItem();

$action->csrf = true;
$action->debug = true;
$action->cache = false;
$action->call = null;
$action->cacheHttp = false;

$this->paramSet(paramAction, $action);



$this->paramSet(paramAction, $action);


//$file = Root . '/scripts/runner/runx.exe';
/*$root = Root;
$php = "d:/Develop/Projects/ALL/server/php7/7_44/php.exe";


$line = ' 15 "{php}" {root}/excmd/asrorz.php {cmd}';


$line = strtr($line, [
    '{php}' => $php,
    '{root}' => $root,
]);*/

/*$line = "@php ../..//excmd/asrorz.php caller/marce-ami/run";

Az::$app->utility->execs->exec($line, true);*/


//Az::$app->utility->execs->exec($file . $line, true);




    //Az::$app->calls->marceAMI->restartAutodial();
    
 

      Az::$app->calls->marceAMI->exitAutodial();

//shell_exec('D:\Develop\Projects\ALL\asrorz\zetsoft\scripts\runner\marce-ami.cmd');




//$this->urlRedirect('/shop/supervisor/stats/autodial.aspx');




//shell_exec('D:\Develop\Projects\ALL\asrorz\zetsoft\scripts\runner\exitx.exe');

