<?php

use zetsoft\system\Az;
use zetsoft\system\kernels\ZView;
use zetsoft\models\test\Test5;
/** @var ZView $this */

$action->title = Azl . 'Search';

$action->icon = 'fa fa-th';
$action->debug = true;
$this->csrf = true;
$action->type = WebItem::type['html'];
$model = Test5::find()->all();

foreach($model as $value){
    if($value->column->elastic){}
        
        
}



?>

<html>
<head>

</head>
<body>

</body>
</html>


<?php

$query = $this->httpGet('search');

if($query){
     $result =(Az::$app->search->elasticsearch->search($query));
     $result1 =(Az::$app->search->elasticsearch->highlightSearch($query));

     $array = [];
    foreach($result1['hits']['hits'] as $key=> $source){
        if(!empty($source['_source']['text'])){
            echo "<div class='row' style='font-size: 20px'>";
            echo "<div class='shadow p-3 mb-5 bg-white rounded  bg bg-primary column'>";
            echo $source['_source']['text'].'Produc Text <br>';
            echo $source['_source']['title'].'Product Title <br>';
            echo $source['_source']['category_id'].'Category id <br>';
            echo $source['_source']['category_name'].'Product id <br>';
              $array[] = $source['_source']['id'];
            foreach($source['_source']['tags'] as $tag){
                echo $tag.' ';
            }
           echo "<hr>";
            echo "</div>";
            echo '</div>';
        }else{
            foreach($result1['hits']['hits'] as $key=> $source) {
                if ($source['_source']['first_name']) {
                    echo "<div class='shadow p-3 mb-5 bg-white rounded w-25'>";
                    echo $source['_source']['first_name'] . 'user_name <br>';
                    echo $source['_source']['last_name'] . 'Last Name <br>';
                    echo $source['_source']['email'] . 'users Email <br>';
                    foreach ($source['_source']['tags'] as $tag) {
                        echo $tag . ' ';
                    }
                    echo "<hr>";
                    echo "</div>";
                }
            }

        }


    }

}
    else
       // vdd('not found');


?>
