<div class="row">
    <div class="col-4">
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

        use zetsoft\models\auto\ChatMessage;
        use zetsoft\models\auto\ChatNotify;
        use zetsoft\models\user\User;
        use zetsoft\models\App\eyuf\EyufScholar;
        use zetsoft\system\assets\ZColor;
        use zetsoft\system\Az;
        use zetsoft\widgets\former\ZDynaWidget;
        use zetsoft\widgets\former\ZFormWidget;
        use zetsoft\widgets\themes\ZCardProfileWidget;
        use zetsoft\widgets\themes\ZCardWidget;

        /** @var User $model */
        $model = $this->userIdentity();
        $url = $this->userPhoto();
        /** @var EyufScholar $Sch */
        $Sch = EyufScholar::findOne(['user_id' => $model->id]);


        ZCardProfileWidget::begin([
            'config' => [
                'url' => $url,
                'color' => ZColor::color['primary-color'],
                'title' => $model->name,

            ]
        ]);

        echo Az::l('Имя: ') . $model->name;
        echo EOL;
        if (!empty($model->role))
            echo Az::l('Роль: ') . $model->role;

        if (!empty($Sch->status)&&($model->role === 'scholar'))
            echo Az::l('Статус: ') . $Sch->status;


        ZCardProfileWidget::end();

        $passModel = User::findOne($model->id);
        $form = $this->activeBegin();

        ZCardWidget::begin([
            'config' => [
                'title' => $this->title,
                'type' => ZCardWidget::type['dynCard'],
            ]
        ]);


        $passModel->configs->nameOn = [
            'password'
        ];

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


        $form = $this->activeBegin();

        ZCardWidget::begin([
            'config' => [
                'title' => $this->title,
                'type' => ZCardWidget::type['dynCard'],
            ]
        ]);


        $model->configs->nameOn = [
            'name',
            'title',
            'photo'
        ];
        $this->title = Az::l('Мой профиль');


        echo ZFormWidget::widget([
            'model' => $model,
            'form' => $form,
            'config' => [
                'title' => Az::l('Мой профиль'),
                'topBtn' => false
            ]
        ]);


        ZCardWidget::end();

        $this->activeEnd();

        ?>
    </div>
    <div class="col-8">
        <?php

        $this->title = Az::l('Уведомления');
        /** @var ChatNotify $docs */
        $docs = new ChatNotify();
        $docs->configs->query = ChatNotify::find()
            ->where([
                'user_id' => $model->id
            ]);
        $docs->configs->edit = false;
        $docs->configs->nameOff = [
            'user_id',
            'type',
            'link',
            'remove',
            'read',
            'check',
            'id'
        ];

        /** @var ZView $this */
        echo ZDynaWidget::widget([
            'model' => $docs,
            'config' => [
                'toolbar' => false,
                'columnAction' => false,
                'columnCheckbox' => false,
                'columnID' => true,
                'summary' => false,
            ],

        ]);

        $this->title = Az::l('Сообщения');

        /** @var ChatNotify $docs */
        $messages = new ChatMessage();
        $messages->query = ChatMessage::find()
            ->where([
                'receiver' => $model->id
            ])
            ->orWhere([
                'sender' => $model->id
            ]);
        $messages->configs->edit = false;
        $messages->configs->nameOff = [
            'read'
        ];
        if ($this->modelSave($model)) $this->urlRefresh();

        /** @var ZView $this */
        echo ZDynaWidget::widget([
            'model' => $messages,
            'config' => [
                'toolbar' => false,
                'columnAction' => false,
                'columnCheckbox' => false,
                'columnID' => true,
                'summary' => false,
            ],

        ]);

        ?>
    </div>
</div>
