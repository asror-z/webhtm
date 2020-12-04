<?php


use zetsoft\service\utility\Views;
use zetsoft\widgets\themes\ZFontYandexWidget;


use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\kernels\ZView;

/** @var ZView $this */


$this->fileCss('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/all.min.css');
$this->fileCss('https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css');
$this->fileCss('/render/asrorz/mdb/css/mdb.min.css');
$this->fileCss('https://cdn.jsdelivr.net/npm/hint.css@2.6.0/hint.css');
$this->fileCss('https://cdn.jsdelivr.net/npm/file-icon-vectors@1.0.0/dist/file-icon-classic.min.css');
$this->fileCss('https://cdn.jsdelivr.net/npm/file-icon-vectors@1.0.0/dist/file-icon-square-o.min.css');
$this->fileCss('https://cdn.jsdelivr.net/npm/file-icon-vectors@1.0.0/dist/file-icon-vivid.min.css');
$this->fileCss('https://cdn.jsdelivr.net/npm/file-icon-vectors@1.0.0/dist/file-icon-vectors.min.css');
$this->fileCss('/render/asrorz/css/ALL.css');
$this->fileCss('/render/asrorz/css/font.css');
$this->fileCss('/render/asrorz/css/media.css');
$this->fileCss('/render/ALL/jquery.loader.js-master/jquery.loader.min.css');

$this->fileCss('/render/asrorz/css-app/' . App . '.css');


Az::$app->params['position'] = Views::position['head'];

$this->fileJs('/render/ALL/jquery.loader.js-master/jquery.loader.min.js');

$this->fileJs('https://code.jquery.com/jquery-3.5.1.min.js');
$this->fileJs('https://cdn.jsdelivr.net/npm/jquery-slimscroll@1.3.8/jquery.slimscroll.min.js');
$this->fileJs('https://cdn.jsdelivr.net/npm/js-cookie@beta/dist/js.cookie.min.js');
$this->fileJs('https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.bundle.js');
$this->fileJs('https://cdn.jsdelivr.net/npm/mobile-detect@1.4.4/mobile-detect.min.js');
$this->fileJs('https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.2/jquery.form.min.js');
$this->fileJs('https://cdn.jsdelivr.net/npm/bootstrap-popover-x@1.4.7/js/bootstrap-popover-x.js');
$this->fileJs('/render/asrorz/js/ALL.js');
$this->fileJs('https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.4.0/bootbox.min.js');

$this->linkAll();

$this->registerLinkTag([
    'rel' => 'icon',
    'type' => 'image/x-icon',
    'href' => Az::getAlias('@web/favicon.ico')
]);


echo ZFontYandexWidget::widget([
    'config' => [
        'fonts' => ZFontYandexWidget::fonts['sibirix'], //yandex,  sibirix
    ],

]);
?>
<style>
    body {
        overflow-x: hidden;
    }

    .classic-tabs .nav {
        border-radius: 0;
        border-bottom: 1px solid #000;
        display: flex;
        justify-content: space-around;
        z-index: 999;
        /*position: fixed;*/
        width: 100%;
    }

    .md-form {
        margin: 0 0 20px;
        padding: 0;
    }

    .bottomBtn {
        height: 0;
    }

    .columns-row {
        display: flex;
        justify-content: space-between;
    }

    .columns-model {
        width: 29%;
    }

    .columns-row .card {
        width: 69%;
        margin-bottom: 0 !important;
    }

    .disabled-tab {
        pointer-events: none;
    }

    .nav-item {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        width: 33%;
    }

    .tab-content {
        padding: 10px;
    }

    #content-options {
        padding-top: 30px;
    }

    #VisualDyna, #DynaForm {
        visibility: hidden;
    }

    .classic-tabs .nav li a.active {
        text-align: center;
        border-bottom: 3px solid #fff;
        width: 70%;
    }

    .classic-tabs .nav li a {
        display: block;
        padding: 10px;
        font-size: 16px;
        font-weight: bold;
        text-transform: uppercase;
        color: rgba(255,255,255,.7);
        text-align: center;
        border-radius: 0;
    }
</style>



                                                                                                                
