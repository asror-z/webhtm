<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\service\forms\Active;
use zetsoft\service\forms\Ajaxer;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZUrl;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZFormBuildWidget;
use zetsoft\widgets\former\ZFormWidget;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;
use zetsoft\widgets\themes\ZCardWidget;
use zetsoft\models\shop\ShopShipment;
use zetsoft\models\shop\ShopOrder;


/** @var ZView $this */


/**
 *
 * Action Params
 */

$action = new WebItem();

$action->title = Azl . 'Создание Заказы к доставке';
$action->icon = 'fal fa-birthday-cake';
$action->type = WebItem::type['ajax'];
$action->csrf = true;
$action->debug = true;



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

    <?

    require Root . '/webhtm/block/navbar/main.php';

    echo ZSessionGrowlWidget::widget();?>

<div id="content" class="content-footer p-3">

    <div class="row">
        <div class="col-md-12 col-12">

            <?


            $formId = $this->httpGet('formId');
            $model = new ShopOrder();

            if ($this->httpPost('ShopOrder')) {
                $model->setAttributes($this->httpPost('ShopOrder'));
                if ($model->save()) {
                    $this->urlRedirect([
                        'process',
                        'id' => $this->httpGet('id')
                    ]);
                }
            }

            $active = new Ajaxer();
            $active->id = $formId;
            $active->formAction = ZUrl::to(['create-order', 'id' => $this->httpGet('id')]);
            $active->success = <<<JS
        function() {
          
            $('#ShopOrder-modal').modal('hide')
            $('#ShopOrder_Grid_Reset').click()
          
        }
JS;

            $form = $this->ajaxBegin($active);

            $model->configs->value = [
                'shop_shipment_id' => $this->httpGet('id')
            ];
            $model->columns();
            echo ZFormWidget::widget([
                'model' => $model,
                'form' => $form,
            ]);

            $this->ajaxEnd();


            ?>

        </div>
    </div>


</div>

</div>


<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>
