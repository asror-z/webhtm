
<?php

use Illuminate\Support\Collection;
use zetsoft\dbitem\core\WebItem;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\market\ZFooterAllWidgetOrg;


/** @var ZView $this */
$market_id = $this->httpGet('market_id');

$companylist = Az::$app->market->product->allCompanies();

foreach ($companylist as $item) {
    if ($item->id === (int)$market_id)
        $company = $item;
}
$action = new WebItem();

if (!empty($market_id) && !empty($company)) {
    $action->title = Azl . $company->name;
}
$action->icon = 'fa fa-area-chart';
$action->type = WebItem::type['html'];
$action->csrf = true;
$action->debug = true;
$action->loader = true;

$action->cache = false;

$action->call = [];

$action->cacheHttp = false;

$this->paramSet(paramAction, $action);



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
<body class="<?= ZWidget::skin['white-skin'] ?> main-catalog-style">

<?php

$this->beginBody();
require Root . '/webhtm/block/header/main.php';
require Root . '/webhtm/block/navbar/main.php';

?>


<div class="container-fluid text-center">

    <div class="row mt-4" id="new">
        <div class="col-lg-4">
            <?php

            echo $this->require( '/render/market/ZFiterWidget/ready/main.php', [
                'item' => $category_id
            ]);
            ?>
        </div>
        <div class="col-lg-8">
            <h3><?= Az::l('Cкидки') ?><span class="ml-2 badge badge-success shadow-none fe-05">Cкидки</span></h3>
            <div class="row">
                <?
                /** @var Collection $catalogsByStatusNew */

                $catalogsByStatusSale = Az::$app->market->offer->catalogByStatus('discount', $market_id, 12);

                if ($catalogsByStatusSale->count() === 0) {

                    echo $this->require( '/webhtm/shop/user/main-common/empty/emptyBySatus.php');
                } else {
                    foreach ($catalogsByStatusSale as $product) {

                        echo $this->require( '/render/cards/ZVMarketWidget/ready/main_row2.php', [
                            'item' => $product,
                            'id' => random_int(1, 1000000)
                        ]);
                    }
                }
                ?>
            </div>
        </div>
    </div>

</div>


<?php
echo ZFooterAllWidgetOrg::widget();

?>


<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>







