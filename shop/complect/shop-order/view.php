<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\models\shop\ShopOrderItem;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\former\ZViewWidget;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;
use zetsoft\models\shop\ShopOrder;


/** @var ZView $this */


/**
 *
 * Action Params
 * @author MurodovMirbosit
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
                $this->pjaxBegin();
                $shop_order_id = $this->httpGet('id');
                $model = ShopOrder::findOne($shop_order_id);

                echo ZViewWidget::widget([
                    'model' => $model,
                ]);

                ?>
                </br></br></br></br></br>
                <?

                $order_item = new ShopOrderItem();
                $order_item->query = ShopOrderItem::find()
                ->where(['shop_order_id' => $shop_order_id]);
                $order_item->configs->readonly = true;
                $order_item->columns();

                echo ZDynaWidget::widget([
                    'model' => $order_item,
                    'config' => [
                        'actionButtons' => false,
                        'pjax' => false,
                        'columnBefore' => ['checkbox'],
                        'columnAfter' => false,
                    ],
                    'leftBtn' => [
                        'status' => [
                            'content' => '',
                            'options' => ['class' => 'btn-group p-1 mr-0 {btnSize} {iconSize}']
                        ],
                        'search' => [
                            'content' => '',
                        ],
                    ],
                    'rightBtn' => [
                        'system' => [
                            'content' => '',
                            'options' => ['class' => 'btn-group p-1 mr-0 {btnSize} {iconSize}']
                        ],
                        'update' => [
                            'content' => '',
                            'options' => ['class' => 'btn-group p-1 mr-0 {btnSize} {iconSize}']
                        ],

                        'add-clone-delete' => [
                            'content' => '',
                            'options' => ['class' => 'btn-group p-1 mr-0 {btnSize} {iconSize}']
                        ],

                        'filter-sort-id' => [
                            'content' => '',
                            'options' => ['class' => 'btn-group p-1 mr-0 {btnSize} {iconSize}']
                        ],

                        'statistics' => [
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
                    ],
                ]);
                $this->pjaxEnd();
                ?>
            </div>
        </div>


    </div>

</div>


<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>
