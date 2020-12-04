<?php


//use zetsoft\dbitem\data\Form;
use zetsoft\former\shop\ShopCompanyCardForm;
use zetsoft\models\core\CoreInput;
use zetsoft\widgets\former\ZFormWidget;
use zetsoft\widgets\inputes\ZPeriodPickerWidget;
use zetsoft\widgets\inputes\ZPeriodPickerWidgetNew;
use zetsoft\widgets\inputes\ZPeriodPickerWidgetNew2;
use zetsoft\widgets\navigat\ZButtonWidget;
use zetsoft\models\user\User;
use zetsoft\dbitem\core\WebItem;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\former\ZDynaWidgetBosya;
use zetsoft\widgets\former\ZDynaWidgetnarm;
use zetsoft\widgets\former\ZDynaWidgetRav;
use zetsoft\widgets\menus\ZMmenuWidget;
use zetsoft\widgets\menus\ZMmenuWidgetSh;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;
use zetsoft\models\shop\ShopOrder;
use kartik\builder\Form;


/** @var ZView $this */

/**
 *
 * Action Params
 */

$action = new WebItem();

$action->title = Azl . 'Заказы';
$action->icon = 'fal fa-lock';
$action->type = WebItem::type['html'];
$action->csrf = true;
$action->debug = true;
if ($this->httpGet('spa')) {
    $action->debug = false;
}



$this->paramSet(paramAction, $action);

$this->title();
$this->toolbar();


$model = $this->modelGet(CoreInput::class, 4);
/** @var ZView $this */

$items = $this->modelData();
$form = $this->activeBegin();
$this->modelSave($model);
/**
 *
 * Start Page
 */

$this->beginPage();
?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>

    <?php

    require Root . '/webhtm/block/metas/main.php';
    require Root . '/webhtm/block/assets/main.php';

    $this->head();

    ?>

</head>


<body class="<?= ZWidget::skin['white-skin'] ?>">

<?php
$productId = 24;
$get = [];
//$users = User::find()->all();
//$set = Az::$app->market->cart->getcatalogsByElement($productId, $get);
$array = [
    '1' => '1',
    '2' => '2',
    '3' => '3',
    '4' => '4'
];

$companyItem = new ShopCompanyCardForm();
$companyItem->id = 12;
$companyItem->rating = 4.3;
$companyItem->catalogId = 3;
$companyItem->name = 'name';
$companyItem->amount = 1200;
$companyItem->title = 'New company';

//vdd($companyItem->attributes);
$this->beginBody();

echo ZNProgressWidget::widget([]);
if (!$this->httpGet('spa'))
    echo ZMmenuWidget::widget([
        //'data' => $this->cores->menus->create('mmenu'),
        'config' => [
            'theme' => 'white',
            'content.img.width' => 230,
            'iconbar.top' => [
                "<a href='#/'><i class='fa fa-home'></i>cc</a>",
                "<a href='#/'><i class='fa fa-home'></i>cc</a>",
            ],
            'iconbar.bottom' => [
                "<a href='#/'><i class='fa fa-home'></i>aa</a>",
                "<a href='#/'><i class='fa fa-home'></i>cc</a>",
            ],
            'all.border' => ZMmenuWidget::border['border-full'],
            'menu-effect-slide' => true,
        ],
    ]);
?>

<div id="page">

    <?
    if (!$this->httpGet('spa'))
        require Root . '/webhtm/block/navbar/admin.php';

    echo ZSessionGrowlWidget::widget();?>

    <div id="content" class="content-footer p-3">


        <div class="row">
            <div class="col-md-12 col-12">
                <?
                echo $this->require( '/webhtm/test/metrika/requiretest2.php', [
                    'array' => $array,
                    'companyItem' => $companyItem
                ], 'check');

                ?>

            </div>
        </div>


    </div>

</div>


<?php $this->endBody() ?>


</body>
</html>

<?php $this->endPage();
$this->activeEnd();

?>



