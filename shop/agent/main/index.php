<?php

use kartik\daterange\DateRangePicker;
use kartik\grid\DataColumn;
use zetsoft\dbitem\core\WebItem;
use zetsoft\dbitem\data\ALLApp;
use zetsoft\dbitem\data\Form;
use zetsoft\models\drag\DragFormDb;
use zetsoft\service\forms\Active;
use zetsoft\system\assets\ZColor;
use zetsoft\system\Az;
use zetsoft\system\column\ZKDataColumn;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZCheckButtonWidget;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\former\ZFormWidget;
use zetsoft\widgets\inputes\ZHHiddenInputWidget;
use zetsoft\widgets\inputes\ZInputWidget;
use zetsoft\widgets\inputes\ZKDateRangePickerWidget;
use zetsoft\widgets\inputes\ZPeriodPickerWidget;
use zetsoft\widgets\menus\ZMmenuWidget;
use zetsoft\widgets\menus\ZMmenuWidgetSh;
use zetsoft\widgets\navigat\ZButtonWidget;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;
use zetsoft\models\shop\ShopOrder;
use zetsoft\widgets\phone\ZSipml5Widget44;
use zetsoft\widgets\phone\ZSipml5WidgetX;


/** @var ZView $this */


/**
 *
 * Action Params
 */

$action = new WebItem();

$action->title = Azl . 'Заказы';
$action->icon = 'fa fa-pie-chart';
$action->type = WebItem::type['html'];
$action->csrf = true;
$action->debug = true;
$action->layout = true;
$action->layoutFile = 'admin';


$this->paramSet(paramAction, $action);

$this->title();
$this->toolbar();


/*$id = $this->httpPost('id', null, true);
$name = $this->httpPost('id', null, true);
$name = $this->httpPost('id', null, true);*/


?>
<div id="content" class="content-footer p-3">

  <div class="row">
    <!--DynaWidget begin-->
    <div class="col-md-10 col-10">
      <div class="row">
          <? $form = $this->ajaxBegin(); ?>
        <div class="col-lg-4 d-flex">
            <?php

            $model = new ShopOrder();
            $startRange = $this->sessionGet('rangeDatePeriod');


            $app = new ALLApp();

            $column = new Form();
            $column->dbType = dbTypeDate;
            $column->widget = ZHHiddenInputWidget::class;
            $app->columns['start'] = $column;

            $column = new Form();
            $column->dbType = dbTypeDate;
            $column->widget = ZHHiddenInputWidget::class;
            $app->columns['end'] = $column;

            $column = new Form();
            $column->title = 'form_id';
            $column->widget = ZPeriodPickerWidget::class;
            $column->options = [
                'config' => [
                    'valueStart' => 'start',
                    'valueEnd' => 'end',
                ],
                'value' => $startRange,
            ];


            $app->columns['period'] = $column;

            $model_d = Az::$app->forms->former->model($app);


            echo ZFormWidget::widget([
                'model' => $model_d,
                'form' => $form,
                'config' => [
                    'topBtn' => false,
                    'botBtn' => false,
                ],


            ]);

            ?>
        </div>
          <?php


          $model->configs->nameOff = [
              'contact_phone',
              // 'date_deliver'

          ];

          $model->configs->nameShowEx = $nameHide = [

              'modified_at',
              'created_by',
              'modified_by',
              'deleted_by',
          ];

          $model->configs->after = [
              'contact_name' => [
                  [
                      'class' => ZKDataColumn::class,
                      'label' => Az::l('Контактное имя'),
                      'width' => '50px',
                      'value' => function ($model, $key, $index, DataColumn $dataColumn) {


                          $clickedNumber = $model->contact_phone;

                          $code = 'function (event)
                                        {
                                           e.preventDefault(); 
                                           var phoneNumber = document.getElementById("txtPhoneNumber").value = "309";
                                           sipCall("call-audio");
                                            
                                        console.log(phoneNumber) 
                                        
                                        }';

                          $code = strtr($code, [
                              '{number}' => $clickedNumber,
                          ]);

                          //vdd($clickedNumber);
                          return ZButtonWidget::widget([

                              'id' => 'settings-widget-' . $key,
                              'config' => [
                                  'title' => Az::l('Настроить Виджет'),
                                  'icon' => 'fa fa-phone fa-2x fa-inverse',
                                  'pjax' => 0,
                                  'btnSize' => ZColor::btnSize['btn-sm'],
                                  'btnRounded' => true,
                                  'btn' => true,
                                  'hasIcon' => true,
                                  'color' => ZColor::color['green'],

                              ],
                              'event' => [
                                  'click' => $code,
                              ]
                          ]);
                      }
                  ],
              ]
          ];

          $model->columns();
          $post = $this->httpPost('ZDynamicModel');


          $period = ZArrayHelper::getValue($post, 'period');
          if ($post !== null) {
              $dateBegin = $period[0];
              $dateEnd = $period[1];

              $this->sessionSet('rangeDatePeriod', $period);
              $this->urlRedirect(['/agent/main/index'], true);

          }

          if ($startRange) {
              $beginDate = $this->sessionGet('rangeDatePeriod')[0];
              $endDate = $this->sessionGet('rangeDatePeriod')[1];


              if ($beginDate && $endDate) {
                  $model->configs->query = ShopOrder::find()->where(['between', 'created_at', $beginDate, $endDate]);
              }
          }
          $model->columns();

          ?>
        <div class="col-lg-4 pt-4 ">
            <?php
            echo ZButtonWidget::widget([
                'config' => [
                    'text' => Az::l('Филтровать'),
                    'btnType' => ZButtonWidget::btnType['submit'],
                    'btnRounded' => false,
                    'btnStyle' => 'text-success border border-success',
                    'btnSize' => 'btn-ml',
                    'class' => 'p-0 pl-3 pr-3'
                ]
            ]);
            echo ZButtonWidget::widget([
                'config' => [
                    'text' => Az::l('Очистить филтр'),
                    'btnType' => ZButtonWidget::btnType['button'],
                    'btnRounded' => false,
                    'btnStyle' => 'text-info border border-info',
                    'btnSize' => 'btn-ml',
                    'class' => 'p-0 pl-3 pr-3',

                ],
                'event' => [
                    'click' => <<<JS
                                      
                          
                                function() {

                                        $.ajax({
                                            type: 'POST',
                                            url: '/core/product/rangeClear.aspx',
   
                                            success: function (response) {
                                                location.reload();
                                            },
                                        });
                                    
                                }
JS
                ]
            ]);
            ?>
        </div>
          <? $this->ajaxEnd(); ?>
        <div class="col-lg-12 d-flex">
            <?php

            /** @var ZView $this */
            echo ZDynaWidget::widget([
                'model' => $model,
                'rightNameEx' => [
                    'system'
                ],
                'config' => [
                    'hasToolbar' => false,
                    'actionButtons' => ['false'],
                    'columnBefore' => ['false'],
                    'columnAfter' => ['false'],

                    'paginationOptions' => [

                        'defaultPageSize' => 5,

                    ],
                ]
            ]);
            /*   if($this->sessionGet('rangeDatePeriod'))
                   $this->sessionSet('rangeDatePeriod',null);*/
            ?>
        </div>
      </div>
    </div>
    <div class="col-md-2">

        <?= $this->require('/render/phone/ZSipml5Widget/clean/clean.php');

        ?>
    </div>
  </div>
</div>

<!--SIPML5 begin-->

<? require Root . '\webhtm\block\footer\footerAdmin.php' ?>
</div>


<style>
  .main_block .block_item:last-child {
    width: 100%;
  }

  .main_block .or2 {
    padding-top: 0;
  }

  .main_block .block_item:first-child {
    height: auto;
  }
</style>


