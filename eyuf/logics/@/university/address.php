<?php

/**
 *
 *
 * Author:  Asror Zakirov
 * https://www.linkedin.com/in/asror-zakirov
 * https://www.facebook.com/asror.zakirov
 * https://github.com/asror-z
 *
 */
use yii\bootstrap\Modal;
use zetsoft\models\ALL\CoreCompany;
use zetsoft\models\ALL\CoreCountry;
use zetsoft\models\ALL\CoreRole;
use zetsoft\models\ALL\CoreUser;
use zetsoft\models\eyuf\Compatriot;
use zetsoft\models\eyuf\Program;
use zetsoft\models\eyuf\Scholar;
use zetsoft\system\assets\ZColor;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\former\ZDynaArrayGridWidget;
use zetsoft\widgets\former\ZFormBuilderWidget;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\themes\ZAdminCardWidget;

/** @var ZView $this */
$this->init();

$this->title('Адрес') ;

?>


<div class="text-center text-white mb-3 rounded p-2" style="height: 50px; width: 100%; background: #125188;">
    <p class="font-weight-bold mt-1">Наш адресс</p>
</div>

<div id="map-container-google-2" class="z-depth-1-half map-container" style="height: 700px">
    <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d1498.5417364020373!2d69.2771437835653!3d41.307047675056296!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x38ae8b2a49ff1f07%3A0x2e152bdd835063a3!2sEl-Yurt%20Umidi%20Foundation!5e0!3m2!1sru!2s!4v1581677707352!5m2!1sru!2s" width="100%" height="100%" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
</div>
