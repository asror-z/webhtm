<?php

/**
 *
 *
 * Author:  Asror Zakirov
 * https://www.linkedin.com/in/asror-zakirov
 * https://www.facebook.com/asror.zakirov
 * https://github.com/asror-z
 *
 */


use kartik\popover\PopoverX;
use yii\helpers\Html;
use zetsoft\widgets\dialogs\ZKPopoverXWidget;
use zetsoft\widgets\extend\ZPopoverX;

ZKPopoverXWidget::begin([
    'sToggleTag' => 'a',
    'sToggleLabel' => 'start widget',
    'header' => 'widget header',
    'footer' => 'widget footer'
]);

echo 'test popover body content';


ZKPopoverXWidget::end();


//ZPopoverX::begin([
//    'placement' => PopoverX::ALIGN_TOP,
//    'toggleButton' => ['label'=>'Login', 'class'=>'btn btn-default'],
//    'header' => '<i class="glyphicon glyphicon-lock"></i> Enter credentials',
//    'footer' => Html::button('Submit', [
//            'class' => 'btn btn-sm btn-primary',
//            'onclick' => '$("#kv-login-form").trigger("submit")'
//        ]) . Html::button('Reset', [
//            'class' => 'btn btn-sm btn-default',
//            'onclick' => '$("#kv-login-form").trigger("reset")'
//        ])
//]);
//
//echo 'test popover body content';
//
//ZPopoverX::end();
?>

