<?php

use rmrevin\yii\fontawesome\FA;
use zetsoft\models\auto\ChatMessage;
use zetsoft\models\auto\ChatNotify;
use zetsoft\models\user\User;
use zetsoft\models\App\eyuf\EyufScholar;
use zetsoft\service\utility\Notify;
use zetsoft\system\assets\ZColor;
use zetsoft\system\Az;
use zetsoft\widgets\actions\ZFilterWidget;
use zetsoft\widgets\chates\ZChatDataList;
use zetsoft\widgets\chates\ZChatListWidget;
use zetsoft\widgets\chates\ZChatUsersLIst;
use zetsoft\widgets\dialogs\ZAlertCardWidget;
use zetsoft\widgets\former\ZAjaxWidget;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\former\ZViewWidget;
use zetsoft\widgets\navigat\ZButtonWidget;
use zetsoft\widgets\themes\ZCardProfileWidget;

?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@9.10.3/dist/sweetalert2.css">

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9.10.3/dist/sweetalert2.js"></script>
<?
Az::$app->forms->zPjax->begin();

$action->title = Azl . 'ЧАТ';

?>

<div class="row">
    <div class="col-md-4 mb-5">
            <?php


            echo ZFilterWidget::widget([
                'config' => [
                    'itemselector' => 'li',
                ]
            ]);

            echo ZChatDataList::widget([
                'config' => [
                    'picture' => '',
                    'height' => '130rem',
                    'status' => 'lastseen recently',
                    'badge' => 0,
                    'addFriend' => FA::_PLUS,
                    'railVisible' => false,
                ]
            ]);

            ?>


    </div>
    <div class="col-md-8">
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



                $userId = $this->httpGet('userId');

            if (isset($userId)){

                

                $recId = $this->userIdentity()->id;







                $model = User::findOne($userId);
                $url = $model->userPhoto();
                /** @var EyufScholar $Sch */

                $model->configs->nameOn = [
                    'name', 'role'
                ];
                ZCardProfileWidget::begin([
                    'config' => [
                        'url' => $url,
                        'color' => ZColor::color['primary-color'],
                        'name' => $model->name,

                    ]
                ]);




                $addFriends = ZButtonWidget::widget([


                    'config' => [

                        /**
                         *
                         * ALL
                         */

                        'btnType' => ZButtonWidget::btnType['link'],
                        'btnStyle' => ZButtonWidget::btnStyle['btn-primary'],
                        'btnSize' => ZButtonWidget::btnSize['btn-md'],
                        'btnRounded' => true,
                        'btnFloating' => false,
                        'class' => 'friendAdd',
                        'text' => Az::l('Добавить в друзья'),

                        'hasIcon' => true,
                        'icon' => 'fa fa-' . FA::_EDIT,

                        'iconColor' => '#ffffff'
                    ],

                    'event' => [
                        'click' => <<<JS
        function (e) {
         addFriendAjax('/core/tester/eyeremove/addfriend.aspx?person='+$recId+'&friend='+$model->id);
         
         
    }
    
JS
                    ],
                ]);

                echo ZAjaxWidget::widget([
                    'config' => [
                        'func' => 'addFriendAjax',
                    ],
                    
                ]);



                $sendMessage = ZButtonWidget::widget([


                    'config' => [

                        /**
                         *
                         * ALL
                         */

                        'btnType' => ZButtonWidget::btnType['link'],
                        'btnStyle' => ZButtonWidget::btnStyle['btn-primary'],
                        'btnSize' => ZButtonWidget::btnSize['btn-md'],
                        'btnRounded' => true,
                        'btnFloating' => false,
                        'url' => '/cores/chat/index.aspx?userId=' . $userId,
                        'text' => Az::l('Отправить сообщения'),

                        /**
                         *
                         * Links
                         */


                        'hasIcon' => true,
                        'icon' => 'fa fa-' . FA::_EDIT,

                        'iconColor' => '#ffffff'
                    ],

                    'event' => [
                        'click' => <<<JS
        function (e) {
         sendMessageAjax('/core/tester/eyeremove/sendmessage.aspx?sender='+$recId+'&receiver='+$userId);
         
         
    }
    
JS
                    ],
                ]);


                echo ZAjaxWidget::widget([
                    'config' => [
                        'func' => 'sendMessageAjax',
                    ],

                ]);

                echo $addFriends;
                echo $sendMessage;


                ZCardProfileWidget::end();


                echo ZViewWidget::widget([
                    'model' => $model,
                ]);


        } else {

            $title = Az::l('Извините контакт не выбран');

            return $this->alertWarning($title, Az::l('Пожалуйста выбирайте контакта из листа Пользователей'));
            }


        ?>
    </div>
</div>
<style>
    .tegma {
        height: 7rem !important;
        margin-top: -115px !important;
    }


    .swal2-content {
        display: none !important;
    }

    /** new style */
  




</style>


<script>
    $('.friendAdd').click(function () {
            $.ajax({
                url: '/core/tester/chat/addfriend.aspx',
                type: 'GET',
                data: {'userId': <?=$userId ?>},
                success: function (res) {

                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'Ваш запрос был отправлен',
                        showConfirmButton: false,
                        timer: 2500
                    })

                },
            });

        }
    )
</script>

<?
Az::$app->forms->zPjax->end();

?>
