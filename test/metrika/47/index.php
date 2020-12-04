<?php


$mainRoot = dirname(__DIR__) . '/Main.php';
$mainLocal = __DIR__ . '/Main.php';

if (file_exists($mainLocal))
    require $mainLocal;
else
    require $mainRoot;

$main = new Main();


$main->offer_id = 12241;
$main->item_id = 47;
$main->post();

echo $main->release();

?>
