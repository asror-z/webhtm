<?php

use yii\bootstrap4\Html;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZView;

/** @var ZView $this */


?>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="google-site-verification" content="AIsF8XU-eXWtCRTAQo_GLIRcOF48YLENj--OoWFFft8"/>

<title>
    <?php
    if ($this->paramGet(paramError))
        echo Az::l('Страница исключений');
    else
        echo Html::encode($this->viewTitle());
    ?>

</title>
