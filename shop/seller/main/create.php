<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\models\place\PlaceAdress;
use zetsoft\models\shop\ShopOrder;
use zetsoft\models\shop\ShopReview;
use zetsoft\models\shop\ShopStatus;
use zetsoft\service\forms\Active;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZUrl;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\former\ZFormBuildWidget;
use zetsoft\widgets\inputes\ZInputWidget;
use zetsoft\widgets\menus\ZMmenuWidget;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;


/** @var ZView $this */


/**
 *
 * Action Params
 */

$action = new WebItem();

$action->title = Azl . 'Панель организации';
$action->icon = 'fa fa-globe';
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
<div id="content" class="content-footer p-3">

    <div class="row">
        <div class="col-md-12">
            <?

            echo ZSessionGrowlWidget::widget();
        


            $id = $this->httpGet('id');
            $model = new ShopOrder();

            $model->date = Az::$app->cores->date->fbDateTime();
            $model->responsible = $this->userIdentity()->id;
            $model->configs->readonlyWidget = [

                'responsible'
            ];
            
            $model->cards = [
                [
                    'title' => Az::l('Первый этап'),
                    'shows' => true,
                    'items' => [
                        [
                            'title' => Az::l('Форма'),
                            'shows' => true,
                            'items' => [
                                [
                                    'date',
                                    'responsible',
                                ],
                                [
                                    'user_id',
                                    'contact_name'
                                ],
                                [
                                    'comment_user',
                                    'contact_phone',
                                ],
                                [
                                    'user_company_ids'
                                ],
                                [
                                    'ware_ids',
                                    'source',
                                ],
                                [
                                    'tasks',
                                    'date_approve',
                                ],
                                [
                                    'date_deliver',
                                    'delayed_deliver_cause'
                                ],
                                [
                                    'deliver_price',
                                    'shop_channel_id',
                                ],
                                [
                                    'shop_coupon_id',
                                    'payment_type',
                                ],
                                [
                                    'additional_payment_type',
                                ],
                            ],
                        ],
                    ],
                ],
            ];

            $model->configs->readonlyWidget = [
                'responsible',

            ];

            $model->columns();


            $active = new Active();
            $active->type = Active::type['vertical'];
            $form = $this->activeBegin($active);

            $isCard = true;
            if ($this->httpGet('spa'))
                $isCard = false;


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


    ?>


</div>


<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>
