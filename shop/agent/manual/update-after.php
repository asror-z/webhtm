<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\models\shop\ShopOrder;
use zetsoft\models\shop\ShopOrderItem;
use zetsoft\system\assets\ZColor;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZUrl;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\navigat\ZButtonWidget;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;
use zetsoft\widgets\themes\ZCardWidget;


/** @var ZView $this */


/**
 *
 * Action Params
 */

$action = new WebItem();

$action->title = Azl . 'Редактирование Заказы';


$action->icon = 'fal fa-lock';
$action->type = WebItem::type['html'];
$action->csrf = true;

if ($this->httpGet('spa'))
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

    if (!$this->httpGet('spa'))
        //require Root . '/webhtm/block/navbar/main.php';

        echo ZSessionGrowlWidget::widget();?>

    <div id="content" class="content-footer p-3">


        <div class="row">
            <div class="col-md-12 col-12">

                <?


                $id = $this->httpGet('id');
                $model = ShopOrder::findOne($id);

                ZCardWidget::begin([
                    'config' => [
                        'title' => Az::$app->view->title,
                        'type' => ZCardWidget::type['dynCard'],
                    ]
                ]);


                $model->columns();
                $items = new ShopOrderItem();
                $items->query = ShopOrderItem::find()->where(['shop_order_id' => $model->id]);

                $items->configs->nameOn = [
                    'shop_order_id',
                    'user_company_id',
                    'shop_catalog_id',
                    'amount'
                ];
                $items->configs->readonly = [
                    'amount'
                ];
                $items->columns();

                $save = ZButtonWidget::widget([
                    'config' => [
                        'url' => ZUrl::to([
                            '/shop/agent/manual/all',
                            'id' => $model->id
                        ]),
                        'btnType' => ZButtonWidget::btnType['link'],
                        'btnSize' => ZColor::btnSize['default'],
                        'btnRounded' => false,
                        'btnFloating' => false,
                        'title' => Az::l('s'),
                        'toggle' => ZButtonWidget::toggle['tooltip'],
                        'hasIcon' => true,
                        'icon' => 'fal fa-save',


                    ],

                ]);


                echo ZDynaWidget::widget([
                    'model' => $items,
                    'rightName' => [
                        'add-clone-delete'
                    ],
                    'rightBtn' => [
                        'add-clone-delete' => [
                            'content' => "{$save}{add}{delete}",
                        ]
                    ],
                    'config' => [
                        'createUrl' => ZUrl::to(['create-order-item', 'shop_order_id' => $model->id]),
                        'columnBefore' => ['checkbox'],
                        'columnAfter' => ['false'],
                    ]
                ]);

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
