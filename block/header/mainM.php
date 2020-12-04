<?php

/**
 *
 *
 * Author:  Asror Zakirov
 * https://www.linkedin.com/in/asror-zakirov
 * https://github.com/asror-z
 *
 */

use zetsoft\models\shop\ShopCatalog;
use zetsoft\system\Az;
use zetsoft\widgets\iconers\ZLangPickerWidget;
use zetsoft\widgets\inputes\ZHInputWidget;
use zetsoft\widgets\inputes\ZKSelect2Widget;
use zetsoft\widgets\inputes\ZSelect2Widget;
use zetsoft\widgets\inputes\ZTextAreaWidget;
use zetsoft\widgets\market\ZSVGWidget;

?>
<style>
    .lang-currency {
        z-index: 2000;
    }
    .lang-currency a {
        color: #888;
        transition: .1s !important;
    }
    .lang-currency:hover a{
        transition: .1s;
        color: #00c851;
    }
    .market-header-menu a {
        color: #888;
        transition: .1s !important;
    }
    .market-header-menu a:hover {
        transition: .1s;
        color: #00c851;
    }
    .market-header-menu .market-phone {
        color: #888;
        transition: .1s;
        margin: 0 3px;
    }
    .market-header-menu .market-phone:hover {
        transition: .1s;
        color: #00c851;
    }
</style>


  <div class="d-flex justify-content-between p-2" style="background: #fff;z-index: 3; width: 95%; margin: 0 auto;">
    <div class="d-flex flex-grow-1 justify-content-around flex-wrap market-header-menu">
      <div class="market-phone">
        <i class="fas fa-phone my-auto"></i>
        <a href="tel:+998 90 123 45 67" class="fp-15">+998 90 123 45 67</a>
      </div>
      <a href="/shop/cores/info/help.aspx" class="fp-15">Помощь</a>
      <a href=#" data-toggle="modal" data-target="#callBackModal" class="fp-15">Служба поддержки</a>
      <a href="/shop/cores/faqs/index.aspx" class="fp-15">ЧАВО</a>
    </div>
    <div class="flex-grow-1"></div>
    <div class="flex-grow-1"></div>
    <div class="d-flex flex-grow-1 justify-content-around flex-wrap">
      <div class="lang-currency mx-4">
        <a id="langPick" href="#" class="d-block my-auto">Язык / Валюта</a>
        <div class="position-absolute lang-cart z-depth-1 p-2 bg-white" style="display: none">
            <div class="d-flex justify-content-center align-items-center mb-3 p-2" >
                <?
                echo ZLangPickerWidget::widget();
                ?>
            </div>
          <div class="lang-cart-header d-flex flex-column m-3 p-2">
              
            <!--Trigger-->
              <?

              $core_catalog = new ShopCatalog();
              echo ZSelect2Widget::widget([
                  'name' => 'adasd',
                  'data' => $core_catalog->_currency,
              ]);
              ?>



          </div>
        </div>
      </div>

    </div>
  </div>


  <div class="modal fade" id="callBackModal" tabindex="-1" role="dialog" aria-labelledby="callBackModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header text-center">
          <p class="modal-title fp-20" id="callBackModalLabel">Служба поддержки</p>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true" class="fp-30">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="col-md-12">
            <h3 class="text-center">Обратная связь</h3>
            <p class="text-center text-muted font-weight-normal fp-16">Мы всегда готовы ответить на любой вопрос, а также <br> услышать ваши отзывы и предложения по работе нашего сервиса.</p>
            <div class="d-flex">

              <div class="col-md-6">

                  <?
                  echo ZHInputWidget::widget([
                      'config' => [
                          'class' => 'fp-16',
                          'placeholder' => Az::L('Ваше имя')

                      ]
                  ])
                  ?>

              </div>

              <div class="col-md-6">
                  <?
                  echo ZHInputWidget::widget([
                      'config' => [
                          'class' => 'fp-16',
                          'placeholder' => Az::L('Ваш город')

                      ]
                  ])
                  ?>
              </div>

            </div>

            <div class="d-flex">

              <div class="col-md-6">

                  <?
                  echo ZHInputWidget::widget([
                      'config' => [
                          'class' => 'fp-16',
                          'placeholder' => Az::L('Мобильный телефон')

                      ]
                  ])
                  ?>

              </div>

              <div class="col-md-6">
                  <?
                  echo ZHInputWidget::widget([
                      'config' => [
                          'class' => 'fp-16',
                          'placeholder' => Az::L('Адрес электронной почты')
                      ]
                  ])
                  ?>
              </div>

            </div>

            <div class="col-md-12">

              <div>

                  <?
                  echo ZTextAreaWidget::widget([
                      'config' => [

                          'placeholder' => Az::L('Опишите ваш вопрос'),
                          'rows' => 1,
                          'class' => 'border-light fp-17',
                          'style' => 'max-height: 10px;'

                      ]
                  ]);
                  ?>

              </div>

            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Отменить</button>
          <button type="button" class="btn btn-success">Отправить</button>
        </div>
      </div>
    </div>
  </div>




<script>
    $('#langPick').on('click', function () {
        $(".lang-cart").fadeToggle("fast");
    });
</script>



