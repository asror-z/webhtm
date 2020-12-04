<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\menus\ZMmenuWidget;
use zetsoft\widgets\menus\ZMmenuWidgetSh;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;
use zetsoft\models\shop\ShopCatalog;


/** @var ZView $this */


/**
 *
 * Action Params
 */

$action = new WebItem();

$action->title = Azl . 'Каталог магазина';
$action->icon = 'fal fa-map-marker-alt';
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

<div id="content" class="content-footer p-3">


  <div class="row">
    <div class="col-md-12">

        <?

        $userCompanyID = $this->userIdentity()->user_company_id;

        if (empty($userCompanyID))
            $userCompanyID = 210;

        $model = new ShopCatalog();

        $model->configs->query = ShopCatalog::find()
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
                    'relation'

                ],
                'spaArray' => [
                    'update' => false,
                    'create' => true,
                ],
                'columnAfter' => ['false']
            ]
        ]);

        ?>

    </div>
  </div>


</div>

