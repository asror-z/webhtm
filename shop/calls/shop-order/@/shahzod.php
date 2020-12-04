<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\models\ware\WareTrans;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\former\ZDynaWidgetCard;
use zetsoft\widgets\former\ZDynaWidgetLeftButtons;
use zetsoft\widgets\former\ZDynaWidgetnarm;
use zetsoft\widgets\former\ZDynaWidgetSha;
use zetsoft\widgets\inputes\ZHTextareaWidget;
use zetsoft\widgets\menus\ZMmenuWidgetSh;
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
$action->icon = 'fal fa-power-off';
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

$this->notifySuccess('success');
$this->notifyError('success');
$this->notifyInfo('success');
$this->notifyWarning('success');


?>

<div id="page">

    <?

    require Root . '/webhtm/block/navbar/admin.php';

    echo ZSessionGrowlWidget::widget();?>

    <div id="content" class="content-footer p-3">




        <div class="row">
            <div class="col-md-12 col-12 cardfalse">

                <?

                $model = new ShopOrder();

                echo ZSessionGrowlWidget::widget([
                    'model' => $model,
                    'config'=>[

                        'title' => 'Well done!',
                        'body' => 'You successfully read this important alert message. 1',

                    ]
                ]);

           

                /** @var ZView $this */
                echo ZDynaWidget::widget([
                    'model' => $model,
                    'config' => [
                        'isCard' => false
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
