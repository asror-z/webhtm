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
use zetsoft\models\user\User;
use zetsoft\models\App\eyuf\EyufCompatriot;
use zetsoft\models\App\eyuf\Program;
use zetsoft\models\App\eyuf\EyufScholar;
use zetsoft\system\assets\ZColor;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\former\ZDynaArrayGridWidget;
use zetsoft\widgets\former\ZFormBuildWidget;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\themes\ZAdminCardWidget;
use zetsoft\widgets\themes\ZCardWidget;
use zetsoft\dbitem\core\WebItem;

/** @var ZView $this */


$action = new WebItem();

$action->title = Azl . 'Адрес';
$action->icon = 'fal fa-print';


$action->layout = true; $action->debug = false;


$this->paramSet(paramAction, $action);

$this->title();
$this->toolbar();?>

<div class="container-fluid">

    <div class="mb-5">

        <div class="text-center text-white mb-3 rounded p-2" style="height: 50px; width: 100%; background: #125188;">
            <p class="font-weight-bold mt-1">Наш адресс</p>
        </div>

        <div id="map-container-google-2" class="z-depth-1-half map-container" style="height: 700px">
            <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d1498.5417364020373!2d69.2771437835653!3d41.307047675056296!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x38ae8b2a49ff1f07%3A0x2e152bdd835063a3!2sEl-Yurt%20Umidi%20Foundation!5e0!3m2!1sru!2s!4v1581677707352!5m2!1sru!2s" width="100%" height="100%" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
        </div>

    </div>

    <div class="px-5 card">


        <div class="contact-info py-4">
            <h2 class="font-weight-bold card-title">ФОНД «ЭЛ-ЮРТ УМИДИ»</h2>
            <p>В целях налаживания тесного взаимодействия с соотечественниками, в особенности имеющими большой научный потенциал учеными, специалистами и талантливой молодежью, проживающими и ведущими свою профессиональную деятельность за рубежом, а также обеспечения высококвалифицированными и конкурентоспособными на мировом рынке труда специалистами, необходимыми для всестороннего и ускоренного развития Узбекистана.</p>
            <ul class="list-group">
                <li class="list-group-item border-0"><i class="fas fa-map-marker-alt"></i> 13, Ул. Амира темура, Ташкент, Узбекистан</li>
                <li class="list-group-item border-0"><i class="fas fa-mobile-alt"></i> (0 371) 203 14 41, (0 371) 232 34 74</li>
                <li class="list-group-item border-0"><i class="fas fa-envelope"></i> info@eyuf.uz</li>
            </ul>
        </div>



    </div>
</div>
