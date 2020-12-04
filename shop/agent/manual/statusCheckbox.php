<?php

/**
 *
 *
 * Author: Xolmat Ravshanov
 * https://www.linkedin.com/in/asror-zakirov
 * https://github.com/asror-z
 *
 */

use kartik\editable\Editable;
use zetsoft\system\Az;
use zetsoft\widgets\former\ZEditKartikWidget;
use zetsoft\widgets\inputes\ZKSelect2Widget;
use zetsoft\widgets\inputes\ZMImageRadioGroupWidget;

$agentId = $this->userIdentity()->id;
$model = $this->modelGet(\zetsoft\models\user\User::class, $agentId);

//$model   = $this->modelGet(\zetsoft\models\user\User::class ,126);

?>
<div class="m-2">
    <?php

    echo ZKSelect2Widget::widget([
        'data' => [
            'online' => Az::l('Активен'),
            'offline' => Az::l('Отключен'),
            'away' => Az::l('Отошел'),
            'dnd' => Az::l('Не беспокоить'),
            'lunch' => Az::l('Перерыв на обед'),
            'process' => Az::l('Обработка'),
        ],

        'config' => [
            'ajax' => false,
        ],
        
        'active' => [
          'select' => true,
        ],

        'name' => 'status',
        'value' => $this->userIdentity()->status,
        'event' => [
            'select' => <<<JS
                 $.ajax({
                    url: '/api/core/market/agent_status.aspx',                              
                    method: 'GET',
                    
                    data: {
                        id: {$this->userIdentity()->id},
                        status: this.value
                    },
                })             
                
JS,
        ]
    ]);
    ?>
</div>
<?php

/*echo ZEditKartikWidget::widget([
    'model' => $model,
    'attribute' => 'status',
    'config' => [
        'inputType' => Editable::INPUT_WIDGET,
        'widgetClass' => ZMImageRadioGroupWidget::class,
        'format' => ZEditKartikWidget::format['link'],
        'placement' => ZEditKartikWidget::placement['ALIGN_AUTO_BOTTOM'],
        'asPopover' => true,
        'displayValueConfig' => [
            'online'  => Az::l('Активен'),
            'offline' => Az::l('Отключен'),
            'away' => Az::l('Отошел'),
            'dnd' => Az::l('Не беспокоить'),
            'lunch' => Az::l('Перерыв на обед'),
            'process' => Az::l('Обработка'),
        ],
    ],
    
    'event'=>[
        'editableSubmit' => <<<JS
            function(event, val, form)  {
                 $.ajax({
                        url: '/api/calls/time/setTime.aspx',
                        method: "GET",
                        data: {
                            userId: " {$this->userIdentity()->id} ",
                        },
                        success: function(data){
                               console.log(data) 
                               console.log(data) 
                               console.log(data) 
                               console.log(data) 
                               console.log(data) 
                               console.log(data) 
                               console.log(data) 
                               console.log(data) 
                               console.log(data) 
                               console.log(data) 
                               console.log(data) 
                               console.log(data) 
                               console.log(data) 
                        }
                    })
            }
JS,
    ],
]);*/

?>
