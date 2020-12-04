
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

$this->fileJs('https://cdn.jsdelivr.net/npm/jquery@3.4.1/dist/jquery.min.js', View::POS_HEAD);
$this->fileJs('/render/asrorz/js/ALL.js', Views::position['begin']);
$this->fileJs('https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.bundle.js');

$this->fileCss('/render/asrorz/fontawesome-pro-5.12.0-web/css/all.css');
$this->fileCss('https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.css');

$this->fileCss('https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css');
$this->fileCss('/render/asrorz/mdb/css/mdb.min.css');

$this->fileCss('/render/asrorz/css/ALL.css');
$this->fileCss('/render/asrorz/css/font.css');
$this->fileCss('/render/asrorz/css/media.css');


if ($this->paramGet(paramAction)->loader)
    echo ZSimpleLoaderWidget::widget();
?>






