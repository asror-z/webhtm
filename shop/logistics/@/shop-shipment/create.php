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
use zetsoft\widgets\notifier\ZSessionGrowlWidget;
use zetsoft\widgets\themes\ZCardWidget;
use zetsoft\models\shop\ShopShipment;


/** @var ZView $this */


/**
 *
 * Action Params
 * @author MurodovMirbosit
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

    <?php


    echo ZSessionGrowlWidget::widget();?>

    <div id="content" class="content-footer p-3">

        <div class="row">

            <div class="col-md-10 mx-auto">

                <?

                $id = $this->httpGet('id');
                $model = new ShopShipment();
                $this->formModel($model);
                if ($this->modelSave($model)) {
                    $this->paramSet(paramIframe, true);
                    /**@var ShopShipment $model*/
                    $this->urlRedirect(ZUrl::to([
                        'process',
                        'shop_shipment_id' => $model->id,
                    ]));
                }

                $active = new Active();
                $active->type = Active::type['vertical'];
                $active->childClass = 'my-3';


                $form = $this->activeBegin($active);


                $model->configs->widget = [
                    'date' => ZInputWidget::class,
                ];

                $model->configs->readonlyWidget = [
                    'date',
                    'responsible'
                ];

                $model->date = Az::$app->cores->date->dateTime();

                $model->responsible = $this->userIdentity()->id;

                $model->cards = [
                    [
                        'title' => Az::l('Первый этап'),
                        'items' => [
                            [
                                'title' => Az::l('Форма'),
                                'items' => [
                                    [
                                        'shop_courier_id',
                                        'date_deliver',
                                    ],
                                    [
                                        'responsible',
                                        'shipment_type',
                                    ],
                                    [
                                        'date'
                                    ],
                                    [
                                        'comment',
                                    ],
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
