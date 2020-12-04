<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\models\shop\ShopOrder;
use zetsoft\models\shop\ShopOrderItem;
use zetsoft\service\forms\Active;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZUrl;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\former\ZFormBuildWidget;
use zetsoft\widgets\navigat\ZButtonWidget;
use zetsoft\widgets\themes\ZCardWidget;


/** @var ZView $this */


/**
 *
 * Action Params
 */

$action = new WebItem();

$action->title = Azl . 'Назначение заказов курьеру';


$action->icon = 'fal fa-film';
$action->type = WebItem::type['html'];
$action->csrf = true;
$action->debug = true;
$action->layout = true;
$action->layoutFile = 'admin';


$this->paramSet(paramAction, $action);

$this->title();

$this->toolbar();

?>

<div id="content" class="content-footer p-3">


    <div class="row">

        <div class="col-md-12 mx-auto">

            <?php

            $shop_order_id = $this->httpGet('shop_order_id');

            $shopOrder = ShopOrder::findOne($shop_order_id);

            if ($shopOrder === null)
                return null;

            $shopOrder->configs->nameOn = [
                'operator',
                'status_callcenter',
            ];


            $shopOrder->cards = [
                [
                    'title' => Az::l('Первый этап'),
                    'shows' => true,
                    'items' => [

                        [
                            'title' => Az::l('Форма'),

                            'shows' => true,
                            'items' => [

                                [
                                    'contact_name',
                                    'contact_phone',
                                    'add_contact_phone',
                                ],

                                [
                                    'date_deliver',
                                    'operator',
                                    'status_callcenter'
                                ]

                            ],
                        ],

                    ],
                ],
            ];


            $shopOrder->configs->rules = [
                'date_deliver' => validatorSafe,
                'contact_name' => validatorSafe
            ];


            $shopOrder->configs->hasLabel = true;

            $shopOrder->configs->changeSave = true;

            $shopOrder->columns();


            if ($this->modelSave($shopOrder)) {
                $this->urlRedirect(['/shop/supervisor/main/index', true]);
            }


            $active = new Active();

            $active->type = Active::type['vertical'];

            $active->childClass = 'my-3';

            ZCardWidget::begin([
                'config' => [
                    'title' => Az::$app->view->title,
                    'type' => ZCardWidget::type['dynCard'],
                ]
            ]);
            ?>


            <div class="d-flex justify-content-end topBtn mt-0 mb-3">
                <?php

                echo ZButtonWidget::widget([
                    'config' => [
                        'text' => Az::l('Оформить и закрыть'),
                        'btnRounded' => false,
                        'btnType' => ZButtonWidget::btnType['link'],
                        'url' => ZUrl::to(['/shop/supervisor/main/index', true])
                    ]
                ]);
                ?>
            </div>

            <?php

            $form = $this->activeBegin($active);

            echo ZFormBuildWidget::widget([
                'model' => $shopOrder,
                'form' => $form,
                'config' => [
                    'btnTitle' => Az::l('Оформить и закрыть'),
                    'stepType' => ZFormBuildWidget::stepType['none'],
                    'blockType' => ZFormBuildWidget::blockType['naked'],
                    'botBtn' => false,
                    'topBtn' => false,
                    'showCancelBtn' => false
                ]
            ]);

            $this->activeEnd();

            ZCardWidget::end();

            ?>

        </div>


        <div class="mt-5 mx-auto col-md-12">

            <?

            $shopOrderItem = new ShopOrderItem();

            $shopOrderItem->query = ShopOrderItem::find()
                ->where([
                    'shop_order_id' => $shopOrder->id,
                ]);

            $shopOrderItem->configs->nameOn = [
                'id',
                //'name',
                'shop_catalog_id',
                'user_company_id',
                'amount',
                'price',
                'price_all',
                'date_deliver',
                'status_logistics',
                'place_adress_id',
                'date_deliver'
            ];


            $shopOrderItem->configs->readonly = [
                'shop_catalog_id',
                'price',
                'price_all',
            ];

            $shopOrderItem->configs->dynaButtons = [
                'add-tabular-clone-delete' =>
                    [
                        'content' => '{add}{delete}',
                        'options' => ['class' => 'btn-group p-1 mr-0 {btnSize} {iconSize}']
                    ],

            ];


            $shopOrderItem->columns();

            echo ZDynaWidget::widget([

                'model' => $shopOrderItem,

                'rightNameEx' => [
                    'system'
                ],

                'config' => [

                    'spaHeight' => [
                        'create' => '700px',
                        'choose' => '800px'
                    ],

                    'spaWidth' => [
                        'create' => '700px',
                        'choose' => '900px'
                    ],

                    'createUrl' => ZUrl::to(['/shop/supervisor/main/create-order-item', 'shop_order_id' => $shopOrder->id]),

                    'hasToolbar' => true,
                    'spa' => true,
                    'title' => Az::l('Подобранные заказы'),
                    'search' => false,
                    'headerIcon' => '',
                    'bordered' => false,

                    'columnBefore' => [
                        'checkbox',
                        'serial',
                        'id'
                    ],

                    'columnAfter' => false,

                ]

            ]);
            ?>

        </div>
    </div>

</div>
