<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\models\ware\WareTrans;
use zetsoft\models\ware\WareTransItem;
use zetsoft\service\forms\Active;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZFormBuildWidget;
use zetsoft\widgets\inputes\ZDepdropWidget;
use zetsoft\widgets\navigat\ZButtonWidget;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;


/** @var ZView $this */


/**
 *
 * Action Params
 */

$action = new WebItem();

$action->title = Azl . 'Создание прихода в склад';
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

    echo ZSessionGrowlWidget::widget();?>

    <div id="content" class="content-footer p-3">

        <div class="row">
            <div class="mx-auto pt-5 col-md-11 col-11">

                <?php

                $ware_trans_id = $this->httpGet('ware_trans_id');
                $ware_trans = WareTrans::findOne($ware_trans_id);
                $user_company_id = $this->httpGet('user_company_id');

                $model = new WareTransItem();

                if ($this->modelSave($model)) {

                    $this->paramSet(paramIframe, true);

                    $this->urlRedirect([
                        'process',
                        'ware_trans_id' => $ware_trans_id,
                    ]);
                }

                $active = new Active();
                $active->type = Active::type['vertical'];
                $active->childClass = 'my-3';

                $form = $this->activeBegin($active);

                $model->ware_trans_id = $ware_trans_id;

                $model->configs->ajax = [
                    'shop_catalog_id' => false
                ];

                $model->configs->options = [
                    'shop_catalog_id' => [
                        'data' => Az::$app->inputs->depend->getCatalogsFromWare($ware_trans->warehouse_from),
                        'active' => [
                            'select' => true,
                        ],
                        'event' => [
                            'select' => <<<JS
              function() {
                    $.ajax({
                        url: '/api/shop/orders/getPrice.aspx',
                        data: {
                            shop_catalog_id: $(this).val()
                        },
                        success: function(response) {
                            $('#waretransitem-price').val(response.price)
                            
                            var amountVal = $('#waretransitem-amount').val()
                            var amount = parseInt(amountVal)
                            if (amountVal === '') {
                                $('#waretransitem-price_all').val(response.price)
                            } else {
                                var price_all = amount * response.price;
                            
                                $('#waretransitem-price_all').val(price_all)
                            }
                        }
                    })
              }
JS,

                        ]
                    ],
                    'amount' => [
                        'active' => [
                            'change' => true,
                        ],
                        'event' => [
                            'change' => <<<JS
            function() {
               
                var shop_catalog = $('#waretransitem-shop_catalog_id');
              
                if (shop_catalog.val() !== '') {
                    $.ajax({
                        url: '/api/shop/orders/getAllPrice.aspx',
                        data: {
                            shop_catalog_id: shop_catalog.val(),
                            amount: $(this).val(),
                        },
                        success: function(response) {
                      
                $('#waretransitem-price_all').val(response.price_all)
                
                        }
                    })
                }
              
            }
JS,
                        ]
                    ]
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
                                        'ware_trans_id',
                                    ],
                                    [
                                        'shop_catalog_id',
                                        'best_before',
                                    ],
                                    [
                                        'ware_series_id',
                                        'measure',
                                    ],
                                    [
                                        'price',
                                        'amount',
                                    ],
                                    [
                                        'price_all',
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
                        'blockType' => ZFormBuildWidget::blockType['naked']
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
