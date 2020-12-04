<?php

use Codeception\Exception\ElementNotFound;
use PHPUnit\Util\Exception;
use zetsoft\dbitem\core\WebItem;
use zetsoft\models\shop\ShopOrder;
use zetsoft\models\shop\ShopOrderItem;
use zetsoft\service\forms\Active;
use zetsoft\system\Az;
use zetsoft\system\except\ZException;
use zetsoft\system\helpers\ZUrl;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZBanderolWidget;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\former\ZExportBtnWidget;
use zetsoft\widgets\former\ZFormBuildWidget;
use zetsoft\widgets\former\ZPdfWidget;
use zetsoft\widgets\inputes\ZInputBtnWidget;
use zetsoft\widgets\inputes\ZInputWidget;
use zetsoft\widgets\inputes\ZKDateTimePickerWidget;
use zetsoft\widgets\inputes\ZLibraInputWidget;
use zetsoft\widgets\navigat\ZButtonWidget;
use zetsoft\widgets\notifier\ZKAlertWidget;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;

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
    require Root . '/webhtm/block/header/main.php';
    require Root . '/webhtm/block/navbar/admin.php';


    echo ZSessionGrowlWidget::widget();?>

    <div class="row p-3">
        <div class="mx-auto col-md-12">

            <?
            $order_id = $this->httpGet('shop_order_id');

            $order = ShopOrder::findOne($order_id);

            if ($order === null) {
                throw new ZException(Az::l('Заказ не найден.'));
            }

            $button = ZPdfWidget::widget([
                'config' => [
                    'url' => ZUrl::to([
                        '/core/word/actOb',
                        'type' => 'multiContract',
                    ]),
                    'modelClassName' => 'ShopOrder',
                    'checkKeys' => $order_id,
                    'btnOptions' => [
                        'config' => [

                            'btnStyle' => ZButtonWidget::btnStyle['btn-outline-success'],
                            'btnSize' => ZExportBtnWidget::btnSize['btn-mini'],
                            'btnRounded' => false,
                            'text' => Az::l('Договор заказа')
                        ]
                    ]
                ],
                'event' => [
                    'ajaxComplete' => <<<JS
            function () {

            //location.reload()
           
           }
JS
                ]
            ]);

            $button3 = ZBanderolWidget::widget([
                'id' => 'btn-banderol',
                'config' => [
                    'checkedKeys' => $order_id,
                    'attr' => 'status_logistics',
                    'value' => 'shipment_ready',
                    'url' => ZUrl::to([
                        '/api/shop/cart/banderol',
                        'type' => 'multiBanderol',
                        'attribute' => 'status_logistics',
                        'modelClassName' => $order->className,
                        'value' => 'shipment_ready',
                    ]),
                    'requiredClassName' => 'ShopOrder',
                    'modelClassName' => 'ShopOrder',
                    'btnOptions' => [
                        'config' => [

                            'btnStyle' => ZButtonWidget::btnStyle['btn-outline-success'],
                            'btnSize' => ZExportBtnWidget::btnSize['btn-mini'],
                            'btnRounded' => false,
                            'text' => Az::l('Бандероль')
                        ]
                    ]
                ],
                'event' => [
                    'ajaxComplete' => <<<JS
                                 function() {
                                    //window.location.reload()
                                    //alert('sadas');
                               }
JS
                ]
            ]);


            $order->responsible = $this->userIdentity()->id;

            $order->configs->widget = [
                'date' => ZKDateTimePickerWidget::class,
                'weight' => ZHInputWidget::class
            ];
            $order->cards = [
                [
                    'title' => Az::l('Основное'),
                    'items' => [
                        [
                            'title' => Az::l('Форма'),
                            'items' => [
                                [
                                    'name',
                                    'code',
                                    'responsible',
                                ],
                                [
                                    'date_deliver',
                                    'date',
                                ],
                                [
                                    'date_approve',
                                    'date_return',
                                ],
                                [
                                    'place_adress_id',
                                    'user_company_ids',
                                ],
                                [
                                    'ware_ids',
                                    'operator',
                                ],
                                [
                                    'status_accept',
                                    'packaging',
                                ],
                                [
                                    'weight_plan',
                                    'weight',
                                ]
                            ],
                        ],
                    ],
                ],
                [
                    'title' => Az::l('Клиенты'),
                    'items' => [
                        [
                            'title' => Az::l('Форма'),
                            'items' => [
                                [
                                    'user_id',
                                ],
                                [
                                    'contact_name',
                                ],
                                [
                                    'contact_phone',
                                ],
                                [
                                    'called_time',
                                ],
                            ],
                        ],
                    ],
                ],
            ];

            $order->configs->options = [
                'weight' => [
                    'config' => [
                        'buttonText' => Az::l('Ввес'),
                    ],
                    'event' => [
                        'buttonClick' => <<<JS
                            function() {
                                libra.updateWeight();
                            }
                        JS,
                    ],
                ],

            ];
            
            $order->configs->changeSave = true;

            $order->columns();

            if ($this->modelSave($order))
                $this->urlRedirect(['index', true]);

            $active = new Active();
            $active->type = Active::type['vertical'];
            $active->childClass = 'my-3';

            $form = $this->activeBegin($active);

            $stepType = ZFormBuildWidget::stepType['smartTab'];

            echo ZLibraInputWidget::widget([
                'config' => [
                    'objectName' => 'libra',
                    'mode' => ZLibraInputWidget::mode['manual'],
                    'inputSelector' => '#shop-order-weight',
                    'autorun' => true,
                ],
            ]);

            echo $button . $button3;

            echo ZFormBuildWidget::widget([
                'model' => $order,
                'form' => $form,
                'config' => [
                    'stepOptions' => [
                        'config' => [
                            'mcontent' => 'p-3',
                        ],
                    ],
                    'btnTitle' => Az::l('Сформировать и закрыть'),
                    'botBtn' => false,
                    //'cols' => 12,
                    'stepType' => $stepType,
                    'blockType' => ZFormBuildWidget::blockType['naked']
                ]
            ]);

            $this->activeEnd();

            ?>

        </div>


        <div class="col-md-12 mx-auto mt-5">

            <?php

            $model = new ShopOrderItem();

            $model->configs->query = ShopOrderItem::find()
                ->where([
                    'shop_order_id' => $order_id
                ]);
            $model->configs->nameOff = [
                'shop_order_id',
                'ware_return_id',
                'amount_partial',
                'amount_return',
                'price_all_partial',
                'price_all_return',
                'accepted',
            ];

            if ($order->status_universal !== ShopOrder::status_universal['change']) {
                $model->configs->nameOff = [
                    'check_return',
                    'shop_order_id',
                    'ware_return_id',
                    'amount_partial',
                    'amount_return',
                    'price_all_partial',
                    'price_all_return',
                    'accepted',
                ];
            }
            $model->configs->dynaButtons = [
                'update' => [
                    'content' => '{update}',
                    'options' => ['class' => 'btn-group p-1 mr-0 {btnSize} {iconSize}']
                ],
                'add-tabular-clone-delete' => [
                    'content' => '{add}{clone}{delete}',
                    'options' => ['class' => 'btn-group p-1 mr-0 {btnSize} {iconSize}']
                ],

            ];

            $model->configs->widget = [
                'weight' => ZHInputWidget::class
            ];

            $model->columns();

            /** @var ZView $this */
            echo ZDynaWidget::widget([
                'model' => $model,
                'rightNameEx' => [
                    'system'
                ],
                'config' => [
                    'hasToolbar' => true,
                    'columnBefore' => [
                        'serial',
                        'action',
                        'checkbox',
                        'id'
                    ],
                    'viewUrl' => '{fullUrl}/view-process.aspx?shop_order_id=' . $order_id,
                    'actionButtons' => [
                        'clone',
                        'delete',
                        'view'
                    ],
                    'spaHeight' => [
                        'create' => '800px',
                        'view' => '800px',
                    ],
                    'columnAfter' => false,
                    'deleteAllUrl' => '/api/core/dyna/delete-all.aspx?modelClassName={modelClassName}&shop_order_id=' . $order_id,
                    'createUrl' => '{fullUrl}/create-process.aspx?shop_order_id=' . $order_id,
                    'createTitle' => Az::l('Создание прихода в склад')
                ]

            ]);
            ?>

        </div>

    </div>


    <? require Root . '\webhtm\block\footer\footerAdmin.php' ?>

</div>


<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>
