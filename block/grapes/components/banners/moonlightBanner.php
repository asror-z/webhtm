<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;



/** @var ZView $this */

/**
 *
 * Action Params
 */

$action = new WebItem();
$action->title = Azl . Az::l('create');
$action->icon = 'fal fa-calendar-edit';
$action->type = WebItem::type['html'];
$action->csrf = 1;
$action->cache = false;
$action->toolbar = false;
$action->debug = false;
$action->call = null;
$action->loader = false;
$action->cacheHttp = false;

/**@var ZView $this */


$this->paramSet(paramAction, $action);

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
   // require Root . '/webhtm/block/assets/main.php';

    $this->head();

    ?>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap');
        body {
            padding: 0 !important;
            margin: 0 !important;
        }
        .moonlight-body {
            margin: 0;
            padding: 0;
            font-family: 'Poppins', sans-serif;
            background: #0a2a43;
            min-height: 1500px;
        }
        .moonlight-banner {
            position: relative;
            width: 100%;
            height: 100vh;
            overflow: hidden;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .moonlight-banner:before {
            content: '';
            position: absolute;
            bottom: 0;
            width: 100%;
            height: 100px;
            background: linear-gradient(to top, #0a2a43, transparent);
            z-index: 1000;
        }
        .moonlight-banner:after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: #0a2a43;
            mix-blend-mode: color;
            z-index: 1000;
        }
        .moonlight-banner img {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            pointer-events: none;
        }
        #text {
            position: relative;
            color: #fff;
            font-size: 10em;
            z-index: 1;
        }
        #road {
            z-index: 2;
        }
    </style>

</head>


<body class="<?= ZWidget::skin['white-skin'] ?>">

<?php

$this->beginBody();

?>

<div class="moonlight-body">
    <section class="moonlight-banner">
        <img src="/render/grapeAssets/styleComponents/img/moonlightBg.jpg" id="bg">
        <img src="/render/grapeAssets/styleComponents/img/moon.png" id="moon">
        <img src="/render/grapeAssets/styleComponents/img/mountain.png" id="mountain">
        <img src="/render/grapeAssets/styleComponents/img/road.png" id="road">
        <h2 id="text">Moonlight</h2>
    </section>
</div>

<script>
    let bg = document.getElementById("bg");
    let moon = document.getElementById("moon");
    let mountain = document.getElementById("mountain");
    let road = document.getElementById("road");
    let text = document.getElementById("text");

    window.addEventListener('scroll', function () {
        let value = window.scrollY;

        bg.style.top = value * 0.5 +'px';
        moon.style.left = -value * 0.5 +'px';
        mountain.style.top = -value * 0.15 +'px';
        road.style.top = value * 0.15 +'px';
        text.style.top = value * 1 +'px';
    })
</script>

<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>


