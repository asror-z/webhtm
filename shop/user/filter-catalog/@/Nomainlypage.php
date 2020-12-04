<?php

    use zetsoft\dbitem\core\WebItem;

/** @var ZView $this */
$action = new WebItem();

$category_id = $this->httpGet('category_id');
$company_id = $this->httpGet('market_id');
if (!isset($company_id))
    $company_id = 1;


/*$products = Az::$app->market->product->allElements($category_id, $company_id, 1, 10);*/

//$item = Az::$app->market->category->getMenuItem($company_id, true);

$this->paramSet(paramAction, $action);
$this->title();

$this->beginPage();

?>

    <?php
    require Root . '/webhtm/block/metas/main.php';
    require Root . '/webhtm/block/assets/main.php';

    $this->head();
    ?>



<?php


$this->beginBody();

require Root . '/webhtm/block/header/main.php';
require Root . '/webhtm/block/navbar/singlemain.php';
?>




<? $this->endPage() ?>
