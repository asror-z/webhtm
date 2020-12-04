<?php

/**
 *
 *
 * Author:  Asror Zakirov
 * https://www.linkedin.com/in/asror-zakirov
 * https://github.com/asror-z
 *
 */

use zetsoft\dbitem\core\WebItem;
use zetsoft\former\auth\AuthPassChangeForm;
use zetsoft\models\user\User;
use zetsoft\service\forms\Active;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\former\ZFormWidget;


/** @var ZView $this */


/**
 *
 * Action Params
 */

$action = new WebItem();

$action->title = Azl . 'Создание Пользователь';
$action->icon = 'fa fa-area-chart';
$action->type = WebItem::type['html'];
$action->csrf = true;
$action->debug = false;
$action->layout = true;
$action->layoutFile = 'admin';

$pass = new AuthPassChangeForm();

$this->paramSet(paramAction, $action);

$this->title();
$this->toolbar();

?>
    <div id="content" class="content-footer p-3">

        <div class="container-fluid">
            <?

            $id = $this->userIdentity()->id;

            //  $id = $this->httpGet('id');

            if ($id === null)
                $id = 1;



            if ($this->userIsGuest()) {
                $user = new User;

                $user->id = 1;
                //$user->code = 1;
                $user->name = 'Farrukh';
                $user->password = '1234';
                $user->role = 'Admin';
                $user->gender = 'male';
                $user->lang = 'Uz';
                $user->phone = '+999992121';
                $user->number = '2';
                $user->email = 'sample@gmail.com';
                $user->website = 'sample.uz';
                $user->photo = [];
                $user->status = 'active';
                $user->lastseen = 'дата рождения';
                $user->blocked = false;
                /*$user->verify_code = ;
                $user->verified_email = ;
                $user->auth_key = ;
                $user->oauth = ;
                $user->oauth_type = ;
                $user->user_company_id = ;
                $user->place_adress_ids = ;
                $user->created_at = ;
                $user->modified_at = ;
                $user->created_by = ;
                $user->modified_by = ;*/

                $model = $user;
            } else {

                $model = User::findOne($id);

            }

            if ($this->modelSave($model)) {
                //$this->modelPost();

                /**
                 *
                 * Post save Actions
                 */

                $this->urlRedirect(['/client/main/index', true]);
            }


            $active = new Active();
            //$active->class = 'row';

            $form = $this->activeBegin($active);
            ?>
            <div class="container d-flex justify-content-center">
                <div class="col-md-6 px-3 pb-5">
                    <h3>Изменение пароля</h3>
                    <div class="row">
                        <div class="col-12 ">
                            <div class=" mt-2">
                                <?
                                $model->configs->nameOn = [
                                    'password',
                                ];
                                $model->columns();
                                echo ZFormWidget::widget([
                                    'model' => $pass,
                                    'form' => $form,
                                    'config' => [
                                        'botBtn' => true,
                                        'topBtn' => false,
                                    ]
                                ]);
                                $this->activeEnd();
                                ?>
                            </div>

                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>

