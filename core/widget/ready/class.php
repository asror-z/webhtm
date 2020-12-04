<?php

use zetsoft\system\Az;
use zetsoft\system\kernels\ZView;




/** @var ZView $this */
$action = new WebItem();

$this->title = Az::l('class');
$action->type = WebItem::type['html'];
$action->icon =1;

?>
            


<div widget-container="true">




            

<?php

echo zetsoft\widgets\inputes\ZKSelect2Widget::widget([
                    'id' => 'ZKSelect2Widget_896589',
                    'data' => [],
                    'config' => [
    'isHideSearch' => true,
],
                    'model' => new zetsoft\models\core\CoreInput(),
                    'attribute' => 'string_2',
                ]);
            
            

?>






</div><div widget-container="true">

<?php

echo zetsoft\widgets\inputes\ZKSelect2Widget::widget([
                    'id' => 'ZKSelect2Widget_354081',
                    'data' => [],
                    'config' => [
    'isHideSearch' => true,
],
                    'model' => new zetsoft\models\core\CoreInput(),
                    'attribute' => 'string_2',
                ]);
            
            

?>

</div>

