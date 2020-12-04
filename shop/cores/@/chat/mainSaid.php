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

    body,html{
        height: 100%;
        margin: 0;
        background: #7F7FD5;
        background: -webkit-linear-gradient(to right, #91EAE4, #86A8E7, #7F7FD5);
        background: linear-gradient(to right, #91EAE4, #86A8E7, #7F7FD5);
    }

    .chat{
        margin-top: auto;
        margin-bottom: auto;
    }
    .card{
        height: 500px;
        border-radius: 15px !important;
        background-color: rgba(0,0,0,0.4) !important;
    }
    .contacts_body{
        padding:  0.75rem 0 !important;
        overflow-y: auto;
        white-space: nowrap;
    }
    .msg_card_body{
        overflow-y: auto;
    }
    .card-header{
        border-radius: 15px 15px 0 0 !important;
        border-bottom: 0 !important;
    }
    .card-footer{
        border-radius: 0 0 15px 15px !important;
        border-top: 0 !important;
    }
    .container{
        align-content: center;
    }
    .search{
        border-radius: 15px 0 0 15px !important;
        background-color: rgba(0,0,0,0.3) !important;
        border:0 !important;
        color:white !important;
    }
    .search:focus{
        box-shadow:none !important;
        outline:0px !important;
    }
    .type_msg{
        background-color: rgba(0,0,0,0.3) !important;
        border:0 !important;
        color:white !important;
        height: 60px !important;
        overflow-y: auto;
    }
    .type_msg:focus{
        box-shadow:none !important;
        outline:0px !important;
    }
    .attach_btn{
        border-radius: 15px 0 0 15px !important;
        background-color: rgba(0,0,0,0.3) !important;
        border:0 !important;
        color: white !important;
        cursor: pointer;
    }
    .send_btn{
        border-radius: 0 15px 15px 0 !important;
        background-color: rgba(0,0,0,0.3) !important;
        border:0 !important;
        color: white !important;
        cursor: pointer;
        overflow: hidden;
       
    }
    .search_btn{
        border-radius: 0 15px 15px 0 !important;
        background-color: rgba(0,0,0,0.3) !important;
        border:0 !important;
        color: white !important;
        cursor: pointer;
    }
    .contacts{
        list-style: none;
        padding: 0;
    }
    .contacts li{
        width: 100% !important;
        padding: 5px 10px;
        margin-bottom: 15px !important;
    }
    .active{
        background-color: rgba(0,0,0,0.3);
    }
    .user_img{
        height: 70px;
        width: 70px;
        border:1.5px solid #f5f6fa;

    }
    .user_img_msg{
        height: 40px;
        width: 40px;
        border:1.5px solid #f5f6fa;

    }
    .img_cont{
        position: relative;
        height: 70px;
        width: 70px;
    }
    .img_cont_msg{
        height: 40px;
        width: 40px;
    }
    .online_icon{
        position: absolute;
        height: 15px;
        width:15px;
        background-color: #4cd137;
        border-radius: 50%;
        bottom: 0.2em;
        right: 0.4em;
        border:1.5px solid white;
    }
    .offline{
        background-color: #c23616 !important;
    }
    .user_info{
        margin-top: auto;
        margin-bottom: auto;
        margin-left: 15px;
    }
    .user_info span{
        font-size: 20px;
        color: white;
    }
    .user_info p{
        font-size: 10px;
        color: rgba(255,255,255,0.6);
    }
    .video_cam{
        margin-left: 50px;
        margin-top: 5px;
    }
    .video_cam span{
        color: white;
        font-size: 20px;
        cursor: pointer;
        margin-right: 20px;
    }
    .msg_cotainer{
        margin-top: auto;
        margin-bottom: auto;
        margin-left: 10px;
        border-radius: 25px;
        background-color: #82ccdd;
        padding: 10px;
        position: relative;
    }
    .msg_cotainer_send{
        margin-top: auto;
        margin-bottom: auto;
        margin-right: 10px;
        border-radius: 25px;
        background-color: #78e08f;
        padding: 10px;
        position: relative;
    }
    .msg_time{
        position: absolute;
        left: 0;
        bottom: -15px;
        color: rgba(255,255,255,0.5);
        font-size: 10px;
    }
    .msg_time_send{
        position: absolute;
        right:0;
        bottom: -15px;
        color: rgba(255,255,255,0.5);
        font-size: 10px;
    }
    .msg_head{
        position: relative;
    }
    #action_menu_btn{
        position: absolute;
        right: 10px;
        top: 10px;
        color: white;
        cursor: pointer;
        font-size: 20px;
    }
    .action_menu{
        z-index: 1;
        position: absolute;
        padding: 15px 0;
        background-color: rgba(0,0,0,0.5);
        color: white;
        border-radius: 15px;
        top: 30px;
        right: 15px;
        display: none;
    }
    .action_menu ul{
        list-style: none;
        padding: 0;
        margin: 0;
    }
    .action_menu ul li{
        width: 100%;
        padding: 10px 15px;
        margin-bottom: 5px;
    }
    .action_menu ul li i{
        padding-right: 10px;

    }
    .action_menu ul li:hover{
        cursor: pointer;
        background-color: rgba(0,0,0,0.2);
    }
    @media(max-width: 576px){
        .contacts_card{
            margin-bottom: 15px !important;
        }
    }




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
