<?php


use PhpOffice\PhpSpreadsheet\Shared\OLE\PPS\Root;
use zetsoft\dbitem\core\WebItem;
use zetsoft\dbitem\shop\CompanyCardItem;
use zetsoft\dbitem\shop\ProductItem;
use zetsoft\models\shop\ShopCatalog;
use zetsoft\models\user\UserCompany;
use zetsoft\models\shop\ShopElement;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\inputes\ZKStarRatingWidget;
use zetsoft\widgets\market\ZFooterAllWidget;
use zetsoft\widgets\notifier\ZJspanelWidget;

$model = UserCompany::find();
$productId = $this->httpGet('id');


/* vdd($copmany);*/
/** @var ShopCatalog $item */

/** @var ZView $this */
$action = new WebItem();

$action->title = Azl . 'Главная страница';
$action->icon = 'fa fa-area-chart';
$action->type = WebItem::type['html'];
$action->csrf = true;
$action->debug = true;

$action->cache = false;

$action->call = [];

$action->cacheHttp = false;

/*$copmanies = Az::$app->market->product->allCompanies();*/
$companies = null;
if (!isset($companies)) {
    $company = new CompanyCardItem();
    $company->id = 2;
    $company->name = 'ООО «Тойота Мотор';
    $company->title = 'Производитель процессора: Samsung, Поддержка 2G: Да, Страна:Индия, Разъем для наушников: 3.5 мм, Гарантия: 1 год, Проводная гарнитура: Да, Тип процессора:
                                    Exynos 9611, Порт USB: Type-C USB 2.0, Блок питания: Да, Емкость аккумулятора: 4000
                                    мАч, Сканер отпечатка пальца под экраном: Да, Технология Wi-Fi Direct: Да,
                                    Количество ядер: 8, Wi-Fi точка доступа: Да, Габаритные размеры (В*Ш*Г)';
    $company->amount = '4';
    $company->url = 'market.ru';
    $company->visible = '34234234';
    $company->new_price = '3123213';
    $company->image = 'https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcRVDh2D2fzRSBYnwaA-70G74wjOeeZWbRnEVBMxfu1jVqcP9fMv&usqp=CAU';
    $company->price_old = '243234';
    $company->currency = '$';
    $company->currencyType = ProductItem::currencyType['before'];
    $company->rating = 3;
    $company->cart_amount = 0;
    $company->reviewCount = 0;

    $company->delivery_price = null;
    $company->delivery_type = null;

    $company->measure = ProductItem::measure['pcs'];
    $company->measureStep = ProductItem::measureStep['pcs'];
    $companies[] = $company;
    $companies[] = $company;

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
<body class="<?= ZWidget::skin['white-skin'] ?>">
<?php

$this->beginBody();
require Root . '/webhtm/block/header/main.php';
require Root . '/render/menus/ZSidebarWidget/ready/main.php';
require Root . '/webhtm/block/navbar/main.php';

?>
<div class="market-container">

    <div class="row">
        <?

        foreach ($companies as $item) {
            echo $this->require( '/render/cards/ZYandexCompanyPriceWidget/ready/company-price.php', [
                'company' => $item
            ]);
        }
        ?>
    </div>
</div>


<?php
echo ZFooterAllWidget::widget();
echo ZJspanelWidget::widget([]);
?>
<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>
