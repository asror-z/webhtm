<?php


use yii\web\JqueryAsset;
use zetsoft\dbitem\core\WebItem;
use zetsoft\service\utility\Views;
use zetsoft\widgets\animo\ZFakeLoaderWidget;
use zetsoft\widgets\animo\ZSimpleLoaderWidget;
use zetsoft\widgets\themes\ZFontYandexWidget;


use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\kernels\ZView;

/** @var ZView $this */

$this->fileCss('/render/asrorz/fontawesome-pro-5.12.0-web/css/all.css');
$this->fileCss('https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.8.2/css/all.min.css');
$this->fileCss('https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css');
$this->fileCss('https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.css');
$this->fileCss('https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css');
$this->fileCss('/render/asrorz/mdb/css/mdb.min.css');
$this->fileCss('https://cdn.jsdelivr.net/npm/hint.css@2.6.0/hint.css');
//$this->fileCss('https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css');
$this->fileCss('https://cdn.jsdelivr.net/npm/file-icon-vectors@1.0.0/dist/file-icon-classic.min.css');
$this->fileCss('https://cdn.jsdelivr.net/npm/file-icon-vectors@1.0.0/dist/file-icon-square-o.min.css');
$this->fileCss('https://cdn.jsdelivr.net/npm/file-icon-vectors@1.0.0/dist/file-icon-vivid.min.css');
$this->fileCss('https://cdn.jsdelivr.net/npm/file-icon-vectors@1.0.0/dist/file-icon-vectors.min.css');
$this->fileCss('https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700');
$this->fileCss('https://cdn.jsdelivr.net/npm/metismenu@3.0.6/dist/metisMenu.css');




//$this->fileCss('/render/asrorz/css/ALL.css');
//$this->fileCss('/render/asrorz/css/doft.css'
//);
$this->fileCss('/render/asrorz/css/font.css');
$this->fileCss('/render/asrorz/css/media.css');
//$this->fileCss('/render/asrorz/css-app/market.css');
$this->fileCss('/render/asrorz/css/AdminLoader.css');
$this->fileCss('https://rawcdn.githack.com/IanLunn/Hover/5c9f92d2bcd6414f54b4f926fd4bb231e4ce9fd5/css/hover-min.css');

$this->fileCss('https://cdn.jsdelivr.net/npm/sweetalert2@9.8.2/dist/sweetalert2.min.css');
$this->fileCss('/render/ALL/jquery.loader.js-master/jquery.loader.min.css');
$this->fileCss('/render/asrorz/css-app/' . App . '.css');
$this->fileCss('/render/asrorz/css-app/arbitTemplate/adminlte.min.css');

$this->fileJs('https://cdn.jsdelivr.net/npm/jquery@3.4.1/dist/jquery.min.js');
$this->fileJs('https://unpkg.com/@popperjs/core@2/dist/umd/popper.js');
$this->fileJs('https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.bundle.js');
$this->fileJs('https://cdn.jsdelivr.net/npm/bootstrap-popover-x@1.4.7/js/bootstrap-popover-x.js');
$this->fileJs('https://cdn.jsdelivr.net/npm/jquery-slimscroll@1.3.8/jquery.slimscroll.min.js');
$this->fileJs('https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.2/jquery.form.min.js');




$this->fileJs('https://cdn.jsdelivr.net/npm/sweetalert2@9.10.2/dist/sweetalert2.js');
$this->fileJs('https://cdn.jsdelivr.net/npm/sweetalert2@9.10.2/dist/sweetalert2.all.min.js');

//$this->fileJs('/render/asrorz/fontawesome-pro-5.12.0-web/js/ALL.js');
$this->fileJs('https://cdn.jsdelivr.net/npm/js-cookie@beta/dist/js.cookie.min.js');

$this->fileJs('https://cdn.jsdelivr.net/npm/mobile-detect@1.4.4/mobile-detect.min.js');


$this->fileJs('/render/asrorz/market/js/loadData.js');
/*$this->fileJs('/render/cards/ZVMarketWidget/asset/main2.js');*/
$this->fileJs('https://cdn.jsdelivr.net/npm/bootbox@5.4.0/dist/bootbox.all.min.js');


$this->fileJs('/render/ALL/jquery.loader.js-master/jquery.loader.min.js');
/*$this->fileJs('/webhtm/core/menu/assets/jQuery-Menu-Editor-master/bootstrap-iconpicker/js/bootstrap-iconpicker.min.js');*/
$this->fileJs('/render/asrorz/js/bootstrap-iconpicker.min.js');


$this->headerFont('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/webfonts/fa-regular-400.woff2');
$this->headerFont('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/webfonts/fa-solid-900.woff2');


/**
 *
 * Loaders
 *
 */

/*$this->fileJs('/render/animo/All/assets/loaders/CSS JS/SimpleLoader/loader/js/loading.js');

$this->fileCss('/render/animo/All/assets/loaders/CSS JS/SimpleLoader/loader/css/loading.css');*/


$this->fileJs('/render/asrorz/js/ALL.js');

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

if ($this->paramGet(paramAction)->loader)
    echo ZSimpleLoaderWidget::widget();
?>






