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
use zetsoft\models\ALL\CoreFaq;
use zetsoft\models\ALL\CoreFaqType;
use zetsoft\models\ALL\CoreRole;
use zetsoft\models\ALL\CoreUser;
use zetsoft\models\eyuf\Compatriot;
use zetsoft\models\eyuf\Program;
use zetsoft\models\eyuf\Scholar;
use zetsoft\system\assets\ZColor;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\former\ZDynaArrayGridWidget;
use zetsoft\widgets\former\ZFormBuilderWidget;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\navigat\ZAccWidget;
use zetsoft\widgets\themes\ZAdminCardWidget;

/** @var ZView $this */
$this->init();

$this->title('Часто задаваемые вопросы');



$program_ids = CoreFaqType::find()->all();
$faqs = CoreFaq::find()->all();
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
