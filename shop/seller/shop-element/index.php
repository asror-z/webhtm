<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\models\shop\ShopCatalog;
use zetsoft\models\shop\ShopElement;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\menus\ZMmenuWidget;
use zetsoft\widgets\menus\ZMmenuWidgetSh;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;
use zetsoft\models\shop\ShopProduct;


/** @var ZView $this */


/**
 *
 * Action Params
 */

$action = new WebItem();

$action->title = Azl . 'Элементы';
$action->icon = 'fal fa-desktop';
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
            <div class="col-md-12">

                <?
             
                $userCompanyID = $this->userIdentity()->user_company_id;

                if (empty($userCompanyID))
                    $userCompanyID = 210;

                $model = new ShopElement();

                $model->configs->query = ShopElement::find()
                    ->where([
                        'user_company_id' => $userCompanyID
                    ]);

                $model->configs->readonly = [
                  'user_company_id'
                ];

                $model->columns();

                /** @var ZView $this */
                echo ZDynaWidget::widget([

                    'model' => $model,
                    'rightNameEx' => [
                        'system'
                    ],
                    'config' => [
                        'actionButtons' => [
                            'update',
                            'delete',
                            'view',
                        ],
                        'columnBefore' => [
                            'checkbox',
                            'serial',
                            'sort',
                            'action',

                        ],
                        'columnAfter' => ['false'],
                    ]
                ]);

                ?>

            </div>
        </div>


    </div>

<? require Root . '/webhtm/block/footer/footerAdmin.php'; ?>
</div>
