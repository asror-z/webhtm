<?php

/**
 *
 *
 * Author:  Asror Zakirov
 * https://www.linkedin.com/in/asror-zakirov
 * https://github.com/asror-z
 *
 */

use zetsoft\system\Az;
use zetsoft\system\helpers\ZVarDumper;
use zetsoft\widgets\former\ZListViewWidgetOld;
use zetsoft\widgets\market\ZMarketCardsWidget;

$get = $this->httpGet('ZDynamicModel');
 $product_id = $get['product_id'];

   echo ZVarDumper::beauty($get);

   $product_id = 9;
   $options = [11, 2, 18];

   $model = Az::$app->market->product->catalogsByElement($product_id, $options);

   echo ZListViewWidgetOld::widget([
        'model' => $model,
        'config' => [
            'itemView' =>  function ($model, $key, $index, $widget) {
       

            }
        ]
   ]);

 /*echo ZListViewWidgetOld::widget([
     'model' => $this->model,
     'config' => [
         'itemView' => function ($model, $key, $index, $widget) {
             echo "<div class='m-0'>";
             echo ZMarketCardsWidget::widget([
                 'config' => [
                     'type' => ZMarketCardsWidget::type['featureHorizontal'],
                 ],
                 'model' => $model
             ]);

             echo "</div>";

         },

         'layout' => '{items}'
     ]
 ]);*/
