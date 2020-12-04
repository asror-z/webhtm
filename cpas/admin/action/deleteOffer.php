<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\models\cpas\CpasOffer;
use zetsoft\models\cpas\CpasOfferItem;
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



/** @var ZView $this */


/**
 *
 * Action Params
 */

$action = new WebItem();

$action->title = Azl . 'Создание Бренды';
$action->icon = 'fa fa-globe';
$action->type = WebItem::type['html'];
$action->csrf = true;
$action->debug = true;



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


$post = $this->httpPost();
$id = $this->httpGet('id');



/** @var Models $model */
$model = CpasOffer::findOne($id);
$modelItems = CpasOfferItem::find()
    ->where([
        'cpas_offer_id' => $id
    ])
    ->all();

foreach ($modelItems as $item){
    $item->delete();
}


if ($model->delete())
    return $this->urlRedirect(['/cpas/admin/offer']);



?>
<?php $this->endBody() ?>

</body>

<?php $this->endPage() ?>
