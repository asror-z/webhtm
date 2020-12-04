<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\models\place\PlaceAdress;
use zetsoft\models\shop\ShopOrder;
use zetsoft\models\shop\ShopOrderItem;
use zetsoft\service\cores\Date;
use zetsoft\service\forms\ZPjax;
use zetsoft\system\except\ZException;
use zetsoft\service\forms\Active;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\helpers\ZUrl;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZBanderolWidget;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\former\ZExportBtnWidget;
use zetsoft\widgets\former\ZFormBuildWidget;
use zetsoft\widgets\former\ZGetChecksWidget;
use zetsoft\widgets\former\ZPdfWidget;
use zetsoft\widgets\inputes\ZHInputWidget;
use zetsoft\widgets\inputes\ZInputBtnWidget;
use zetsoft\widgets\inputes\ZInputWidget;
use zetsoft\widgets\inputes\ZKDateTimePickerWidget;
use zetsoft\widgets\inputes\ZLibraInputWidget;
use zetsoft\widgets\navigat\ZButtonWidget;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;
use zetsoft\dbitem\data\TabItem;
use zetsoft\widgets\navigat\ZSmartTabWidget;


/** @var ZView $this */


/**
 *
 * Action Params
 * @author MurodovMirbosit
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

    $this->paramSet(paramTransact, true);
    
    echo ZSessionGrowlWidget::widget(); ?>

    <div class="row p-3">
        <div class="mx-auto col-md-12">

            <?

            echo ZLibraInputWidget::widget([
                'config' => [
                    'objectName' => 'libra',
                    'mode' => ZLibraInputWidget::mode['manual'],
                    'inputSelector' => '#shoporder-weight',
                    'autorun' => true,
                ]
            ]);

            $order_id = $this->httpGet('shop_order_id');

            $order = ShopOrder::findOne($order_id);
//            vdd($order->place_adress_id);

            $place = PlaceAdress::findOne($order->place_adress_id);
            $userId = $this->userIdentity()->id;
            $url = $this->urlArrayStr;
            $className = $order->className;

            $sessionKey = "Cancel-$className-$url-$userId";

            $request = Az::$app->request;
            if (!$request->isAjax && !$request->isPjax && !$request->isPost)
                $this->sessionSet($sessionKey, $order->attributes);

            if ($order === null) {
                throw new ZException(Az::l('Заказ не найден.'));
            }
            $session = Az::$app->cores->session->getCookieSession();
            $cancel = ZButtonWidget::widget([
                'config' => [
                    'btnType' => ZButtonWidget::btnType['button'],

                    'btnStyle' => ZButtonWidget::btnStyle['btn-outline-danger'],
                    'btnSize' => ZButtonWidget::btnSize['btn-mini'],
                    'btnRounded' => false,
                    'text' => Az::l('Отменить'),
                    'class' => 'm-0'
                ],
                'event' => [
                    'click' => <<<JS
        function() {
          
          $.ajax({
            url:'/api/core/tranz/flush.aspx', 
            data:{
                modelName: '{$order->className}|{$place->className}',
                session: '{$session}',
            },
            success: function(response){
                if (response)
                location.reload()   
            }
          })
          
        }
JS,

                ]
            ]);

            $button = ZButtonWidget::widget([
                'config' => [
                    'btnType' => ZButtonWidget::btnType['button'],
                    'btnStyle' => ZButtonWidget::btnStyle['btn-outline-dark'],
                    'btnSize' => ZButtonWidget::btnSize['btn-mini'],
                    'btnRounded' => false,
                    'text' => Az::l('Провести и закрыть'),
                    'class' => 'm-0'
                ],
                'event' => [
                    'click' => <<<JS
        function() {
          
          $.ajax({
            url:'/api/core/tranz/save.aspx', 
            data:{
                modelName: '{$order->className}|{$place->className}',
                session: '{$session}',
            },
            success: function(response){
                 window.location = '/shop/complect/shop-order/index.aspx'  
            }
          })
          
        }
JS,

                ]
            ]);
            $dogovor = ZGetChecksWidget::widget([
                'model' => $order,
                'config' => [
                    'url' => ZUrl::to([
                        '/api/shop/cart/actOb',
                        'type' => 'multiContract',
                        'modelId' => $order_id,
                    ]),
                    'dyna' => false,
                    'noConfirm' => true,
                    'btnOptions' => [
                        'config' => [
                            'btnStyle' => ZButtonWidget::btnStyle['btn-outline-dark'],
                            'btnType' => ZButtonWidget::btnType['button'],
                            'btnSize' => ZExportBtnWidget::btnSize['btn-mini'],
                            'btnRounded' => false,
                            'text' => Az::l('Договор заказа'),
                            'class' => 'm-0'
                        ]
                    ],
                ],
                'event' => [
                    'ajaxSuccess' => <<<JS
            function(data) {
            
                if (data.error) {
                    alert(data.error)
                }
                
                if (data.path) {
                    window.open(data.path, '_blank')
                    window.dynaReload('{$order->className}')
                }
                    
            }
JS,

                ]
            ]);

            $banderol = ZGetChecksWidget::widget([
                'model' => $order,
                'config' => [
                    'url' => ZUrl::to([
                        '/api/shop/cart/banderol',
                        'type' => 'multiBanderol',
                        'modelId' => $order_id,
                        'modelClassName' => $order->className,
                        'value' => 'shipment_ready',
                    ]),
                    'dyna' => false,
                    'noConfirm' => true,
                    'btnOptions' => [
                        'id' => 'btn-banderol',
                        'config' => [

                            'btnType' => ZButtonWidget::btnType['button'],
                            'btnStyle' => ZButtonWidget::btnStyle['btn-outline-dark'],
                            'btnSize' => ZButtonWidget::btnSize['btn-mini'],
                            'btnRounded' => false,
                            'text' => Az::l('Бандероль'),
                            'class' => 'm-0'
                        ]
                    ],
                ],
                'event' => [
                    'ajaxSuccess' => <<<JS
            function(data) {
            
                if (data.error) {
                    bootbox.confirm({
                        title: 'Ошибка',
                        message: data.error,
                        callback: function (result) {
                            
                        }
                    });
                }
            
                if (data.data) {
                    
                    if (data.redirect) {
                         window.open(data.data, '_blank')
                    } else {
                        bootbox.confirm({
                            title: 'Ошибка',
                            message: 'Необходимо заполнить вес заказа!',
                            callback: function (result) {
                                if (result === true)
                                    $('#update'+ data.id).click();
                            }   
                        });
                    }
                    
                }
            
                
                
            }
JS,
                ]
            ]);

            $order->configs->readonlyWidget = [
                'responsible',
                'date',
                'user_company_ids',
                /*  'ware_ids',*/
                'shop_element_ids',
                'number',
                'code'
            ];

            $order->configs->widget = [
                'weight' => ZHInputWidget::class,
            ];

            $order->cards = [
                [
                    'title' => Az::l('Основное'),
                    'items' => [
                        [
                            'title' => Az::l('Форма'),
                            'items' => [
                                [
                                    'number',
                                    'code',
                                    'responsible',
                                    'operator',
                                ],
                                [
                                    'date_deliver',
                                    /*'date_approve',*/
                                    'weight',

                                ],
                                [
                                    // 'place_adress_id',
                                    'time_deliver',
                                    'packaging',
                                ],
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
                        'buttonText' => Az::l('Вес'),
                        'buttonWeight' => true,
                        'classMain' => 'd-flex',
                        'btnClass' => 'px-4',
                    ],
                    'active' => [
                        'buttonClick' => true
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

            $order->responsible = $this->userIdentity()->id;

            $order->configs->changeSave = true;
            $order->columns();

            //start|DavlatovRavshan|2020.10.10


            if (!$place) {
                $place = new PlaceAdress();
                $place->configs->rules = validatorSafe;

                if ($place->save()) {
                    $order->place_adress_id = $place->id;
                    $order->save();
                    $this->urlRedirect([
                        $this->urlArrayStr,
                        'shop_order_id' => $order->id
                    ]);
                }

            }
            //end | DavlatovRavshan | 10.10.2020

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
                                    //'place_region_id',
                                    'postal_code',
                                ],
                                [
                                    'region_form',
                                ],
                                [
                                    'street',
                                    'home',
                                    'orientation',
                                    'place',

                                ]
                            ],
                        ],
                    ],
                ],
            ];

            $place->configs->changeSave = true;
            $place->configs->changeReloadId = '#place-form-pjax';
            $place->configs->changeReload = true;

            $place->columns();
            if ($this->modelSave($order)) {
                $this->urlRedirect(['index', true]);
            }

            $this->modelSave($place);

            if (empty($order->parent))
                echo <<<HTML

        <div class="mb-3 d-flex justify-content-between">
        
            <div class="d-flex">
                $dogovor
                $banderol
            </div>
            <div class="d-flex">
                $cancel
                $button
            </div>
            
          
            
        </div>
        
HTML;
            else
                echo <<<HTML

        <div class="mb-3 d-flex justify-content-between">
        
            <div class="d-flex">
                <h2>Заказ является дочерним заказом {$order->parent}</h2>
            </div>
            
            $button
            
        </div>
        
        
HTML;

            $active = new Active();
            $active->type = Active::type['vertical'];
            $active->childClass = 'my-3';

            $form = $this->activeBegin($active);


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
                    'topBtn' => false,
                    //'cols' => 12,
                    'stepType' => ZFormBuildWidget::stepType['smartTab'],
                    'blockType' => ZFormBuildWidget::blockType['naked']
                ],
            ]);

            $this->activeEnd();

            $this->paramSet(paramChangeReloadId, 'supervisor-create-pjax');
            $form2 = $this->activeBegin();

            $config = [
                'stepOptions' => [
                    'config' => [
                        'mcontent' => 'p-3',
                    ],
                ],
                'botBtn' => false,
                'topBtn' => false,
                //'cols' => 12,
            ];

            echo ZFormBuildWidget::widget([
                'model' => $place,
                'form' => $form2,
                'config' => $config,
            ]);

            $this->sessionSet('configs', $config);

            $this->activeEnd();
            ?>

        </div>


        <div class="col-md-12 mx-auto mt-5">

            <?php

            $this->pjaxBegin();

            $model = new ShopOrderItem();

            $model->configs->query = ShopOrderItem::find()
                ->where([
                    'shop_order_id' => $order_id
                ]);

            $model->configs->readonly = [
                'shop_order_id',
                'ware_id' => false
            ];

            if ($order->status_universal === ShopOrder::status_universal['change']) {
                $model->configs->nameOn = [
                    'id',
                    'shop_catalog_id',
                    'shop_order_id',
                    'check_return',
                    'user_company_id',
                    'ware_id',
                    'amount',
                    'best_before',
                    'price',
                    'price_all',
                    'price_all_partial',
                ];
            } else {
                $model->configs->nameOn = [
                    'id',
                    'shop_catalog_id',
                    'shop_order_id',
                    'user_company_id',
                    'ware_id',
                    'amount',
                    'best_before',
                    'price',
                    'price_all',
                    'price_all_partial',
                ];
            }

            $model->configs->dynaButtons = [
                'update' => [
                    'content' => '{update}',
                    'options' => ['class' => 'btn-group p-1 mr-0 {btnSize} {iconSize}']
                ],
                'add-tabular-clone-delete' => [
                    'content' => '{add}{delete}',
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
                    'pjax' => false,
                    'columnBefore' => [
                        'checkbox',
                        'serial',
                        'action',
                        'id'
                    ],
                    'viewUrl' => '{fullUrl}/view-process.aspx?shop_order_id=' . $order_id,
                    'actionButtons' => [
                        'clone',
                        'delete',
                        'view'
                    ],
                    'spaHeight' => [
                        'create' => '600px',
                        'view' => '600px',
                    ],
                    'columnAfter' => false,
                    'deleteAllUrl' => '/api/core/dyna/delete-all.aspx?modelClassName={modelClassName}&shop_order_id=' . $order_id,
                    'createUrl' => '{fullUrl}/create-process.aspx?shop_order_id=' . $order_id,
                    'createTitle' => Az::l('Создание прихода в склад')
                ]

            ]);
            $this->pjaxEnd();
            ?>

        </div>

    </div>


    <? require Root . '\webhtm\block\footer\footerAdmin.php' ?>

</div>


<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>
