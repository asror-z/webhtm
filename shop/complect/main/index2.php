<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\models\shop\ShopOrder;
use zetsoft\models\shop\ShopOrderItem;
use zetsoft\system\assets\ZColor;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZUrl;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZCheckButtonWidget;
use zetsoft\widgets\former\ZCheckButtonWidgetJavohir;
use zetsoft\widgets\former\ZCheckDynaWidget;
use zetsoft\widgets\former\ZDynaCheckWidget;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\former\ZDynaWidgetAbl;
use zetsoft\widgets\former\ZDynaWidgetRav;
use zetsoft\widgets\former\ZPdfSimpleWidget;
use zetsoft\widgets\former\ZPdfWidget;
use zetsoft\widgets\incores\ZDynaCheckboxTwoWidget;
use zetsoft\widgets\menus\ZMmenuWidget;
use zetsoft\widgets\navigat\ZButtonWidget;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;


/** @var ZView $this */


/**
 *
 * Action Params
 * @author Shahzod Gulomqodirov
 */

$action = new WebItem();

$action->title = Azl . 'В ожидании комплектации';
$action->icon = 'fal fa-calendar-times-o';
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
echo ZMmenuWidget::widget([]);
?>

<div id="page">

    <?

    require Root . '/webhtm/block/header/main.php';
    require Root . '/webhtm/block/navbar/admin.php';

    echo ZSessionGrowlWidget::widget();?>

    <div id="content" class="content-footer p-3">


        <div class="row">
            <div class="col-md-12">

                <?

                $model = new ShopOrder();

                $model->configs->query = ShopOrder::find()
                    ->where([
                        'status_logistics' => ShopOrder::status_logistics['complect_wait']
                    ]);

                $model->configs->nameOn = [
                    'id',
                    'number',
                    'name',
                    'code',
                    'date',
                    'parent',
                    'status_logistics',
                    'ware_ids',
                    'date_deliver'
                ];

                $model->columns();

                echo ZDynaWidget::widget([
                    'model' => $model,
                    'leftBtn' => [
                        'button' => [
                            'content' => ZCheckDynaWidget::widget([
                                'model' => $model,
                                'config' => [
                                    'url' => '/shop/complect/main/help/change.aspx',
                                    'text' => Az::l('На комплектацию'),
                                    'btnStyle' => ZButtonWidget::btnStyle['btn-transparent'],
                                    'btnSize' => ZButtonWidget::btnSize['btn-sm'],
                                ],
                                'event' => [
                                    'ajaxSuccess' => <<<JS
                function() {
                    location.reload()
                }
JS,

                                ]
                            ]),
                            'options' => [
                                'class' => 'btn-group p-1 mr-0 {btnSize} {iconSize}'
                            ]
                        ],

                    ],
                    'rightBtn' => [
                        'add-tabular-clone-delete' => [
                            'content' => '{tabular}',
                            'options' => ['class' => 'btn-group p-1 mr-0 {btnSize} {iconSize}']
                        ],
                        'add-clone-delete' => [
                            'content' => '{tabular}{delete}',
                            'options' => ['class' => 'btn-group p-1 mr-0 {btnSize} {iconSize}']
                        ]
                    ],
                    'config' => [
                        'columnBefore' => [
                            'checkbox',
                            'serial',
                            'sort',
                            'action',
                        ],
                        'columnAfter' => [
                            'maladoy'
                        ],
                        'actionButtons' => [
                            'view',
                            'update',
                        ]
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
