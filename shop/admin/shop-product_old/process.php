<?php

use Codeception\Exception\ElementNotFound;
use PHPUnit\Util\Exception;
use zetsoft\dbitem\core\WebItem;
use zetsoft\models\shop\ShopProduct;
use zetsoft\models\shop\ShopElement;
use zetsoft\service\forms\Active;
use zetsoft\system\Az;
use zetsoft\system\except\ZException;
use zetsoft\system\helpers\ZUrl;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZBanderolWidget;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\former\ZExportBtnWidget;
use zetsoft\widgets\former\ZFormBuildWidget;
use zetsoft\widgets\former\ZPdfWidget;
use zetsoft\widgets\inputes\ZInputBtnWidget;
use zetsoft\widgets\inputes\ZInputWidget;
use zetsoft\widgets\inputes\ZKDateTimePickerWidget;
use zetsoft\widgets\inputes\ZLibraInputWidget;
use zetsoft\widgets\navigat\ZButtonWidget;
use zetsoft\widgets\notifier\ZKAlertWidget;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;

/** @var ZView $this */


/**
 *
 * Action Params
 */

$action = new WebItem();

$action->title = Azl . 'Редактирование Поступление товаров в склад';


$action->icon = 'fal fa-film';
$action->type = WebItem::type['html'];
$action->csrf = true;
$action->debug = false;
$action->layout = true;
$action->layoutFile = 'admin';


$this->paramSet(paramAction, $action);

$this->title();
$this->toolbar();
?>

<div class="row p-3">
  <div class="mx-auto col-md-12">

      <?
      $product_id = $this->httpGet('shop_product_id');

      $product = ShopProduct::findOne($product_id);

      if ($product === null) {
          throw new ZException(Az::l('Товар не найден.'));
      }

      $product->cards = [
          [
              'title' => Az::l('Продукт'),
              'items' => [
                  [
                      'title' => Az::l('Форма'),
                      'items' => [
                          [
                              'user_company_id',
                              'name',
                              'package',
                          ],
                          [
                              'title',
                          ],
                          [
                              'text',
                          ],
                          [
                              'image',
                          ],
                          [
                              'shop_category_id',
                              'shop_option_ids',
                              'shop_brand_id',
                          ],
                          [
                              'related',
                              'shelf_life',
                              'shelf_life_unit',
                          ],
                          [
                              'weight',
                              'offer',
                              'measure',
                          ],
                          [
                              'rating',
                          ],
                          [
                              'autocreate',
                          ]
                      ],
                  ],
              ],
          ],
      ];

      $product->configs->options = [
          'weight' => [
              'config' => [
                  'buttonText' => Az::l('Ввес'),
              ],
              'event' => [
                  'buttonClick' => <<<JS
                      function() {
                          libra.updateWeight();
                      }
                  JS,
              ],
          ],

      ];

      $product->configs->changeSave = true;

      $product->columns();

      if ($this->modelSave($product))
          $this->urlRedirect(['index', true]);

      $active = new Active();
      $active->type = Active::type['vertical'];
      $active->childClass = 'my-3';

      $form = $this->activeBegin($active);

      $stepType = ZFormBuildWidget::stepType['smartTab'];

      echo ZLibraInputWidget::widget([
          'config' => [
              'objectName' => 'libra',
              'mode' => ZLibraInputWidget::mode['manual'],
              'inputSelector' => '#shop-order-weight',
              'autorun' => true,
          ],
      ]);

      //            echo $button . $button3;

      echo ZFormBuildWidget::widget([
          'model' => $product,
          'form' => $form,
          'config' => [
              'stepOptions' => [
                  'config' => [
                      'mcontent' => 'p-3',
                  ],
              ],
              'btnTitle' => Az::l('Сформировать и закрыть'),
              'botBtn' => false,
              //'cols' => 12,
              'stepType' => $stepType,
              'blockType' => ZFormBuildWidget::blockType['naked']
          ]
      ]);

      $this->activeEnd();

      ?>

  </div>


  <div class="col-md-12 mx-auto mt-5">

      <?php
      $this->pjaxBegin();
      $model = new ShopElement();

      $model->configs->query = ShopElement::find()
          ->where([
              'shop_product_id' => $product_id
          ]);
      $model->configs->nameOn = [
          'id',
          'name',
          'user_company_id',
          'shop_product_id',
          'barcode',
          'barcode_type',
          'active',
          'shop_option_ids',
      ];

      //            if ($product->status_universal !== ShopElement::status_universal['change']) {
      //                $model->configs->nameOff = [
      //                    'check_return'
      //                ];
      //            }
      $model->configs->dynaButtons = [
          'update' => [
              'content' => '{update}',
              'options' => ['class' => 'btn-group p-1 mr-0 {btnSize} {iconSize}']
          ],
          'add-tabular-clone-delete' => [
              'content' => '{add}{clone}{delete}',
              'options' => ['class' => 'btn-group p-1 mr-0 {btnSize} {iconSize}']
          ],

      ];

      $model->configs->widget = [
          'weight' => ZHInputWidget::class
      ];

      $model->columns();

      /** @var ZView $this */
      echo ZDynaWidget::widget([

          'model' => $model,
          'rightNameEx' => [
              'system'
          ],

          'config' => [
              'hasToolbar' => true,
              'columnBefore' => [
                  'serial',
                  paramAction,
                  'checkbox',
                  'id'
              ],

              'actionButtons' => [
                  'clone',
                  'delete',
                  'view'
              ],
              'spaHeight' => [
                  'create' => '800px',
                  'view' => '800px',
              ],

              'columnAfter' => false,
              'viewUrl' => '/shop/admin/shop-element/view-process.aspx?shop_product_id=' . $product_id,
              'deleteAllUrl' => '/api/core/dyna/delete-all.aspx?modelClassName={modelClassName}&shop_product_id=' . $product_id,
              'createUrl' => '/shop/admin/shop-element/create-process.aspx?shop_product_id=' . $product_id,
              'createTitle' => Az::l('Создание прихода в склад')

          ]

      ]);
      $this->pjaxEnd();
      ?>

  </div>

</div>

