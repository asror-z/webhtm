<?php
/* @var $this \yii\web\View */
/* @var $exception \Exception */

/* @var $handler \yii\web\ErrorHandler */

use PhpOffice\PhpSpreadsheet\Shared\OLE\PPS\Root;
use yii\helpers\ArrayHelper;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZView; ?>
<?php if (method_exists($this, 'beginPage')) : ?>
    <?php $this->beginPage() ?>
<?php endif ?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8"/>

    <title>
        <?php
        //vdd($handler);
        $name = $handler->getExceptionName($exception);
        if ($exception instanceof \yii\web\HttpException) {
            echo (int)$exception->statusCode . ' ' . $handler->htmlEncode($name);
        } else {
            if ($name !== null) {
                echo $handler->htmlEncode($name . ' – ' . get_class($exception));
            } else {
                echo $handler->htmlEncode(get_class($exception));
            }
        }
        ?>
    </title>

    <script src="/render/core/error/main.js"></script>

    <link rel="stylesheet" href="/render/core/error/main.css">


    <!-- styles -->
    <?
    require Root . '/webhtm/core/error/blocks/style.php';
    ?>

</head>


<body>

<!-- main -->
<?
require Root . '/webhtm/core/error/blocks/main.php'
?>

<!-- vanta js scripts -->
<?
require Root . '/webhtm/core/error/blocks/script.php';
?>



<?php if (method_exists($this, 'endBody')) : ?>
    <?php $this->endBody() // to allow injecting code into body (mostly by Yii Debug Toolbar)
    ?>
<?php endif ?>
</body>

</html>
<?php if (method_exists($this, 'endPage')) : ?>
    <?php $this->endPage() ?>
<?php endif ?>
