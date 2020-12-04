<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\models\ware\WareTransItem;
use zetsoft\service\forms\Active;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZFormBuildWidget;

use zetsoft\widgets\inputes\ZHHiddenInputWidget;
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

                <?


                $id = $this->httpGet('ware_trans_id');
                $ware_id = $this->httpGet('ware_id');
                $user_company_id = $this->httpGet('user_company_id');

                $model = new WareTransItem();

                if ($this->modelSave($model)) {

                    $this->paramSet(paramIframe, true);

                    $this->urlRedirect([
                        'process',
                        'ware_trans_id' => $model->id,
                    ]);
                }


                $active = new Active();
                $active->type = Active::type['vertical'];
                $active->childClass = 'my-3';

                $form = $this->activeBegin($active);

                $model->ware_trans_id = $id;
                $model->configs->readonlyWidget = [
                    'ware_trans_id'
                ];
                $model->configs->nameOff = [
                    'name',
                ];
                $model->configs->options = [

                    'shop_catalog_id' => [
                        'data' => Az::$app->market->order->getElementFormUserCompany($ware_id, $user_company_id),
                        'event' => [
                            'select' => <<<JS
    function() {
      
        
        $.ajax({
            url: '/api/orders/measure.aspx',
            data: {
                shop_element_id: $(this).val(),
            },
            success: function(response) {
            
               var measure = $('#wareenteritem-weight');
               var label = $('[for="wareenteritem-weight"]');
               measure.attr('placeholder', response.output) 
               label.html(response.output)
                
            }
        })    
        
      
    }
JS,

                        ]
                    ]
                ];

                $model->configs->widget = [
                    'ware_trans_id' => ZHHiddenInputWidget::class
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
                                        'name',
                                        'ware_trans_id',
                                        'shop_catalog_id',
                                        'ware_series_id',
                                        'amount',
                                        'measure',
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
