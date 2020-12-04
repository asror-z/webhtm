<?php


use zetsoft\dbitem\core\WebItem;
use zetsoft\models\shop\ShopProduct;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\menus\ZMmenuWidget;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;

/** @var ZView $this */


/**
 *
 * Action Params
 */
$action = new WebItem();

$action->title = Azl . 'Продукты';
$action->icon = 'fal fa-calendar-plus-o';
$action->type = WebItem::type['html'];
$action->csrf = true;
$action->layout = true;
$action->layoutFile = 'admin';

if ($this->httpGet('spa'))
    $action->debug = true;



$this->paramSet(paramAction, $action);

$this->title();
$this->toolbar();


?>


        <div class="row">
            <div class="col-md-12 col-12">

                <?
                $this->pjaxBegin();
                $model = new ShopProduct();

                /** @var ZView $this */
                echo ZDynaWidget::widget([
                    'model' => $model,
                    'config' => [
                        'pjax'=>false,
                        'actionButtons' => [
                            'update',
                            'delete',
                            'view',
                        ],
                        'columnBefore' => [
                            'serial',
                            'sort',
                            'checkbox',
                            'action',
                        ],
                        'spaArray' => [
                         'update' => false,
                         'create' => true,
                        ],
                        'columnAfter' => ['false']
                    ]
                ]);
                $this->pjaxEnd();
                ?>

            </div>
        </div>


