<?php

/**
 *
 *
 * Author:  Maxamadjonov Jaxongir
 *
 */

use kartik\detail\DetailView;
use zetsoft\models\App\eyuf\EyufDocumentType;
use zetsoft\widgets\former\ZViewWidget;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\former\ZFormWizardWidget;
use zetsoft\widgets\market\ZBlockProductWidget;

/** @var ZView $this */
$action = new WebItem();

$action->title = Azl . 'Product Blocks';
$action->icon = 'fa fa-cloud-download';

$id = $this->httpGet('id');

echo '<div class="container">';
echo ' <div class="row">';
           
echo ZBlockProductWidget::widget([
    'config' => [
        'type' => ZBlockProductWidget::types['main'],
        'url'=> 'https://www.mediapark.uz/upload/file/article/images/news_pix.png',
        'price' =>'1 399 000',
    ],
]);
echo ZBlockProductWidget::widget([
    'config' => [
        'type' => ZBlockProductWidget::types['amain'],
        'day' => '3',
        'text' => 'Ноутбук Lenovo 80UD i7/8GB/1000GB/VGA2',
        'price' =>'5 699 000',
        'price_old' => '7 040 000',
        'url'=>'https://www.mediapark.uz/upload/file/mp/products/Notebook/Lenovo_80UD_i7.jpg'
    ],
]);
echo ZBlockProductWidget::widget([
    'config' => [
        'type' => ZBlockProductWidget::types['new'],
        'day' => '7',
        'text' => 'Смартфон Xiaomi Redmi 8A Dual 32 ГБ Sky White',
        'price' =>'1 430 000',
        'url'=>'https://www.mediapark.uz/upload/file/mp/products/smartfony/Xiaomi_Redmi_8A_Dual_32_Sky_White.jpg'

    ],
]);
echo '</div> </div>';


?>


