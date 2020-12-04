<?php


use zetsoft\former\core\CoreCurrencyForm;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\former\ZFormWidget;


/** @var ZView $this */

$form = $this->activeBegin();


echo ZFormWidget::widget([
    'model' => new zetsoft\former\core\CoreCurrencyForm(),
    'form' => $form
]);




$this->activeEnd();

