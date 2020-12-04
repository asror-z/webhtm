<?php

/**
 *
 *
 * Author:  Asror Zakirov
 * https://www.linkedin.com/in/asror-zakirov
 * https://github.com/asror-z
 *
 */


/** @var ZView $this */

use zetsoft\dbitem\core\WebItem;
use zetsoft\models\place\PlaceCountry;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\inptest\ZKSelect2AjaxWidget;
use zetsoft\widgets\inputes\ZKSelect2Widget;
use zetsoft\widgets\menus\ZMmenuWidget;

$action = new WebItem();

$action->title = Azl . 'Заказы';
$action->icon = 'fal fa-envelope';
$action->type = WebItem::type['html'];
$action->csrf = true;

if ($this->httpGet('spa'))
    $action->debug = true;



$this->paramSet(paramAction, $action);
$this->title();
$this->toolbar();
$this->beginPage();

?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>

    <?php

    require Root . '/webhtm/block/metas/main.php';
    require Root . '/webhtm/block/assets/main.php';

    $this->head();

    ?>

</head>


<body class="<?= ZWidget::skin['white-skin'] ?>">

<?php

$this->beginBody();

echo ZNProgressWidget::widget([]);
if (!$this->httpGet('spa'))
    echo ZMmenuWidget::widget([
        //'data' => $this->cores->menus->create('mmenu'),
        'config' => [
            'theme' => 'white',
            'content.img.width' => 230,
            'iconbar.top' => [
                "<a href='#/'><i class='fa fa-home'></i>cc</a>",
                "<a href='#/'><i class='fa fa-home'></i>cc</a>",
            ],
            'iconbar.bottom' => [
                "<a href='#/'><i class='fa fa-home'></i>aa</a>",
                "<a href='#/'><i class='fa fa-home'></i>cc</a>",
            ],
            'all.border' => ZMmenuWidget::border['border-full'],
            'menu-effect-slide' => true,
        ],
    ]);
?>

<div id="page">
    <style>
        .received-message, .sent-message {
            padding: 10px;
            margin: 1px 0 0 0;
            text-align: left;
        }

        .sent-message {
            background: #efefef;
            text-align: right;
        }

        .received-message {
            background: #efefef;

        }

        #chat {
            background: #EAEAEA;
            border: #CCC;
            padding: 20px;
        }

        .login-btn {
            cursor: pointer;
            font-weight: bold;
        }

        .msg-container {
            min-height: 300px;
            max-height: 600px;
            overflow-y: scroll;
        }
    </style>

  
    <div id="chatHolder">
        <h3>Hello I'm <span id="me"></span> (<span id="mekey"></span>)</h3>
    </div>
    <div class="nav flex-column nav-pills col-md-2" id="onlineUsers">
    </div>

    <div class="tab-content col-md-10" id="userChat">

    </div><!-- tab content -->


    <script>
        var conn = new WebSocket('ws://' + window.location.hostname + ':1997');
        var name;
        conn.onopen = function (e) {
            console.log("Connection established!");
        };

        function getTime() {
            var date = new Date();

            return date.toLocaleDateString()
        };

        function sendMessage(e, msgFor) {
            var code = (e.keyCode ? e.keyCode : e.which);

            if (code !== 13) {
                return null;
            }

            var message = document.getElementById('message').value;

            if (message.length === 0) {
                return null;
            }

            var msg = {};
            msg["type"] = "message";
            msg["name"] = name;
            msg["message"] = message;
            msg["msgFor"] = msgFor;
            msg["from"] = $('#mekey').text();
            conn.send(JSON.stringify(msg));

            var content = document.getElementById('tab_messages_' + msgFor).innerHTML;
            scrollBottom('tab_messages_' + msgFor);

            document.getElementById('tab_messages_' + msgFor).innerHTML = content + '<div class="sent-message">' + message + '</div>';
            document.getElementById('message').value = '';
        };

        function receiveMessage(e) {
            var jsonMessage = JSON.parse(e.data);

            console.log(jsonMessage);
            if (jsonMessage.type === "message") {
                var content = document.getElementById('tab_messages_' + jsonMessage.from).innerHTML;
                document.getElementById('tab_messages_' + jsonMessage.from).innerHTML = content + '<div class="received-message">' + jsonMessage.message + '</div>';
                scrollBottom('tab_messages_' + jsonMessage.from);
            } else if (jsonMessage.type === "onlineUsers") {
                var count = 0;
                var onlineUsers = "";
                var userChat = "";
                $.each(jsonMessage.onlineUsers, function (key, val) {
                    var me = $('#me').text();
                    if (me === val) {
                        $('#mekey').text(key);
                    }
                    if (me != val) {
                        if (count === 0) {
                            onlineUsers = '<a href="#tab_' + key + '" class="nav-link active" data-toggle="pill">' + val + '</a>';

                            userChat = '<div class="tab-pane fade show active" id="tab_' + key + '"><h5>' + val + ' is online</h5><div class="msg-container" id="tab_messages_' + key + '"></div><textarea id="message" class="form-control" onkeyup="sendMessage(event,' + key + ')" placeholder="Type your message here..."></textarea>';
                        } else {
                            onlineUsers = onlineUsers + '<a href="#tab_' + key + '" class="nav-link" data-toggle="pill">' + val + '</a>';
                            userChat = userChat + '<div class="tab-pane fade" id="tab_' + key + '"><h5>' + val + '  is online</h5><div class="msg-container" id="tab_messages_' + key + '"></div><textarea id="message" class="form-control" onkeyup="sendMessage(event,' + key + ')" placeholder="Type your message here..."></textarea>';
                        }
                        count++;
                    }
                });
                //console.log(onlineUsers);
                document.getElementById('onlineUsers').innerHTML = onlineUsers;
                document.getElementById('userChat').innerHTML = userChat;
            }
        };

        conn.onmessage = function (e) {
            console.log(e);

            receiveMessage(e);
        };

        function hideChat() {
            var element = document.getElementById("chatHolder");
            element.style.display = "none";
        }
        
        $(document).ready(function () {
            hideChat();
        });

        function scrollBottom(divName) {
            var objDiv = document.getElementById(divName);
            objDiv.scrollTop = objDiv.scrollHeight;
        }
    </script>
</div>
<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>
