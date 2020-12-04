<?php

use zetsoft\system\Az;
use zetsoft\models\test\Test5;
use zetsoft\service\search\TntSearchService;
use zetsoft\system\kernels\ZView;

$search = $_GET['search'] ?? 'vera';
if (isset($search)) {
    $tnt = new TntSearchService();
    $tnt->name = 'test5';
    $tnt->search = $search;
    $tnt->regularSearch();
    $res = $tnt->result;
    $modal = new Test5();
    $finalres = $modal::findBySql('SELECT * FROM test5 WHERE id IN :res ORDER BY FIELD(id, :res)', [':res' => $res])->all();
}

?>

<html>
<head>

</head>
<body>
<form action="?" method="get">
    <div>
        <input type="text" name="search" class="border-none pt-3">
        <button type="submit" class="btn btn-primary">Search</button>
    </div>
</form>

<div class="result">
    <?php
    var_dump($finalres);
    ?>
</div>
</body>
</html>
