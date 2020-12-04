<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\models\shop\ShopProduct;
use zetsoft\models\user\User;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;
use zetsoft\models\user\ChatGroup;


/** @var ZView $this */


/**
 *
 * Action Params
 */
 
$action = new WebItem();

$action->title = Azl . 'Клиенты';
$action->icon = 'fa fa-pie-chart';
$action->type = WebItem::type['html'];
$action->csrf = true;
$action->debug = true;
$action->layout = true;
$action->layoutFile = 'admin';





$this->paramSet(paramAction, $action);

$this->title();
$this->toolbar();

?>



 

        <div class="row">
            <div class="col-md-12">

                <?
                $userCompanyID = $this->userIdentity()->user_company_id;
                if (empty($userCompanyID))
                    $userCompanyID = 4;
                    
                $model = new User();
                $data=Az::$app->market->sellerStatistic->getclients($userCompanyID);
                $model->configs->edit = false;
                $model->configs->nameOn = [
                    'name',
                    'email',
                    'phone',
                    'status',

                ];
                $model->configs->query = User::find()->where([
                    'id' => $data
                ]);
                $model->columns();
                /** @var ZView $this */
                echo ZDynaWidget::widget([
                    'model' => $model,
                    'rightNameEx' => [
                        'system'
                    ],
                ]);

                ?>

            </div>
        </div>


    </div>

</div>

