<?php
/**
 *
 *
 * Author:  Asror Zakirov
 * https://www.linkedin.com/in/asror-zakirov
 * https://www.facebook.com/asror.zakirov
 * https://github.com/asror-z
 *
 */

use zetsoft\models\user\User;
use zetsoft\models\App\eyuf\EyufScholar;
use zetsoft\system\assets\ZColor;
use zetsoft\system\Az;
use zetsoft\widgets\former\ZFormWidget;
use zetsoft\widgets\themes\ZCardProfileWidget;
use zetsoft\widgets\themes\ZCardWidget;
use zetsoft\widgets\themes\ZColRowWidgets;


$user = $this->userIdentity();
$url = $user->userPhoto();
?>
<div class="row">
    <div class="col-4 col-md-4">
        <?php
        ZCardProfileWidget::begin([
            'config' => [
                'url' => $url,
                'color' => ZColor::color['primary-color'] ,
                'title'=>$user->title,


            ]
        ]);
        ZCardProfileWidget::end();
        ?>
    </div>
    <div class="col-8 col-md-8">


        <?php

        /** @var User $model */
        ZCardWidget::begin([
            'config' => [
                'title' => Az::l('Изменить пароль')
            ]
        ]);

        $user->configs->nameOn = [
            'password'
        ];
        $form = $this->activeBegin();



        $user->configs->rules = [
            [validatorSafe]
        ];
        if ($this->modelSave($user))
            $this->urlRedirect(['/cores/user/index']);


        echo ZFormWidget::widget([
            'model' => $user,
            'form' => $form,
        ]);


        $this->activeEnd();
        ZCardWidget::end()
        ?>
    </div>
</div>
