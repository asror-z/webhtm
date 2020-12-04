<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\models\ware\WareEnterItem;
use zetsoft\models\shop\ShopShipment;
use zetsoft\models\shop\ShopOrder;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZUrl;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZCheckButtonWidget;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\former\ZFormWidget;
use zetsoft\widgets\navigat\ZButtonWidget;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;
use zetsoft\widgets\themes\ZCardWidget;
use zetsoft\models\ware\WareEnter;


/** @var ZView $this */


/**
 *
 * Action Params
 */

$action = new WebItem();

$action->title = Azl . 'Редактирование Поступление товаров в склад';


$action->icon = 'fal fa-film';
$action->type = WebItem::type['html'];
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


                $id = $this->httpGet('id');
                $model = ShopShipment::findOne($id);

                if ($this->modelSave($model))
                    $this->urlRedirect(['index', true]);


                ZCardWidget::begin([
                    'config' => [
                        'title' => Az::$app->view->title,
                        'type' => ZCardWidget::type['dynCard'],
                    ]
                ]);

                $form = $this->activeBegin();

                echo ZFormWidget::widget([
                    'model' => $model,
                    'form' => $form,
                    'config' => []
                ]);

                $this->activeEnd();

                ZCardWidget::end();


                $model = new ShopOrder();
                $model->configs->query = ShopOrder::find()
                    ->where([
                        'status_client' => 'accepted'
                    ]);

                /** @var ZView $this */

                $model->configs->readonly = true;

                $model->columns();

                echo ZDynaWidget::widget([
                    'model' => $model,
                    'config' => [
                        'hasToolbar' => false,
                        'spa' => true,
                        'reloadUrl' => ZUrl::to([
                            'process',
                            'id' => $this->httpGet('id')
                        ]),
                        'title' => Az::l('Успешные заказы'),
                        'search' => false,
                        'headerIcon' => '',
                        'createUrlAjax' => ZUrl::to([
                            'create-process-item',
                            'id' => $this->httpGet('id')
                        ]),
                        'width' => 'auto',
                        'bordered' => false,
                        'columnBefore' => [
                            'serial',
                            'radio',
                            'id'
                        ],
                        'createUrl' => ZUrl::to([
                            'create-order',
                            'id' => $this->httpGet('id')
                        ]),
                    ],


                ]);

                ?>

            </div>
        </div>

        <div class="p-2 row justify-content-end dynaCheck">

            <?

            echo ZCheckButtonWidget::widget([

                'config' => [
                    'icon' => 'fas fa-clone',
                    'text' => Az::l('Отправить заказ'),
                    'hasIcon' => true,
                    'grapes' => false,
                    'btnStyle' => ZButtonWidget::btnStyle['btn-outline-success'],
                    'url' => ZUrl::to([
                        'shipment',
                        'shipment_id' => $this->httpGet('id')
                    ]),
                    'title' => 'Клонировать?',
                    'class' => 'checkbox-ShopOrder',
                    'message' => Az::l('Вы хотите клонировать этот элемент(ы)?'),
                    'modelClassName' => 'ShopOrder'
                ]
            ]);

            ?>

        </div>


    </div>

</div>


<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>
