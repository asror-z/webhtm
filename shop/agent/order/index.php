<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZUrl;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZCheckButtonWidget;
use zetsoft\widgets\former\ZCheckSelectWidget;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\former\ZDynaWidgetJ;
use zetsoft\widgets\inputes\ZKSelect2Widget;
use zetsoft\widgets\menus\ZMmenuWidget;
use zetsoft\widgets\menus\ZMmenuWidgetSh;
use zetsoft\widgets\navigat\ZButtonWidget;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;
use zetsoft\models\shop\ShopOrder;
use zetsoft\widgets\themes\ZCardWidget;
use zetsoft\widgets\inputes\ZDropDownListWidget;

/** @var ZView $this */


/**
 *
 * Action Params
 */

$action = new WebItem();

$action->title = Azl . 'Заказы';
$action->icon = 'fal fa-money-check-edit-alt';
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
            <div class="col-md-12 col-12">

                <?
                ZCardWidget::begin([
                    'config' => [
                        'type' => ZCardWidget::type['dynCard'],
                        'classHeadColor' => 'bg-primary',
                        'hasIcon' => true,

                    ]
                ]);
                $model = new ShopOrder();

                $users = [];
                $operators = Az::$app->market->operator->getUserByRole('agent');

                $firstSelect = null;
                if (!empty($operators)) {
                    $firstSelect = $operators[0]['id'];

                    foreach ($operators as $operator)
                        $users[$operator['id']] = $operator['name'];

                } else {
                    echo '<span class="pl-3">' . Az::l("operators are not found") . '</span>';
                }

                $button = ZCheckSelectWidget::widget([
                    'config' => [
                        'text' => 'Buttons',
                        //'class' => 'simple-Report',
                        'url' => ZUrl::to([
                            '/api/core/app/check',
                            'modelClassName' => $model->className,
                        ]),
                        'widgetClass' => ZDropDownListWidget::class,
                        'widgetOptions' => [
                            'data' => $users,
                            'config' => [
                                'class' => 'form-control d-block'
                            ],

                        ],
                        'attr' => 'operator',
                        'modelClassName' => $model->className,
                        'btnOptions' => [
                            'config' => [
                                'text' => 'OK',
                                'btnStyle' => ZButtonWidget::btnStyle['btn-outline-success'],
                                'btnType' => ZButtonWidget::btnType['submit'],
                                'btnRounded' => false,
                                'btnSize' => 'btn-ml',
                                'class' => 'py-1'
                            ]
                        ]
                    ]
                ]);

               
                /** @var ZView $this */
                echo ZDynaWidget::widget([
                    'model' => $model,
                    'rightNameEx' => [
                        'system'
                    ],
                    'config' => [
                        'isCard' => false,
                        /*'topRequireUrl'=>'/webhtm/shop/agent/order/dynaTopRequire.php',*/
                    ],
                   /* 'leftBtn' => [
                        'update' => [
                            'content' => $button,
                            'options' => [
                                'class' => 'btn-group p-1 mr-0 {btnSize} {iconSize}'
                            ]
                        ],
                    ]*/
                ]);

                ZCardWidget::end();

                ?>

            </div>
        </div>


    </div>


