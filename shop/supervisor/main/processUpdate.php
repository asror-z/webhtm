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
use zetsoft\widgets\menus\ZMmenuWidget;
use zetsoft\widgets\navigat\ZButtonWidget;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;
use zetsoft\widgets\themes\ZCardWidget;


/** @var ZView $this */


/**
 *
 * Action Params
 */

$action = new WebItem();

$action->title = Azl . 'Изменить заказа';


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

echo ZMmenuWidget::widget([

]);

?>

<div id="page">

    <?

    require Root . '/webhtm/block/navbar/admin.php';

    echo ZSessionGrowlWidget::widget(); ?>

    <div id="content" class="content-footer p-3">


        <div class="row">

            <div class="col-md-12 mx-auto">

                <?php

                $shop_order_id = $this->httpGet('shop_order_id');

                $shopOrder = ShopOrder::findOne($shop_order_id);

                if ($shopOrder === null)
                    return null;

                $shopOrder->configs->nameOn = [
                    'contact_name',
                    'contact_phone',
                    'add_contact_phone',
                    'date_deliver',
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

                $shopOrder->configs->changeSave = true;
                $shopOrder->configs->hasLabel = true;

                $shopOrder->columns();

                $place = PlaceAdress::findOne($shopOrder->place_adress_id);

                if ($place === null) {
                    $place = new PlaceAdress();
                    $place->configs->rules = validatorSafe;

                    if ($place->save()) {
                        $shopOrder->place_adress_id = $place->id;
                        $shopOrder->place_region_id = $place->place_region_id;
                        $shopOrder->configs->rules = validatorSafe;
                        if ($shopOrder->save()) {
                            $this->urlRedirect([
                                '/shop/supervisor/main/processUpdate',
                                'shop_order_id' => $shopOrder->id
                            ]);
                        }
                    }
                }

                $place->cards = [
                    [
                        'title' => Az::l('Первый этап'),
                        'shows' => true,
                        'items' => [

                            [
                                'title' => Az::l('Форма'),

                                'shows' => true,
                                'items' => [

                                    [
                                        'place_country_id',
                                    ],

                                    [
                                        'region_form',
                                        'place_region_id',

                                    ],

                                    [
                                        'street',
                                    ],

                                    [

                                        'home',
                                        'orientation',
                                        'postal_code',

                                    ],

                                    [
                                        'place',
                                    ],
                                    [

                                        'location'
                                    ]

                                ],
                            ],

                        ],
                    ],
                ];

                $place->configs->changeSave = true;
                $place->configs->changeReloadId = '#supervisor-pjax';
                $place->configs->changeReload = true;

                $place->configs->nameOff = [
                    'name'
                ];

                $place->configs->readonly = [
                    'place_region_id'
                ];

                $place->columns();

                if ($this->modelSave($shopOrder)) {
                    $this->urlRedirect(['index', true]);
                }


                if ($this->modelSave($place)) {

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
                        ],
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

                echo EOL . "<hr>";

                $this->pjaxBegin(function (ZPjax $pjax) {
                    $pjax->id = 'supervisor-pjax';
                    return $pjax;
                });

                echo ZFormBuildWidget::widget([
                    'model' => $place,
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

                $this->pjaxEnd();

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
                    'price',
                    'price_all',
                    'shop_catalog_id',
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

                        'createUrl' => ZUrl::to(['/shop/supervisor/main/create-order-item-update', 'shop_order_id' => $shopOrder->id]),

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

</div>

<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>
