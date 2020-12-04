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

/*echo ZNProgressWidget::widget([]);
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
*/?>

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
    <form action='' name='mesage'>
    <div id="loginHolder">
        <div class="form-group">
            <label for="text-name">Name</label>
            <div class="input-group d-block">
                <input type="text" name='login' id="text-name" class="form-control">
            </div>
        </div>
        <div class="form-group">
            <label for="text-name">Message</label>
            <div class="input-group d-block">
                <input type="text" name='mesage' id="text-name" class="form-control">
            </div>
        </div>
    </div>
        <input type='submit' value='Click'>
    </form>
    <div id='element'></div>
    <script>
        window.onload = function(){
            var socket = new WebSocket("ws://localhost:8080");
            var status = document.querySelector("#element");

            socket.onopen = function() {
                status.innerHTML = "cоединение установлено<br>";
            };

            socket.onclose = function(event) {
                if (event.wasClean) {
                    status.innerHTML = 'cоединение закрыто';
                } else {
                    status.innerHTML = 'соединения как-то закрыто';
                }
                status.innerHTML += '<br>код: ' + event.code + ' причина: ' + event.reason;
            };

            socket.onmessage = function(event) {
                let message = JSON.parse(event.data);
                status.innerHTML+= 'пришли данные:' + message.name + '   ' + message.msg +'<br>';
            };

            socket.onerror = function(event) {
                status.innerHTML = "ошибка " + event.message;
            };
            document.forms["mesage"].onsubmit = function(){
                let message = {
                    name:this.login.value,
                    msg: this.mesage.value
                }
                socket.send(JSON.stringify(message));
                return false;
            }


        }

    </script>
</div>
<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>
