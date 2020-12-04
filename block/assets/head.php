
<?php


use yii\web\View;
use zetsoft\service\utility\Views;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\animo\ZSimpleLoaderWidget;
use zetsoft\widgets\themes\ZFontYandexWidget;


?>

<?php
/** @var ZView $this */


/**
 *
 * Font Awesome
 */
$this->headerImg('/favicon.ico');
$this->headerFont('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/webfonts/fa-regular-400.woff2');
$this->headerFont('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/webfonts/fa-solid-900.woff2');
$this->headerFont('/render/theme/ZFontYandexWidget/assets/fonts/sibirix/FuturaPT-Medium.woff');

$this->headerImg('/render/menus/ZMMmenuWidget/img/logo.svg', false);
$this->headerImg('/render/former/ZDynaWidget/assets/img/edit.svg', false);

$this->linkAll();
?>






