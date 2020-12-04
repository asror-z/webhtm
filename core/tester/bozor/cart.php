<?php

/**
 *
 *
 * Author:  Madaminov Shaykhnazar
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


