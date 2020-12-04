<?php

/**
 *
 * @author OtabekNosirov
 * @author JaloliddinovSalohiddin
 * @author AkromovAzizjon
 *
 * Word Pdf generatsiyasi uchun @api
 *
 * /shop/complect/on-complect/index.aspx#
 * /shop/admin/ware-send/index.aspx#
 * /shop/admin/ware-return/index.aspx#
 */

use zetsoft\dbitem\core\WebItem;
use zetsoft\former\chart\ChartForm;
use zetsoft\former\order\OperatorForm;
use zetsoft\former\order\OrderForm;
use zetsoft\former\order\PayBackCCForm;
use zetsoft\former\order\PortionFormForm;
use zetsoft\former\reports\ReportsCourierForm;
use zetsoft\former\reports\ReportsSoldProductsForm;
use zetsoft\models\shop\ShopOrder;
use zetsoft\models\shop\ShopOrderItem;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\charts\ZChartFormWidget;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\themes\ZCardWidget;

/** @var ZView $this */
$action = new WebItem();

$action->csrf = true;
$action->debug = true;
$action->cache = false;
$action->call = null;
$action->cacheHttp = false;

$action->type = WebItem::type['ajax'];

$this->paramSet(paramAction, $action);

$post = $this->httpPost();

$ids = ZArrayHelper::getValue($post, 'checkKeys');

$getId = $this->httpGet('modelId');

if (!empty($getId)) {
    $ids = [$getId];
}

$type = $this->httpGet('type');

$attr = $this->httpGet('attribute');
$val = $this->httpGet('value');

$modelClassName = $this->httpGet('modelClassName');
$requiredClassName = $this->httpGet('requiredClassName');
$modelClass = $this->bootFull($modelClassName);
$requiredClass = $this->bootFull($requiredClassName);

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
        'error' => Az::l('Выберите корректный заказ. Данный(е) заказ(ы) является(ются) дочерним(и)')
    ]);

    return;
}

$path = Az::$app->office->wordpdf->universalDocument($cleanIds, $type);

$domain = $this->urlGetBase();

$errors = null;
if (!empty($dirtyIds)) {
    $strings = implode(',', $dirtyIds);
    $errors = Az::l("Заказ(ы) $strings является дочерним(и)");
}

echo json_encode([
    'path' => $domain . $path,
    'error' => $errors
]);
