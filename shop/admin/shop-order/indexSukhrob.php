<?php

use kartik\grid\DataColumn;
use zetsoft\dbitem\core\WebItem;
use zetsoft\system\assets\ZColor;
use zetsoft\system\Az;
use zetsoft\system\column\ZKDataColumn;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\helpers\ZUrl;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZCheckButtonWidget;
use zetsoft\widgets\former\ZDialogButtonWidget;
use zetsoft\widgets\former\ZDynaCheckWidget;
use zetsoft\widgets\former\ZDynaDialogWidget;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\former\ZDynaWidgetBosya;
use zetsoft\widgets\former\ZDynaWidgetnarm;
use zetsoft\widgets\former\ZDynaWidgetRav;
use zetsoft\widgets\inputes\ZHRadioButtonGroupWidget;
use zetsoft\widgets\inputes\ZKSelect2Widget;
use zetsoft\widgets\inputes\ZKSelect2WidgetRav;
use zetsoft\widgets\inputes\ZSelect2Widget;
use zetsoft\widgets\menus\ZMmenuWidget;
use zetsoft\widgets\menus\ZMmenuWidgetSh;
use zetsoft\widgets\navigat\ZButtonWidget;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;
use zetsoft\models\shop\ShopOrder;
use zetsoft\widgets\notifier\ZSweetAlert2Widget;
use zetsoft\widgets\values\ZDateFormatWidget;

/** @var ZView $this */

/**
 *
 * Action Params
 */

$action = new WebItem();

$action->title = Azl . 'Заказы';
$action->icon = 'fal fa-lock';
$action->type = WebItem::type['html'];
$action->csrf = true;

if ($this->httpGet('spa')) {
    $action->debug = false;
}



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
if (!$this->httpGet('spa'))
    echo ZMmenuWidget::widget();
?>

<div id="page">

    <?
    if (!$this->httpGet('spa'))
        require Root . '/webhtm/block/navbar/admin.php';

    echo ZSessionGrowlWidget::widget();?>

    <div id="content" class="content-footer p-3">

        <div class="row">
            <div class="col-md-12 col-12">
                <?php

                $model = new ShopOrder();

                ZSweetAlert2Widget::begin([

                    'config' => [
                        'grapes' => false,
                        'funcName' => 'orderItems',
                        'width' => 'auto',
                        'height' => 'auto',
                        'begin' => true,
                        'allowOutsideClick' => 0,
                        'showCloseButton' => true,
                        'footer' => '',
                        'padding' => '0',
                    ],
                ]);

                ?>

                <iframe id="orderItems" width="1200px" height="700px"></iframe>


                <?php
                ZSweetAlert2Widget::end();
                
                $model->configs->before = [
                    'id' => [
                        [
                            'class' => ZKDataColumn::class,
                            'label' => Az::l('Товары'),
                            'format' => 'raw',
                            'value' => function (ShopOrder $model) {
                                return ZButtonWidget::widget([
                                    'id' => 'order-item' . $model->id,
                                    'config' => [
                                        'pjax' => 0,
                                        'class' => 'ZDynaBTN',
                                        'btnRounded' => false,
                                        'btn' => false,
                                        'src' => '/render/former/ZDynaWidget/assets/img/items.svg',
                                        'img' => true,
                                        'hasIcon' => false,
                                        'icon' => '',
                                    ],
                                    'event' => [
                                        'click' => <<<JS
                                    function () {
                                      orderItems(); 
                                      
                                      var iframe = $('#orderItems');
                                      iframe.attr('src', '/shop/admin/shop-order/view-order-item.aspx?shop_order_id={$model->id}');   
                                    }
JS
                                    ],
                                ]);
                            }
                        ]
                    ]
                ];

                $model->configs->valueWidget = [
                    'date' => ZDateFormatWidget::class,
                    'date_deliver' => ZDateFormatWidget::class,
                ];

                $model->configs->valueOptions = [
                    'date' => [
                        'config' => [
                            'hour' => true,
                        ]
                    ],
                    'date_deliver' => [
                        'config' => [
                            'hour' => true,
                        ]
                    ]
                ];

                /** @var ZView $this */
                echo ZDynaWidget::widget([
                    'model' => $model,
                    'leftBtn' => [
                        'status' => [
                            'content' => ZDynaDialogWidget::widget([
                                'model' => $model,
                                'config' => [
                                    'content' => ZHRadioButtonGroupWidget::widget([
                                        'name' => 'dialog_value',
                                        'data' => [
                                            'change' => Az::l('Обмен'),
                                            'free' => Az::l('Бесплатный курс'),
                                            'error' => Az::l('Заказ по ошибке'),
                                            'cancel' => Az::l('Отказ'),
                                        ],
                                        'config' => [
                                            'parentClass' => 'd-flex flex-wrap',
                                            'class' => 'w-100',
                                        ]
                                    ]),
                                    'text' => Az::l('Скопировать по статусу')
                                ]
                            ]),
                            'options' => ['class' => 'mx-3']
                        ]
                    ],
                    'config' => [
                        'updateUrl' => '{fullUrl}/process.aspx?shop_order_id={id}',
                        'actionButtons' => [
                            'update',
                            'delete',
                            'clone',
                            'view',
                        ],
                        'columnBefore' => [
                            'serial',
                            'sort',
                            'checkbox',
                            'action',
                        ],
                        'spaArray' => [
                            'update' => false,
                            'create' => true,
                        ],
                        'spaHeight' => [
                            'create' => '750px',
                            'view' => '618px',
                        ],
                        'columnAfter' => false,
                    ],
                    'rightBtn' => [
                        'system' => [
                            'content' => '',
                            'options' => ['class' => 'btn-group p-1 mr-0 {btnSize} {iconSize}']
                        ],
                        'update' => [
                            'content' => '{update}',
                            'options' => ['class' => 'btn-group p-1 mr-0 {btnSize} {iconSize}']
                        ],

                        'add-clone-delete' => [
                            'content' => '{choose}{add}{tabular}{clone}{delete}',
                            'options' => ['class' => 'btn-group p-1 mr-0 {btnSize} {iconSize}']
                        ],

                        'filter-sort-id' => [
                            'content' => '{dynagridFilter}{filter}{dynagridSort}{dynagridSettings}{dynagrid}',
                            'options' => ['class' => 'btn-group p-1 mr-0 {btnSize} {iconSize}']
                        ],

                        'statistics' => [
                            'content' => '{statistics}{report}',
                            'options' => ['class' => 'btn-group p-1 mr-0 {btnSize} {iconSize}']
                        ],

                        'export' => [
                            'content' => '',
                            'options' => ['class' => 'btn-group p-1 {btnSize} {iconSize}']
                        ],


                        'toggleData' => [
                            'content' => '{all}',
                            'options' => ['class' => 'btn-group p-1 {btnSize} {iconSize}']
                        ],
                    ],
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
