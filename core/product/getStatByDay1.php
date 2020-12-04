<?php


use zetsoft\dbitem\core\WebItem;
use zetsoft\models\shop\ShopOrder;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\former\ZDynaWidget;

/** @var ZView $this */
$action = new WebItem();

$action->csrf = true;
$action->debug = true;
$action->cache = false;
$action->call = null;
$action->cacheHttp = false;

$this->paramSet(paramAction, $action);

$action->type = WebItem::type['ajax'];

$this->paramSet(paramAction, $action);
$day = $this->httpGet('day');
$user_company_id = $this->httpGet('companyId');

$date = date("Y-m-d h:i:s", strtotime("-" . $day . " days"));

$model = new ShopOrder();

$model->configs->query = $user_company_id
    ? ShopOrder::find()
        ->where([
            '>=', 'created_at', $date,
        ])->andWhere([
            'user_company_ids' => $user_company_id
        ])
    : ShopOrder::find()
        ->where([
            '>=', 'created_at', $date,
        ]);

$model->configs->nameShowEx = [];
$model->configs->nameOn = [
    'contact_name',
    'user_id',
    'total_price',
    'status_client',
    'created_at',
];
$model->configs->edit = false;
$model->configs->filter = true;
$model->configs->readonly = true;
$model->columns();

/** @var ZView $this */
echo ZDynaWidget::widget([
    'model' => $model,
    'config' => [
        'hasToolbar' => false,
        'editableLink' => true,
        'search' => true,
        'copy' => false,
        'columnBefore' => [
            'false'
        ],
        'isCard' => false,
        'columnAfter' => ['asd'],
        //'panelTemplate' => '{items}',
        'theme' => 'success',
        'bordered' => false,
        'striped' => false,
    ]
]);

