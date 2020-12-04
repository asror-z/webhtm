<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\models\shop\ShopOrder;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\menus\ZMmenuWidget;
use zetsoft\widgets\menus\ZMmenuWidget_Axror1;
use zetsoft\widgets\menus\ZMmenuWidgetSh;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;
use zetsoft\models\shop\ShopShipment;
use zetsoft\widgets\places\ZGoogleDb29WidgetZoir;
use yii\widgets\LinkPager;
use yii\data\Pagination;


/** @var ZView $this */


/**
 *
 * Action Params
 */

$action = new WebItem();

$action->title = Azl . 'Заказы к доставке';
$action->icon = 'fa fa-wifi';
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
echo ZMmenuWidget_Axror1::widget([
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
        'all.border' => ZMmenuWidget_Axror1::border['border-full'],
        'menu-effect-slide' => true,
    ],
]);
?>
<div id="page">
<div class="col-md-12">




    <?

    require Root . '/webhtm/block/navbar/admin.php';

    echo ZSessionGrowlWidget::widget();?>


    <div id="content" class="content-footer p-3">




        <div class="row">

                <?

                $query = ShopShipment::find();

                $pagination = new Pagination([
                    'defaultPageSize' => 2,
                    'totalCount' => $query->count(),
                ]);

                $countries = $query->orderBy('id')
                    ->offset($pagination->offset)
                    ->limit($pagination->limit)
                    ->all();

                $model = new ShopShipment();

                /** @var ZView $this */
                echo ZDynaWidget::widget([
                    'model' => $model,
                    'class' => $pagination,
                ]);
                ?>

                <div class="col-md-12">

                <?


                $model = new ShopOrder();



                    echo ZGoogleDb29WidgetZoir::widget([
                        'options' => [
                            'config' => [
                                'depend_id'=>$model->place_adress_id

                            ],
                        ]
                    ])

                    ?>

                </div>

            </div>

        </div>


    </div>

</div>


<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>
