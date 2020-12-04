<?php


use kartik\builder\Form;
use rmrevin\yii\fontawesome\FA;
use yii\authclient\signature\HmacSha1;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use zetsoft\models\auto\ChatMessage;
use zetsoft\models\user\User;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\helpers\ZUrl;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\chates\ZChatUsersLIst;
use zetsoft\widgets\chates\ZFriendAddWidget;
use zetsoft\widgets\former\ZFormWidget;
use zetsoft\widgets\inputes\ZFileInputWidget;
use zetsoft\widgets\inputes\ZFileInputWidget_JK;
use zetsoft\widgets\inputes\ZHFileInputWidget;
use zetsoft\widgets\inputes\ZInputWidget;
use zetsoft\widgets\navigat\ZButtonWidget;
use zetsoft\widgets\chates\ZUserMessageWidget;
use zetsoft\widgets\actions\ZFilterWidget;
use zetsoft\widgets\inputes\ZTextAreaWidget;
use zetsoft\widgets\former\ZAjaxWidget;
use zetsoft\widgets\notifier\ZModalNewWidget;

/* @var ZView $this */


$name = "parse";


$userId = $this->httpGet('userId');
$recId = $this->userIdentity()->id;
$url = $this->urlTo($this->urlParamStr);

if (isset($_POST['message'])) {
    Az::$app->App->eyuf->chat->Insert($_POST['message'], $userId);

}

if (isset($_POST['file'])) {

    Az::$app->App->eyuf->chat->File($_POST['file'], $userId);

}
Az::$app->forms->zPjax->begin();

$menBloklagan = Az::$app->App->eyuf->chat->menBloklaganlar($userId);
$mengaBlokBosgan = Az::$app->App->eyuf->chat->meniBloklaganlar($userId);

$unblock = Az::$app->App->eyuf->chat->getUnblock($userId);


if (!empty($userId))
    Az::$app->App->eyuf->chat->updateRead($userId, $recId);


if (!empty($mengaBlokBosgan)) {
    $readonly = 'readonly';
    $placeholder = Az::l("Tы заблокирован");
} else {
    $readonly = '';
    $placeholder = Az::l("Cообщение");
}

?>


<div class="container-fluid" style="width: 100% !important;">

    <div id="pjaxFor">
        <div class="card-body">

            <!-- Grid row -->
            <div class="row px-lg-2 px-4">
                <!-- Grid column -->
                <div class="col-md-6 col-xl-4 px-0 ">
                    <?php
                    /*                    echo ZButtonWidget::widget([
                                            'config' => [
                                                'text' => 'Мои контакты',
                                                'icon' => 'fas fa-' . FA::_USER,
                                                'btnType' => ZButtonWidget::btnType['button'],
                                                'btnStyle' => ZButtonWidget::btnStyle['btn-primary'],
                                                'class' => 'text-white'
                                            ],
                                            'event' => [
                                                'click' => '$(contacts1).modal(\'show\')'
                                            ]
                                        ]);

                                        */ ?><!--
                        <?php
                    /*
                                            ZModalNewWidget::begin([
                                                'id' => 'contacts',
                                                'config' => [
                                                    'title' => 'Мои контакты',
                                                    'size'=> ZModalNewWidget::size['lg']
                                                ]
                                            ]);

                                        */ ?>

                        <div class="col-lg-12 col-md-8 col-sm-6" style="overflow: hidden;">
                            ваш контакты здесь
                        </div>

                        --><?php
                    /*                          ZModalNewWidget::end();
                                        */ ?>


                    <?php

                    echo ZFilterWidget::widget([
                        'config' => [
                            'itemselector' => 'div',
                        ]
                    ]);

                    echo ZChatUsersLIst::widget([
                        'config' => [
                            'picture' => '',
                            'height' => '90%',
                            'railVisible' => false,
                        ]
                    ]);

                    ?>

                </div>
                <!-- Grid column -->

                <!-- Grid column -->


                <div class="col-md-6 col-xl-8 pl-md-3 px-lg-auto px-0">

                    <div style="width: 100%;z-index: 20 ;background-color:#7ba6d1; height: 70px !important;"
                         class="messageBlog d-flex input-box">

                        <?php
                        if (!empty($userId)) {
                            $url = Az::$app->App->eyuf->chat->getUserPhoto($userId);
                            $currName = Az::$app->App->eyuf->chat->getUserName();

                            $userInfo =
                                "<h3 class='font-bold font-lg ml-4 text-uppercase' >$currName</h3>";

                            echo $userInfo;
                        }
                        ?>

                        <?php
                        $form = $this->activeBegin();
                        if (!empty($userId)):

                            if (empty($menBloklagan)) {
                                echo '<span onclick="block()" class="leftBtn">
                                    <button class="btn btn-danger btn-sm btn-rounded" style=" right: 15px;position: absolute;top:8px;cursor:pointer"><i class="fas fa-ban"></i>&nbsp;Блок</button>
                                </span>';
                            } else {
                                echo '<span onclick="unblock()" class="leftBtn"  style=" right: 15px;position: absolute;top:8px;cursor:pointer">
                                      <button class="btn btn-success btn-sm btn-rounded" ><i class="fas fa-check"></i>&nbsp;Pазблок</button>
                                </span>';
                            }

                        endif;
                        $form = $this->activeEnd();
                        ?>


                    </div>


                    <div>


                        <div class="chat-message">


                            <ul class="list-unstyled chat-1 scrollbar-light-blue" id="ul_chat">

                                <?php

                                if (isset($userId)) {
                                    if ($userId != null && isset($recId)) {

                                        $messages = Az::$app->App->eyuf->chat->getMessage();

                                        $userName = Az::$app->App->eyuf->chat->getName();

                                        foreach ($messages as $key => $value) {
                                            if ($value->sender == $recId) {
                                                $cmdk = true;
                                                $Name = $this->userIdentity()->name;
                                            } else {
                                                $Name = $userName;
                                                $cmdk = false;
                                            }
                                            echo ZUserMessageWidget::widget([
                                                'config' => [
                                                    'name' => $Name,
                                                    'picture' => "$url",
                                                    'time' => $value->time,
                                                    'text' => $value->text,
                                                    'mine' => $cmdk,
                                                    'userId' => $userId,
                                                    'file' =>$value->file
                                                ]
                                            ]);
                                        }
                                    }
                                }

                                ?>

                            </ul>


                        </div>
                        <div>

                            <? if (!empty($userId)):  ?>


                                <?
                                $form = $this->activeBegin();
                                $model =new ChatMessage();

                                $this->modelSave($model);
                                echo ZFormWidget::widget([
                                    'model' => $model,
                                    'form' => $form,
                                    'rows' => [
                                        [
                                            'attributes' => [
                                                'sender'=>$this->userIdentity()->id,
                                                'receiver'=>$userId,
                                                'text'=>'lkfasdbfsadf',
                                                'file' => [
                                                    'type' => Form::INPUT_WIDGET,
                                                    'widgetClass' => ZFileInputWidget::class,
                                                    'options' => [
                                                        'config' => [
                                                            'showCaption' => true,
                                                            'maxFileCount' => 5,
                                                            'required' => false,
                                                        ],

                                                    ]

                                                ],
                                            ]
                                        ],
                                    ],


                                ]);

                                $this->activeEnd();

                            endif; ?>


                            <div class="input-group-append" >
                                <button class="btn btn-md btn-secondary m-0 px-3" type="submit" id="send"
                                        name="submit">Отправить
                                </button>
                            </div>
                        </div>


                    </div>


                </div>
                <!-- Grid column -->
            </div>
            <!-- Grid row -->
        </div>
    </div>

    <?php


    echo ZAjaxWidget::widget([
        'config' => [
            'func' => 'ajax',
            'url' => '/chat/users',
            'data' => '',
        ],

        'event' => [
            'complete' => <<<JS
                function a(jqXHR, textStatus) {
                //$('#widget').html();
                alert(12);
        }
        JS,
        ],
    ]);


    ?>


    <script>
        function modal() {
            $('profPic').show();
        }
        function contacts() {
            alert('vash contact here');
        }

        function card() {
            $.ajax({
                url: '/core/tester/chat/userblock.aspx',
                type: 'GET',
                data: {'userId': <?=$userId ?>},
                success: function (res) {
                    console.log("Success")
                },
            });

        }


        function unblock() {
            $.ajax({
                url: '/core/tester/chat/userunblock.aspx',
                type: 'GET',
                data: {'userId': <?=$userId ?>},
                success: function (res) {
                    console.log("Success")
                },
            });

        }

        $(function () {
            var id = <?=$userId?>;
            $("#ul_chat").animate({scrollTop: $('#ul_chat').prop("scrollHeight")});
            $("#b" + id).css('cssText', 'background: #7ba6d1 !important;');
        });

        setTimeout(online, 2000);

        function online() {
            $.ajax({
                url: '/core/tester/chat/useronline.aspx',
                type: 'GET',
                data: {'id': <?=$recId?>},
                success: function (res) {
                    setTimeout(online, 5000);
                },
            });
        }


    </script>

    <?php Az::$app->forms->zPjax->end(); ?>


    <style>
        .input-box {
            padding-top: 25px;
        }

        .card.chat-room .members-panel-1,
        .card.chat-room .chat-1 {
            position: relative;
            overflow-y: scroll;
        }
        

        .card.chat-room .members-panel-1 {
            height: 80vh;

        }

        .card.chat-room .chat-1 {
            height: 64vh;
        }

        .card.chat-room .friend-list li {
            border-bottom: 1px solid #e0e0e0;
        }

        .card.chat-room .friend-list li:last-of-type {
            border-bottom: none;
        }

        .scrollbar-light-blue::-webkit-scrollbar-track {
            -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.1);
            background-color: #F5F5F5;
            border-radius: 10px;
        }

        .scrollbar-light-blue::-webkit-scrollbar {
            width: 12px;
            background-color: #F5F5F5;
        }

        .scrollbar-light-blue::-webkit-scrollbar-thumb {
            border-radius: 10px;
            -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.1);
            background-color: #82B1FF;
        }

        .rare-wind-gradient {
            background-image: -webkit-gradient(linear, left bottom, left top, from(#a8edea), to(#fed6e3));
            background-image: -webkit-linear-gradient(bottom, #a8edea 0%, #fed6e3 100%);
            background-image: linear-gradient(to top, #a8edea 0%, #fed6e3 100%);
        }

        .avattar {
            font-size: 20px !important;
            font-weight: bold;
            margin-left: 20px;
        }

        #w2 i:hover {
            opacity: 0.5;
        }

        #w0 i:hover {
            opacity: 0.5;
        }

        .messageBlog {
            width: 85%;
            height: 60px !important;
            min-height: 15px;
            overflow-y: hidden;
        }


        .avatar {
            width: 50px !important;
            height: 50px !important;
            margin-bottom: 20px !important;
        }
    </style>
