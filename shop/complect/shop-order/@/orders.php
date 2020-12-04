<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\models\shop\ShopOrder;
use zetsoft\service\forms\Active;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\helpers\ZUrl;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZBanderolWidget;
use zetsoft\widgets\former\ZCheckSelectWidget;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\former\ZExportBtnWidget;
use zetsoft\widgets\former\ZFormBuildWidget;
use zetsoft\widgets\former\ZPdfWidget;
use zetsoft\widgets\inputes\ZInputBtnWidget;
use zetsoft\widgets\inputes\ZKDateTimePickerWidget;
use zetsoft\widgets\inputes\ZLibraInputWidget;
use zetsoft\widgets\inputes\ZSelect2Widget;
use zetsoft\widgets\navigat\ZButtonWidget;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;


/** @var ZView $this */


/**
 *
 * Action Params
 * @author MurodovMirbosit
 */

$action = new WebItem();

$action->title = Azl . 'Редактирование'; /*Поступление товаров в склад*/


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
/*require Root . '/webhtm/block/navbar/mainAdmin.php';
require Root . '/webhtm/block/menu/menu-m.php';*/
echo ZNProgressWidget::widget([]);

?>
<style>
    .iframe-orders {
        border: none;
        min-height: 600px;
    }
</style>

<div id="page">
    <nav id="menu"></nav>

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
            'weight' => ZHInputWidget::class
        ];

        $order->configs->readonly = [
            'date'
        ];

        $order->cards = [
            [
                'title' => Az::l('Основное'),
                'items' => [
                    [
                        'title' => Az::l('Форма'),
                        'items' => [
                            [
                                'name',
                                'code',
                                'responsible',
                            ],
                            [
                                'date_deliver',
                                'date',
                            ],
                            [
                                'date_approve',
                                'date_return',
                            ],
                            [
                                'place_adress_id',
                                'user_company_ids',
                            ],
                            [
                                'ware_ids',
                                'operator',
                            ],
                            [
                                'status_accept',
                                'packaging',
                            ],
                            [
                                'weight_plan',
                                'weight',
                            ]
                        ],
                    ],
                ],
            ],
        ];

        $order->configs->options = [
            'weight' => [
                'config' => [
                    'buttonText' => Az::l('Ввес'),
                ],
                'event' => [
                    'buttonClick' => <<<JS
                        function() {
                            libra.updateWeight();
                        }
                    JS,
                ],
            ],
        ];

        $order->columns();

        $stepType = ZFormBuildWidget::stepType['card'];

        echo ZLibraInputWidget::widget([
            'config' => [
                'objectName' => 'libra',
                'mode' => ZLibraInputWidget::mode['manual'],
                'inputSelector' => '#shoporder-weight',
                'autorun' => true,
            ],
        ]);

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


