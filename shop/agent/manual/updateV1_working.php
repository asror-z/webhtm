<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\models\place\PlaceAdress;
use zetsoft\models\shop\ShopOrderItem;
use zetsoft\service\forms\Active;
use zetsoft\system\assets\ZColor;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\helpers\ZUrl;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\former\ZDynaWidgetD;
use zetsoft\widgets\former\ZFormWidget;
use zetsoft\widgets\navigat\ZButtonWidget;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;
use zetsoft\widgets\themes\ZCardWidget;
use zetsoft\models\shop\ShopOrder;
use function Dash\Curry\filter;


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

                ZCardWidget::begin([
                    'config' => [
                        'title' => Az::$app->view->title,
                        'type' => ZCardWidget::type['dynCard'],
                    ]
                ]);
                
                $active = new Active();

                $active->enableAjaxValidation = true;


                $form = $this->activeBegin($active);


                $id = $this->httpGet('id');


                $order = ShopOrder::findOne($id);


                /*$order->configs->rules = [
                    'date_deliver' => function (ShopOrder $model) {

                        if ($model->status_callcenter === ShopOrder::status_callcenter['approved']) {
                            return 'zetsoft\\system\\validate\\ZRequiredValidator';
                        }
                        return validatorSafe;
                    }

                ];*/


                $order->configs->options = [
                    'status_callcenter' => [
                        'event' => [
                            'select' => <<<JS
                function() {
                 var Selected = $(this).val()
                if(Selected == 'approved'){
                
                    $("#shoporder-date_deliver").attr('required', 'required');
                   // $("#shoporder-date_deliver").addClass( "bg-danger" );
                    
               }else {
               
                  $("#shoporder-date_deliver").removeAttr('required');
                  
                  //$("#shoporder-date_deliver").removeClass( "bg-danger");
           }
    }
JS,
                        ]
                    ]
                ];


                $order->configs->changeSave = true;

                $place = PlaceAdress::findOne($order->place_adress_id);

                if ($place === null)
                    $place = new PlaceAdress();


                $place->configs->changeSave = true;

                $place->configs->nameOff = [
                    'name'
                ];

                $order->configs->nameOn = [
                    'contact_name',
                    'status_callcenter',
                    'comment_agent',
                    'tasks',
                    'add_contact_phone',
                    'date_deliver',

                    //'place_region_id',
                    //'place_adress_id',
                ];
                
                $order->configs->readonlyWidget = [
                    'tasks'
                ];


                $order->columns();

                $place->columns();


                if ($this->modelSave($place)) {
                    $order->place_adress_id = $place->id;
                }
                
                if ($this->modelSave($order)) {
                
                    $this->paramSet(paramIframe, true);
                    
                    $this->urlRedirect([
                        'main',
                        'sort' => '',
                    ]);
                    
                }




                /*        $order->configs->options = [
                            'status_callcenter' => [
                                'event' => [
                                    'select' => <<<JS
            function() {


                    setTimeout(function() {
                       location.reload();
                    }, 1000)
            }
        JS

                                ]
                            ]
                        ];*/

                /*$order->configs->autoSave = true;*/
                //$order->validate();



                ZCardWidget::begin([
                    'config' => [
                        'hasTitle' => false,
                    ]
                ]);
                ?>
                
                <div class="d-flex justify-content-end topBtn mt-0 mb-3">
                 <!-- button for save and send ajax for change status of agent  -->
                    <?
                    echo ZButtonWidget::widget([
                        'config' => [
                            'pjax' => 0,
                            'btnRounded' => true,
                            'text' => Az::l(' Сохранить'),
                            'btnType' => ZButtonWidget::btnType['submit'],

                        ],
                        'event' => [
                            'click' => <<<JS
                              function (event){
                                 $.ajax({
                                     type: "GET",
                                     url: '/core/agent/setOnline.aspx',
                                     data:{
                                         agentId: "{$this->userIdentity()->id}",
                                     },
                                 });
                            }
JS

                        ],
                    ]);
                    ?>

                </div>
                <?
                   //
                echo ZFormWidget::widget([

                    'model' => $order,
                    'form' => $form,
                    'config' => [
                        'topBtn' => false,
                        'botBtn' => false
                    ]
                ]);
                
                ZCardWidget::end();
                echo EOL;
                ZCardWidget::begin([
                    'config' => [
                        'hasTitle' => false,
                    ]
                ]);
                
                echo ZFormWidget::widget([
                    'model' => $place,
                    'form' => $form,
                    'config' => [
                        'botBtn' => false,
                        'topBtn' => false
                    ]
                ]);
                
                ZCardWidget::end();

                $this->activeEnd();

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
                            'shop_order_id' => $order->id
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

<script>


</script>


<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>
