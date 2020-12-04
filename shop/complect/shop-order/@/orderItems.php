<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\models\shop\ShopOrder;
use zetsoft\models\shop\ShopOrderItem;
use zetsoft\models\ware\WareAccept;
use zetsoft\models\ware\WareEnterItem;
use zetsoft\models\ware\WareExit;
use zetsoft\models\ware\WareExitItem;
use zetsoft\service\forms\Active;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\helpers\ZUrl;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZBanderolWidget;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\former\ZExportBtnWidget;
use zetsoft\widgets\former\ZFormBuildWidget;
use zetsoft\widgets\former\ZFormWidget;
use zetsoft\widgets\former\ZPdfWidget;
use zetsoft\widgets\inputes\ZHHiddenInputWidget;
use zetsoft\widgets\inputes\ZInputBtnWidget;
use zetsoft\widgets\inputes\ZKDateTimePickerWidget;
use zetsoft\widgets\inputes\ZKSwitchInputWidget;
use zetsoft\widgets\inputes\ZLibraInputWidget;
use zetsoft\widgets\navigat\ZButtonWidget;
use zetsoft\widgets\navigat\ZSmartTabWidget;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;
use zetsoft\widgets\themes\ZCardWidget;
use zetsoft\models\ware\WareEnter;


/** @var ZView $this */


/**
 *
 * Action Params
 * @author MurodovMirbosit
 */

$action = new WebItem();

$action->title = Azl . 'Редактирование';


$action->icon = 'fal fa-film';
$action->type = WebItem::type['html'];




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

<style>
    .iframe-orders {
        border: none;
        min-height: 600px;
    }
</style>

<div id="page">

    <?
    echo ZSessionGrowlWidget::widget();?>

    <div class="mx-auto col-md-12">

        <?

        $order_id = $this->httpGet('shop_order_id');

        $order = ShopOrder::findOne($order_id);

        if ($this->modelSave($order))
            $this->urlRedirect(['index', true]);

        $active = new Active();
        $active->type = Active::type['vertical'];
        $active->childClass = 'my-3';

        $form = $this->activeBegin($active);

        $order->date = Az::$app->cores->date->dateTime();
        $order->responsible = $this->userIdentity()->id;

        $order->configs->widget = [
            'date' => ZKDateTimePickerWidget::class,
        ];

        $order->configs->readonly = [
            'date'
        ];


        $order->cards = [
            [
                'title' => Az::l('Клиенты'),
                'items' => [
                    [
                        'title' => Az::l('Форма'),
                        'items' => [
                            [
                                'user_id',
                            ],
                            [
                                'contact_name',
                            ],
                            [
                                'contact_phone',
                            ],
                            [
                                'called_time',
                            ],
                        ],
                    ],
                ],
            ],
        ];

        $order->columns();

        $stepType = ZFormBuildWidget::stepType['card'];

        echo ZFormBuildWidget::widget([
            'model' => $order,
            'form' => $form,
            'config' => [
                'stepOptions' => [
                    'config' => [
                        'bodyClass' => 'm-5',
                        'dynClass' => 'm-2 d-flex w-100',

                    ],
                ],
                'btnTitle' => Az::l('Сформировать и закрыть'),
                'botBtn' => false,
                //'cols' => 12,
                'stepType' => $stepType,
                'blockType' => ZFormBuildWidget::blockType['naked']
            ]
        ]);

        $this->activeEnd();

        ?>

    </div>

</div>

<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>

