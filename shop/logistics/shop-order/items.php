<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\models\shop\ShopCatalog;
use zetsoft\models\shop\ShopOrder;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZDetailWidget;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\menus\ZMmenuWidget;
use zetsoft\widgets\menus\ZMmenuWidgetSh;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;
use zetsoft\models\shop\ShopOrderItem;


/** @var ZView $this */


/**
 *
 * Action Params
 * @author MurodovMirbosit
 */

$action = new WebItem();

$action->title = Azl . 'Элементы заказа';
$action->icon = 'fa fa-area-chart';
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

if (!$this->httpGet('spa'))
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
            'all.border' => ZMmenuWidget::border['border-full'],
        ],
    ]);
?>

<div id="page">

    <?
    if (!$this->httpGet('spa'))
        require Root . '/webhtm/block/navbar/admin.php';

    echo ZSessionGrowlWidget::widget();?>

    <div id="content" class="content-footer p-3">
        <div class="row">
            <div class="col-md-12">

                <?

                $id = $this->httpGet('id');
                
                $model = new ShopOrderItem();

                $model->configs->query = ShopOrderItem::find()
                    ->where([
                        'shop_order_id' => $id
                    ]);

                $model->configs->filter = false;
                $model->configs->readonly = true;
                $model->columns();
                ?>
                <br><br>
                <?

                /** @var ZView $this */
                echo ZDynaWidget::widget([
                    'model' => $model,
                    'rightNameEx' => [
                        'system'
                    ],
                    'rightBtn' => [
                        'export' => [
                            'content' => '',
                            'options' => ['class' => 'btn-group p-1 {btnSize} {iconSize}']
                        ],
                        'filter-sort-id' => [
                            'content' => '{dynagridSettings}',
                            'options' => ['class' => 'btn-group p-1 mr-0 {btnSize} {iconSize}']
                        ],
                    ],
                    'config' => [
                        'hasToolbar' => false,
                        'editableLink' => true,
                        'search' => true,
                        'isCard' => false,
                        'bordered' => false,
                        'striped' => true,
                        'columnBefore' => [
                            'serial',
                            'sort',
                            'action',
                        ],
                        'actionButtons' => [
                            'view',
                            'delete',
                        ]
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
