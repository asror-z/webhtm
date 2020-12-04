<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZCheckButtonWidget;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\navigat\ZButtonWidget;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;
use zetsoft\models\shop\ShopOrder;



/** @var ZView $this */


/**
 *
 * Action Params
 */

$action = new WebItem();

$action->title = Azl . 'Заказы';
$action->icon = 'fa fa-pie-chart';
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

?>

<div id="page">

    <?

    require Root . '/webhtm/block/navbar/mainAdmin.php';
    require Root . '/webhtm/block/menu/menu-m_old.php';

    echo ZSessionGrowlWidget::widget();?>

    <div id="content" class="content-footer p-3">




        <div class="row">
            <div class="col-md-12 col-12">

                <?
                $model = new ShopOrder();
                
                $button = ZCheckButtonWidget::widget([
                    
                    'config' => [
                        'title' => 'удалить?',
                        'grapes' => false,
                        'url' => '/core/product/saveOrder.aspx',
                        'class' => 'checkbox-' . $model->className,
                        'btnStyle' => ZButtonWidget::btnStyle['btn-outline-danger rounded-0'],
                        'btnRounded' => false,
                        'icon' => 'fas fa-trash-alt m-0',
                        'confirm' => false,
                        'modelClassName' => $this->modelClassName,
                        'failMessage' => Az::l("Вы должны выбрать адрес.")
                    ]
                ]);


                /** @var ZView $this */
                echo ZDynaWidget::widget([
                    'model' => $model,
                        'rightBtn' => [
                            'newBtn' => [
                                'content' => $button,
                                'options' => [
                                    'class' => ''
                                ]
                            ]
                        ],
                ]);

                ?>

            </div>
        </div>


    </div>

</div>

<?

require(Root . '/webhtm/block\footer\mplace\footerAll.php')

?>

<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>
