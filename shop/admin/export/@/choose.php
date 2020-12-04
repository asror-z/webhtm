<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\models\shop\ShopOrder;
use zetsoft\models\ware\WareAccept;
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

$action->title = Azl . 'Заказы';
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

        $query = ZVarDumper::arrayFilter($query, true);

        $model = new WareAccept();

        $checkUrl = ZUrl::to([
            '/api/core/dyna/choose-dyna',
            'query' => $query,
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
                     function() {
                         window.parent.location.reload()    
                     }
JS,
            ]
        ]);

        ?>

    </div>
    <div class="row">
        <div class="col-md-12 col-12">

            <?
            /** @var ZView $this */

            $model = new WareAccept();

            $model->configs->query = WareAccept::find()
                ->where($query);

            $model->configs->readonlyWidget = true;
            $model->configs->nameOn = [
                'place_adress_id',
                'status_client',
                'shop_shipment_id',
                'created_at',
                'date_deliver',
                'name',
                'user_id',
            ];
            $model->columns();

            echo ZDynaWidget::widget([
                'model' => $model,
                'leftNameEx' => [
                  'barCode'
                ],
                'config' => [
                    'isCard' => false,
                    'columnBefore' => [
                        'checkbox',
                        'serial',
                        'id'
                    ],
                    'hasToolbar' => false,
                    'search' => false,
                     'heighbody' => '62vh',
                ]
            ]);

            ?>

        </div>
    </div>



</div>


<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>
