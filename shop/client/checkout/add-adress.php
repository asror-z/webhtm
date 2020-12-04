<?php


use zetsoft\former\ALL\Location;
use zetsoft\models\place\PlaceAdress;
use zetsoft\models\core\CoreLocation;
use zetsoft\models\user\User;
use zetsoft\service\forms\Active;
use zetsoft\system\assets\ZColor;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\former\ZFormWidget;
use zetsoft\widgets\themes\ZCardWidget;

$this->title = Az::l('Добавить Адресс');


?>







<?php

use yii\caching\TagDependency;
use zetsoft\dbitem\core\WebItem;
use zetsoft\models\core\CoreAdvancedItem;


use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\cards\ZAzCardWidget;
use zetsoft\widgets\market\ZFooterAllWidget;
use zetsoft\widgets\market\ZMenuWidgetAbdulloh;
use zetsoft\widgets\market\ZMSwiperDbWidget;
use zetsoft\widgets\market\ZMSwiperWidget;
use zetsoft\widgets\menus\ZSidebarWidget;


/** @var ZView $this */
$action = new WebItem();

$action->title = Azl . 'Добавить Адресс';
$action->icon = 'fa fa-area-chart';
$action->type = WebItem::type['html'];
$action->csrf = true;
$action->debug = true;

$action->cache = false;

$action->call = [
//    TagDependency::invalidate()
];
$action->cacheHttp = false;

$this->paramSet(paramAction, $action);

$this->title();
$this->toolbar();
if ($this->httpGet('id') === null) {
    $model = new PlaceAdress();

   // $model->address_type = PlaceAdress::address_type['order'];
 
} else
    $model = PlaceAdress::findOne($this->httpGet('id'));
$model->configs->nameShowEx = [
    'address_type',
    'id',
];

$model->configs->nameOff = [

    'location',

];


/** @var ZView $this */

/*if ($this->modelForm($model))
    */
$this->modelPost();

if ($this->modelSave($model)) {

    /** @var User $user */
    $user = User::findOne($this->userIdentity()->id);
    $ids = $user->core_adress_ids;
    $ids[] = $model->id;
    $user->core_adress_ids = $ids;
    $user->save();

    $this->urlRedirect(['/client/checkout/check-out']);
}

/** @var ZView $this */
$this->beginPage();
?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>

    <?php

    $this->require( '/webhtm/block/metas/main.php');
    $this->require( '/webhtm/block/assets/main.php');
    #require Root . '/webhtm/block/header/main.php';
    $this->require( '/webhtm/block/navbar/main.php');

    $this->head();

    ?>

</head>
<body class="<?= ZWidget::skin['white-skin'] ?>">

<?php

$this->beginBody();
?>

<div>


    <div class="row p-5">

        <div class="col-md-6 col-6 ">

            <?

            $active = new Active();
            $active->id = 'sendLocation';

            $form = $this->activeBegin($active);

            ZCardWidget::begin([
                'config' => [
                    'title' => $this->title,
                    'type' => ZCardWidget::type['dynCard'],
                    'classHeadColor' => 'bg-success',
                    'classBorderColor' => 'border-light',
                    'hasTitle' => true,
                ]
            ]);

            echo ZFormWidget::widget([
                'model' => $model,
                'form' => $form,
                'config' => [
                    'topBtn' => false,
                    'botBtn'
                ],

            ]);


            ZCardWidget::end();
            ?>

        </div>

        <div class="col-6 col-md-6">
            <?
            ZCardWidget::begin([
                'id' => 'locationMap',
                'config' => [
                    'title' => Az::l('Посмотрите ваш адресс'),
                    'type' => ZCardWidget::type['dynCard'],
                    'classHeadColor' => 'bg-success',
                    'classBorderColor' => 'border-light',
                ]
            ]);


            $clone = clone $model;
            $clone->configs->nameOn = [

                'location',
            ];

            $clone->columns();

            echo ZFormWidget::widget([
                'model' => $clone,
                'form' => $form,
                'config' => [
                    'topBtn' => false,
                    'botBtn' => true,
                ]
            ]);

            ZCardWidget::end();


            $this->activeEnd();
            ?>

        </div>

    </div>


</div>


<?php
echo ZFooterAllWidget::widget([

]);
?>
<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>
