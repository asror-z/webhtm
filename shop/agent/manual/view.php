<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\models\place\PlaceAdress;
use zetsoft\models\shop\ShopOrderItem;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\former\ZViewWidget;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;
use zetsoft\models\shop\ShopOrder;
use zetsoft\system\Az;


/** @var ZView $this */


/**
 *
 * Action Params
 */

$action = new WebItem();

$action->title = Azl . 'Просмотр Заказы';
$action->icon = 'fal fa-lock';
$action->type = WebItem::type['html'];
$action->csrf = true;

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

?>

<div id="page">

    <?

    if (!$this->httpGet('spa'))
        require Root . '/webhtm/block/navbar/main.php';

    echo ZSessionGrowlWidget::widget();?>

    <div id="content" class="content-footer p-3">


        <div class="row">
            <div class="col-md-12 col-12">
                <?
                $id = $this->httpGet('id');

                $model = ShopOrder::findOne($id);


                if ($model === null)
                    return null;

                $model->configs->nameOn = [
                    'contact_name',
                    'status_callcenter',
                    'comment_agent',
                    'tasks',
                    'add_contact_phone',
                    'date_deliver',
                    'date_approve',
                    'status_logistics',
                ];

                $model->configs->readonlyWidget = [
                    'tasks'
                ];

                $model->columns();

                $place = PlaceAdress::findOne($model->place_adress_id);

                if ($place === null)
                    $place = new PlaceAdress();


                $place->configs->nameOn = [
                    'name',
                    'place_country_id',
                    'place_region_id',
                    'street',
                    'home',
                    'orientation',
                    'postal_code',
                    'place',
                    'location',
                ];

                $place->columns();


                $items = new ShopOrderItem();

                $items->query = ShopOrderItem::find()
                    ->where(
                        ['shop_order_id' => $model->id]
                    );

                $items->configs->nameOn = [
                    'shop_catalog_id',
                    'user_company_id',
                    'amount',
                    'price',
                    'price_all',
                ];

                $items->configs->readonly = true;


                $items->configs->readonly = [
                    'amount',
                    'price',
                ];

                $items->columns();

                $isCard = true;
                if ($this->httpGet('spa'))
                    $isCard = false;

                echo ZViewWidget::widget([
                    'model' => $model,
                    'config' => [
                        'isCard' => $isCard,
                        'title' => Az::l('Информация о заказе'),
                    ]
                ]);


                echo ZViewWidget::widget([
                    'model' => $place,
                    'config' => [
                        'isCard' => $isCard,
                        'title' => Az::l('Информация об адресе заказа'),
                    ]
                ]);

                echo ZDynaWidget::widget([

                    'model' => $items,

                    'rightNameEx' => [
                        'system'
                    ],

                    'config' => [
                        'search' => false,

                        'spaArray' => [
                            'update' => false
                        ],

                        'pjax' => false,

                        'hasToolbar' => false,

                        'columnBefore' => [
                            'serial',
                            'action'
                        ],

                        'columnAfter' => ['false'],

                        'paginationOptions' => [
                            'defaultPageSize' => 5,
                            'limit' => 30,

                        ],

                        'actionButtons' => [
                            'false'
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
