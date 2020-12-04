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

                if ($this->modelSave($model) || $this->modelSave($placeAdress)) {
                    $placeAdress->place_region_id = $model->place_region_id;
                    $placeAdress->save();

                    $model->place_adress_id = $placeAdress->id;
                    /*$model->configs->rules = [
                        [validatorSafe]
                    ];*/
                    $model->columns();
                    $model->save();

                    $this->paramSet(paramIframe, true);

                    $this->urlRedirect([
                        'main',
                        'sort' => '',
                    ]);
                }


                $model->configs->nameOn = [
                    'contact_name',
                    'status_callcenter',
                    'comment_agent',
                    'tasks',
                    //'place_region_id',
                    //'place_adress_id',
                ];
                $model->configs->readonlyWidget = [
                    'tasks'
                ];


                $model->columns();

                $placeAdress->configs->nameOff = [
                    'name'
                ];
                $placeAdress->columns();

               

                ZCardWidget::begin([
                    'config' => [
                        'title' => Az::$app->view->title,
                        'type' => ZCardWidget::type['dynCard'],
                    ]
                ]);

                $active = new Active();

                $form = $this->activeBegin($active);

                $isCard = true;
                if ($this->httpGet('spa'))
                    $isCard = false;
                ZCardWidget::begin([
                     'config' => [
                         'hasTitle' => false,
                     ]
                ]);
                echo ZFormWidget::widget([
                    'model' => $model,
                    'form' => $form,
                    'config' => [
                        'isCard' => $isCard,
                        'botBtn' => false,
                    ],
                    /*'event' => [
                        'buttonClick' => 'function(){
                                var hangUpButton = document.querySelector(".hangUpButton");
                                hangUpButton.addEventListener("click", function () {
                                phone.terminateSessions();
                                ringing.pause();
                                calling.pause();
                                console.log("HANGUP");
                                console.log("HANGUP");
                                console.log("HANGUP");
                            });

                        }'
                    ]*/
                ]);

                ZCardWidget::end();

                $this->activeEnd();

                $active = new Active();

                $form = $this->activeBegin($active);

                $isCard = true;
                if ($this->httpGet('spa'))
                    $isCard = false;
                ZCardWidget::begin([
                    'config' => [
                        'hasTitle' => false,
                    ]
                ]);
                echo ZFormWidget::widget([
                    'model' => $placeAdress,
                    'form' => $form,
                    'config' => [
                        'isCard' => $isCard,
                        'topBtn' => false,
                    ],
                ]);
                ZCardWidget::end();

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
                            '/shop/agent/manual/create-order-item',
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
