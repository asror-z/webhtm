<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\models\place\PlaceAdress;
use zetsoft\models\shop\ShopOrder;
use zetsoft\service\forms\Active;
use zetsoft\service\forms\ZPjax;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZInflector;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZFormBuildWidget;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;
use zetsoft\widgets\themes\ZCardWidget;


/** @var ZView $this */


/**
 *
 * Action Params
 */

$action = new WebItem();

$action->title = Azl . 'Создание Заказы';
$action->icon = 'fal fa-lock';
$action->type = WebItem::type['html'];
$action->csrf = true;

if ($this->httpGet('spa'))
    $action->debug = false;


$this->paramSet(paramAction, $action);

$this->title();
$this->toolbar();

$modelClassName = $this->bootFullUrl();

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

    echo ZSessionGrowlWidget::widget(); ?>

    <div id="content" class="content-footer p-3">

        <div class="row">

            <div class="col-md-12 col-12">

                <?

                $id = $this->httpGet('id');

                /** @var ShopOrder $model */
                $model = null;
                if (!empty($id))
                    $model = ShopOrder::findOne($id);

                if (!$model)
                    $model = new ShopOrder();


                if ($this->httpGet('spa') && empty($id)) {
                    $model->configs->rules = validatorSafe;
                    if ($model->save()) {
                        $this->urlRedirect([
                            'create',
                            'id' => $model->id,
                            'isNew' => true,
                            'spa' => 1,
                        ]);
                    }
                }

                $model->responsible = $this->userIdentity()->id;
                $model->date = Az::$app->cores->date->fbDate();
                $model->configs->changeSave = true;

                $model->configs->rules = [
                    'date_deliver' => validatorSafe,
                    'contact_name' => validatorSafe
                ];

                $model->configs->nameOn = [
                    'contact_name',
                    'contact_phone',
                    'add_contact_phone',
                    'date_deliver',
                    'time_deliver',
                ];

                //start|XolmatRavshanov|2020-10-13
                
                $model->configs->options = [
                    'date_deliver' => [
                        'config' => [
                            'startDate' => Az::$app->cores->date->dateTime()
                        ]
                    ]
                ];
                
                //end|XolmatRavshanov|2020-10-13

                $model->columns();

                ZCardWidget::begin([
                    'config' => [
                        'title' => Az::$app->view->title,
                        'type' => ZCardWidget::type['dynCard'],
                    ]
                ]);

                $active = new Active();

                $form = $this->activeBegin($active);

                echo ZFormBuildWidget::widget([
                    'model' => $model,
                    'form' => $form,
                    'config' => [
                        'botBtn' => false
                    ]
                ]);

    
                $placeAddres = PlaceAdress::findOne($model->place_adress_id);

                if (!$placeAddres) {

                    $placeAddres = new PlaceAdress();

                    $placeAddres->configs->rules = validatorSafe;
                    if ($placeAddres->save()) {

                        $model->place_adress_id = $placeAddres->id;

                        $model->save();
                        
                        $this->urlRedirect([
                            $this->urlArrayStr,
                            'id' => $model->id,
                            'isNew' => true,
                            'spa' => 1,
                        ]);
                        
                    }

                }

                $placeAddres->cards = [
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
                                    ],
                                    [
                                        'region_form',
                                        'street',
                                    ],
                                    [
                                        'home',
                                    ],
                                    [
                                        'orientation',
                                    ],
                                    [
                                        'postal_code',
                                    ],
                                    [
                                        'place',
                                    ],
                                    [
                                        'location',
                                    ]
                                ],
                            ],
                        ],
                    ],
                ];

                $this->paramSet(paramChangeReloadId, 'supervisor-create-pjax');;
                $placeAddres->columns();

                $this->pjaxBegin(function (ZPjax $pjax) {
                    $pjax->id = 'supervisor-create-pjax';
                    return $pjax;
                });

                echo ZFormBuildWidget::widget([
                    'model' => $placeAddres,
                    'form' => $form,
                    'config' => [
                        'topBtn' => false
                    ]
                ]);

                $this->pjaxEnd();

                $this->activeEnd();

                ZCardWidget::end();

                if ($this->modelSave($model)) {
                    $this->paramSet(paramIframe, true);
                    $this->urlRedirect([
                        'process',
                        'shop_order_id' => $model->id,
                    ]);
                }

                if ($this->modelSave($placeAddres)) {
                    $model->place_adress_id = $placeAddres->id;
                }

                ?>


            </div>
        </div>


    </div>

</div>


<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>
