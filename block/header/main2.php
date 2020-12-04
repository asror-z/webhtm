<?php

/**
 *
 *
 * Author:  Asror Zakirov
 * https://www.linkedin.com/in/asror-zakirov
 * https://github.com/asror-z
 *
 */

use kartik\builder\Form;
use zetsoft\models\shop\ShopCatalog;
use zetsoft\system\Az;
use zetsoft\widgets\iconers\ZLangPickerWidget;
use zetsoft\widgets\inputes\ZLangCheckWidget;
use zetsoft\widgets\inputes\ZSelect2LangWidget;
use zetsoft\widgets\inputes\ZSelect2Widget;

?>


<div class="container-fluid header-main" style="background: #fafafa;">
    <div class="col-md-12 ">
        <div class="container-fluid">
            <div class="d-flex h-25">
                <div class="col-md-6 d-flex">
                    <div class="mt-2">
                        <i class="fas fa-phone-alt text-muted my-auto fe-9 mx-2"></i>
                        <a href="#" class="text-muted fr-08">+998 90 123 45 67</a>
                    </div>

                    <div class="d-flex mt-2">
                        <a href="#" class="ml-5 fr-08 text-muted">Помощь</a>
                        <a href="#" class="ml-5 fr-08 text-muted">Служба поддержки</a>
                        <a href="#" class="ml-5 fr-08 text-muted">

                        </a>
                        <a href="#menu">Demo open menu</a>
                    </div>
                </div>

                <div class="col-md-2 mt-1">
                    <div class="d-flex align-items-center mr-3">
                        <?
                        echo ZLangCheckWidget::widget()
                        ?>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="d-inline-flex my-1 ml-auto">
                        <a class="" href="#">
                            <?php
                            $current_currency = Az::$app->cores->session->get('currency');
                            $core_catalog = new ShopCatalog();

                            echo ZSelect2Widget::widget([
                                'config' => [
                                    'placeholder' => 'Выберите Валюту',
                                    'allowClear' => true,
                                    'theme' => ZSelect2Widget::theme['bootstrap'],
                                    'isHideSearch' => true,
                                    'selectColor' => '#f2faf2',
                                    'selectedColor' => '#e8e8e8',
                                    'size' => ZSelect2Widget::size['lg'],
                                    'imagePath' => false,
                                ],
                                'name' => 'currency',
                                'data' => $core_catalog->_currency,
                                'value' => $current_currency,
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
                            
JS,

                                ]
                            ]);
                            ?>
                        </a>

                    </div>
                </div>
                <div class="col-md-2 ml-auto d-flex">
                    <div class="d-inline-flex ml-auto">
                        <i class="fas fa-map-marker-alt text-success mx-2 my-auto fe-14"></i>
                        <a class="text-muted mt-2 fr-06"
                           href="#"> Мирзо-Улугбек,<br>
                            ул.Сухайл, 13а</a>
                    </div>
                </div>



            </div>
        </div>

    </div>
</div>




