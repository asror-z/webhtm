<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\models\shop\ShopOrderItem;
use zetsoft\models\shop\ShopOrder;
use zetsoft\models\ware\WareReturn;
use zetsoft\service\forms\Active;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\helpers\ZUrl;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\former\ZFormBuildWidget;
use zetsoft\widgets\inputes\ZInputWidget;
use zetsoft\widgets\menus\ZMmenuWidget;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;

/** @var ZView $this */


/**
 *
 * Action Params
 */

$action = new WebItem();

$action->title = Azl . 'Возврат товаров от клиентов';


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
        //'data' => $this->cores->menus->create('mmenu'),
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
            'all.border' => ZMmenuWidget::border['border-full'],
            'menu-effect-slide' => true,
        ],
    ]);

?>

<div id="page">

    <?
    
    require Root . '/webhtm/block/header/main.php';
    require Root . '/webhtm/block/navbar/admin.php';

    echo ZSessionGrowlWidget::widget();


    ?>

    <div id="content" class="content-footer p-3">


        <div class="row">

            <div class="col-md-12 mx-auto">

                <?php

                $ware_return_id = $this->httpGet('ware_return_id');
                $ware_return = WareReturn::findOne($ware_return_id);

                $active = new Active();
                $active->type = Active::type['vertical'];
                $active->childClass = 'my-3';

                $form = $this->activeBegin($active);

                if ($this->modelSave($ware_return)) {
                    $this->urlRedirect(['/cruds/ware/index', true]);
                }

                $ware_return->configs->readonlyWidgetAll = true;
                $ware_return->configs->widget = [
                    'date' => ZInputWidget::class,
                    'date_delay' => ZInputWidget::class,
                ];

                $ware_return->configs->dynaButtons = [
                    'add-tabular-clone-delete' => [
                        'content' => "{choose}",
                        'options' => ['class' => 'btn-group p-1 mr-0 {btnSize} {iconSize}']
                    ],
                ];

                $ware_return->cards = [
                    [
                        'title' => Az::l('Первый этап'),
                        'items' => [
                            [
                                'title' => Az::l('Форма'),
                                'items' => [
                                    [
                                        'name',
                                        'date',
                                        'shop_order_id',
                                        'shop_courier_id',
                                        'ware_id',
                                        'comment',
                                    ],
                                ],
                            ],
                        ],
                    ],
                ];

                $ware_return->columns();

                echo ZFormBuildWidget::widget([
                    'model' => $ware_return,
                    'form' => $form,
                    'config' => [
                        'btnTitle' => Az::l('Провести и закрыть'),
                        'botBtn' => false,
                        'cols' => 2,
                        'stepType' => ZFormBuildWidget::stepType['none'],
                        'blockType' => ZFormBuildWidget::blockType['naked'],
                        'isCard' => false,

                    ]
                ]);

                $this->activeEnd();

                ?>

            </div>


            <div class="col-md-12 mx-auto mt-5">

                <?

                $shop_orders = ShopOrder::find()
                    ->where([
                        'status_accept' => ShopOrder::status_accept['completed']
                    ])
                    ->all();


                $model = new ShopOrderItem();
                $model->configs->query = ShopOrderItem::find()
                    ->where([
                        'ware_return_id' => $ware_return_id
                    ]);

                $model->configs->dynaButtons = [
                    'add-tabular-clone-delete' => [
                        'content' => '{choose}{delete}',
                        'options' => ['class' => 'btn-group p-1 mr-0 {btnSize} {iconSize}']
                    ],

                ];

                $model->configs->nameOn = [
                    'id',
                    'name',
                    'shop_catalog_id',
                    'ware_id',
                    'amount',
                    'amount_partial',
                    'amount_return',
                    'price',
                    'price_all',
                    'price_all_partial',
                    'price_all_return',
                ];

                $model->configs->readonly = [
                    'id',
                    'name',
                    'shop_order_id',
                    'ware_id',
                    'amount',
                    'amount_return',
                    'price',
                    'price_all',
                    'price_all_partial',
                    'price_all_return',
                ];
                $model->columns();

                $shop_order_ids = ZArrayHelper::getColumn($shop_orders, 'id');

                echo ZDynaWidget::widget([
                    'model' => $model,
                    'config' => [
                        'chooseQuery' => [
                            'shop_order_id' => $shop_order_ids,
                        ],
                        'deleteAllUrl' => ZUrl::to([
                            '/api/orders/deleteReturn',
                            'ware_return_id' => $ware_return_id,
                        ]),
                        'chooseUrl' => '{fullUrl}/choose.aspx?ware_return_id=' . $ware_return_id,
                        'hasToolbar' => true,
                        'spa' => true,
                        'search' => false,
                        'headerIcon' => '',
                        'bordered' => false,
                        'columnBefore' => [
                            'checkbox',
                            'serial',
                            'id'
                        ],
                        'spaWidth' => [
                            'choose' => '1000px'
                        ],
                        'columnAfter' => false,

                    ]

                ]);

                ?>

            </div>


        </div>

    </div>
    <? require Root . '\webhtm\block\footer\footerAdmin.php' ?>
</div>


<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>
