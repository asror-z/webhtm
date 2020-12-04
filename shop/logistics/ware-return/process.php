<?php

use Intervention\Image\Exception\NotFoundException;
use yii\web\NotFoundHttpException;
use zetsoft\dbitem\core\WebItem;
use zetsoft\models\shop\ShopOrderItem;
use zetsoft\models\shop\ShopOrder;
use zetsoft\dbitem\data\TabItem;
use zetsoft\service\cores\Date;
use zetsoft\widgets\former\ZPdfSimpleWidget;
use zetsoft\widgets\navigat\ZButtonWidget;
use zetsoft\models\ware\WareReturn;
use zetsoft\service\forms\Active;
use zetsoft\widgets\themes\ZDropDownWidget;

use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\helpers\ZUrl;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\former\ZFormBuildWidget;
use zetsoft\widgets\inputes\ZInputWidget;
use zetsoft\widgets\menus\ZMmenuWidget;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;

/** @var ZView $this */


/**
 *
 * Action Params
 * @author MurodovMirbosit
 */

$action = new WebItem();

$action->title = Azl . 'Возврат товаров от клиентов';


$action->icon = 'fal fa-film';
$action->type = WebItem::type['html'];
$action->csrf = true;
$action->debug = true;
$action->layout = true;
$action->layoutFile = 'admin';

$this->paramSet(paramAction, $action);

$this->title();
$this->toolbar();
?>
<div id="content" class="content-footer p-3">


    <div class="row">

        <div class="col-md-12 mx-auto">

            <?php
            $ware_return_id = $this->httpGet('ware_return_id');

            $ware_return = WareReturn::findOne($ware_return_id);
            if ($ware_return === null)
                throw new NotFoundHttpException(Az::l('Возврат не найден!'));
            $shop_order_ids = $ware_return->shop_order_ids;

            $ware_return->configs->readonlyWidgetOff = [
                'comment',
            ];

            $ware_return->configs->options = [
                'shop_order_ids' => [
                    'config' => [
                        'multiple' => true,
                        'isHiddenVal' => true,
                    ]
                ],
            ];

            $ware_return->configs->dynaButtons = [
                'add-tabular-clone-delete' => [
                    'content' => '{choose}',
                    'options' => ['class' => 'btn-group p-1 mr-0 {btnSize} {iconSize}']
                ],
            ];

            $ware_return->cards = [
                [
                    'title' => Az::l('Первый этап'),
                    'items' => [
                        [
                            'title' => Az::l('Форма'),
                            'items' => [
                                [
                                    'name',
                                    'date'
                                ],
                                [
                                    'shop_order_ids',
                                ],
                                [
                                    'ware_id',
                                    'comment',
                                ],
                            ],
                        ],
                    ],
                ],
            ];

            $ware_return->configs->changeSave = true;
            $ware_return->columns();

            if ($this->modelSave($ware_return)) {
                $this->urlRedirect(['index', true]);
            }

            $active = new Active();
            $active->type = Active::type['vertical'];
            $active->childClass = 'my-3';

            $form = $this->activeBegin($active);

            echo ZFormBuildWidget::widget([
                'model' => $ware_return,
                'form' => $form,
                'config' => [
                    'btnTitle' => Az::l('Провести и закрыть'),
                    'botBtn' => false,
                    'stepType' => ZFormBuildWidget::stepType['none'],
                    'blockType' => ZFormBuildWidget::blockType['naked'],
                    'isCard' => false,
                ]
            ]);

            $this->activeEnd();

            ?>

        </div>


        <div class="col-md-12 mx-auto mt-5">

            <?php
            $this->pjaxBegin();
            $model = new ShopOrderItem();

            $model->configs->query = ShopOrderItem::find()
                ->where([
                    'shop_order_id' => $shop_order_ids,
                ]);

            $model->configs->dynaButtons = [
                'add-tabular-clone-delete' => [
                    'content' => '{delete}',
                    'options' => ['class' => 'btn-group p-1 mr-0 {btnSize} {iconSize}']
                ],
            ];

            $model->configs->nameOn = [
                'id',
                'name',
                'shop_catalog_id',
                'ware_id',
                'amount',
                'amount_partial',
                'amount_return',
                'price',
                'price_all',
                'price_all_partial',
                'price_all_return',
            ];

            $model->configs->readonly = [
                'amount_partial' => false,
            ];

            $model->columns();

            echo ZDynaWidget::widget([
                'model' => $model,
                'config' => [
                    'deleteAllUrl' => ZUrl::to([
                        '/api/shop/orders/deleteReturn',
                        'ware_return_id' => $ware_return_id,
                    ]),
                    'chooseUrl' => '{fullUrl}/choose.aspx?ware_return_id=' . $ware_return_id,
                    'pjax' => false,
                    'hasToolbar' => true,
                    'spa' => true,
                    'search' => false,
                    'headerIcon' => '',
                    'bordered' => false,
                    'columnBefore' => [
                        'checkbox',
                        'serial',
                        'id'
                    ],
                    'spaWidth' => [
                        'choose' => '1000px'
                    ],
                    'columnAfter' => false,
                ],
                /*'leftBtn' => [
                    'print' => [
                        'content' => $button,
                       'options' => ['class' => 'btn-group p-1 mr-0 {btnSize} {iconSize}']
                    ]
                ],*/
            ]);
            $this->pjaxEnd();
            ?>

        </div>


    </div>

</div>
<? require Root . '\webhtm\block\footer\footerAdmin.php' ?>
</div>
