<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\models\place\PlaceAdress;
use zetsoft\models\shop\ShopCourier;
use zetsoft\models\shop\ShopDelay;
use zetsoft\models\shop\ShopShipment;
use zetsoft\models\shop\ShopOrder;
use zetsoft\service\forms\Active;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZUrl;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZCheckButtonWidget;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\former\ZFormBuildWidget;
use zetsoft\widgets\former\ZFormWidget;
use zetsoft\widgets\inputes\ZInputWidget;
use zetsoft\widgets\menus\ZMmenuWidget;
use zetsoft\widgets\navigat\ZButtonWidget;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;
use zetsoft\widgets\notifier\ZSweetAlert2Widget;
use zetsoft\widgets\themes\ZCardWidget;
use zetsoft\models\ware\WareEnter;
use function Symfony\Component\String\s;


/** @var ZView $this */


/**
 *
 * Action Params
 */

$action = new WebItem();

$action->title = Azl . 'Перенос даты доставки';


$action->icon = 'fal fa-film';
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
echo ZMmenuWidget::widget([
]);
?>

<div id="page">

    <?
    require Root . '/webhtm/block/header/main.php';
    require Root . '/webhtm/block/navbar/admin.php';

    echo ZSessionGrowlWidget::widget();?>

    <div id="content" class="content-footer p-3">


        <div class="row">

            <div class="col-md-12 mx-auto">

                <?php

                $shop_delay_id = $this->httpGet('shop_delay_id');
                $shop_delay = ShopDelay::findOne($shop_delay_id);

                $active = new Active();
                $active->type = Active::type['vertical'];

                $form = $this->activeBegin($active);

                if ($this->modelSave($shop_delay)) {
                    $this->urlRedirect(['index', true]);
                }

                $shop_delay->date = Az::$app->cores->date->dateTime();
                $shop_delay->configs->dynaButtons = [
                    'add-tabular-clone-delete' => [
                        'content' => '{choose}',
                        'options' => ['class' => 'btn-group p-1 mr-0 {btnSize} {iconSize}']
                    ],
                ];


                $shop_delay->columns();

                echo ZFormBuildWidget::widget([
                    'model' => $shop_delay,
                    'form' => $form,
                    'config' => [
                        'btnTitle' => Az::l('Провести и закрыть'),
                        'botBtn' => false,
                        'cols' => 2,
                        'stepType' => ZFormBuildWidget::stepType['none'],
                        'blockType' => ZFormBuildWidget::blockType['naked'],
                        'isCard' => false,

                    ]
                ]);

                $this->activeEnd();

                ?>

            </div>


            <div class="col-md-12 mx-auto mt-5">

                <?


                $model = new ShopOrder();

                $model->configs->query = ShopOrder::find()
                    ->where(['not', ['delayed_deliver_date' => null]])
                    ->andWhere([
                        'shop_delay_id' => $shop_delay_id
                    ]);

                $model->configs->dynaButtons = [
                    'add-tabular-clone-delete' => [
                        'content' => '{choose}{delete}',
                        'options' => ['class' => 'btn-group p-1 mr-0 {btnSize} {iconSize}']
                    ],

                ];
                $model->configs->nameOn = [
                    'id',
                    'name',
                    'created_at',
                    'user_id',
                    'status_logistics',
                    'delayed_deliver_date',
                    'place_adress_id',
                    'date_deliver',
                ];

                $model->columns();

                $delays = [
                    ShopOrder::status_logistics['complect_wait'],
                    ShopOrder::status_logistics['on_complecting'],
                    ShopOrder::status_logistics['courier_appointment'],
                    ShopOrder::status_logistics['shipment_ready'],
                ];

                echo ZDynaWidget::widget([
                    'model' => $model,
                    'config' => [
                        'chooseQuery' => [
                            'status_logistics' => $delays,
                        ],
                        'deleteAllUrl' => ZUrl::to([
                            '/api/orders/deleteDelay',
                            'shop_delay_id' => $shop_delay_id,
                        ]),
                        'chooseUrl' => '{fullUrl}/choose.aspx?date_delay=' . $shop_delay->date_delay . '&shop_delay_id=' . $shop_delay_id,
                        'hasToolbar' => true,
                        'spa' => true,
                        'search' => false,
                        'headerIcon' => '',
                        'bordered' => false,
                        'columnBefore' => [
                            'checkbox',
                            'serial',
                            'id'
                        ],
                        'columnAfter' => false,

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
