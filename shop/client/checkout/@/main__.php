<?php

use rmrevin\yii\fontawesome\FA;
use zetsoft\dbitem\core\WebItem;
use zetsoft\dbitem\shop\ProductItem;
use zetsoft\dbitem\shop\SingleProductItem;
use zetsoft\former\shop\ShopOrderForm;
use zetsoft\models\place\PlaceAdress;
use zetsoft\models\shop\ShopOrder;
use zetsoft\models\user\User;
use zetsoft\service\forms\Active;
use zetsoft\service\forms\Ajaxer;
use zetsoft\system\assets\ZColor;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\helpers\ZHTML;
use zetsoft\system\helpers\ZUrl;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\former\ZFormWidget;
use zetsoft\widgets\incores\ZMCheckboxWidget;
use zetsoft\widgets\inputes\ZHCheckboxWidget;
use zetsoft\widgets\market\ZFooterAllWidget;
use zetsoft\widgets\market\ZInputSpinnerWidget;
use zetsoft\widgets\navigat\ZButtonWidget;
use zetsoft\widgets\notifier\ZSweetAlertWidget;
use zetsoft\widgets\themes\ZCardWidget;


/** @var ZView $this */

$action = new WebItem();

$action->title = Azl . 'Проверка покупки';
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

/** @var ZView $this */


$items = Az::$app->market->cart->cartOrders(null, true);
//vdd($items);
if (empty($items)) {
    echo ZHTML::tag('div', Az::l('Показаны тестовые данные'), [
        'class' => 'alert alert-warning',
        'role' => 'alert'
    ]);

    /*   $items = [];
       $item = new SingleProductItem();
       $item->id = 2;
       $item->name = 'Арахисовая паста с медом 200г';
       $item->company_name = 'CompanyName';
       $item->title = 'Test Desc';
       $item->new_price = 20;
       $item->total_price = 20;
       $item->price_old = 188920;
       $item->barcode = 34234234;
       $item->exist = ProductItem::exists['not'];
       $item->images = [
           'https://images.pexels.com/photos/1095550/pexels-photo-1095550.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500',
           'https://images.pexels.com/photos/461198/pexels-photo-461198.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500',
           'https://previews.123rf.com/images/veneratio/veneratio1511/veneratio151100044/48203428-landscape-iamge-of-river-flowing-through-lush-green-forest-in-summer.jpg',
           'https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcRVDh2D2fzRSBYnwaA-70G74wjOeeZWbRnEVBMxfu1jVqcP9fMv&usqp=CAU',
       ];
       $item->currency = 'сум';
       $item->currencyType = 'after';
       $item->measure = 'шт';
       $item->rating = 3.5;
       $item->discount = -10;
       $item->catalogId = 19;
       $item->delivery_price = 1200;
       $item->sale = 'sdadsa';
       $item->is_multi = false;
       $item->in_wish = true;
       $item->in_compare = false;
       $item->amount = 1;

       $item2 = new SingleProductItem();
       $item2->id = 3;
       $item2->name = 'Арахиihhuihuiuhiом 200г';
       $item2->company_name = 'NikeName';
       $item2->title = 'Test Desc';
       $item2->new_price = 10;
       $item2->price_old = 188920;
       $item2->currency = 'сум';
       $item2->currencyType = 'after';
       $item2->measure = 'шт';
       $item2->amount = 1;
       $item2->company_image = 's';
       $item2->images = [
           'https://images.pexels.com/photos/1095550/pexels-photo-1095550.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500',
           'https://images.pexels.com/photos/461198/pexels-photo-461198.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500',
           'https://previews.123rf.com/images/veneratio/veneratio1511/veneratio151100044/48203428-landscape-iamge-of-river-flowing-through-lush-green-forest-in-summer.jpg',
           'https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcRVDh2D2fzRSBYnwaA-70G74wjOeeZWbRnEVBMxfu1jVqcP9fMv&usqp=CAU',
       ];

       $items[] = $item;
       $items[] = $item2;
       $items[] = $item2;*/

    //vdd($items);
}


$this->beginPage();
?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" xmlns="http://www.w3.org/1999/html">
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
require Root . '/webhtm/block/navbar/main.php';

$form = $this->httpPost('ShopOrderForm');
//vdd($form);

if (!empty($form)) {

    $save = Az::$app->market->order->saveOrders($form);

    if ($save === true)
        $this->urlRedirect('/client/checkout/success.aspx');
}
?>

<style>

</style>


<?php

?>
<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>
