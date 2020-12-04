<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\models\shop\ShopOrderItem;
use zetsoft\service\forms\Active;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZFormWidget;
use zetsoft\widgets\inputes\ZDepdropWidget;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;
use zetsoft\widgets\themes\ZCardWidget;


/** @var ZView $this */


/**
 *
 * Action Params
 */

$action = new WebItem();

$action->title = Azl . 'Создание Заказы';
$action->icon = 'fal fa-power-off';
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

    echo ZSessionGrowlWidget::widget();?>

    <div id="content" class="content-footer p-3">

        <div class="row">
            <div class="col-md-12 col-12">

                <?

                $id = $this->httpGet('shop_order_id');

                $model = new ShopOrderItem();

                $model->configs->nameOn = [

                    'user_company_id',
                    'shop_catalog_id',
                    'amount'

                ];


                $model->configs->widget = [
                    'shop_catalog_id' => ZDepdropWidget::class
                ];

                $model->configs->options = [
                    'shop_catalog_id' => [
                        'config' => [
                            'depend' => 'user_company_id',
                            'method' => 'getCompaniesCatalog'
                        ]
                    ]

                ];

                //                $model->cards = [
                //                    [
                //                        'title' => Az::l('Первый этап'),
                //                        'shows' => true,
                //                        'items' => [
                //                            [
                //                                'title' => Az::l('Форма'),
                //                                'shows' => true,
                //                                'items' => [
                //                                    'user_company_id',
                //                                    'shop_catalog_id',
                //                                    'amount'
                //                                ],
                //                            ],
                //                        ],
                //                    ],
                //                ];

                $model->shop_order_id = $id;

                $model->columns();

                if ($this->modelSave($model)) {

                    /**
                     * Post save Actions
                     */
/*
                    $order = ShopOrder::findOne($model->shop_order_id);

                    $elem = $order->shop_element_ids;
                    if (empty($elem))
                        $elem = [];

                    if (!is_array($elem))
                        $elem = [$elem];

                    $catalog = $model->getShopCatalogOne();


                    $elem[] = $catalog->shop_element_id;

                    $elem = array_unique($elem);

                    $order->shop_element_ids = $elem;

                    $order->save();*/
                    

                    $this->paramSet(paramIframe, true);

                    $this->urlRedirect([
                        'process',
                        'shop_order_id' => $id,
                    ]);

                }


                ZCardWidget::begin([
                    'config' => [
                        'title' => Az::$app->view->title,
                        'type' => ZCardWidget::type['dynCard'],
                    ]
                ]);


              //  $get = $this->httpGet();

                $active = new Active();

             //   $active->id = ZArrayHelper::getValue($get, 'formId');

                $form = $this->activeBegin($active);

                echo ZFormWidget::widget([
                    'model' => $model,
                    'form' => $form,
                ]);

                $this->activeEnd();

                ZCardWidget::end();

                ?>

            </div>
        </div>


    </div>

</div>


<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>
