<?php

use zetsoft\models\user\User;
use zetsoft\system\Az;
use zetsoft\widgets\former\ZDynaWidget82;
?>

<div class="table-responsive">
<?= /*ZDynaWidget82::widget([
    'model' => new User(),
]);*/
$model = new ProductItemForm();

$data = Az::$app->market->product->getProductItemForm();
?>
</div>
