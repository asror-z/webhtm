<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\models\place\PlaceAdress;
use zetsoft\models\shop\ShopOrderItem;
use zetsoft\service\forms\Active;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZUrl;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\former\ZDynaWidgetD;
use zetsoft\widgets\former\ZFormWidget;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;
use zetsoft\widgets\themes\ZCardWidget;
use zetsoft\models\shop\ShopOrder;


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
$action->debug = false;

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

    <style>

        .pac-container {

            top: -285% !important;

        }
    </style>
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

                $placeAdress = PlaceAdress::findOne($model->place_adress_id);

                if ($placeAdress === null)
                    $placeAdress = new PlaceAdress();




                $active = new Active();

                $form = $this->activeBegin($active);

                $isCard = true;
                if ($this->httpGet('spa'))
                    $isCard = false;

                echo ZFormWidget::widget([
                    'model' => $model,
                    'form' => $form,
                    'config' => [
                        'isCard' => $isCard,
                        'botBtn' => false,
                    ],
                  
                ]);

                $this->activeEnd();

                if (null !== $placeAdress) {
                    $placeAdress->configs->rules = [
                        'place' => [
                            [validatorSafe]
                        ]
                    ];
                    $placeAdress->columns();
                    /* vdd($placeAdress->columns);*/
                }
                $active = new Active();

                $form = $this->activeBegin($active);

                $isCard = true;
                if ($this->httpGet('spa'))
                    $isCard = false;

                echo ZFormWidget::widget([
                    'model' => $placeAdress,
                    'form' => $form,
                    'config' => [
                        'isCard' => $isCard,
                        'topBtn' => false,
                    ],
                ]);

                $this->activeEnd();

                $items = new ShopOrderItem();
                $items->query = ShopOrderItem::find()->where(['shop_order_id' => $model->id]);
                $items->configs->nameOn = [
                    //'shop_order_id',
                    'shop_catalog_id',
                    'user_company_id',
                    'amount',
                    'price',
                    'price_all',
                ];
                $items->configs->readonly = [
                    'amount'
                ];

                $items->columns();


                echo ZDynaWidget::widget([
                    'model' => $items,
                    'rightName' => [
                        'add-clone-delete'
                    ],
                    'rightBtn' => [
                        'add-clone-delete' => [
                            'content' => '{add}{delete}',
                        ]
                    ],
                    'config' => [
                        'createUrl' => ZUrl::to([
                            'create-order-item',
                            'shop_order_id' => $model->id
                        ]),
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
