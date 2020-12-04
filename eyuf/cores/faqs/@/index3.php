<center>
    <h2><b>Часто задаваемые вопросы</b></h2>
</center>
<?php


use rmrevin\yii\fontawesome\FA;
use zetsoft\models\Faqs;
use zetsoft\models\FaqsType;
use zetsoft\models\App\eyuf\Program;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\former\ZAccardionWidget;
use zetsoft\widgets\former\ZDynaWidget;
use kartik\dynagrid\DynaGrid;
use kartik\grid\EditableColumn;
use yii\data\ActiveDataProvider;
use zetsoft\widgets\navigat\ZAccLayWidgetOLD;
use zetsoft\widgets\navigat\ZAccordionPlusWidget;
use zetsoft\widgets\navigat\ZAccordionWidget;
use zetsoft\widgets\navigat\ZAccWidget;
use zetsoft\widgets\navigat\ZBadgerAccordionWidget;
use zetsoft\widgets\navigat\ZCollapseAccordionWidget;



$action->title = Azl . 'ЧАВО';


$program_ids = FaqsType::find()->all();
$faqs = Faqs::find()->all();
$check = 0;

/** @var ZView $this */
$role = $this->userRole();
?>
<div class="container">

<?
foreach ($program_ids as $program_id) {
    foreach ($faqs as $faq) {
        if ($faq->core_faq_type_id == $program_id->id) {
            if ($check != $faq->core_faq_type_id) {
                print_r('<h5 class="mt-5 pl-3 text-center " style="font-family:Verdana;">' . $program_id->name . '</h5>');
                $check = $faq->core_faq_type_id;
            }
            echo ZAccLayWidgetOLD::widget([
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
?>
</div>










