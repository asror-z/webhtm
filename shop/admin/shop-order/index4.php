<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\models\place\PlaceAdress;
use zetsoft\models\shop\ShopOrder;
use zetsoft\models\shop\ShopOrderItem;
use zetsoft\service\forms\Active;
use zetsoft\system\Az;
use zetsoft\system\except\ZException;
use zetsoft\system\helpers\ZUrl;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZBanderolWidget;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\former\ZExportBtnWidget;
use zetsoft\widgets\former\ZFormBuildWidget;
use zetsoft\widgets\former\ZPdfWidget;
use zetsoft\widgets\inputes\ZInputBtnWidget;
use zetsoft\widgets\inputes\ZInputWidget;
use zetsoft\widgets\inputes\ZKDateTimePickerWidget;
use zetsoft\widgets\inputes\ZLibraInputWidget;
use zetsoft\widgets\navigat\ZButtonWidget;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;

/** @var ZView $this */


/**
 *
 * Action Params
 */

$action = new WebItem();

$action->title = Azl . 'Редактирование Поступление товаров в склад';


$action->icon = 'fal fa-film';
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

<div id="page">

    <?
    require Root . '/webhtm/block/header/main.php';
    require Root . '/webhtm/block/navbar/admin.php';


    echo ZSessionGrowlWidget::widget();



    ?>

    <div class="row p-3">
        <div class="mx-auto col-md-12">

            <?

            $order_id = $this->httpGet('shop_order_id');

            $order = ShopOrder::findOne($order_id);

            if ($order === null) {
                throw new ZException(Az::l('Заказ не найден.'));
            }

            $order->responsible = $this->userIdentity()->id;

            $order->configs->widget = [
                'date' => ZKDateTimePickerWidget::class,
                'weight' => ZHInputWidget::class
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
                                    'user_company_ids',
                                    'place_adress_id'
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
                                ],
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

            $order->configs->options = [
                'weight' => [
                    'config' => [
                        'buttonText' => Az::l('Вес'),
                        'buttonWeight' => true,
                        'classMain' => 'd-flex',
                        'btnClass' => 'px-4',
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

            $place = PlaceAdress::findOne($order->place_adress_id);

            $place->configs->changeSave = true;

            $place->cards = [
                [
                    'title' => Az::l('Первый этап'),
                    'shows' => true,
                    'items' => [
                        [
                            'title' => Az::l('Форма'),
                            'shows' => true,
                            'items' => [
                                [
                                    'place_country_id',
                                    'place_region_id',
                                    'home',
                                ],
                                [
                                    'orientation',
                                    'place',
                                    'postal_code',
                                ]

                            ],
                        ],
                    ],
                ],
            ];
            $place->columns();

            $order->configs->changeSave = true;
            $order->columns();

            if ($this->modelSave($order))
                $this->urlRedirect(['index', true]);
            $this->modelSave($place);

            $active = new Active();
            $active->type = Active::type['vertical'];
            $active->childClass = 'my-3';

            $form = $this->activeBegin($active);

            $stepType = ZFormBuildWidget::stepType['smartTab'];

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
                    'btnTitle' => Az::l('Сформировать и закрыть'),
                    'botBtn' => false,
                    //'stepType' => $stepType,
                    'blockType' => ZFormBuildWidget::blockType['naked']
                ]
            ]);

            echo ZFormBuildWidget::widget([
                'model' => $place,
                'form' => $form,
                'config' => [
                    'stepOptions' => [
                        'config' => [
                            'mcontent' => 'p-3',
                        ],
                    ],
                    'botBtn' => false,
                    'topBtn' => false,
                    //'cols' => 12,
                ],
            ]);

            $this->activeEnd();

            ?>

        </div>

    </div>


    <? require Root . '\webhtm\block\footer\footerAdmin.php' ?>

</div>


<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>
