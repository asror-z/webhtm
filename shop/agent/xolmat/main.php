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


use Google\Cloud\Talent\V4beta1\Phone;
use kartik\slider\Slider;
/*use zetsoft\former\ALL\AzimForm;
use zetsoft\former\ALL\AzimForm2;
use zetsoft\former\ALL\AzimForm3;*/
use zetsoft\former\auth\AuthPhoneForm;
use zetsoft\former\eyuf\EyufExperienceForm;
use zetsoft\former\eyuf\EyufHigherEducationForm;
use zetsoft\former\eyuf\EyufHigherPublicationForm;
use zetsoft\models\place\PlaceCountry;
use zetsoft\models\App\eyuf\Card;
use zetsoft\system\actives\ZAjaxForm;
use zetsoft\system\Az;
use zetsoft\dbitem\data\Config;
use zetsoft\dbitem\data\Form;

use zetsoft\system\kernels\ZView;
use zetsoft\widgets\former\ZFormWidget;
use zetsoft\widgets\former\ZFormWidgetzim;
use zetsoft\widgets\incores\ZGrapesCheckboxWidget;
use zetsoft\widgets\incores\ZkFirstWidget;
use zetsoft\widgets\inputes\ZCKEditorWidget;
use zetsoft\widgets\inputes\ZInputWidget;
use zetsoft\widgets\inptest\ZKSliderWidget;
use zetsoft\widgets\inputes\ZKDateTimePickerWidget;
use zetsoft\widgets\inputes\ZKStarRatingWidget;
use zetsoft\widgets\inputes\ZKSelect2Widget;
use zetsoft\system\actives\ZModel;
use zetsoft\widgets\market2\ZCarouselWidget;
use zetsoft\widgets\market2\ZOrderSummaryWidget;
use zetsoft\widgets\market2\ZSingleProductWidget;
use zetsoft\widgets\navigat\ZButtonWidget;
use zetsoft\widgets\themes\ZCardWidget;


$action->title = Azl . 'main';
$action->icon = 'fa fa-rocket rss';
$model = new Card();
$attribute = 'name';


Az::$app->controller->layout = 'bozorMain';



echo ZSingleProductWidget::widget([
    'config' => [
        'star' => ZKStarRatingWidget::widget([
            'model' => $model,
            'attribute' => $attribute,
            'config' => [
                'hasIcon' => true
            ]
        ]),
    ]
]);



