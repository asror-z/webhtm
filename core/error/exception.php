<!-- main -->

<?

use zetsoft\system\Az;
use zetsoft\system\kernels\ZView;

global $boot;
/** @var ZView $this */
$exception = Az::$app->errorHandler->exception;
$userDev = $boot->enableDebug();


$handler = Az::$app->errorHandler;
//      vdd($exception = new ErrorException($error['message'], $error['type'], $error['type'], $error['file'], $error['line']));
if ($userDev) {
    require Root . '/webhtm/core/error/blocks/style.php';
    require Root . '/webhtm/core/error/blocks/script.php';
                      
    echo $this->require('/webhtm/core/error/blocks/main.php', [
        'exception' => $exception,
        'handler' => $handler
    ]);
    ?>
    
    <script src="/render/core/error/main.js"></script>
    <link rel="stylesheet" href="/render/core/error/main.css">
    
<?php } else {
    echo $this->require('\webhtm\core\error\templates\exception.php', [
        'exception' => $exception,
        'handler' => $handler
    ]);

} ?>
