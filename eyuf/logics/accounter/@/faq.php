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

use rmrevin\yii\fontawesome\FA;
use yii\bootstrap\Modal;
use zetsoft\models\ALL\CoreCompany;
use zetsoft\models\ALL\CoreCountry;
use zetsoft\models\Faqs;
use zetsoft\models\FaqsType;
use zetsoft\models\ALL\CoreRole;
use zetsoft\models\user\User;
use zetsoft\models\App\eyuf\EyufCompatriot;
use zetsoft\models\App\eyuf\Program;
use zetsoft\models\App\eyuf\EyufScholar;
use zetsoft\system\assets\ZColor;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\former\ZDynaArrayGridWidget;
use zetsoft\widgets\former\ZFormBuildWidget;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\navigat\ZAccWidget;
use zetsoft\widgets\themes\ZAdminCardWidget;
use zetsoft\dbitem\core\WebItem;

/** @var ZView $this */

$action = new WebItem();

$action->title = Azl . 'Часто задаваемые вопросы';
$action->icon = 'fal fa-print';


$action->layout = true; $action->debug = false;


$this->paramSet(paramAction, $action);

$this->title();
$this->toolbar();$program_ids = FaqsType::find()->all();
$faqs = Faqs::find()->all();
$check = 0;


foreach ($program_ids as $program_id) {
    foreach ($faqs as $faq) {
        if ($faq->core_faq_type_id == $program_id->id) {
            if ($check != $faq->core_faq_type_id) {
                print_r('<h5 class="mt-5 pl-3 text-center " style="font-family:Verdana;">' . $program_id->name . '</h5>');
                $check = $faq->core_faq_type_id;
            }
            echo ZAccWidget::widget([
                'data' => [
                    '2' => [
                        'name' => "" . $faq['question'] . "",
                        'text' => "" . $faq['answer'] . "",
                        'icon' => "fa fa-" . FA::_ALIGN_LEFT,
                    ],
                ]

            ]);
        }
    }
}
