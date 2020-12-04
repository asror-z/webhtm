<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\models\place\PlaceAdress;
use zetsoft\models\shop\ShopElement;
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

                $model->configs->nameOn = [
                    'id',
                    'contact_name',
                    
                   // 'user_company_ids',
                   // 'shop_element_ids',

                    'contact_phone',
                    'status_callcenter',
                    'operator',
                    'created_at',
                    'date_approve',
                    'comment_agent',
                    'status_callcenter',
                    'date_deliver',
                    
                    //'place_adress_id'
                ];

                $model->columns();

                $place = PlaceAdress::findOne($model->place_adress_id);

                if ($place === null)
                    $place = new PlaceAdress();

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


                $shop_order_items = new ShopOrderItem();

                $shop_order_items->query = ShopOrderItem::find()->where([
                    'shop_order_id' => $model->id
                ]);


                $shop_order_items->configs->nameOn = [
                    'user_company_id',
                    'shop_catalog_id',
                    'amount',
                    'price',
                    'price_all',

                ];


                $shop_order_items->configs->readonly = true;


                $shop_order_items->columns();


                /** @var ZView $this */
                echo ZDynaWidget::widget([

                    'model' => $shop_order_items,

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
