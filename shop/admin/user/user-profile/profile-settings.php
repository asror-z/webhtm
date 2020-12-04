<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\models\user\User;
use zetsoft\service\forms\Active;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZUrl;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZFormBuildWidget;
use zetsoft\widgets\inputes\ZKSelect2Widget;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;


/** @var ZView $this */


/**
 *
 * Action Params
 * @license  JahongirKudratov
 */

$action = new WebItem();

$action->title = Azl . 'Новый заказ';
$action->icon = 'fas fa-line-chart';
$action->type = WebItem::type['html'];
$action->layout = true;
$action->layoutFile = 'admin';
$action->csrf = true;

if ($this->httpGet('spa'))
    $action->debug = false;



$this->paramSet(paramAction, $action);

$this->title();
$this->toolbar();


?>


<div id="page">


<div id="content" class="content-footer p-3 ">
    <h3 class="font-family">Личная информация</h3>
        <div class="row border rounded mx-auto">
            <div class="col-md-6 col-6 ">

                <?

                $id = $this->userIdentity()->id;

                $model = User::findOne($id);


                if ($model === null)
                    return $this->urlRedirect('/core/user/user-auth/login-register.aspx');
                
                $model->configs->nameAuto = false;
                
                $model->configs->widget = [
                 'gender' => ZKSelect2Widget::class,
                ];
                $model->cards = [
                    [
                        'title' => Az::l('Первый этап'),
                        'shows' => true,
                        'items' => [
                            [
                                'title' => Az::l('Форма'),
                                'shows' => true,
                                'items' => [

                                    [
                                        'gender',
                                    ],
                                    [
                                        'phone',
                                        'email',
                                    ],

                                    [
                                        'social',
                                    ],
                                ],
                            ],
                        ],
                    ],
                ];
                $model->columns();




                $active = new Active();
                
                $active->type = Active::type['vertical'];
                $form = $this->activeBegin($active);


                echo ZFormBuildWidget::widget([
                    'model' => $model,
                    'form' => $form,
                    'config' => [
                        'topBtn' => false,
                        'botBtn' => false,

                        'stepType' => ZFormBuildWidget::stepType['none'],
                        'blockType' => ZFormBuildWidget::blockType['naked'],
                    ]
                ]);

                ?>

            </div>
            <div class="col-md-6 col-6 ">

                <?

                $model->configs->nameOff = [
                    'role'
                ];
                
                $model->cards = [
                    [
                        'title' => Az::l('Первый этап'),
                        'shows' => true,
                        'items' => [
                            [
                                'title' => Az::l('Форма'),
                                'shows' => true,
                                'items' => [
                                    [
                                        'photo',
                                    ],
                                ],
                            ],
                        ],
                    ],
                ];
                $model->columns();
                
                if ($this->modelSave($model)) {
                    $this->urlGetBack();
                }

                $model1 = User::findOne($id);
                
                $model1->configs->nameAuto = false;
                $model1->configs->nameOff = [
                    'name',
                    'role',
                    'gender',
                    'phone',
                    'contact',
                    'email',
                    'social',
                    'card',
                    'autodial',
                    'apiclient',
                    'status',
                    'user_company_id',
                    'number',
                    'website',
                    'lastseen',
                    'purchase_count',
                    'referal_link',
                    'place_adress_ids'
                ];


                $model->columns();

                echo ZFormBuildWidget::widget([
                    'model' => $model1,
                    'form' => $form,
                    'config' => [
                        'topBtn' => false,
                        'stepType' => ZFormBuildWidget::stepType['none'],
                        'blockType' => ZFormBuildWidget::blockType['naked'],
                        'btnClass' => 'border-0 rounded success-color white-text',
                        'btnStyle' => '',
                    ]
                ]);

                $this->activeEnd();
               

                $url = ZUrl::to([
                    'shop/admin/main/main',
                ]);
                if ($this->modelSave($model) || $this->modelSave($model1)) {
                    return $this->urlRedirect($url);
                }

                ?>

            </div>
        </div>
        </div>
      </div>

