<?php


use League\CLImate\Decorator\Component\Format;
use yii\web\Response;
use zetsoft\dbitem\core\WebItem;
use zetsoft\former\chart\ChartForm;
use zetsoft\former\order\OrderOperatorForm;
use zetsoft\former\order\OrderForm;
use zetsoft\former\order\OrderPayBackCCForm;
use zetsoft\former\order\OrderPortionFormForm;
use zetsoft\former\reports\CourierReportForm;
use zetsoft\former\reports\SoldProductsForm;
use zetsoft\models\shop\ShopOrder;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\helpers\ZUrl;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\charts\ZChartFormWidget;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\themes\ZCardWidget;

/**
 * @author Daho
 */
/** @var ZView $this */
$action = new WebItem();

$action->csrf = true;
$action->debug = true;
$action->cache = false;
$action->call = null;
$action->cacheHttp = false;

$action->type = WebItem::type['ajax'];
Az::$app->response->format = Response::FORMAT_JSON;
$this->paramSet(paramAction, $action);

$post = $this->httpPost();
$ids = ZArrayHelper::getValue($post, 'checkKeys');
$type = $this->httpGet('type');

$attr = $this->httpGet('attribute');
$val = $this->httpGet('value');

$modelClassName = $this->httpGet('modelClassName');
$requiredClassName = $this->httpGet('requiredClassName');
$modelClass = $this->bootFull($modelClassName);
$requiredClass = $requiredClassName ? $this->bootFull($requiredClassName) : null;

$dirtyIds = [];
$cleanIds = [];

foreach ($ids as $id) {

    $order = ShopOrder::findOne($id);

    if (!empty($order->parent))
        $dirtyIds[] = $id;
    else
        $cleanIds[] = $id;

}

if (empty($cleanIds)) {

    echo json_encode([
        'error' => Az::l('Выберите корректный заказ. Эти заказы являются дочерними')
    ]);

    return;
}

$orders = ShopOrder::find()
    ->where([
        'id' => $cleanIds
    ])
    ->all();
    
/** @var ShopOrder $order */

$path = Az::$app->office->wordpdf->universalDocument($cleanIds, 'multiContract');

foreach ($orders as $order) {
    $order->status_logistics = ShopOrder::status_logistics['on_complecting'];
    $order->configs->rules = validatorSafe;
    $order->save();
}

$errors = null;
if (!empty($dirtyIds)) {
    $strings = implode(',', $dirtyIds);
    $errors = Az::l("Заказ(ы) $strings является дочерним(и)");
}

$domain = $this->urlGetBase();

echo json_encode([
    'path' => $domain . $path,
    'error' => $errors
]);


