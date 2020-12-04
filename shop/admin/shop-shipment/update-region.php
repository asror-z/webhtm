<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\models\place\PlaceAdress;
use zetsoft\models\place\PlaceRegion;
use zetsoft\models\shop\ShopCourier;
use zetsoft\service\forms\Active;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\former\ZDynaWidgetRav;
use zetsoft\widgets\former\ZFormBuildWidget;
use zetsoft\widgets\former\ZFormWidget;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;
use zetsoft\widgets\themes\ZCardWidget;
use zetsoft\models\shop\ShopShipment;


/** @var ZView $this */


/**
 *
 * Action Params
 */

$action = new WebItem();

$action->title = Azl . 'Редактирование заказа';
$action->icon = 'fal fa-area-chart';
$action->type = WebItem::type['html'];
$action->csrf = true;
$action->debug = false;



$this->paramSet(paramAction, $action);

$this->title();
$this->toolbar();


/**
 *
 * Start Page
 */

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

echo ZNProgressWidget::widget([]);

?>

<div id="page">

    <div id="content" class="content-footer p-3">

        <div class="row">

            <div class="col-md-12 col-12">

                <?

                $id = $this->httpGet('id');
                $shop_shipment_id = $this->httpGet('shop_shipment_id');

                $active = new Active();

                $form = $this->activeBegin($active);

                $model = ShopCourier::findOne($id);

                if ($this->modelSave($model)) {
                    $this->paramSet(paramIframe, true);
                    $this->urlRedirect([
                        'process',
                        'shop_shipment_id' => $shop_shipment_id
                    ]);
                }

                $model->columns();

                echo ZFormBuildWidget::widget([
                    'model' => $model,
                    'form' => $form,
                    'config' => [
                        'topBtn' => false
                    ]
                ]);

                $this->activeEnd();

                ?>

            </div>

        </div>


    </div>

</div>


<?php $this->endBody() ?>

<script>

    var parentWindow = window.parent.document;
    var title = parentWindow.getElementById('swal2-title')

    $(title).show()
    $(title).html("<?=$model->name?>")

</script>

</body>
</html>

<?php $this->endPage() ?>
