<?php

use kartik\grid\DataColumn;
use zetsoft\dbitem\core\WebItem;
use zetsoft\system\Az;
use zetsoft\system\column\ZKDataColumn;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\inputes\ZInputWidget;
use zetsoft\widgets\menus\ZMmenuWidget;
use zetsoft\widgets\menus\ZMmenuWidgetSh;
use zetsoft\widgets\navigat\ZButtonWidget;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;
use zetsoft\models\shop\ShopShipment;


/** @var ZView $this */


/**
 *
 * Action Params
 */

$action = new WebItem();

$action->title = Azl . 'Назначение заказов курьеру';
$action->icon = 'fal fa-area-chart';
$action->type = WebItem::type['html'];
$action->csrf = true;
$action->debug = true;



$user_ip = Az::$app->request->userIP;
$json       = file_get_contents('http://api.ipstack.com/'.$user_ip.'?access_key=98308ea83d85971a34b29d479c192fd8');
$json       = json_decode($json ,true);

$latLng = $json['latitude'].','. $json['longitude'];



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

    /*  require Root . '/webhtm/block/navbar/main.php';*/
    require Root . '/webhtm/block/header/main.php';
    require Root . '/webhtm/block/navbar/admin.php';
    echo ZSessionGrowlWidget::widget();?>

    <div id="content" class="content-footer p-3" style="overflow-x: hidden !important;">


        <div class="row">
            <div class="col-md-12 col-12">

                <?
                vd($latLng);
                vd($url = Az::$app->maps->navigation->urlGeneratorGoogle(53, $latLng));

                $model = new ShopShipment();
                $model->configs->spa = false;
                $model->configs->nameOn = [
                    'id',
                    'created_at',
                    'code',
                    'shop_courier_id',
                    'date_deliver',
                    'responsible',
                ];
                $model->configs->nameShowEx = [];
                /*$model->configs->widget = [
                    'date_deliver' => ZInputWidget::class
                ];*/
                $model->configs->before = [
                    'code' => [
                        [
                            'class' => ZKDataColumn::class,
                            'label' => Az::l('Навигация'),
                            'width' => '50px',
                            'value' => function ($model, $key, $index, DataColumn $dataColumn) {


                                return ZButtonWidget::widget([
                                    'id' => $key,
                                    'config' => [
                                        'title' => Az::l('Google Навигация'),
                                        'icon' => 'fa fa-google',
                                        'pjax' => 0,
                                        'url' => '/logistics/tracking/googleTracking.aspx',
                                        'btnRounded' => false,
                                        'btn' => false,
                                        'hasIcon' => true,
                                    ],
                                    'event' => [
                                        'click' => 'function(event){event.preventDefault(); window.open(this.href, "_blank")}',
                                    ],
                                ]).ZButtonWidget::widget([
                                        'id' => $key,
                                        'config' => [
                                            'title' => Az::l('Yandex Навигация'),
                                            'icon' => 'fab fa-yandex',
                                            'pjax' => 0,
                                            'url' => '/logistics/tracking/yandexTracking.aspx',
                                            'btnRounded' => false,
                                            'btn' => false,
                                            'hasIcon' => true,
                                        ],
                                        'event' => [
                                            'click' => 'function(event){event.preventDefault(); window.open(this.href, "_blank")}',
                                        ],
                                    ]);
                               
                            }
                        ],
                    ]
                ];
                
                $model->columns();

                /** @var ZView $this */
                echo ZDynaWidget::widget([
                    'model' => $model,
                    'config' => [
                        'updateUrl' => '{fullUrl}/process.aspx?shop_shipment_id={id}',
                        'spaArray' => [
                            'create' => true,
                            'update' => false
                        ],
                        'spaHeight' => [
                            'create' => '500px',
                            'view' => '750px'
                        ],
                        'actionButtons' => [
                            'update',
                            'delete',
                            'clone',
                            'view',
                        ],
                        
                        'columnBefore' => [
                            'serial',
                            'checkbox',
                            'action',
                        ],
                        'columnAfter' => false
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
