<?php

use PhpOffice\PhpSpreadsheet\Shared\OLE\PPS\Root;
use zetsoft\dbitem\data\TabItem;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\market\ZReviewWidget;
use zetsoft\widgets\navigat\ZSmartTabWidget;
/** @var ZView $this */
$tabs = [];
$product = new TabItem();
$product->label = 'Информация';
$product->content =  $product->name;
$product->class = 'p-1';
$product->pushUrl = true;
$tabs[] = $product;
$product = new TabItem();
$product->label = 'Характеристика';
$product->content = $this->require('/render/bozor/ZCProductFeatureWidget/clean1.php', ['item'=>$product]);
$product->class = 'pt-3 ';
$tabs[] = $product;
$product = new TabItem();
$product->label = 'Отзывы';
$product->content =
    ZReviewWidget::widget([
        'config' => [
            'data' => $company
        ]
    ]);
$product->class = 'pt-3';
$tabs[] = $product;
$product = new TabItem();
$product->label = 'Вопросы и Ответы';
//$product->content = $this->require('/render/market/Questions answers/clean.php');
$product->content = '';
$product->class = 'p-1';
$tabs[] = $product;


echo ZSmartTabWidget::widget([
    'data' => $tabs,
    'config' => [
        'type' => ZSmartTabWidget::theme['Classic'],
        //'tab-margin'=>'mx-1'
    ],
]);
?>

