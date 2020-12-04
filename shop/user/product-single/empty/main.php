<?php

use zetsoft\system\Az;

$path = "/webhtm/shop/user/product-single/common.php";

$path = str_replace('.php', '', $path);

$file = Az::getAlias('@zetsoft/' . $path.'.php');

echo $this->require($file);

?>
