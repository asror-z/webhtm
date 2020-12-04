<?php
use zetsoft\models\shop\ShopProduct;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZView;
use zetsoft\models\test\Test5;
/** @var ZView $this */

$action->title = Azl . 'Search';

$action->icon = 'fa fa-th';
$action->debug = true;
$this->csrf = true;
$action->type = WebItem::type['html'];

?>

<html>
<head>

</head>
<body class="">
<form action="?" method="get">
    <div>
        <input type="text" name="search" class="border-none pt-3">
        <button type="submit" class="btn btn-primary">Search</button>
    </div>
</form>
</body>
</html>


<?php

$query = $this->httpGet('search');

if($query){
     $result =(Az::$app->search->elasticsearch->search($query));
     $result1 =(Az::$app->search->elasticsearch->highlightSearch($query));

    foreach($result1['hits']['hits'] as $key=> $source){
        if(!empty($source['_source']['id'])){
            echo "<div class='row m-2' style='font-size: 20px'>";
            echo "<div class='shadow p-3 mb-5 bg-white rounded  bg bg-primary column'>";
            $shop_product = ShopProduct::find()->where([
                'id' => $source['_source']['id']
            ])->all();
            $test5 = Test5::find()->where([
                'id' => $source['_source']['id']
            ])->all();
            foreach ($shop_product as $product){
                echo "<p>$product->name</p>";
                echo "<p>$product->text</p>";
                echo "<p>$product->title</p>";
            }

            foreach ($test5 as $test){
                echo "<p>$test->first_name</p>";
                echo "<p>$test->second_name</p>";
                echo "<p>$test->email</p>";
            }

           echo "<hr>";
            echo "</div>";
            echo '</div>';
        }


    }

}
    else
       // vdd('not found');


?>
