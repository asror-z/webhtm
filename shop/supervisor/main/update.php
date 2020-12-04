<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\models\shop\ShopOrderItem;
use zetsoft\service\forms\Active;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZUrl;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\former\ZFormWidget;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;
use zetsoft\widgets\themes\ZCardWidget;
use zetsoft\models\shop\ShopOrder;


/** @var ZView $this */


/**
 *
 * Action Params
 */

$action = new WebItem();

$action->title = Azl . 'Редактирование Заказы';


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
                    'user_company_ids',
                    'contact_phone',
                    'status_callcenter',
                    'operator',
                    'created_at',
                    'date_approve',
                    'comment_agent',
                    'status_callcenter',
                    'date_deliver',
                    'place_adress_id'
                ];

                $model->columns();

                if ($this->modelSave($model)) {

                    $this->paramSet(paramIframe, true);

                    $this->urlRedirect([
                        'index',
                        'sort' => '-id'
                    ]);
                }


                ZCardWidget::begin([
                    'config' => [
                        'title' => Az::$app->view->title,
                        'type' => ZCardWidget::type['dynCard'],
                    ]
                ]);

                $active = new Active();

                $form = $this->activeBegin($active);

                $isCard = true;
                if ($this->httpGet('spa'))
                    $isCard = false;

                echo ZFormWidget::widget([
                    'model' => $model,
                    'form' => $form,
                    'config' => [
                        'isCard' => $isCard,
                    ],
                ]);

                $this->activeEnd();

                $items = new ShopOrderItem();
                $items->query = ShopOrderItem::find()
                    ->where([
                        'shop_order_id' => $model->id
                    ]);

                $items->configs->nameOn = [
                     'name',
                     'user_company_id',
                     'shop_catalog_id',
                     'amount',
                     'price',
                     'price_all'
                ];

                $items->columns();

                echo ZDynaWidget::widget([
                    'model' => $items,
                    'config' => [
                        'columnBefore' => [
                            'false'
                        ],
                        'createUrl' => ZUrl::to([
                            '/shop/supervisor/main/update-order-item',
                            'id' => $model->id
                        ]),
                    ],
                    'rightName' => [
                        'add-clone-delete'
                    ],
                    'rightBtn' => [
                        'add-clone-delete' => [
                            'content' => '{add}{tabular}{clone}{delete}',
                            'options' => ['class' => 'btn-group p-1 mr-0 {btnSize} {iconSize}']
                        ],
                    ]
                ]);

                ZCardWidget::end();

                ?>

            </div>
        </div>


    </div>

</div>


<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>
