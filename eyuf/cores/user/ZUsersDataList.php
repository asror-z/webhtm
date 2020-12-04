<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@9.10.3/dist/sweetalert2.css">

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9.10.3/dist/sweetalert2.js"></script>

<div class="row">
    <div class="col-4">
       <?php

       use rmrevin\yii\fontawesome\FA;
       use zetsoft\models\ALL\CoreMessage;
       use zetsoft\models\ALL\CoreNotify;
       use zetsoft\models\user\User;
       use zetsoft\models\App\eyuf\EyufScholar;
       use zetsoft\service\utility\Notify;
       use zetsoft\system\assets\ZColor;
       use zetsoft\system\Az;
       use zetsoft\widgets\actions\ZJquerySieveFilteringWidget;
       use zetsoft\widgets\chates\ZChatDataList;
       use zetsoft\widgets\chates\ZChatListWidget;
       use zetsoft\widgets\chates\ZChatUsersLIst;
       use zetsoft\widgets\former\ZDynaWidget;
       use zetsoft\widgets\former\ZViewWidget;
       use zetsoft\widgets\navigat\ZButtonWidget;
       use zetsoft\widgets\themes\ZCardProfileWidget;

        ?>
        <div>

            <?php


            echo ZJquerySieveFilteringWidget::widget([
                'config' => [
                    'itemselector' => 'li',
                ]
            ]);

            echo ZChatDataList::widget([
                'config' => [
                    'picture' => '',
                    'height' => '130rem',
                    'status' => Az::l('lastseen recently'),
                    'badge' => 0,
                    'addFriend' => FA::_PLUS,
                    'railVisible' => false,
                ]
            ]);

            ?>

        </div>
    </div>
    <div class="col-8">
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
          
        $model = User::findOne($userId);
        $imageUrl = $this->userPhoto();
        /** @var EyufScholar $Sch */
        $Sch = EyufScholar::findOne(['user_id' => $model->id]);

        

        ZCardProfileWidget::begin([
            'config' => [
                'imageUrl' => $imageUrl,
                'color' => ZColor::color['primary-color'],
                'title' => $model->name,

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
                'class'=>'friendAdd',
                'text' => Az::l('Добавить друзя'),
            
                'hasIcon' => true,
                'icon' => 'fa fa-' . FA::_EDIT,

                'iconColor' => '#ffffff'
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
                'url' => '/cores/chat.aspx?userId='.$userId,
                'text' => Az::l('Отправить сообщения'),

                /**
                 *
                 * Links
                 */
              

                'hasIcon' => true,
                'icon' => 'fa fa-' . FA::_EDIT,

                'iconColor' => '#ffffff'
            ],




        ]);



        echo $addFriends;
        echo $sendMessage;
       
       

        ZCardProfileWidget::end();


        echo ZViewWidget::widget([
            'model' => $Sch,
        ]);

        ?>
    </div>
</div>
<style>
    .tegma {
    height: 7rem!important;
    margin-top: -115px!important;
    }
    .swal2-content{
    display: none!important;
    }
</style>


<script>
    $('.friendAdd').click(function () {
            $.ajax({
                url: '/tester/chat/addfriend.aspx',
                type: 'GET',
                data: {'userId': <?=$userId ?>},
                success: function (res) {

                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'Tы вступил в ряды друзей',
                            showConfirmButton: false,
                            timer: 1500
                        })

                },
            });

        }
    )
</script>
