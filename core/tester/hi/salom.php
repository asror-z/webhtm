<?php

/**
 *
 *
 * Author:  Asror Zakirov
 * https://www.linkedin.com/in/asror-zakirov
 * https://github.com/asror-z
 *
 */


/** @var ZView $this */

use zetsoft\models\shop\ShopCatalog;
use zetsoft\models\place\PlaceCountry;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\inptest\ZKSelect2AjaxWidget;
use zetsoft\widgets\inputes\ZKSelect2Widget;

$action->title = Azl . 'Веб-действия';

$action->icon = 'fa fa-cubes';
$action->debug = true;
$action->type = WebItem::type['html'];


$core_catalog = new ShopCatalog();
echo ZKSelect2Widget::widget([
    'name' => 'currency',
    'data' => $core_catalog->_currency,
    'event' => [
        'select' => <<<JS
            function () {
                var selectC = $(this);
                $.ajax({
                  method: "GET",
                  url: "/core/product/setCurrency.aspx",
                  data: {
                      currency: selectC.val(),
                  },
                  success: function(data){
                      console.log(data);
                  },
                  error:  function() {
                    //alert('error');
                  }      
                })
            }
               
JS

    ]
]);
