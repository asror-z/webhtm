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
use zetsoft\models\user\User;


/** @var ZView $this */


/**
 *
 * Action Params
 */

$action = new WebItem();

$action->title = Azl . 'Пользователи';
$action->icon = 'fal fa-gift-card';
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

<div id="page">

    <div id="content" class="content-footer p-3">


        <div class="row">
            <div class="col-md-12 col-12">

                <?

                $model = new User();

                $model->configs->query = User::find()
                    ->where([
                        'role' => ['agent', 'supervisor']
                    ]);

                $model->configs->nameOn = [
                    'title',
                    'password',
                    'role',
                    'gender',
                    'phone',
                    'number',
                    'email',
                    'photo',
                ];

                $model->columns();


                /** @var ZView $this */
                 echo ZDynaWidget::widget([
                    'model' => $model,
                    'rightNameEx' => [
                        'system'
                    ],

                    'config' => [
                        //start|Lobar|27-10-2020
                       /* 'columnBefore' => [
                            'serial',
                            'checkbox',
                            'sort',
                            'action',
                        ],

                        'columnAfter' => [
                            'false'
                        ],*/
                        //end|Lobar|27-10-2020
                        'actionButtons' => [
                            'update',
                            'delete',
                            //'clone',
                            'view',
                        ],
                        'updateUrl' => '{fullUrl}/create.aspx?id={id}&model={modelClassName}',


                    ],
                    'rightBtn' => [

                        'add-clone-delete' => [
                            //start|NurbekMakhmudov|2020-10-23
                            'content' => '{add}{tabular}{delete}',
                            //end|NurbekMakhmudov|2020-10-23



                            'options' => ['class' => 'btn-group p-1 mr-0 {btnSize} {iconSize}'],
                        ],

                        'export' => [
                            'content' => '',
                            'options' => ['class' => 'btn-group p-1 {btnSize} {iconSize}'],
                        ],

                    ],

                ]);

                ?>

            </div>
        </div>


    </div>

</div>
