<?php

use zetsoft\models\ALL\CoreMessage;
use zetsoft\models\ALL\CoreNotify;
use zetsoft\service\forms\Active;
use zetsoft\system\assets\ZColor;
use zetsoft\system\Az;
use zetsoft\dbitem\core\WebItem;

use zetsoft\system\kernels\ZView;
use zetsoft\widgets\former\ZFormWidget;
use zetsoft\widgets\themes\ZCardProfileWidget;
use zetsoft\widgets\themes\ZCardWidget;
use zetsoft\models\user\User;
use zetsoft\models\App\eyuf\EyufScholar;


$action = new WebItem();

$action->title = Azl . 'Персональная страница';
$action->icon = 'fal fa-print';
$action->layout = true; $action->debug = false;


$this->paramSet(paramAction, $action);

$this->title();
$this->toolbar();

?>



<div class="row">
    <div class="col-md-12">

        <div class="d-flex">
        <div class="col-md-6">

        <?php

        /**
         * Author:  Asror Zakirov
         * https://www.linkedin.com/in/asror-zakirov
         * https://www.facebook.com/asror.zakirov
         * https://github.com/asror-z
         */


        /** @var User $model */
        /** @var ZView $this */

        $id =  $this->userIdentity()->id;
        $model = User::findOne($id);
        $imageUrl = $this->userPhoto();

        /** @var EyufScholar $Sch */
        $Sch = EyufScholar::findOne(['user_id' => $model->id]);


        echo $this->require('/webhtm/eyuf/cores/block/scholarInfo.php', [
              'scholar' => $Sch
        ]);


        ?>

        </div>

        <div class="col-md-6">
        <?


        $passModel = \zetsoft\models\user\User::findOne($model->id);
        $passModel->configs->nameOff = [
            'balance'
        ];


        $passModel->configs->nameOn = [
            'name',
            'title',
            'password',
            'gender',
            'lang',
            'phone',
            'email',
            'website',
            'photo',
            'place_region_id',
            'user_company_id',
            'currency',
        ];



        $passModel->columns();
        $active = new Active();
        $active->type = Active::type['horizontal'];
        $form = $this->activeBegin($active);

        ZCardWidget::begin([
            'config' => [
                'title' => $this->title,
                'type' => ZCardWidget::type['dynCard'],
            ]
        ]);

        if ($this->modelSave($passModel)) $this->urlRefresh();
        $this->title = Az::l('Изменить пароль');


        echo ZFormWidget::widget([
            'model' => $passModel,
            'form' => $form,
            'config' => [
                'topBtn' => false
            ]
        ]);


        ZCardWidget::end();

        $this->activeEnd();
        ?>
    </div>
    </div>
</div>
</div>

