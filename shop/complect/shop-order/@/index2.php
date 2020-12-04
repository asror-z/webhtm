<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\helpers\ZUrl;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZBanderolWidget;
use zetsoft\widgets\former\ZDynaDialogWidget;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\former\ZDynaWidget2;
use zetsoft\widgets\former\ZExportBtnWidget;
use zetsoft\widgets\former\ZPdfWidget;
use zetsoft\widgets\inputes\ZHRadioButtonGroupWidget;
use zetsoft\widgets\menus\ZMmenuWidget;
use zetsoft\widgets\navigat\ZButtonWidget;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;
use zetsoft\models\shop\ShopOrder;
use zetsoft\widgets\values\ZDateFormatWidget;


/** @var ZView $this */


/**
 *
 * Action Params
 * @author MurodovMirbosit
 */

$action = new WebItem();

$action->title = Azl . 'Заказы';
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
                $model->configs->query = ShopOrder::find()
                    ->where([
                        'status_callcenter' => ShopOrder::status_callcenter['approved']
                    ]);

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
                echo ZDynaWidget2::widget([
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
                            'content' => '{add}{tabular}{clone}{delete}',
                            'options' => ['class' => 'btn-group p-1 mr-0 {btnSize} {iconSize}']
                        ],

                        'filter-sort-id' => [
                            'content' => '{dynagridFilter}{filter}{dynagridSort}{dynagridSettings}{dynagrid}',
                            'options' => ['class' => 'btn-group p-1 mr-0 {btnSize} {iconSize}']
                        ],

                        'statistics' => [
                            'content' => '{statistics}',
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
