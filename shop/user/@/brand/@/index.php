<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\dbitem\shop\CompanyCardItem;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\menus\ZMetisMenuWidget;

$action = new WebItem();

$action->title = Azl . 'Бренды';
$action->icon = 'fa fa-area-chart';
$action->type = WebItem::type['html'];
$action->csrf = true;
$action->debug = true;



/*$items = Az::$app->market->product->allCompanies();*/
$items = null;
if (!isset($items)) {
    $item = new CompanyCardItem();
    $item->id = 1;
    $item->catalogId = null;
    $item->name = "Zetsoft";
    $item->amount = 0;
    $item->title = "company it";
    $item->url = "/customer/markets/show.aspx?id=1";
    $item->visible = true;
    $item->image = "https://cdn.dribbble.com/users/357797/screenshots/3998541/empty_box.jpg";
    $item->new_price = null;
    $item->price_old = null;
    $item->currency = "$";
    $item->currencyType = "before";
    $item->cart_amount = 0;
    $item->reviewCount = 0;
    $item->delivery_type = null;
    $item->delivery_price = null;
    $item->measure = "шт";
    $item->measureStep = 1;
    $item->distence = "12km";
    $items[] = $item;
    $items[] = $item;
    $items[] = $item;
    $items[] = $item;
    $items[] = $item;
    $items[] = $item;
    $items[] = $item;
    $items[] = $item;

}
$this->paramSet(paramAction, $action);

$this->title();
$this->toolbar();

/** @var ZView $this */
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
<body class="<?= ZWidget::skin['white-skin'] ?> borderzz">
<?php

$this->beginBody();

require Root . '/webhtm/block/header/main.php';
require Root . '/webhtm/block/navbar/main.php';
?>

<div class="container-fluid bg-white">

    <div class="row py-3">
        <div class="col-lg-3 col-md-3 col-sm-12">
            <?
            echo \zetsoft\widgets\menus\ZMetisMenuWidget::widget([
                'config' => [
                    'MenuOpen' => true,
                    'type' => ZMetisMenuWidget::type['Category'],
                ],
            ]);
            ?>
        </div>


        <div class="col-lg-9 col-md-9 col-sm-12">
            <div class="row">
                <h3 class="text-center"><?= Az::l('Бренды') ?></h3>
                <div class="col-md-12 d-flex flex-wrap">

                    <?


                    foreach ($items as $item) {
                        ?>
                        <div class="col-md-4 d-flex justify-content-center">
                            <?
                            echo $this->require( '/render/cards/ZCompanyCardWidget/ready/companyCard.php', [
                                'company' => $item
                            ]);
                            ?>
                        </div>
                        <?
                    }
                    ?>
                </div>
            </div>
        </div>


    </div>


</div>

<?php $this->endBody() ?>

</body>
</html>

<?php
$this->endPage()
?>



