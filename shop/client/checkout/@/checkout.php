<?php

use FontLib\Table\Type\name;
use rmrevin\yii\fontawesome\FA;
use zetsoft\dbitem\data\ALLApp;
use zetsoft\dbitem\data\Form;
use zetsoft\models\place\PlaceAdress;
use zetsoft\system\assets\ZColor;
use zetsoft\system\Az;
use zetsoft\system\column\ZEditableColumn;
use zetsoft\widgets\bozor\ZAdressWidget;
use zetsoft\widgets\cards\ZMyCardWidget;
use zetsoft\widgets\former\ZEditKartikWidget;
use zetsoft\widgets\incores\ZIRadioGroupWidget;
use zetsoft\widgets\incores\ZMRadioWidget;
use zetsoft\widgets\inptest\ZImageCheckboxGroupWidget;
use zetsoft\widgets\inputes\ZKDateTimePickerWidget;
use zetsoft\widgets\inputes\ZKTimePickerWidget;
//use zetsoft\widgets\market\ZMyCardWidget;
use zetsoft\widgets\navigat\ZButtonWidget;
use zetsoft\widgets\navigat\ZLiloAccordionWidget;
use zetsoft\widgets\navigat\ZPillWidget;
use zetsoft\widgets\notifier\ZKPopoverXWidget;


use zetsoft\widgets\notifier\ZSweetAlertWidget;
use zetsoft\widgets\places\ZYandexWidget;
use zetsoft\widgets\themes\ZCardWidget;
use zetsoft\widgets\themes\ZTabWidget;

?>
    <div class="row">
    <div class="col-6">

<?php

$userAddress = Az::$app->market->address->getAddress(57, 'user');

//vdd($userAddress);



echo  ZSweetAlertWidget::widget([
    'config' => [
        'functionName' => 'iframe',
        'iframe' => true,
        'url' => '/customer/main/address.aspx',
        'iframeHeight'=> '700px',
        'width' => 1000,
    ]
]);



$addressForm = ZButtonWidget::widget([
    'config' => [
        'icon' => 'fas fa-' . FA::_PENCIL_ALT,
        'hasIcon' => true,
        'btn' => false,
        'btnStyle' => ZButtonWidget::btnStyle['none'],
        'iconColor' => ZColor::color['black'],
    ],
    'event' => [
        'click' => 'iframe'
    ]
]);


ZAdressWidget::begin([
    'config' => [
        //'type' => ZAdressWidget::type['mdbCard'],

        'title' => Az::l("Адрес доставки")
    ]
]);


$radioGroupData = [];
foreach ($userAddress as $address)
{
    $radioGroupData[] = $address->name . $addressForm;
}
echo 'fedegsrrrrrrrrrrrrrrrrrrrrrrrrrrrs';
echo ZMRadioWidget::widget([
    'name' => 'address',
    'data' => $radioGroupData
]);

ZAdressWidget::end();

ZAdressWidget::begin([
    'config' => [
        //'type' => ZAdressWidget::type['mdbCard'],
        'headerColor' => ZColor::color['success-color'],
        'title' => Az::l("Время доставки")
    ]
]);

/*$time = ZImageCheckboxGroupWidget::widget([
    'name' => 'name',
    'data' => [
        '1' =>ZCardWidget::widget([
            'config' => [
                'content' => '09:00 - 12:00',
                'type' => ZCardWidget::type['slim'],
            ]
        ]),
        '2' => ZCardWidget::widget([
            'config' => [
                'content' => '12:00 - 15:00',
                'type' => ZCardWidget::type['slim'],
            ]
        ]),
        '3' => ZCardWidget::widget([
            'config' => [
                'type' => ZCardWidget::type['slim'],
                'content' => '15:00 - 18:00'
            ]
        ]),
        '4' => ZCardWidget::widget([
            'config' => [
                'content' => '18:00 - 21:00',
                'type' => ZCardWidget::type['slim'],
            ]
        ]),
    ],
    'config' => [
        'radio' => true,

    ]
]);

$tab1 = ZPillWidget::widget([
    'id' => 'timePill',
    'data' => [
        Az::l("CЕГОДНЯ") => $time,
        Az::l("ЗАВТРА") => $time,
        Az::l("ПЯТНИЦА") => $time,
        Az::l("СУББОТА") => $time,
        Az::l("ВОСКРЕСЕНЬЕ") => $time,
        Az::l("ПОНЕДЕЛЬНИК") => $time,
        Az::l("ВТОРНИК") => $time,

    ],
    'config' => [
        'tabPanelId' => 'tab-panel-id-1',
        'contentPanelId' => 'content-panel-id-1',
    ]
]);


$tab2 = ZKTimePickerWidget::widget([
    'name' => 'name',
    'config' => [
        'isShowSeconds' => false,
        'isShowMeridian' => false,
        'size' => ZKTimePickerWidget::size['lg']
    ]
]);

echo ZTabWidget::widget([
    'data' => [
        'ewd' => $tab1,
        'ewdq' => $tab2
    ]
]);*/

echo ZKDateTimePickerWidget::widget([
    'name' => 'dws',
]);

ZAdressWidget::end();

/*ZAdressWidget::begin([
    'config' => [
        //'type' => ZAdressWidget::type['mdbCard'],
        'headerColor' => ZColor::color['success-color'],
        'title' => Az::l("Оплата")
    ]
]);

echo ZImageCheckboxGroupWidget::widget([
    'name' => 'nameq',
    'data' => [
        '1' => 'visa',
        '2' => 'uzcart',
        '3' => 'humo',
    ]
]);


ZAdressWidget::end();*/

  ?>
    </div>
    <div class="col-6">
        <?php
            echo ZMyCardWidget::widget([

            ])
        ?>
    </div>
    </div>
