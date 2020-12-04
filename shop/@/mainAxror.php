<?php

use yii\bootstrap4\Html;
use zetsoft\models\App\eyuf\EyufScholar;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\animo\ZSimpleLoaderWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\menus\ZMmenuWidgetSh;
use zetsoft\widgets\menus\ZMMmenuWidget;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;


/** @var ZView $this */

?>
<?php
$this->beginPage();
?>

<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>


    <!-- -------------------------- -->
    <!-- ---------  Assets ----------->

    <!-- ---------  Styles ----------->


    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.12.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/render/asrorz/mdb/css/mdb.min.css">

    <link href="/render/asrorz/ven/css/theme.min.css" rel="stylesheet" type="text/css">

    <link href="/render/asrorz/ven/css/theme-responsive.min.css" rel="stylesheet" type="text/css">

    <link rel="stylesheet" href="/render/asrorz/css/ALL.css">
    <!--<link rel="stylesheet" href="/render/asrorz/css/<? /*= App*/ ?>.css">-->


    <!-- ---------  Scripts ----------->

    <!--  <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/jquery@3.4.1/dist/jquery.min.js"></script>-->
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/jquery@3.4.1/dist/jquery.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/js-cookie@beta/dist/js.cookie.min.js"></script>


    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.bundle.js"></script>


    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/mobile-detect@1.4.4/mobile-detect.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.2/jquery.form.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/cookiejs@1.0.26/dist/cookie.min.js"></script>
    <script type="text/javascript" src="/render/asrorz/ven/js/theme.js"></script>

    <script type="text/javascript" src="/render/asrorz/js/ALL.js"></script>
    <script type="text/javascript" src="/render/asrorz/js/<?= App ?>.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/copy-to-clipboard@3.3.1/example/index.js"></script>
    <!--<script src="//code.tidio.co/sajsbepsx7hzwgqrdaohzr1sbsz3vgyv.js" async></script>-->

    <!-- <script type="text/javascript" src="//consultsystems.ru/script/37510/" async charset="utf-8"></script>-->
    <!--
    $this->fileJs('https://cdn.jsdelivr.net/npm/copy-to-clipboard@3.3.1/example/index.js')
    -->


    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/mburger-css@1.3.3/dist/mburger.css">
    <link rel="stylesheet" href="/render/menus/ZMMmenuWidget/assets/mmenu/mmenuextension.css">


    <!-- -------------------------- -->
    <!-- ---------  Assets ----------->


    <?php
    $this->head();

    $this->registerLinkTag(['rel' => 'icon', 'type' => 'image/x-icon', 'href' => Yii::getAlias('@web/favicon.ico')]);

    ?>

    <style>
        body {
            /*overflow: auto !important;*/
            overflow-x: hidden !important;
            /*overflow-y: scroll !important;*/
            scrollbar-3dlight-color: #000000;
            scrollbar-arrow-color: #ffffff;
            scrollbar-darkshadow-color: #000000;
            scrollbar-face-color: #000000;
            scrollbar-highlight-color: #ffffff;
            scrollbar-shadow-color: #ffffff;
            scrollbar-track-color: #000000;
        }

    </style>

</head>

<body class="<?= ZWidget::skin['white-skin'] ?>">


<?php $this->beginBody() ?>




<?php
 if (false)
echo ZNProgressWidget::widget([

]);

/*echo IpotekButton::widget([
    'config' => [
        'type' => IpotekButton::type['button'],
        'isSticky' => false
    ]
]);*/

/*
echo ZAFakeloaderWidget::widget([
    'config' => [
        'timeToHide' => 200,
        'zIndex' => 999,
        'spinner' => ZAFakeloaderWidget::spinner['spinner7'],
        'imagePath' => false,
        'bgColor' => '#2eccf1'
    ]
]);*/

    /*echo ZSimpleLoaderWidget::widget([]);*/
/*
echo ZSpeakerWidget::widget([
    'config' => [
        'type' => ZSpeakerWidget::type['Russian Female'],
        'icon' => '/render/audios/assets/audio/responciveVoice/rupor.png',
        'bg_color' => '#000000',
    ]
]);*/

/*
echo ZConferenceNavbarWidget::widget([
    'config' => [
        'type' => '',
        'tlgTitle' => '',
        'telTitle' => '',
        'smsTitle' => '',
        'siteTitle' => '',
        'chatTitle' => '',
        'a_link' => [
            '1' => 'https://t.me/joinchat/JNR4XVQ-Yf-2q0zoIF8dmw',
            '2' => 'https://eyuf.uz/',
            '3' => 'https://eyuf.uz/',
            '4' => 'https://eyuf.uz/',
            '5' => 'https://eyuf.uz/',
        ],
        'confontsize' => '25px',
        'isSticky' => true,
        'view' => ZConferenceNavbarWidget::type['main'],
    ]
]);*/

echo ZMMenuWidgetSh::widget([
    //    'data' => $this->cores->menus->create('mmenu'),
    'config' => [
        'theme'=> 'white',
        'content.img.width' => 80,
        'iconbar.top' => [
            "<a href='#/'><i class='fa fa-home'></i>cc</a>",
            "<a href='#/'><i class='fa fa-home'></i>cc</a>",
        ],
        'iconbar.bottom' => [
            "<a href='#/'><i class='fa fa-home'></i>aa</a>",
            "<a href='#/'><i class='fa fa-home'></i>cc</a>",
        ],
        'all.border' => ZMMenuWidgetSh::border['border-full'],
    ],
]);


?>

<?=
require Root . '/webhtm/block/navbar/other/navbarAxror.php';

?>

<div>

    <?php

    /*echo ZBreadCrumbWidgetNew::widget([
        'data' => [
            [
                'name' => '<i class="brea fa fa-home  fa-2x align-items-center mb-3">&nbsp;</i>',
                'url' => '/'
            ],
        ]
    ]);*/

    echo ZSessionGrowlWidget::widget();

    ?>

    <?

    if ($this->controlId === 'scholar' && $this->hasRole('scholar')) {
        $scholar = EyufScholar::findOne([
            'user_id' => $this->userIdentity()->id
        ]);

        switch (true) {

            case !$this->userIdentity()->verified_email:
                if ($this->actionId !== 'verify')
                    $this->urlRedirect(['/logics/scholar/verify']);
                break;

            case empty($scholar->program):
                if ($this->actionId !== 'add-info')
                    $this->urlRedirect(['/logics/scholar/add-info']);
                break;
        }
    }
    ?>

    <div id="content" class="content-footer pr-2 pl-2 pt-4">

        <?= $content ?>

    </div>





</div>
<?

if ($this->controlId !== 'chat')
    require Root . '/webhtm/block/footer/eyuf/mainNew.php';

?>


<div id="page"></div>

<?php $this->endBody() ?>

</body>
</html>
<?php
$this->endPage()

?>
