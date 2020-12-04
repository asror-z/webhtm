<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\animo\ZVantaJSWidget;
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
<div class="container-fluid header_bg mb-3">
    <div class="row">
        <div class="col-lg-12 mt-2">
            <h1 class="text-center"><?= $company->name ?></h1>
        </div>
    </div>
    <div class="row">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 mt-5">
                    <span class="fp-22">
                        <?= $company->text_short ?>
                    </span>

                </div>

                <div class="col-lg-6 text-right mt-3">
                    <p class="mb-0">
                        <span class="fp-22"><?= Az::l('Телефон компании: ') ?> </span>
                        <span class="fp-25"> <?= $company->phone ?> <i class="fa fa-phone"></i></span>
                    </p>
                    <p class="mb-0">
                        <span class="fp-22"><?= Az::l('Вебсайт компании: ') ?></span>
                        <span class="fp-25"> <?= $company->website ?> <i class="fa fa-globe"></i></span>
                    </p>
                    <p class="mb-0">
                        <span class="fp-22"> <?= Az::l('Электронная почта компании: ') ?></span>
                        <span class="fp-25"> <?= $company->email ?> <i class="fa fa-envelope"></i> </span>
                    </p>
                </div>
            </div>
        </div>
    </div>
    <style type="text/css">
        .header_bg {
            background: url('https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcR1RsMd8CLzUNFD2aFyLZbMIPHFLbUcTrG0Rw&usqp=CAU') no-repeat center top / cover ;
            min-height:  270px;
            box-shadow: 0 5px 5px rgba(182, 182, 182, 0.75);
        }
    </style>
</div>

<div class="text-center">
    <?= $company->text ?>
</div>


<?php
echo ZFooterAllWidgetOrg::widget();

?>
<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>



