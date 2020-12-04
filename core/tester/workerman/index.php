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

require __DIR__ .'/style.php';
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
    <!doctype html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Socket.IO Chat Example</title>
    </head>
    <body>
    <ul class="pages">
        <li class="chat page">
            <div class="chatArea">
                <ul class="messages"></ul>
            </div>
            <input class="inputMessage" placeholder="Type here..."/>
        </li>
        <li class="login page">
            <div class="form">
                <h3 class="title">What's your nickname?</h3>
                <input class="usernameInput" type="text" maxlength="14" />
            </div>
        </li>
    </ul>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.3.0/socket.io.js"></script>

    </body>
    </html>


</div>
<?php
require __DIR__ .'/main.php';
?>
?>
<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>
