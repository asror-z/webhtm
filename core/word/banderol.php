<?php


use League\CLImate\Decorator\Component\Format;
use yii\web\Response;
use zetsoft\dbitem\core\WebItem;
use zetsoft\former\chart\ChartForm;
use zetsoft\former\order\OperatorForm;
use zetsoft\former\order\OrderForm;
use zetsoft\former\order\PayBackCCForm;
use zetsoft\former\order\PortionFormForm;
use zetsoft\former\reports\ReportsCourierForm;
use zetsoft\former\reports\ReportsSoldProductsForm;
use zetsoft\models\shop\ShopOrder;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\charts\ZChartFormWidget;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\themes\ZCardWidget;

/** @var ZView $this */
$action = new WebItem();

$action->csrf = false;
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
$requiredClass = $requiredClassName?$this->bootFull($requiredClassName):null;


$this->sessionSet('banderolKeys', $ids);

$orders = ShopOrder::find()
    ->where([
        'id' => $ids
    ])->all();

foreach ($orders as $order)
    if ($order->weight === null || !($order->weight > 0)) {

        return [
            'redirect' => 0,
            'data' => 'update_button_' . $modelClassName . '_' . $order->id
        ];
    }

$path = Az::$app->office->wordpdf->universalDocument($ids, 'multiBanderol');
Az::$app->office->wordpdf->changeStatus($ids,$modelClass,$attr,$val,$requiredClass);

$domain = $this->urlGetBase();
/*echo 1;
return '1';*/

//$this->sessionDel('banderolKeys');
return [
    'redirect' => 1,
    'data' => $domain.$path
];


