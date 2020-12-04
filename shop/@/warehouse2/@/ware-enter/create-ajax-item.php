<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\models\ware\WareEnterItem;
use zetsoft\service\forms\Active;
use zetsoft\service\forms\Ajaxer;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZUrl;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZFormBuildWidget;
use zetsoft\widgets\former\ZFormWidget;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;
use zetsoft\widgets\themes\ZCardWidget;
use zetsoft\models\ware\WareEnter;


/** @var ZView $this */


/**
 *
 * Action Params
 */

$action = new WebItem();

$action->title = Azl . 'Создание Поступление товаров в склад';
$action->icon = 'fal fa-film';
$action->type = WebItem::type['ajax'];
$action->csrf = true;
$action->debug = true;



$this->paramSet(paramAction, $action);
?>

<div id="content" class="content-footer p-3">

    <div class="row">
        <div class="col-md-12">

            <?


            $formId = $this->httpGet('formId');
            $model = new WareEnterItem();

            if ($this->httpPost('WareEnterItem')) {
                $model->setAttributes($this->httpPost('WareEnterItem'));
                $model->save();

            }

            $active = new Ajaxer();
            $active->id = $formId;
            $active->formAction = ZUrl::to(['create-process-item', 'id' => $this->httpGet('id')]);
            $active->success = <<<JS
        function() {
          
            $('#WareEnterItem-modal').modal('hide')
            $('#WareEnterItem_Grid_Reset').click()
          
        }
JS;

            $form = $this->ajaxBegin($active);
                        
            $model->configs->value = [
                'ware_enter_id' => $this->httpGet('id')
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
                                    'ware_enter_id',
                                    'shop_element_id',
                                    'amount',
                                    'measure',
                                    'price_buy',
                                    'price',
                                    'ware_series_id',
                                    'currency',
                                    'weight',
                                ],
                            ],
                        ],
                    ],
                ],
            ];
            $model->configs->options = [
                'ware_enter_id' => [
                    'config' => [
                        'readonly' => true
                    ]
                ]
            ];
            $model->columns();

            echo ZFormWidget::widget([
                'model' => $model,
                'form' => $form,
                'config' => [
                    
                ]
            ]);

            $this->ajaxEnd();


            ?>

        </div>
    </div>


</div>
