<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\models\place\PlaceAdress;
use zetsoft\models\shop\ShopCourier;
use zetsoft\service\forms\Active;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZUrl;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZFormBuildWidget;
use zetsoft\widgets\former\ZFormWidget;
use zetsoft\widgets\inputes\ZInputWidget;
use zetsoft\widgets\navigat\ZButtonWidget;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;
use zetsoft\widgets\themes\ZCardWidget;
use zetsoft\models\shop\ShopShipment;


/** @var ZView $this */


/**
 *
 * Action Params
 */

$action = new WebItem();

$action->title = Azl . 'Новое назначение заказа курьеру';
$action->icon = 'fal fa-area-chart';
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

            <div class="col-md-10 mx-auto">

                <?php

                $model = new ShopShipment();

                $shop_courier = new ShopCourier();

                $button = ZButtonWidget::widget([
                    'config' => [
                        'btn' => false,
                        'target' => '_blank',
                        'url' => ZUrl::to([
                            '/shop/logistics/shop-courier/update'
                        ]),
                        'icon' => 'fas fa-link',
                        'btnType' => ZButtonWidget::btnType['link'],
                    ],
                    'active' => [
                        'click' => true,
                    ],
                    'event' => [
                        'click' => <<<JS
      
        var value = $('#shopshipment-shop_courier_id').val()
        
        if (value === '')
            event.preventDefault();
      
        $(this).attr('href', '/shop/logistics/shop-courier/update.aspx?id=' + value)
      
JS,

                    ]
                ]);

                $model->configs->options = [
                    'shop_courier_id' => [
                        'config' => [
                            'addonAppendContent' => $button,
                        ],
                        'event' => [
                            'select' => <<<JS
                                function() {
                                     
                                     $.ajax({
                                        method: 'GET',
                                        url: 'courier.aspx',
                                        data: {
                                            shop_courier_id: $(this).val(),
                                        },
                                        success: function() {
                                        }
                                     })   
                                            
                                }
JS,
                        ],
                    ]
                ];

                if ($this->modelSave($model)) {

                    $this->paramSet(paramIframe, true);

                    /** @var ShopShipment $model */
                    $this->urlRedirect([
                        'process',
                        'shop_shipment_id' => $model->id
                    ]);

                }

                $active = new Active();
                $active->type = Active::type['vertical'];
                $active->childClass = 'my-3';

                $form = $this->activeBegin($active);

                $model->configs->nameOn = [
                    'date',
                    'responsible',
                    'date_deliver',
                    'shipment_type',
                    'shop_courier_id',
                    'comment',
                ];

                $model->date = Az::$app->cores->date->fbDateTime();
                $model->configs->hasLabel = true;
                $model->responsible = $this->userIdentity()->id;

                $model->cards = [
                    [
                        'title' => Az::l('Первый этап'),
                        'items' => [
                            [
                                'title' => Az::l('Форма'),
                                'items' => [
                                    [
                                        'date',
                                        'responsible',
                                    ],
                                    [
                                        'shop_courier_id',
                                        'date_deliver',
                                    ],
                                    [
                                        'shipment_type',
                                    ],
                                    [
                                        'comment',
                                    ]
                                ],
                            ],
                        ],
                    ],
                ];

                $model->columns();

                echo ZFormBuildWidget::widget([
                    'model' => $model,
                    'form' => $form,
                    'config' => [
                        'topBtn' => false,
                        'stepType' => ZFormBuildWidget::stepType['none'],
                        'blockType' => ZFormBuildWidget::blockType['naked'],
                    ]
                ]);

                $this->activeEnd();


                ?>

            </div>

        </div>


    </div>

</div>


<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>
