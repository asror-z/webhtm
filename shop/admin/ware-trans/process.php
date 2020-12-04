<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\models\ware\WareEnterItem;
use zetsoft\models\ware\WareTrans;
use zetsoft\models\ware\WareTransItem;
use zetsoft\service\forms\Active;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZUrl;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\former\ZFormBuildWidget;

use zetsoft\widgets\former\ZFormWidget;
use zetsoft\widgets\inputes\ZHHiddenInputWidget;
use zetsoft\widgets\inputes\ZInputWidget;
use zetsoft\widgets\menus\ZMmenuWidget;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;
use zetsoft\widgets\themes\ZCardWidget;
use zetsoft\models\ware\WareEnter;


/** @var ZView $this */


/**
 *
 * Action Params
 */

$action = new WebItem();

$action->title = Azl . 'Перемещение товаров между складами';


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

                <?

                $ware_trans_id = $this->httpGet('ware_trans_id');

                $ware_trans = WareTrans::findOne($ware_trans_id);

                if ($this->modelSave($ware_trans)) {
                    $this->urlRedirect([
                        'index'
                    ]);
                }

                ZCardWidget::begin([
                    'config' => [
                        'title' => Az::$app->view->title,
                        'type' => ZCardWidget::type['dynCard'],
                    ]
                ]);

                $active = new Active();
                $active->method = Active::method['post'];
                $active->type = Active::type['vertical'];
                $active->childClass = 'my-3';


                $form = $this->activeBegin($active);

                $ware_trans->responsible = $this->userIdentity()->id;

                $ware_trans->cards = [
                    [
                        'title' => Az::l('Первый этап'),
                        'shows' => true,
                        'items' => [
                            [
                                'title' => Az::l('Форма'),
                                'shows' => true,
                                'items' => [
                                    [
                                        /*'name',*/
                                        'date'
                                    ],
                                    [
                                        'user_company_id',
                                        'warehouse_from'
                                    ],
                                    [
                                        'warehouse_to',
                                        'responsible'
                                    ],
                                    [
                                        'comment',
                                    ],
                                ],
                            ],
                        ],
                    ],
                ];

                $ware_trans->columns();

                echo ZFormBuildWidget::widget([
                    'model' => $ware_trans,
                    'form' => $form,
                    'config' => [
                        'btnTitle' => Az::l('Сформировать и закрыть'),
                        'botBtn' => false,
                        'stepType' => ZFormBuildWidget::stepType['none'],
                        'blockType' => ZFormBuildWidget::blockType['naked']
                    ],
                ]);

                $this->activeEnd();

                ZCardWidget::end();

                ?>

            </div>


            <div class="col-md-12 mx-auto mt-5">

                <?php
                $this->pjaxBegin();
                $model = new WareTransItem();

                $model->configs->query = WareTransItem::find()
                    ->where([
                        'ware_trans_id' => $ware_trans_id
                    ]);

                $model->configs->dynaButtons = [
                    'add-tabular-clone-delete' => [
                        'content' => '{add}',
                        'options' => [
                        'class' => 'btn-group p-1 mr-0 {btnSize} {iconSize}'
                        ],
                    ],
                ];

                $model->columns();


                /** @var ZView $this */
                echo ZDynaWidget::widget([
                    'model' => $model,
                    'config' => [
                        'pjax' => false,
                        'columnBefore' => [
                            'serial',
                            'checkbox',
                            'action',
                            'id',
                        ],
                        'spaHeight' => [
                            'create' => '600px',
                        ],
                        'columnAfter' => false,
                        'actionButtons' => [
                            'view',
                        ],
                        'spa' => true,
                        'reloadUrl' => ZUrl::to([
                            'process',
                            'ware_trans_id' => $ware_trans_id
                        ]),
                        'viewUrl' => '{fullUrl}/view-process.aspx?id={id}',
                        'createUrl' => '{fullUrl}/create-process.aspx?ware_trans_id=' . $ware_trans_id .
                        '&user_company_id=' . $ware_trans->user_company_id .
                        '&ware_id=' . $ware_trans->warehouse_from .
                        '&ware_trans_id=' . $ware_trans_id,
                    ]

                ]);
                $this->pjaxEnd();
                ?>

            </div>
        </div>


    </div>
