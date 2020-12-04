<?php
/** @var ZView $this */

use zetsoft\dbitem\core\WebItem;
use zetsoft\models\place\PlaceCountry;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\inptest\ZKSelect2AjaxWidget;
use zetsoft\widgets\inputes\ZKSelect2Widget;
use zetsoft\widgets\menus\ZMmenuWidget;

?>
    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>">
    <head>

        <?php


        $this->head();

        ?>

    </head>


    <body class="<?= ZWidget::skin['white-skin'] ?>">

    <?php

    $this->beginBody();


    require_once join(DIRECTORY_SEPARATOR, array(__DIR__,'../','../','../','../',"vendor", "autoload.php"));

    $mpdf = new \Mpdf\Mpdf();
    $mpdf->WriteHTML('<h1>Hello world!</h1>');
    $mpdf->Output();

    ?>
    <?php $this->endBody() ?>

    </body>
    </html>

<?php $this->endPage() ?>


