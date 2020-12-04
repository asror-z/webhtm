<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\models\shop\ShopCatalog;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\system\module\Models;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZFormBuildWidget;
use zetsoft\widgets\former\ZFormWidget;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;
use zetsoft\widgets\themes\ZCardWidget;
use zetsoft\models\shop\ShopBrand;
use function Dash\toArray;
use function GuzzleHttp\json_decode;

/** @var ZView $this */
/**
 *
 * @license Shahzod Gulomqodirov
 */
$action = new WebItem();
$action->title = Azl . 'Создание Бренды';
$action->icon = 'fa fa-globe';
$action->type = WebItem::type['html'];
$action->csrf = true;
$action->debug = true;
$action->cache = false;
$action->call = null;
$action->cacheHttp = false;
$this->paramSet(paramAction, $action);
/**
 *
 * Start Page
 */
$this->beginPage();
?>
<body class="<?= ZWidget::skin['white-skin'] ?>">
<?php
$this->beginBody();
$client = new GuzzleHttp\Client();
//http://arbit.zetsoft.uz/cpas/admin/catalogs.aspx
$res = $client->request('Post', '/api/shop/cpas/get-catalog.aspx', [
    'form_params' => [
        'id' => 200
    ]
]);
$response = json_decode($res->getBody());

foreach ($response as $key => $value) {
    $m = ShopCatalog::findOne($value->id);
    if ($m !== null)
        continue;
    $model = new ShopCatalog();
    $model->load(toArray($value), '');
    $model->configs->rules = [
        [validatorSafe]
    ];
    $model->columns();
    $model->save();
}
return $this->urlRedirect(['/cpas/admin/offer'], false);
?>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
