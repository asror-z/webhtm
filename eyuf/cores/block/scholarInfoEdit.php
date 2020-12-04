<?php

/** @var ZView $this */

use zetsoft\models\App\eyuf\EyufScholar;
use zetsoft\service\forms\Active;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\widgets\former\ZFormBuildWidget;
use zetsoft\widgets\navigat\ZButtonWidget;
use rmrevin\yii\fontawesome\FA;
use zetsoft\widgets\notifier\ZModalNewWidget;
use zetsoft\widgets\themes\ZCardProfileWidget;
use zetsoft\system\assets\ZColor;
use zetsoft\widgets\former\ZViewWidget;


//start|JakhongirKudratov|2020-10-26

?>

<div>

    <?php
    $profileRightButton = ZButtonWidget::widget([
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
            /* start|AzimjonToirov|24-10-2020 */
            'click' => <<<JS
                    console.log('Modal opened !!!')
                    $('#profilePicture').modal('show')
JS,
            /* end|AzimjonToirov|24-10-2020 */
        ]
    ]);
    /* start|AzimjonToirov|24-10-2020 */
    ZModalNewWidget::begin([
        'id' => 'profilePicture',
    ]);

    $user = \zetsoft\models\user\User::findOne($id);

    if (empty($user))
        throw new Exception('User not fount!');

    $user->configs->nameOn = [
        'photo'
    ];

    $user->configs->rules = [
        [
            validatorSafe
        ]
    ];
    $user->columns();

    $active = new Active();
    $active->type = Active::type['horizontal'];

    $form = $this->activeBegin($active);

    echo ZFormBuildWidget::widget([
        'model' => $user,
        'form' => $form,
    ]);

    $this->activeEnd();

    if ($this->modelSave($user)) {
        //vdd($user);
        $this->paramSet(paramIframe, true);


    }
    ZModalNewWidget::end();
    /* end|AzimjonToirov|24-10-2020 */
    $userImage = '/uploaz/eyuf/User/photo/' . $user->id . '/' . ZArrayHelper::getValue($user->photo, 0);

    $photoUrl = $this->userPhoto();
    if (!empty($user->photo))
        $photoUrl = $userImage;


    ZCardProfileWidget::begin([
        'config' => [
            'color' => ZColor::color['primary-color'],
            'title' => $user->title,
            'ProfileRightButton' => $profileRightButton,
            'url' => $photoUrl,
        ]
    ]);

    if (!empty($scholar))
    {

    $statuses = (new EyufScholar())->_status;

    echo $scholar->status
        ? 'Статус: ' . $statuses[$scholar->status]
        : 'Статус: ' . '';
        
    echo '<br>';


        $bdate = Az::$app->App->eyuf->user->getAge($scholar->birthdate);
        if ($bdate !== null)
            echo 'Возраст: ' . $bdate . EOL;
    }


    ZCardProfileWidget::end();

   


    //end|JakhongirKudratov|2020-10-26


    ?>

</div>
