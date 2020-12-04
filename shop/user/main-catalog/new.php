
<?php

use Illuminate\Support\Collection;
use zetsoft\dbitem\core\WebItem;
use zetsoft\models\shop\ShopOffer;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\helpers\ZUrl;
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

<div class="row my-4">
    <div class=" d-flex">

        <div class="col-md-12 d-flex px-5 border shadow">
            <img class="bg-danger img-fluid"
                 src="<?= '/imagez/mplace/' . ZArrayHelper::getValue($company->photo, 0)
                 ?>" alt="">
            <span class="fp-26 font-weight-bold mt-5">
                    <?= $company->name ?>
                     <p class="fp-20">
                    "On the other hand, we denounce with righteous indignation and dislike men who are so beguiled and demoralized by the charms of pleasure of the moment, so blinded by desire, that they cannot foresee the pain and trouble that are bound to ensue; and equal blame belongs to those who fail in their duty through weakness of will, which is the same as saying through shrinking from toil and pain. These cases are perfectly simple and easy to distinguish. In a free hour, when our power of choice is untrammelled and when nothing prevents our being able to do what we like best, every pleasure is to be welcomed and every pain avoided. But in certain circumstances and owing to the claims of duty or the obligations of business it will frequently occur that pleasures have to be repudiated and annoyances accepted. The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains."
                </p>
                </span>


        </div>

        <div class="fp-20 w-75 ml-auto d-flex align-items-center">
            <?
            /*echo ZBreadcrumbs2Widget::widget([
                'config' => [
                    'mode' => ZBreadcrumbsWidget::mode['category'],
                    'category_id' => 978,
                ]
            ]);*/
            ?>

        </div>

    </div>

</div>


<div class="container-fluid">

    <div class="row mt-4" id="new">
        <div class="col-12">
            <h3><?= Az::l('Новинки') ?><span class="ml-2 badge badge-success shadow-none fe-05">New</span></h3>
        </div>
        <div class="col-12">
            <div class="row">
                <?
                /** @var Collection $catalogsByStatusNew */
                
                $catalogsByStatusNew = Az::$app->market->offer->catalogByStatus('new', $market_id, 12);

                if ($catalogsByStatusNew->count() === 0) {

                    echo $this->require( '/webhtm/shop/user/main-common/empty/emptyBySatus.php');
                } else {
                    foreach ($catalogsByStatusNew as $product) {

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




