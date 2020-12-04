<?php

use rmrevin\yii\fontawesome\FA;
use zetsoft\former\auth\AuthPassChangeForm;
use zetsoft\models\user\User;
use zetsoft\system\assets\ZColor;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\former\ZFormWidget;
use zetsoft\widgets\former\ZViewWidget;
use zetsoft\widgets\navigat\ZButtonWidget;
use zetsoft\widgets\notifier\ZModalNewWidget;
use zetsoft\widgets\themes\ZCardProfileWidget;
use zetsoft\widgets\themes\ZCardWidget;

/** @var User $model */


/** @var ZView $this */
$id = $this->userIdentity()->id;

$action->title = Azl . 'Измененить пароль';

$model = User::findOne([
    'id' => $id
]);


$user = User::findOne([
    'id' => $id
]);

$user->configs->nameOn = [
    'name',
    'email',
    'phone',
    'sex'
];

$model->configs->nameOn = [
    'name',
    'photo'
];
ZModalNewWidget::begin([
    'id' => 'profPic'
]);
$form = $this->activeBegin();


$model->configs->rules = [

];
$this->modelSave($model);

echo ZFormWidget::widget([
    'model' => $model,
    'form' => $form,
]);

$this->activeEnd();

ZModalNewWidget::end();

$url = $this->userPhoto();

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

        ZCardProfileWidget::begin([
            'config' => [
                'url' => $url,
                'color' => ZColor::color['primary-color'],

               'ProfileRightButton' => $ProfileRightButton,
            ]
        ]);

        ZCardProfileWidget::end();


        echo ZViewWidget::widget([
            'model' => $user,
        ]);
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
        $form = $this->activeBegin();

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
        $form = $this->activeBegin();

        $model = new AuthPassChangeForm();

        if ($this->formModel($model) === true) {



            if ($model->confirm !== $model->new_pass)
                $this->alertDanger( подтвердите и попробуйте ещё раз"), Az::l("Пароли не совпадают"),Az::l("Пожалуйста);
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
