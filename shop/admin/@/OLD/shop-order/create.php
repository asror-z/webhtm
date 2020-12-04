<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\service\forms\Active;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZFormBuildWidget;
use zetsoft\widgets\former\ZFormWidget;
use zetsoft\widgets\inputes\ZInputWidget;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;
use zetsoft\widgets\themes\ZCardWidget;
use zetsoft\models\shop\ShopOrder;


/** @var ZView $this */


/**
 *
 * Action Params
 */

$action = new WebItem();

$action->title = Azl . 'Новый заказ';
$action->icon = 'fa fa-line-chart';
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

    /* require Root . '/webhtm/block/navbar/main.php';*/

    echo ZSessionGrowlWidget::widget();?>

    <div id="content" class="content-footer p-3">

        <div class="row">
            <div class="mx-auto col-md-11 col-11">

                <?php

                $id = $this->httpGet('id');
                $model = new ShopOrder();
                $model->date = Az::$app->cores->date->dateTime();


                $model->configs->widget = [
                    'date' => ZInputWidget::class,

                ];
                $model->cards = [
                    [
                        'title' => Az::l('Первый этап'),
                        'items' => [
                            [
                                'title' => Az::l('Форма'),
                                'items' => [
                                    [
                                        'user_id',
                                        'contact_name',
                                        'contact_phone',
                                        'called_time',
                                        'date',
                                        'date_deliver',
                                        'comment_user',
                                        'place_adress_id',
                                        'distance',
                                        'user_company_ids',
                                        'ware_ids',
                                        'operator',
                                        'comment_agent',
                                        'tasks',
                                        'source',
                                        'shop_reject_cause_id',
                                        'status_client',
                                        'status_callcenter',
                                        'status_autodial',
                                        'status_logistics',
                                        'status_accept',
                                        'date_deliver',
                                        'date_approve',
                                        'date_return',
                                        'delayed_deliver_date',
                                        'delayed_deliver_cause',
                                        'packaging',
                                        'labelled',
                                        'fragile',
                                        'weight',
                                        'weight_plan',
                                        'size',
                                        'volume',
                                        'shop_shipment_id',
                                        'price',
                                        'deliver_price',
                                        'total_price',
                                        'shop_coupon_id',
                                        'shop_channel_id',
                                        'payment_type',
                                        'additional_payment_type',
                                        'additional_received_money',
                                    ],
                                ],
                            ],
                        ],
                    ]
                ];
                $model->configs->nameOff = [
                    'name',
                    'code',
                ];
                if ($this->modelSave($model)) {

                    $this->paramSet(paramIframe, true);

                    $this->urlRedirect([
                        'process',
                        'shop_order_id' => $model->id
                    ]);
                }

                $active = new Active();
                $active->type = Active::type['vertical'];


                $form = $this->activeBegin($active);
                $model->columns();

                echo ZFormBuildWidget::widget([
                    'model' => $model,
                    'form' => $form,
                    'config' => [
                        'cols' => 2,
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
