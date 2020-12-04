<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZUrl;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\inputes\ZKSelect2Widget;
use zetsoft\widgets\menus\ZMmenuWidgetSh;
use zetsoft\widgets\navigat\ZButtonWidget;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;
use zetsoft\models\ware\WareAccept;


/** @var ZView $this */


/**
 *
 * Action Params
 */

$action = new WebItem();

$action->title = Azl . 'Поступление товаров в склад';
$action->icon = 'fal fa-cube';
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
echo ZMmenuWidgetSh::widget([
    //'data' => $this->cores->menus->create('mmenu'),
    'config' => [
        'theme' => 'white',
        'content.img.width' => 80,
        'iconbar.top' => [
            "<a href='#/'><i class='fa fa-home'></i>cc</a>",
            "<a href='#/'><i class='fa fa-home'></i>cc</a>",
        ],
        'iconbar.bottom' => [
            "<a href='#/'><i class='fa fa-home'></i>aa</a>",
            "<a href='#/'><i class='fa fa-home'></i>cc</a>",
        ],
        'all.border' => ZMMenuWidgetSh::border['border-full'],
        'menu-effect-slide' => true,
    ],
]);
?>

<div id="page">

    <?

    require Root . '/webhtm/block/navbar/admin.php';

    echo ZSessionGrowlWidget::widget();?>

    <div id="content" class="content-footer p-3">


        <div class="row">
            <div class="col-md-12">

                <?

                $url = ZUrl::to([
                    '/api/core/app/service',
                    'namespace' => 'office',
                    'service' => 'word2',
                    'method' => 'cashTemplate',
                    'args' => '213',
                ]);

                $download = ZButtonWidget::widget([
                    'config' => [
                        'text' => 'Скачать',
                        'btnType' => ZButtonWidget::btnType['link'],
                        'url' => $url,
                        'btnRounded' => false,
                        'btnStyle' => ZButtonWidget::btnStyle['btn-outline-primary']
                    ]
                ]);

                $select = ZKSelect2Widget::widget([
                    'name' => 'name',

                    'data' => [
                        'act' => Az::l('Aкт передачи'),
                        'list' => Az::l('Наршутный лист'),
                    ],
                    'config' => [
                        'hasPlace' => true,
                        'placeholder' => Az::l('Подменю печать')
                    ]
                ]);

                $model = new WareAccept();


                $model->configs->nameOn = [
                    'created_at',
                    'id',
                    'shop_courier_id',
                    'shop_shipment_id',
                    'responsible',
                    'total',
                    'completed',
                    'cancel',
                    'refusal',

                ];
                $model->configs->spa = false;
                echo '<br>';
                $model->columns();
                /** @var ZView $this */
                echo ZDynaWidget::widget([
                    'model' => $model,
                    'config' => [
                        'actionButtons' => [
                            'update'
                        ],
                        'updateUrl' =>  'process'
                    ],
                    'rightBtn' => [
                        'update' => [
                            'content' => $select,
                            'options' => ['class' => 'w-100']
                        ],

                        'add-tabular-clone-delete' => [
                            'content' => '',
                            'options' => ['class' => 'btn-group p-1 mr-0 {btnSize} {iconSize}']
                        ],

                        'filter-sort-id' => [
                            'content' => '',
                            'options' => ['class' => 'btn-group p-1 mr-0 {btnSize} {iconSize}']
                        ],

                        'export' => [
                            'content' => '',
                            'options' => ['class' => 'btn-group p-1 {btnSize} {iconSize}']
                        ],


                        'toggleData' => [
                            'content' => '',
                            'options' => ['class' => 'btn-group p-1 {btnSize} {iconSize}']
                        ],
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
