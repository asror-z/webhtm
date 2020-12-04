<?php

use zetsoft\models\place\PlaceCountry;
use zetsoft\models\App\eyuf\Card;
use zetsoft\system\kernels\ZView;
use zetsoft\system\Az;
use zetsoft\widgets\former\ZDynaWidget;


/** @var ZView $this */
$action = new WebItem();

$this->title = Az::l('main');

$action->icon = 'fa fa-globe';
$this->csrf = 1;
$action->icon =1;
$action->type = WebItem::type['html'];

$model = new Card();
/*$model->configs->nameOn = [
    'name',
    'title'
];*/
$model->configs->filter = false;
$model->configs->edit = false;
$model->configs->addBy = true;


echo ZDynaWidget::widget([
    'model' => $model,
    'config' => [
        'actionView' => true,
        'actionEdit' => false,
        'actionDelete' => false,
        'actionClone' => false,
        'actionDetail' => true,

        'columnCheckbox' => false,
        'columnExpand' => false,
        'columnFormula' => false,
        'columnRelation' => false,

        'topCreate' => false,
        'topUpdate' => false,
        'topFilter' => false,
        'topSort' => false,
        'topSetting' => false,
        'topDynaSettings' => false,
        'topExport' => false,
    ]
]);





/*<?php

echo zetsoft\widgets\former\ZDynaWidget::widget([
    'id' => 'ZDynaWidget_794139',
    'model' => new zetsoft\models\core\CoreMenu(),
    'attribute' => 'string_2',
    'config' => [
    'title' => 'Меню',
],
]);


?>*/




