<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\models\shop\ShopOrder;
use zetsoft\models\shop\ShopOrderItem;
use zetsoft\service\forms\Active;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\helpers\ZUrl;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZFormBuildWidget;
use zetsoft\widgets\inputes\ZInputWidget;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;

/** @var ZView $this */


/**
 *
 * Action Params
 *
 */

$action = new WebItem();

$action->title = Azl . 'Создание прихода в склад';
$action->icon = 'fal fa-film';
$action->debug = false;
$action->type = WebItem::type['html'];




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
            <div class="mx-auto pt-3 col-md-11 col-11">

                <?

                $shop_order_id = $this->httpGet('shop_order_id');
                $model = new ShopOrderItem();

                if ($this->modelSave($model)) {

                    $this->paramSet(paramIframe, true);

                    $this->urlRedirect([
                        'process',
                        'shop_order_id' => $shop_order_id,
                    ]);
                }

                $active = new Active();
                $active->type = Active::type['vertical'];
                $active->childClass = 'my-3';
                $form = $this->activeBegin($active);

                $model->shop_order_id = $shop_order_id;

                $model->configs->options = [
                    'shop_catalog_id' => [
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
                            $('#shoporderitem-price').val(response.price)
                            
                            var amountVal = $('#shoporderitem-amount').val()
                            var amount = parseInt(amountVal)
                            if (amountVal === '') {
                                $('#shoporderitem-price_all').val(response.price)
                            } else {
                                var price_all = amount * response.price;
                            
                                $('#shoporderitem-price_all').val(price_all)
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
                   
                   function () {
                var shop_catalog = $('#shoporderitem-shop_catalog_id');
              
                if (shop_catalog.val() !== '') {
                    $.ajax({
                        url: '/api/shop/orders/getAllPrice.aspx',
                        data: {
                            shop_catalog_id: shop_catalog.val(),
                            amount: $(this).val(),
                        },
                        success: function(response) {
                      
                $('#shoporderitem-price_all').val(response.price_all)
                
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
                                        'shop_order_id',
                                        'user_company_id',
                                    ],
                                    [
                                        'shop_catalog_id',
                                        'amount',
                                    ],
                                    [
                                        'best_before',
                                        'price',
                                        'price_all',
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
                        'cols' => 1,
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
