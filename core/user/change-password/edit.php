<?php

use rmrevin\yii\fontawesome\FA;
use zetsoft\dbitem\core\WebItem;
use zetsoft\former\auth\AuthPassChangeForm;
use zetsoft\service\forms\Active;
use zetsoft\system\assets\ZColor;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\former\ZFormWidget;
use zetsoft\widgets\former\ZViewWidget;
use zetsoft\widgets\navigat\ZButtonWidget;
use zetsoft\widgets\notifier\ZModalNewWidget;
use zetsoft\widgets\themes\ZCardProfileWidget;
use zetsoft\widgets\themes\ZCardWidget;
use zetsoft\system\helpers\ZArrayHelper;

/** @var User $model */


/** @var ZView $this */

$action = new WebItem();

$action->title = Azl . 'Измененить пароль';
$action->icon = 'fal fa-print';


$action->layout = true;
$action->debug = false;


$this->paramSet(paramAction, $action);

$this->title();
$this->toolbar();
$id = $this->userIdentity()->id;

$userCurrentPassword = $this->userIdentity()->password;
$id_1 = 358;

$model = \zetsoft\models\user\User::findOne($id);

$user = \zetsoft\models\user\User::findOne($id);

$user2 = \zetsoft\models\user\User::findOne($id);
//vdd($user);

if (null !== $user) {
    $user->configs->nameOn = [
        'name',
        'email',
        'phone',
        'sex'
    ];
    $user->columns();
}

//vdd($model);
if (null !== $model) {
    $model->configs->nameOn = [
        'name',
        'photo'
    ];
}

ZModalNewWidget::begin([
    'id' => 'profPic'
]);
$active = new Active();
$active->type = Active::type['horizontal'];
$form = $this->activeBegin($active);

//start|AlisherXayrillayev|2020-10-26
if (null === $model)
    throw new Exception('User not found!');

$model->configs->nameOn = [
    'photo'
];

$model->columns();

echo ZFormWidget::widget([
    'model' => $model,
    'form' => $form,
]);

$this->activeEnd();

ZModalNewWidget::end();

$userPhoto = $this->userIdentity()->photo;
$userId = $this->userIdentity()->id;

?>

<div class="row">
    <div class="col-md-4">
        <?php

        $ProfileRightButton = ZButtonWidget::widget([
            'config' => [
                'icon' => 'fas fa-' . FA::_EDIT,
                'type' => ZButtonWidget::btnType['button'],
                'btnStyle' => ZButtonWidget::btnStyle['btn-transparent'],
                'class' => 'text-white',
                'btnFloating' => false,
                'btn' => false,
                'hasIcon' => true,
                'iconColor' => '#ffffff',
            ],
            'event' => [
                'click' => ' $(profPic).modal(\'show\') '
            ]

        ]);


        $photoUrl = $this->userPhoto();

        ZCardProfileWidget::begin([
            'config' => [
                'url' => $photoUrl,
                'color' => ZColor::color['primary-color'],
                'title' => $this->userIdentity()->title,
                'ProfileRightButton' => $ProfileRightButton,
            ]
        ]);

        ZCardProfileWidget::end();

        // start|MuminovUmid|2020-10-17
        echo ZViewWidget::widget([
            'model' => $user,
            'config' =>[
                'theadColor' => ZColor::color['rgba-blue-light'],
            ]
        ]);
        // end|MuminovUmid|2020-10-17
        ?>
    </div>

    <div class="col-md-8">
        <?php
        /** @var User $user */
        /*ZCardWidget::begin([
            'config' => [
                'title' => 'Изменить ФИО'
            ]
        ]);
        $active = new Active();
$active->type = Active::type['horizontal'];
$form = $this->activeBegin($active);

        if ($this->modelSave($model))
            $this->urlRedirect(['/cores/user/edit']);

        echo ZFormWidget::widget([
            'model' => $model,
            'form' => $form,
            'config' => [
                'topBtn' => false,
                'botBtn' => true,

            ]
        ]);

        $this->activeEnd();
        ZCardWidget::end();*/


        /**
         *
         * PassChange Begin
         */
        ZCardWidget::begin([
            'config' => [
                'title' => Az::l('Изменить пароль'),
            ]
        ]);
        $active = new Active();
        $active->type = Active::type['horizontal'];
        $form = $this->activeBegin($active);

        $model = new AuthPassChangeForm();

        if ($this->formModel($model) === true) {


            if ($model->confirm !== $model->new_pass)
                $this->alertDanger( 'подтвердите и попробуйте ещё раз', Az::l("Пароли не совпадают"));
            else {
                $hash = Az::$app->cores->auth->hashGet($model->old_pass);
                if ($hash !== $user->password)
                    $this->alertDanger( "Попробуйте ещё раз", "Старый пароль указан неверно");
                else {
                    $user->password = $model->new_pass;
                    $user->save();
                }

            }
            // $this->modelPost();
        }

        echo ZFormWidget::widget([
            'model' => $model,
            'form' => $form,
            'config' => [
                'topBtn' => false,
                'botBtn' => true,

            ]
        ]);

        $this->activeEnd();
        ZCardWidget::end();


        ?>
    </div>
</div>
