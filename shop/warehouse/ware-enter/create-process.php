<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\models\ware\WareEnterItem;
use zetsoft\service\forms\Active;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZUrl;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZFormBuildWidget;
use zetsoft\widgets\former\ZFormWidget;
use zetsoft\widgets\inputes\ZInputBtnWidget;
use zetsoft\widgets\inputes\ZInputWidget;
use zetsoft\widgets\navigat\ZButtonWidget;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;
use zetsoft\widgets\themes\ZCardWidget;
use zetsoft\models\ware\WareEnter;
use zetsoft\widgets\inputes\ZLibraInputWidget;


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
            <div class="mx-auto pt-3 col-md-11 col-11">

                <?

                $ware_enter_id = $this->httpGet('ware_enter_id');

                $model = new WareEnterItem();

                if ($this->modelSave($model)) {

                    $this->paramSet(paramIframe, true);

                    $this->urlRedirect([
                        'process',
                        'ware_enter_id' => $ware_enter_id,
                    ]);

                }

                $model->ware_enter_id = $ware_enter_id;
                $model->configs->readonlyWidget = [
                    'ware_enter_id'
                ];

                $model->cards = [
                    [
                        'title' => Az::l('Первый этап'),
                        'items' => [
                            [
                                'title' => Az::l('Форма'),
                                'items' => [
                                    [
                                        'ware_enter_id',
                                        'shop_catalog_id',
                                    ],
                                    [
                                        'amount',
                                        'price_buy',
                                    ],
                                    [
                                        'price',
                                        'currency',
                                    ],
                                    [
                                        'price_all'
                                    ],
                                ],
                            ],
                        ],
                    ]
                ];

                $model->configs->nameOff = [
                    'name',
                    'shop_catalog_ware_id',
                    'measure',
                ];
                $model->configs->widget = [
                    'weight' => ZHInputWidget::class
                ];

                $model->configs->options = [
                    'shop_catalog_id' => [
                        'config' => [
                            'active' => [
                                'select' => true,
                            ],
                            'addonAppendContent' => ZButtonWidget::widget([
                                'config' => [
                                    'title' => Az::l('Добавить Каталог'),
                                    'icon' => 'fas fa-plus',
                                    'pjax' => 0,
                                    'url' => '/shop/warehouse/shop-catalog/index.aspx',
                                    'btnRounded' => false,
                                    'btn' => false,
                                    'hasIcon' => true,
                                    'target' => ZButtonWidget::target['_blank'],
                                ],
                            ]),
                        ],
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
                            var amountVal = $('#wareenteritem-amount').val()
                            var amount = parseInt(amountVal)
                            if (amountVal === '') {
                                $('#wareenteritem-price').val(response.price)
                            } else {
                                var price_all = amount * response.price;
                            
                                $('#wareenteritem-price').val(price_all)
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
                           
               
                var shop_catalog = $('#wareenteritem-shop_catalog_id');
              
                if (shop_catalog.val() !== '') {
                    $.ajax({
                        url: '/api/shop/orders/getAllPrice.aspx',
                        data: {
                            shop_catalog_id: shop_catalog.val(),
                            amount: $(this).val(),
                        },
                        success: function(respons1) {
                      
                $('#wareenteritem-price_all').val(respons1.price_all)
                
                        }
                    })
                }
              
    
JS,
                        ],
                    ]
                ];
                $model->configs->changeSave = true;
                $model->columns();

                $active = new Active();
                $active->type = Active::type['vertical'];
                $active->childClass = 'my-3';

                $form = $this->activeBegin($active);

                echo ZLibraInputWidget::widget([
                    'config' => [
                        'objectName' => 'libra',
                        'mode' => ZLibraInputWidget::mode['manual'],
                        'inputSelector' => '#wareenteritem-weight',
                        'autorun' => true,
                    ],
                ]);

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
