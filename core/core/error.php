<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZView;

/** @var ZView $this */
$viewFile = '/webhtm/core/error/exception.php';
global $boot;
$userDev = $boot->enableDebug();
/** @var WebItem $action */
$action = $this->paramGet(paramAction);
if ($action) {
    $layout = $action->layoutFile;
} else {
    $layout = $this->bootEnv('layout');
}

if ($userDev) {

    echo $this->require($viewFile);
} else {
    $this->paramSet(paramError, true);

    $data = '/webhtm/lays/' . App . '/' . $layout . '.php';
    echo $this->require($data, [
        'content' => $viewFile
    ]);
}


