<?php

use rmrevin\yii\fontawesome\FA;
use zetsoft\dbitem\core\WebItem;
use zetsoft\models\cpas\CpasOffer;
use zetsoft\models\user\User;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\navigat\ZButtonWidget;
use zetsoft\widgets\themes\ZAdminCardWidgetNew;


/** @var ZView $this */


/**
 *
 * Action Params
 */

$action = new WebItem();

$action->title = Azl . 'ArbitPro';
$action->icon = 'fa fa-pie-chart';
$action->type = WebItem::type['html'];
$action->csrf = true;
$action->debug = true;


$action->loader = false;
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
    require Root . '/webhtm/block/assets/App/main_arbit.php';

    $this->head();

    ?>
    <link rel="stylesheet" href="/render/cpa/css/main.css">


</head>


<body class="<?= ZWidget::skin['white-skin'] ?>">


<?php
$current_user = $this->userIdentity();
if($current_user !== null){
    $role = $current_user->role;
    switch ($role){
        case 'admin': return $this->urlRedirect('/cpas/admin/statistic'); break;
        case 'user': return $this->urlRedirect('/cpas/user/statistic'); break;
    }
}

$users = User::find()->count();
$offers = CpasOffer::find()->count();
$money = 300;
//$month = time();
//$percent = \zetsoft\models\user\User::find()->where(['modified_at' => $month])->count();
//vdd($percent);
$now = Az::$app->cores->date->dateTime_Month_Start();
$per_users = User::find()
    ->where([
        '>', 'created_at', $now
    ])->count();

$per_offers = CpasOffer::find()
    ->where([
        '>', 'created_at', $now
    ])->count();
$this->beginBody();
if ($users === 0)
    $per_u = 0;
else
    $per_u = number_format($per_users / $users *100, 2);
if ($offers === 0)
    $per_o = 0;
else
    $per_o = number_format($per_offers / $offers *100, 2);

//require Root . '/webhtm/block/navbar/mainArbit.php';;


?>

<div id="page">

    <header class="header">
        <div class="section-header d-flex justify-content-between align-items-center">
            <div class="brend ml-5">
                <h3 class="text-white">Arbit</h3>
            </div>
            <div class="header-auth mr-5">
                <a class="btn btn-white btn-rounded text-dark font-weight-bold" href="/cpas/user/login-register.aspx"><?= Az::l('Авторизация')?></a>
            </div>
        </div>
    </header>


    <div id="content" class="content-footer">


        <div class="content">
            <div class="container">
                <div class="tatsu-row row">
                    <div class="content-image">
                        <img src="/render/cpa/images/Zeydoo_ill.png" alt="">
                    </div>
                    <div class="content-column">
                        <div class="content-title">
                            <img src="/render/cpa/images/shield_top.png" alt="">
                            <h2><?= Az::l('CPA СЕТЬ')?></h2>
                            <h3><?= Az::l('С ВЫБРАННЫМИ ')?><br><?= Az::l('ВЫГОДНЫМИ ПРЕДЛОЖЕНИЯМИ')?></h3>
                            <p><?= Az::l('Работая на рекламной платформе №1, мы ДЕЛАЕМ то, что не могут сделать другие: предоставлять вам самые выгодные предложения от первоклассных прямых рекламодателей.')?></p>
                            <a href="/cpas/user/login-register.aspx"><?= Az::l('Присоединиться')?></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="section-info">
            <div class="info-header text-center mb-5">
                <h2 class="display-4 font-weight-bold"><?= Az::l('Эти цифры говорят сами за себя')?></h2>
                <h5 class="text-comment"><?= Az::l('Всего несколько простых шагов отделяют вас от успеха.')?></h5>

            </div>

            <div class="container">
                <div class="row">
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <?php
                        echo ZAdminCardWidgetNew::widget([
                            'config' => [
                                'template' => ZAdminCardWidgetNew::template['second'],
                                'color' => \zetsoft\system\assets\ZColor::color['blue-grey lighten-5'],
                                'icon' => 'fas fa-' . FA::_USER,
                                'isImage' => false,
                                'icon-class' => 'fa-5x',
                                'bodyTitle' => Az::l('Пользователей в нашей системе'),
                                'bodyText' => $users,
                                'footerPersent' => $per_u . '%',
                                'footerText' => Az::l('с прошлого месяца')

                            ]
                        ]);
                        ?>
                    </div>

                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <?php
                        echo ZAdminCardWidgetNew::widget([
                            'config' => [
                                'template' => ZAdminCardWidgetNew::template['second'],
                                'color' => \zetsoft\system\assets\ZColor::color['blue lighten-3'],
                                'icon' => 'fas fa-file-text',//<i class="fas fa-hand-holding-usd"></i>
                                'isImage' => false,
                                'icon-class' => 'fa-5x',
                                'bodyTitle' => Az::l('Предложения в нашей системе'),
                                'bodyText' => $offers,
                                'footerPersent' => $per_o . '%',
                                'footerText' => Az::l('с прошлого месяца')

                            ]
                        ]);
                        ?>
                    </div>

                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <?php
                        echo ZAdminCardWidgetNew::widget([
                            'config' => [
                                'template' => ZAdminCardWidgetNew::template['second'],
                                'color' => \zetsoft\system\assets\ZColor::color['green lighten-3'],
                                'icon' => 'fas fa-search-dollar',//<i class="fas fa-search-dollar"></i>
                                'isImage' => false,
                                'icon-class' => 'fa-5x',
                                'bodyTitle' => Az::l('Заработанные деньги'),
                                'bodyText' => $money,
                                'footerPersent' => '20%',
                                'footerText' => Az::l('с прошлого месяца')

                            ]
                        ]);
                        ?>
                    </div>
                </div>
            </div>

        </div>
        <div class="wrapper">
            <div class="container">
                <h2 class="display-4 mb-5"><?= Az::l('Зачем вести с нами дела?')?></h2>
                <div class="wrapper-block row">
                    <div class="col-md-4 mb-4">

                        <div class="wrapper-item shadow">
                            <i class="fas fa-clipboard-check fa-3x p-2"></i>
                            <h4><?= Az::l('Выборочные предложения')?></h4>
                            <p>
                                <?= Az::l('Продвигайте частные предложения от прямых рекламодателей Propellerads')?>
                            </p>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">

                        <div class="wrapper-item shadow">
                            <i class="fas fa-users fa-3x p-2"></i>
                            <h4><?= Az::l('Персональный менеджер')?></h4>
                            <p>
                                <?= Az::l('Мы поможем вам от выбора предложения до получения выплаты.')?>
                            </p>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="wrapper-item shadow">
                            <i class="fab fa-github-square fa-3x p-2"></i>
                            <h4><?= Az::l('Платформа Cazy')?></h4>
                            <p>
                                <?= Az::l('Простая в использовании собственная платформа, специально созданная для нужд аффилированного лица.')?>
                            </p>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="wrapper-item shadow">
                            <i class="far fa-eye fa-3x p-2"></i>
                            <h4><?= Az::l('Статистика в реальном времени')?></h4>
                            <p>
                                <?= Az::l('Получайте актуальные данные о ваших конверсиях и прибыли')?>
                            </p>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="wrapper-item shadow">
                            <i class="fas fa-cube fa-3x p-2"></i>
                            <h4><?= Az::l('Удобные выплаты')?></h4>
                            <p>
                                <?= Az::l('10 способов вывода доходов включая Payme, Click')?>
                            </p>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="wrapper-item shadow">
                            <i class="fas fa-comments fa-3x p-2"></i>
                            <h4><?= Az::l('Поддержка 24/7')?></h4>
                            <p>
                                <?= Az::l('Получите мгновенную помощь от нашей службы поддержки, когда она вам понадобится')?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="section-money p-5 m-5">
                <div class="money-header text-center">
                    <h2 class="display-4 font-weight-bold"><?= Az::l('Начнем зарабатывать деньги!')?></h2>
                    <h5 class="text-comment"><?= Az::l('Благодаря многолетнему опыту в рекламе мы знаем, какие предложения действительно приносят пользу. Используйте наш опыт, чтобы максимизировать свою прибыль!')?></h5>

                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="tatsu-column  tatsu-bg-overlay tatsu-one-fourth tatsu-column-image- tatsu-column-effect-  tatsu-j8pRIUIIB" data-parallax-speed="0" style=""><div class="tatsu-column-inner "><div class="tatsu-column-pad-wrap"><div class="tatsu-column-pad"><div class="tatsu-single-image tatsu-module align-center tatsu-nNGrFWWkT  d-flex justify-content-center"><div class="tatsu-single-image-inner " style="width : 150px;"><div class="tatsu-single-image-padding-wrap" style="padding-bottom : 100%;"></div><img class="tatsu-gradient-border lazyloaded" alt="" data-srcset="https://zeydoo.com/wp-content/uploads/2019/11/step_1-2.gif, https://zeydoo.com/wp-content/uploads/2019/11/step_1-2@2x.gif 2x" srcset="https://zeydoo.com/wp-content/uploads/2019/11/step_1-2.gif, https://zeydoo.com/wp-content/uploads/2019/11/step_1-2@2x.gif 2x"></div><style>.tatsu-nNGrFWWkT{margin: 0 0px 0 0;padding: 0 0 0px 0;}.tatsu-nNGrFWWkT .tatsu-single-image-inner{max-width: 60%;}.tatsu-nNGrFWWkT.tatsu-single-image{transform: translate3d(0px,0px, 0);}@media only screen and (max-width: 767px) {.tatsu-nNGrFWWkT .tatsu-single-image-inner{max-width: 48%;}.tatsu-nNGrFWWkT{padding: 0px 0px 10px 0px;}}</style></div><div class="tatsu-module tatsu-text-block-wrap tatsu-eOiloSd4Tl  "><div class="tatsu-text-inner tatsu-align-center  clearfix"><style>.tatsu-eOiloSd4Tl.tatsu-text-block-wrap .tatsu-text-inner{width: 100%;text-align: center;}.tatsu-eOiloSd4Tl.tatsu-text-block-wrap{margin: 20px 0px 30px 0px;}@media only screen and (min-width:768px) and (max-width: 1024px) {.tatsu-eOiloSd4Tl.tatsu-text-block-wrap{margin: 0px 0px 0px 0px;}}@media only screen and (max-width: 767px) {.tatsu-eOiloSd4Tl.tatsu-text-block-wrap{margin: 0px 0px 0px 0px;}.tatsu-eOiloSd4Tl.tatsu-text-block-wrap .tatsu-text-inner{padding: 0px 0px 30px 0px;}}</style>
                                                <h5 style="text-align: center;"><?= Az::l('Регистр')?></h5>
                                            </div></div></div></div><div class="tatsu-column-bg-image-wrap"><div class="tatsu-column-bg-image"></div></div><div class="tatsu-overlay tatsu-column-overlay tatsu-animate-none"></div></div><style>.tatsu-row > .tatsu-j8pRIUIIB.tatsu-column{width: 25%;}.tatsu-j8pRIUIIB.tatsu-column > .tatsu-column-inner > .tatsu-column-overlay{mix-blend-mode: normal;}.tatsu-j8pRIUIIB > .tatsu-column-inner > .tatsu-top-divider{z-index: 9999;}.tatsu-j8pRIUIIB > .tatsu-column-inner > .tatsu-bottom-divider{z-index: 9999;}.tatsu-j8pRIUIIB > .tatsu-column-inner > .tatsu-left-divider{z-index: 9999;}.tatsu-j8pRIUIIB > .tatsu-column-inner > .tatsu-right-divider{z-index: 9999;}@media only screen and (max-width:1377px) {.tatsu-row > .tatsu-j8pRIUIIB.tatsu-column{width: 25%;}}@media only screen and (min-width:768px) and (max-width: 1024px) {.tatsu-row > .tatsu-j8pRIUIIB.tatsu-column{width: 25%;}.tatsu-j8pRIUIIB.tatsu-column{margin: 0px 0px 0px 0px !important;}}@media only screen and (max-width: 767px) {.tatsu-row > .tatsu-j8pRIUIIB.tatsu-column{width: 100%;}.tatsu-j8pRIUIIB.tatsu-column{margin: 0px 0px 0px 0px !important;}}</style></div>
                    </div>
                    <div class="col-md-3 text-center">
                        <div class="tatsu-column  tatsu-bg-overlay tatsu-one-fourth tatsu-column-image- tatsu-column-effect-  tatsu-Cx2HmgaWMk" data-parallax-speed="0" style=""><div class="tatsu-column-inner "><div class="tatsu-column-pad-wrap"><div class="tatsu-column-pad"><div class="tatsu-single-image tatsu-module align-center tatsu-i4o3RDEG9y d-flex justify-content-center "><div class="tatsu-single-image-inner " style="width : 150px;"><div class="tatsu-single-image-padding-wrap" style="padding-bottom : 100%;"></div><img class="tatsu-gradient-border lazyloaded" alt="" data-srcset="https://zeydoo.com/wp-content/uploads/2019/11/step_2-2.gif, https://zeydoo.com/wp-content/uploads/2019/11/step_2-2@2x.gif 2x" srcset="https://zeydoo.com/wp-content/uploads/2019/11/step_2-2.gif, https://zeydoo.com/wp-content/uploads/2019/11/step_2-2@2x.gif 2x"></div><style>.tatsu-i4o3RDEG9y{margin: 0 0px 0 0;padding: 0 0 0px 0;}.tatsu-i4o3RDEG9y .tatsu-single-image-inner{max-width: 60%;}.tatsu-i4o3RDEG9y.tatsu-single-image{transform: translate3d(0px,0px, 0);}@media only screen and (max-width: 767px) {.tatsu-i4o3RDEG9y .tatsu-single-image-inner{max-width: 48%;}.tatsu-i4o3RDEG9y{padding: 0px 0px 10px 0px;}}</style></div><div class="tatsu-module tatsu-text-block-wrap tatsu-y1e-9aerZO  "><div class="tatsu-text-inner tatsu-align-center  clearfix"><style>.tatsu-y1e-9aerZO.tatsu-text-block-wrap .tatsu-text-inner{width: 100%;text-align: center;}.tatsu-y1e-9aerZO.tatsu-text-block-wrap{margin: 20px 0px 30px 0px;}@media only screen and (min-width:768px) and (max-width: 1024px) {.tatsu-y1e-9aerZO.tatsu-text-block-wrap{margin: 0px 0px 0px 0px;}}@media only screen and (max-width: 767px) {.tatsu-y1e-9aerZO.tatsu-text-block-wrap{margin: 0px 0px 0px 0px;}.tatsu-y1e-9aerZO.tatsu-text-block-wrap .tatsu-text-inner{padding: 0px 0px 30px 0px;}}</style>
                                                <h5 style="text-align: center;"><?= Az::l('Получить одобрение')?><br><?= Az::l('менеджером')?></h5>
                                            </div></div></div></div><div class="tatsu-column-bg-image-wrap"><div class="tatsu-column-bg-image"></div></div><div class="tatsu-overlay tatsu-column-overlay tatsu-animate-none"></div></div><style>.tatsu-row > .tatsu-Cx2HmgaWMk.tatsu-column{width: 25%;}.tatsu-Cx2HmgaWMk.tatsu-column > .tatsu-column-inner > .tatsu-column-overlay{mix-blend-mode: normal;}.tatsu-Cx2HmgaWMk > .tatsu-column-inner > .tatsu-top-divider{z-index: 9999;}.tatsu-Cx2HmgaWMk > .tatsu-column-inner > .tatsu-bottom-divider{z-index: 9999;}.tatsu-Cx2HmgaWMk > .tatsu-column-inner > .tatsu-left-divider{z-index: 9999;}.tatsu-Cx2HmgaWMk > .tatsu-column-inner > .tatsu-right-divider{z-index: 9999;}@media only screen and (max-width:1377px) {.tatsu-row > .tatsu-Cx2HmgaWMk.tatsu-column{width: 25%;}}@media only screen and (min-width:768px) and (max-width: 1024px) {.tatsu-row > .tatsu-Cx2HmgaWMk.tatsu-column{width: 25%;}.tatsu-Cx2HmgaWMk.tatsu-column{margin: 0px 0px 0px 0px !important;}}@media only screen and (max-width: 767px) {.tatsu-row > .tatsu-Cx2HmgaWMk.tatsu-column{width: 100%;}.tatsu-Cx2HmgaWMk.tatsu-column{margin: 0px 0px 0px 0px !important;}}</style></div>
                    </div>
                    <div class="col-md-3">
                        <div class="tatsu-column  tatsu-bg-overlay tatsu-one-fourth tatsu-column-image- tatsu-column-effect-  tatsu-kR-VtRGUTJ" data-parallax-speed="0" style=""><div class="tatsu-column-inner "><div class="tatsu-column-pad-wrap"><div class="tatsu-column-pad"><div class="tatsu-single-image tatsu-module align-center tatsu-oCOwErG3f d-flex justify-content-center "><div class="tatsu-single-image-inner " style="width : 150px;"><div class="tatsu-single-image-padding-wrap" style="padding-bottom : 100%;"></div><img class="tatsu-gradient-border lazyloaded" alt="" data-srcset="https://zeydoo.com/wp-content/uploads/2019/11/step_3-2.gif, https://zeydoo.com/wp-content/uploads/2019/11/step_3-2@2x.gif 2x" srcset="https://zeydoo.com/wp-content/uploads/2019/11/step_3-2.gif, https://zeydoo.com/wp-content/uploads/2019/11/step_3-2@2x.gif 2x"></div><style>.tatsu-oCOwErG3f{margin: 0 0px 0 0;padding: 0 0 0px 0;}.tatsu-oCOwErG3f .tatsu-single-image-inner{max-width: 60%;}.tatsu-oCOwErG3f.tatsu-single-image{transform: translate3d(0px,0px, 0);}@media only screen and (max-width: 767px) {.tatsu-oCOwErG3f .tatsu-single-image-inner{max-width: 48%;}.tatsu-oCOwErG3f{padding: 0px 0px 10px 0px;}}</style></div><div class="tatsu-module tatsu-text-block-wrap tatsu-NHlSZzQwno  "><div class="tatsu-text-inner tatsu-align-center  clearfix"><style>.tatsu-NHlSZzQwno.tatsu-text-block-wrap .tatsu-text-inner{width: 100%;text-align: center;}.tatsu-NHlSZzQwno.tatsu-text-block-wrap{margin: 20px 0px 30px 0px;}@media only screen and (min-width:768px) and (max-width: 1024px) {.tatsu-NHlSZzQwno.tatsu-text-block-wrap{margin: 0px 0px 0px 0px;}}@media only screen and (max-width: 767px) {.tatsu-NHlSZzQwno.tatsu-text-block-wrap{margin: 0px 0px 0px 0px;}.tatsu-NHlSZzQwno.tatsu-text-block-wrap .tatsu-text-inner{padding: 0px 0px 30px 0px;}}</style>
                                                <h5 style="text-align: center;"><?= Az::l('Подберите предложение и')?><br><?= Az::l('начать продвижение')?></h5>
                                            </div></div></div></div><div class="tatsu-column-bg-image-wrap"><div class="tatsu-column-bg-image"></div></div><div class="tatsu-overlay tatsu-column-overlay tatsu-animate-none"></div></div><style>.tatsu-row > .tatsu-kR-VtRGUTJ.tatsu-column{width: 25%;}.tatsu-kR-VtRGUTJ.tatsu-column > .tatsu-column-inner > .tatsu-column-overlay{mix-blend-mode: normal;}.tatsu-kR-VtRGUTJ > .tatsu-column-inner > .tatsu-top-divider{z-index: 9999;}.tatsu-kR-VtRGUTJ > .tatsu-column-inner > .tatsu-bottom-divider{z-index: 9999;}.tatsu-kR-VtRGUTJ > .tatsu-column-inner > .tatsu-left-divider{z-index: 9999;}.tatsu-kR-VtRGUTJ > .tatsu-column-inner > .tatsu-right-divider{z-index: 9999;}@media only screen and (max-width:1377px) {.tatsu-row > .tatsu-kR-VtRGUTJ.tatsu-column{width: 25%;}}@media only screen and (min-width:768px) and (max-width: 1024px) {.tatsu-row > .tatsu-kR-VtRGUTJ.tatsu-column{width: 25%;}.tatsu-kR-VtRGUTJ.tatsu-column{margin: 0px 0px 0px 0px !important;}}@media only screen and (max-width: 767px) {.tatsu-row > .tatsu-kR-VtRGUTJ.tatsu-column{width: 100%;}.tatsu-kR-VtRGUTJ.tatsu-column{margin: 0px 0px 0px 0px !important;}}</style></div>
                    </div>
                    <div class="col-md-3">
                        <div class="tatsu-column  tatsu-bg-overlay tatsu-one-fourth tatsu-column-image- tatsu-column-effect-  tatsu-gI7Mip4YEw" data-parallax-speed="0" style=""><div class="tatsu-column-inner "><div class="tatsu-column-pad-wrap"><div class="tatsu-column-pad"><div class="tatsu-single-image tatsu-module align-center tatsu-EQ9MsKXvd  d-flex justify-content-center"><div class="tatsu-single-image-inner " style="width : 150px;"><div class="tatsu-single-image-padding-wrap" style="padding-bottom : 100%;"></div><img class="tatsu-gradient-border lazyloaded" alt="" data-srcset="https://zeydoo.com/wp-content/uploads/2019/11/step_4-2.gif, https://zeydoo.com/wp-content/uploads/2019/11/step_4-2@2x.gif 2x" srcset="https://zeydoo.com/wp-content/uploads/2019/11/step_4-2.gif, https://zeydoo.com/wp-content/uploads/2019/11/step_4-2@2x.gif 2x"></div><style>.tatsu-EQ9MsKXvd{margin: 0 0px 0 0;padding: 0 0 0px 0;}.tatsu-EQ9MsKXvd .tatsu-single-image-inner{max-width: 60%;}.tatsu-EQ9MsKXvd.tatsu-single-image{transform: translate3d(0px,0px, 0);}@media only screen and (max-width: 767px) {.tatsu-EQ9MsKXvd .tatsu-single-image-inner{max-width: 48%;}.tatsu-EQ9MsKXvd{padding: 0px 0px 10px 0px;}}</style></div><div class="tatsu-module tatsu-text-block-wrap tatsu-U0l0ryshyp  "><div class="tatsu-text-inner tatsu-align-center  clearfix"><style>.tatsu-U0l0ryshyp.tatsu-text-block-wrap .tatsu-text-inner{width: 100%;text-align: center;}.tatsu-U0l0ryshyp.tatsu-text-block-wrap{margin: 20px 0px 30px 0px;}@media only screen and (min-width:768px) and (max-width: 1024px) {.tatsu-U0l0ryshyp.tatsu-text-block-wrap{margin: 0px 0px 0px 0px;}}@media only screen and (max-width: 767px) {.tatsu-U0l0ryshyp.tatsu-text-block-wrap{margin: 0px 0px 0px 0px;}.tatsu-U0l0ryshyp.tatsu-text-block-wrap .tatsu-text-inner{padding: 0px 0px 0px 0px;}}</style>
                                                <h5 style="text-align: center;"><?= Az::l('Выведите свой')?><br><?= Az::l('доход')?></h5>
                                            </div></div></div></div><div class="tatsu-column-bg-image-wrap"><div class="tatsu-column-bg-image"></div></div><div class="tatsu-overlay tatsu-column-overlay tatsu-animate-none"></div></div><style>.tatsu-row > .tatsu-gI7Mip4YEw.tatsu-column{width: 25%;}.tatsu-gI7Mip4YEw.tatsu-column > .tatsu-column-inner > .tatsu-column-overlay{mix-blend-mode: normal;}.tatsu-gI7Mip4YEw > .tatsu-column-inner > .tatsu-top-divider{z-index: 9999;}.tatsu-gI7Mip4YEw > .tatsu-column-inner > .tatsu-bottom-divider{z-index: 9999;}.tatsu-gI7Mip4YEw > .tatsu-column-inner > .tatsu-left-divider{z-index: 9999;}.tatsu-gI7Mip4YEw > .tatsu-column-inner > .tatsu-right-divider{z-index: 9999;}@media only screen and (max-width:1377px) {.tatsu-row > .tatsu-gI7Mip4YEw.tatsu-column{width: 25%;}}@media only screen and (min-width:768px) and (max-width: 1024px) {.tatsu-row > .tatsu-gI7Mip4YEw.tatsu-column{width: 25%;}.tatsu-gI7Mip4YEw.tatsu-column{margin: 0px 0px 0px 0px !important;}}@media only screen and (max-width: 767px) {.tatsu-row > .tatsu-gI7Mip4YEw.tatsu-column{width: 100%;}.tatsu-gI7Mip4YEw.tatsu-column{margin: 0px 0px 0px 0px !important;}}</style></div>

                    </div>

                </div>
            </div>
        </div>


        <footer>
            <div class="container">
                <div class="section-footer">
                    <div class="wrap-left">
                        <h2 class="text-uppercase">arbit</h2>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipisicing
                            elit. Aliquid consequuntur cupiditate dolores iure
                            possimus quod velit. Debitis, dolore ducimus esse
                            expedita labore, laborum maxime minus neque officia
                            provident ullam voluptatum.
                        </p>
                        <hr>
                        <div class="link">
                            <ul>
                                <li><a href="#"><?= Az::l('Yсловия')?></a></li>
                                <li><a href="#"><?= Az::l('Конфиденциальность')?></a></li>
                                <li><a href="#"><?= Az::l('Политика использования файлов cookie')?></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="wrap-right">
                        <h3><?= Az::l('Связаться с нами')?></h3>
                        <ul>
                            <li>
                                <i class="far fa-check-square"></i>
                                <?= Az::l('Поддержка и база знаний')?>
                            </li>
                            <li>
                                <i class="far fa-check-square"></i>
                                <?= Az::l('По общим вопросам:')?> support@arbit.pro
                            </li>
                            <li>
                                <p>
                                    <i class="far fa-check-square"></i>

                                    <?= Az::l('По вопросам продаж:')?>
                                    <br>
                                    support@arbit.pro
                                </p>
                            </li>
                            <li>
                                <i class="far fa-check-square"></i>
                                +35725281664
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </footer>
        <button id="arrowUp" onclick="slowScroll('#page')" class="fixed-btn-up">
            <i class="fas fa-arrow-up"></i>
        </button>

    </div>

    <!--SIPML5 begin-->


</div>


<script>
    function slowScroll(id) {
        $('html, body').animate({
            scrollTop: $(id).offset().top
        }, 500)
    }

</script>


<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>
