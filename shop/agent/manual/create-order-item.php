<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\models\shop\ShopOrderItem;
use zetsoft\service\forms\Active;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZFormBuildWidget;
use zetsoft\widgets\former\ZFormWidget;
use zetsoft\widgets\inputes\ZDepdropWidget;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;
use zetsoft\widgets\themes\ZCardWidget;
use zetsoft\models\shop\ShopOrder;


/** @var ZView $this */


/**
 * Action Params
 */

$action = new WebItem();

$action->title = Azl . 'Создание Заказы';
$action->icon = 'fal fa-power-off';
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

    <?

    echo ZSessionGrowlWidget::widget();?>

    <div id="content" class="content-footer p-3">


            <div class="row">
            <div class="col-md-12 col-12">

                <?

                $id = $this->httpGet('shop_order_id');

                $model = new ShopOrderItem();

                $model->configs->nameOn = [
                    'user_company_id',
                    'shop_catalog_id',
                    'amount'
                ];

                $model->configs->widget = [
                    'shop_catalog_id' => ZDepdropWidget::class
                ];
               $model->configs->options = [
                    'shop_catalog_id' => [
                        'config' => [
                            'depend' => 'user_company_id',
                            'method' => 'getCompaniesCatalog'
                        ]
                    ]
                ];

                $model->shop_order_id = $id;

                $model->columns();

                if ($this->modelSave($model)) {


                    echo "<script language='javascript'> parent.location.reload() </script>";

                    /**
                     *
                     * Post save Actions
                     */

                    /*$this->paramSet(paramIframe, true);
                    $this->urlRedirect([
                        'update-after',
                        'id' => $id
                    ], false);*/

                }


                ZCardWidget::begin([
                    'config' => [
                        'title' => Az::$app->view->title,
                        'type' => ZCardWidget::type['dynCard'],
                    ]
                ]);


                $get = $this->httpGet();

                $active = new Active();

                $active->id = ZArrayHelper::getValue($get, 'formId');

                $form = $this->activeBegin($active);


                /*$model->configs->rules = [
                    [validatorSafe]
                ];
                $model->columns();*/
                echo ZFormWidget::widget([
                    'model' => $model,
                    'form' => $form,
                ]);

                $this->activeEnd();

                ZCardWidget::end();


                ?>

            </div>
        </div>



    </div>

</div>


<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>
