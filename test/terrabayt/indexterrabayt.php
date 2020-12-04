<?php

use zetsoft\dbitem\core\WebItem;
use yii\bootstrap\Html;
use zetsoft\dbitem\stats\AnalyticStatusItem;
use zetsoft\former\chart\ChartForm;
use zetsoft\former\chart\ChartFormAdmin;
use zetsoft\former\chart\ChartFormAnalytic;
use zetsoft\models\shop\ShopOrder;
use zetsoft\models\shop\ShopStatus;
use zetsoft\service\market\GuestStatistic;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\blocks\ZJqueryKnobWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\charts\ZChartFormWidget;
use zetsoft\widgets\charts\ZChartFormWidgetJaxongir;
use zetsoft\widgets\charts\ZChartJsPieWidget;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\inputes\ZKSelect2Widget;
use zetsoft\widgets\market\ZAnalyticsWidget;
use zetsoft\widgets\menus\ZMmenuWidget;
use zetsoft\widgets\menus\ZMmenuWidgetSh;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;
use zetsoft\models\shop\ShopBrand;
use zetsoft\widgets\themes\ZMarketAdminCardWidget;
use zetsoftspace\ZClassName;


/** @var ZView $this */


/**
 *
 * Action Params
 */

$action = new WebItem();

$action->title = Azl . 'Socket';
$action->icon = 'fa fa-globe';
$action->type = WebItem::type['html'];
$action->csrf = true;
$action->debug = false;


$this->paramSet(paramAction, $action);

$this->title();
$this->toolbar();


/**
 *
 * Start Page
 */
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
    <style>
        /* Fix user-agent */

        * {
            box-sizing: border-box;
        }

        html {
            font-weight: 300;
            -webkit-font-smoothing: antialiased;
        }

        html, input {
            font-family: "HelveticaNeue-Light",
            "Helvetica Neue Light",
            "Helvetica Neue",
            Helvetica,
            Arial,
            "Lucida Grande",
            sans-serif;
        }

        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
        }

        ul {
            list-style: none;
            word-wrap: break-word;
        }

        /* Pages */

        .pages {
            height: 100%;
            margin: 0;
            padding: 0;
            width: 100%;
        }

        .page {
            height: 100%;
            position: absolute;
            width: 100%;
        }

        /* Login Page */

        .login.page {
            background-color: #000;
        }

        .login.page .form {
            height: 100px;
            margin-top: -100px;
            position: absolute;

            text-align: center;
            top: 50%;
            width: 100%;
        }

        .login.page .form .usernameInput {
            background-color: transparent;
            border: none;
            border-bottom: 2px solid #fff;
            outline: none;
            padding-bottom: 15px;
            text-align: center;
            width: 400px;
        }

        .login.page .title {
            font-size: 200%;
        }

        .login.page .usernameInput {
            font-size: 200%;
            letter-spacing: 3px;
        }

        .login.page .title, .login.page .usernameInput {
            color: #fff;
            font-weight: 100;
        }

        /* Chat page */

        .chat.page {
            display: none;
        }

        /* Font */

        .messages {
            font-size: 150%;
        }

        .inputMessage {
            font-size: 100%;
        }

        .log {
            color: gray;
            font-size: 70%;
            margin: 5px;
            text-align: center;
        }

        /* Messages */

        .chatArea {
            height: 100%;
            padding-bottom: 60px;
        }

        .messages {
            height: 100%;
            margin: 0;
            overflow-y: scroll;
            padding: 10px 20px 10px 20px;
        }

        .message.typing .messageBody {
            color: gray;
        }

        .username {
            font-weight: 700;
            overflow: hidden;
            padding-right: 15px;
            text-align: right;
        }

        /* Input */

        .inputMessage {
            border: 10px solid #000;
            bottom: 0;
            height: 60px;
            left: 0;
            outline: none;
            padding-left: 10px;
            position: absolute;
            right: 0;
            width: 100%;
        }
    </style>
</head>
<body class="<?= ZWidget::skin['white-skin'] ?>">
<?php
$this->beginBody();
?>


<?php $this->endBody() ?>
<script
        src="https://code.jquery.com/jquery-3.5.1.min.js"
        integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
<script src="/assetz/ajax/libs/socket.io/2.3.0/socket.io.js"></script>
<script !src="">
    $(function () {

        var socket = io('ws://' + document.domain + ':2020/chat', {secure: true, rejectUnauthorized: false});
        document.cookie = 'session=able'
        // var socket = io('http://10.10.3.171:2020/room', {secure: true,    rejectUnauthorized: false});
        var d = new Date();
        if (!$.cookie('key')){
            $.cookie('key', d.getTime())
        }
        var $div = $('<p />').appendTo('body');
        $div.text($.cookie('key'));
        socket.emit('login', $.cookie('key'));
        socket.on('reconnect', () => {
            console.log(124214)
            // socket.emit('login', '124');
        });

        socket.on('user-list', (msg) => {
            console.log(msg)
        });
    });
</script>
</body>
</html>

<?php $this->endPage() ?>
