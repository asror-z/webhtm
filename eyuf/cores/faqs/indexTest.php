<?php
/** @var ZView $this */

use rmrevin\yii\fontawesome\FA;
use yii\helpers\ArrayHelper;
use zetsoft\models\Faqs;
use zetsoft\models\FaqsType;
use zetsoft\models\App\eyuf\Program;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\former\ZDynaWidget;
use kartik\dynagrid\DynaGrid;
use kartik\grid\EditableColumn;
use yii\data\ActiveDataProvider;
use zetsoft\widgets\navigat\ZAccLayNewWidget;
use zetsoft\widgets\navigat\ZAccLayNewWidget2;
use zetsoft\widgets\navigat\ZAccLayWidget;
use zetsoft\widgets\navigat\ZAccLayWidget2ChisiYopilmidi;
use zetsoft\widgets\navigat\ZAccLayWidget2;
use zetsoft\widgets\navigat\ZAccLayWidgetOld;
use zetsoft\widgets\navigat\ZAccLayWidgetTest;
use zetsoft\widgets\themes\ZCardWidget;


$action->title = Azl . 'ЧАВО';

$role = $this->userRole();
$program_ids = FaqsType::find()->all();
$faqs = Faqs::find()->all();
$check = 0;

ZCardWidget::begin([
    'config' => [
        'title' => Az::l('Часто задаваемые вопросы'),
        'type' => ZCardWidget::type['dynCard'],
    ]
]);

foreach ($program_ids as $program_id) {
    foreach ($faqs as $faq) {
        if ($faq->core_faq_type_id == $program_id->id) {

            if (ArrayHelper::isIn($role, $faq->role)) {
                if ($check != $faq->core_faq_type_id) {
                    echo '<h5 class="text-center" style="font-family: Verdana;">' . $program_id->name . '</h5>';
                    $check = $faq->core_faq_type_id;
                }  
                echo ZAccLayWidgetOld::widget([
                    'config' => [
                        'name' => "" . Az::l($faq['name']) . "",
                        'text' => "" . Az::l($faq['title']) . "",
                        'icon' => "fa fa-" . FA::_ALIGN_LEFT,
                    ],
                ]);
            } else continue;
        }
    }
}

ZCardWidget::end();











