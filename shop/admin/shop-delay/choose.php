<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\models\shop\ShopOrder;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\helpers\ZUrl;
use zetsoft\system\helpers\ZVarDumper;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZCheckButtonWidget;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\menus\ZMmenuWidgetSh;
use zetsoft\widgets\navigat\ZButtonWidget;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;
use zetsoft\models\place\PlaceCountry;


/** @var ZView $this */


/**
 *
 * Action Params
 */

$action = new WebItem();

$action->title = Azl . 'Подобрать товары для переноса даты доставки';
$action->icon = 'fal fa-line-chart';
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

<div class="p-3">

    <?

    echo ZSessionGrowlWidget::widget();?>


    <div class="p-2 row justify-content-end dynaCheck">

        <?

        $parentQuery = $this->httpGet('parentQuery');

        $query = $this->httpGet('chooseQuery');

        $shop_delay_id = $this->httpGet('shop_delay_id');

        $query = json_decode($query, true, 512);

        $query = ZVarDumper::arrayFilter($query, true);

        $model = new ShopOrder();
        $model->configs->query = ShopOrder::findOne([
            'place_region_id' => $this->userIdentity()->place_region_id
        ]);

        $checkUrl = ZUrl::to([
            '/api/shop/orders/delay',
            'query' => $query,
            'date_delay' => $this->httpGet('date_delay'),
            'shop_delay_id' => $shop_delay_id,
            'parentQuery' => ZArrayHelper::getValue($parentQuery, 'where')
        ]);


        echo ZCheckButtonWidget::widget([
            'model' => $model,

            'config' => [
                'icon' => '',
                'text' => Az::l('Подобрать'),
                'hasIcon' => false,

                'btnType' => ZButtonWidget::btnType['link'],
                'grapes' => false,
                'btnStyle' => ZButtonWidget::btnStyle['btn-transparent'],
                'btnSize' => ZButtonWidget::btnSize['btn-mini'],
                'url' => $checkUrl,
                'class' => 'rounded-0',
                'title' => Az::l('Подборка'),
                'message' => Az::l('Вы хотите подобрать эти элементы?'),
            ],
            'event' => [
                'ajaxSuccess' => <<<JS
             function(response) {
                     
                if (response.error) {
                    alert(response.error)    
                } else
                    window.parent.location.reload()
                    
             }
JS,
            ]

        ]);

        ?>

    </div>
    <div class="row">
        <div class="col-md-12">

            <?
            /** @var ZView $this */

            $model = new ShopOrder();

            $model->configs->query = ShopOrder::find()
                ->where($query)
                ->andWhere([
                    'shop_delay_id' => null,

                ]);

            $model->configs->nameOn = [
                'id',
                'name',
                'created_at',
                'code',
                'user_id',
                'place_adress_id',
                'date_deliver',
            ];

            $model->columns();

            echo ZDynaWidget::widget([
                'model' => $model,
                'config' => [
                    'pjax' => false,
                    'isCard' => false,
                    'columnBefore' => [
                        'checkbox',
                        'serial',
                        'id',
                    ],
                    'columnAfter' => false,
                    'hasToolbar' => false,
                    'search' => true,
                    'heighbody' => '62vh',
                ],
            ]);

            ?>

        </div>
    </div>


</div>


<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>
