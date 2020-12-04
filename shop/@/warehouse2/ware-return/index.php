<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\dbitem\data\TabItem;
use zetsoft\models\place\PlaceAdress;
use zetsoft\models\ware\Ware;
use zetsoft\models\ware\WareExit;
use zetsoft\models\ware\WareReturn;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\helpers\ZUrl;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZCheckButtonWidget;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\menus\ZMmenuWidget;
use zetsoft\widgets\navigat\ZButtonWidget;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;
use zetsoft\widgets\themes\ZDropDownWidget;
use zetsoft\models\place\PlaceCountry;


/** @var ZView $this */


/**
 *
 * Action Params
 */

$action = new WebItem();

$action->title = Azl . 'Возврат товаров от клиентов';
$action->icon = 'fal fa-balance-scale';
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
    'config' => [
        'theme' => 'white',
        'content.img.width' => 230,
        'iconbar.top' => [
            "<a href='#/'><i class='fa fa-home'></i>cc</a>",
            "<a href='#/'><i class='fa fa-home'></i>cc</a>",
        ],
        'iconbar.bottom' => [
            "<a href='#/'><i class='fa fa-home'></i>aa</a>",
            "<a href='#/'><i class='fa fa-home'></i>cc</a>",
        ],
        'all.border' => ZMMenuWidget::border['border-full'],
        'menu-effect-slide' => true,
    ],
]);
?>

<div id="page">

    <?php
    require Root . '/webhtm/block/header/main.php';
    if (!$this->httpGet('spa')) {
        require Root . '/webhtm/block/navbar/admin.php';
    }

    echo ZSessionGrowlWidget::widget();?>

    <div id="content" class="content-footer p-3">
        <div class="row">
            <div class="col-md-12">
                <?php

                $model = new WareReturn();
                $place_region_id = $this->userIdentity()->place_region_id;

                $place_adress_id = PlaceAdress::find()
                    ->where([
                        'place_region_id' => $place_region_id
                    ])
                    ->all();

                $place_adress_ids = ZArrayHelper::getColumn($place_adress_id, 'id');

                $ware = Ware::find()
                    ->where([
                        'place_adress_id' => $place_adress_ids
                    ])
                    ->all();

                $ware_ids = ZArrayHelper::getColumn($ware, 'id');
                $model->configs->query = WareReturn::find()
                    ->where([
                        'ware_id' => $ware_ids,
                    ]);

                $model->configs->hasPlaceholder = false;

                $model->columns();

                $item = new TabItem();
                $item->title = ZCheckButtonWidget::widget([
                    'model' => $model,
                    'config' => [
                        'btn' => false,
                        'text' => Az::l('Возврат от клиента '),

                        'btnStyle' => 'btn-micro text-nowrap fp-14 text-muted pt-2',

                        'attribute' => 'status',
                        'btnRounded' => false,
                        'btnType' => ZButtonWidget::btnType['link'],
                        'class' => 'simple-' . $model->className,
                        'url' => ZUrl::to([
                            '/core/word/act',
                            'type' => 'selectedCashTemplate',
                        ]),
                        'attr' => 'status',
                        'modelClassName' => $model->className,
                        'value' => 'shipment_ready',
                        'btnFloating' => false,
                        'toggle' => ZButtonWidget::toggle['tooltip'],
                    ]
                ]);

                $item->param = [
                    'class' => 'd-block'
                ];

                $data[] = $item;

                $item = new TabItem();
                $item->title = ZCheckButtonWidget::widget([
                    'model' => $model,
                    'config' => [
                        'btn' => false,
                        'text' => Az::l('Заявление на возврат ДС'),

                        'btnStyle' => 'btn-micro text-nowrap fp-14 text-muted pt-2',

                        'attribute' => 'status',
                        'btnRounded' => false,
                        'btnType' => ZButtonWidget::btnType['link'],
                        'class' => 'simple-' . $model->className,
                        'url' => ZUrl::to([
                            '/core/word/act',
                            'type' => 'selectedReturnCash',
                        ]),
                        'attr' => 'status',
                        'modelClassName' => $model->className,
                        'value' => 'shipment_ready',
                        'btnFloating' => false,
                        'toggle' => ZButtonWidget::toggle['tooltip'],
                    ]
                ]);
                $item->url = '#';
                
                $data[] = $item;

                $item = new TabItem();
                
                $item->title = ZCheckButtonWidget::widget([
                    'model' => $model,
                    'config' => [
                        'btn' => false,
                        'text' => Az::l('Заявление на возврат товаров'),

                        'btnStyle' => 'btn-micro text-nowrap fp-14 text-muted pt-2',

                        'attribute' => 'status',
                        'btnRounded' => false,
                        'btnType' => ZButtonWidget::btnType['link'],
                        'class' => 'simple-' . $model->className,
                        'url' => ZUrl::to([
                            '/core/word/act',
                            'type' => 'selectedReturnProduct',
                        ]),
                        'attr' => 'status',
                        'modelClassName' => $model->className,
                        'value' => 'shipment_ready',
                        'btnFloating' => false,
                        'toggle' => ZButtonWidget::toggle['tooltip'],
                    ],

                ]);
                $item->url = '#';

                $data[] = $item;

                $button = ZDropDownWidget::widget([
                    'data' => $data,
                    'config' => [
                        'title' => Az::l('Печать'),
                        'class' => 'btn btn-mini',
                        'link' => false
                    ]
                ]);
                /** @var ZView $this */
                echo ZDynaWidget::widget([
                    'model' => $model,
                    'rightBtn' => [
                        'update' => [
                            'content' => '{update}',
                            'options' => ['class' => 'btn-group p-1 mr-0 {btnSize} {iconSize}']
                        ],

                        'system' => [
                            'content' => '',
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
                            'content' => '{statistics}',
                            'options' => ['class' => 'btn-group p-1 mr-0 {btnSize} {iconSize}']
                        ],

                        'export' => [
                            'content' => '{export}{exportAll}{exportExcel}',
                            'options' => ['class' => 'btn-group p-1 {btnSize} {iconSize}']
                        ],


                        'toggleData' => [
                            'content' => '{all}',
                            'options' => ['class' => 'btn-group p-1 {btnSize} {iconSize}']
                        ],

                    ],
                    'leftBtn' => [
                        'print' => [
                            'content' => $button,
                            'options' => ['class' => 'btn-group p-1 mr-0 {btnSize} {iconSize}']
                        ]
                    ],
                    'config' => [
                        'spa' => false,
                        'updateUrl' => '{fullUrl}/process.aspx?ware_return_id={id}',
                        'spaArray' => [
                            'create' => true,
                            'update' => false
                        ],
                        'spaHeight' => [
                            'create' => '500px',
                            'view' => '750px'
                        ],
                        'actionButtons' => [
                            'update',
                            'delete',
                            'clone',
                            'view',
                        ],
                        'columnBefore' => [
                            'serial',
                            'checkbox',
                            'action',
                        ],
                        'columnAfter' => false
                    ],
                ]);
                ?>

            </div>
        </div>
    </div>

    <?php require Root . '\webhtm\block\footer\footerAdmin.php' ?>
</div>

<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>
