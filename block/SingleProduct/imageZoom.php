<?php

use zetsoft\widgets\market\ZZoomWpWidget;
$data = [
    'https://static-01.daraz.pk/p/83b3c9646204ea3de622893858c80f25.jpg',
    'https://photographyfirm.co.uk/wp-content/uploads/2016/06/WHITE-BACKGROUND-PRODUCT-PHOTOGRAPHY-19.jpg',
    'https://cdn.shopify.com/s/files/1/0072/2609/7731/products/product-image-677529483.jpg?v=1579678093',
    'https://buvelle.com/wp-content/uploads/2019/01/buvelle-sophie-black-mesh-full-black-BV1128-800x800.jpg',
    'https://www.isa-aydin.com/wp-content/uploads/2020/04/product-on-white-sample-2.jpg?x96595',
    'https://www.isa-aydin.com/wp-content/uploads/2020/04/product-on-white-sample-4.jpg?x96595',
];
echo ZZoomWpWidget::widget([
    'data'=> $product->image ??  $data
]);
