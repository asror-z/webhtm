<?php

use rmrevin\yii\fontawesome\FA;
use zetsoft\dbitem\core\WebItem;
use zetsoft\models\faqs\Faqs;
use zetsoft\models\faqs\FaqsType;
use zetsoft\models\App\eyuf\Program;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\navigat\ZAccLayWidget;
use zetsoft\widgets\navigat\ZOnlyForGrapes;
use zetsoft\widgets\themes\ZCardWidget;


/** @var ZView $this */

$action = new WebItem();
$action->title = Azl . 'ЧАВО';
$action->icon = 'fa fa-graduation-cap';
$action->layout = true;
$action->debug = false;

$this->paramSet(paramAction, $action);

$this->title();
$this->toolbar();

$role = $this->userRole();
$program_ids = FaqsType::find()->all();
$faqs = Faqs::find()->all();
$check = 0;

?>
    <div class="text-center text-white mb-3 rounded p-2" style="height: 50px; width: 100%; background: #125188;">
        <p class="font-weight-bold mt-1"><?=Az::l('Часто задаваемые вопросы')?></p>
    </div>

<?php

foreach ($program_ids as $program_id) {
    foreach ($faqs as $faq) {

        /** @var ZView $this */
        echo ZOnlyForGrapes::widget([
            'config' => [
                'title' => "" . Az::l($faq['name']) . "",
                'content' => "" . Az::l($faq['text']) . "",
                'icon' => "fa fa-" . FA::_ALIGN_LEFT,
            ],
        ]);


    }
}








