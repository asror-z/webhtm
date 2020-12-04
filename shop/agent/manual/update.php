<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\models\place\PlaceAdress;
use zetsoft\models\shop\ShopOrder;
use zetsoft\models\shop\ShopOrderItem;
use zetsoft\service\forms\Active;
use zetsoft\service\forms\ZPjax;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZUrl;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\former\ZFormBuildWidget;
use zetsoft\widgets\former\ZFormWidget;
use zetsoft\widgets\inputes\ZKSelect2Widget;
use zetsoft\widgets\inputes\ZSelect2Widget;
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

        echo ZSessionGrowlWidget::widget(); ?>

    <div id="content" class="content-footer p-3">


        <div class="row">
            <div class="col-md-12 col-12">

                <?php

                ZCardWidget::begin([
                    'config' => [
                        'title' => Az::$app->view->title,
                        'type' => ZCardWidget::type['dynCard'],
                    ]
                ]);

                global $boot;

                $active = new Active();

                $active->enableAjaxValidation = true;


                $form = $this->activeBegin($active);

                $id = $this->httpGet('id');

                $order = ShopOrder::findOne($id);

                $order->configs->options = [
                    'status_callcenter' => [
                        'active' => [
                            'selecting' => true,
                        ],
                        'event' => [
                            'selecting' => <<<JS
                                
                            var Selected = $(this).val()
                            
                            if ( Selected == 'approved' ) {
                                $("#shoporder-date_deliver").attr('required', 'required');
                            } else {
                               $("#shoporder-date_deliver").removeAttr('required');
                            }
JS,
                        ],
                    ],
                ];

                $order->configs->changeSave = true;

                $place = PlaceAdress::findOne($order->place_adress_id);

                if ($place === null) {

                    $place = new PlaceAdress();

                    $place->configs->rules = validatorSafe;

                    if ($place->save()) {

                        $order->place_adress_id = $place->id;

                        $order->place_region_id = $place->place_region_id;

                        $order->configs->rules = validatorSafe;

                        if ($order->save()) {
                            $this->urlRedirect([
                                '/shop/agent/manual/update',
                                'id' => $order->id
                            ]);
                        }

                    }
                }


                $place->configs->changeSave = true;
                //start  www.ravshan.uz
                $place->configs->changeReloadId = '#agent-pjax';
                //end www.ravshan.uz
                $place->configs->changeReload = true;

                $place->configs->nameOff = [
                    'name',
                ];
                $place->configs->readonlyWidget = [
                    'place_region_id'
                ];
                $order->configs->nameOn = [
                    'contact_name',
                    'status_callcenter',
                    'comment_agent',
                    'tasks',
                    'add_contact_phone',
                    'date_deliver',
                    'time_deliver',
                    //'place_region_id',
                    //'place_adress_id',

                ];

                $order->configs->readonlyWidget = [
                    'tasks'
                ];

                $order->configs->options = [
                    'date_deliver' => [
                        'config' => [
                            'startDate' => Az::$app->cores->date->dateTime()
                        ]
                    ]
                ];

                $order->columns();
                $place->columns();

                if ($this->modelSave($place)) {

                    /* $order->place_adress_id = $place->id;
                     $order->place_region_id = $place->place_region_id;*/

                }

                if ($this->modelSave($order)) {

                    $this->paramSet(paramIframe, true);

                    $this->urlRedirect([
                        'main',
                        'sort' => '',
                    ]);

                }

                ZCardWidget::begin([
                    'config' => [
                        'hasTitle' => false,
                    ]
                ]);

                ?>

                <div class="d-flex justify-content-end topBtn mt-0 mb-3">
                    <!-- button for save and send ajax for change status of agent  -->
                    <?

                    $callFrom = $this->httpGet('callFrom');

                    echo ZButtonWidget::widget([
                        'config' => [
                            'pjax' => 0,
                            'btnRounded' => true,
                            'text' => Az::l(' Сохранить'),
                            'btnType' => ZButtonWidget::btnType['submit'],

                        ],
                        'event' => [
                            'click' => <<<JS
                            
                                 $.ajax({
                                     type: "GET",
                                     url: '/core/agent/setOnline.aspx',
                                     data:{
                                         agentId: "{$this->userIdentity()->id}",
                                         callFrom: "{$callFrom}",
                                     },
                                 });
JS
                        ],
                    ]);
                    ?>

                </div>
                <?
                echo ZFormBuildWidget::widget([
                    'model' => $order,
                    'form' => $form,
                    'config' => [
                        'topBtn' => false,
                        'botBtn' => false
                    ]
                ]);

                ZCardWidget::end();

                $this->activeEnd();

                echo EOL;

                ZCardWidget::begin([
                    'config' => [
                        'hasTitle' => false,
                    ]
                ]);

                $this->paramSet(paramChangeReloadId, 'supervisor-create-pjax');
                $form2 = $this->activeBegin();

                echo ZFormBuildWidget::widget([
                    'model' => $place,
                    'form' => $form,
                    'config' => [
                        'botBtn' => false,
                        'topBtn' => false
                    ]

                ]);


                $this->activeEnd();
                ZCardWidget::end();


                $items = new ShopOrderItem();

                $items->query = ShopOrderItem::find()->where(['shop_order_id' => $order->id]);

                $items->configs->nameOn = [
                    //'shop_order_id',
                    'shop_catalog_id',
                    'user_company_id',
                    'amount',
                    'price',
                    'price_all',
                ];

                $items->configs->readonly = [
                    'price',
                    'price_all',
                ];

                $items->configs->readonlyOff = [
                    'amount'
                ];

                /*$items->configs->changeSave = true;
                 $items->configs->changeReloadId = '#items-pjax';
                 //end www.ravshan.uz
                 $items->configs->changeReload = true;*/

                $items->columns();


                /* $this->pjaxBegin(function (ZPjax $pjax) {

                     $pjax->id = 'items-pjax';

                     return $pjax;

                 });*/


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
                            'shop_order_id' => $order->id
                        ]),
                        'columnBefore' => ['checkbox'],
                        'columnAfter' => false,
                        'summary' => true,
                        'search' => false,
                    ]
                ]);

                /*     $this->pjaxEnd();*/

                ZCardWidget::end();


                ?>

            </div>
        </div>


    </div>

</div>

<script>


</script>


<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>
