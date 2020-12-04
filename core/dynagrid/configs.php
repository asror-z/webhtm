<?php


use zetsoft\dbitem\core\WebItem;
use zetsoft\dbitem\data\Form;
use zetsoft\former\dyna\DynaVisual;
use zetsoft\models\dyna\DynaConfig;
use zetsoft\service\forms\Active;
use zetsoft\service\forms\Ajaxer;
use zetsoft\system\actives\ZActiveRecord;
use zetsoft\system\assets\ZColor;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\helpers\ZInflector;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\former\ZFormBuildWidget;
use zetsoft\widgets\former\ZFormWidget;
use zetsoft\widgets\inputes\ZKSelect2Widget;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;
use zetsoft\widgets\themes\ZCardWidget;

/** @var ZView $this */
$action = new WebItem();

$action->type = WebItem::type['html'];
$action->debug = false;

$this->paramSet(paramAction, $action);

$modelName = $this->bootFull($this->httpGet('model'));

/** @var ZActiveRecord $model */
$model = new $modelName();
$model->kernel();
$columns = $model->columns;
$dynaId = $this->httpGet('dynaId');

$coreDyna = DynaConfig::findOne([
    'dynaId' => $dynaId,
    'active' => true
]);

$dynaForm = $this->httpPost('DynaVisual');
if ($dynaForm) {

    if ($coreDyna === null) {
        $coreDyna = new DynaConfig();
    }

    $coreDyna->dynaId = $dynaId;
    $coreDyna->config = $dynaForm;
    $coreDyna->active = true;

    $coreDyna->save();

}

?>

<div class="p-3">
    <?
    ZCardWidget::begin([
        'config' => [
            'hasIcon' => true,
            'icon' => 'fas fa-pen',
            'title' => Az::l('Визуальные настройки DynaGrid'),
            'padding' => '30px',
            'type' => ZCardWidget::type['dynCard'],
            'classHeadColor' => 'bg-transparent text-dark',
            'class' => 'p-3',
        ]
    ]);

    ?>

    <?php


    $active = new Active();
    $active->id = 'visualDyna';

    $form = $this->activeBegin($active);

    $modelClassName = $this->httpGet('model');
    $modelClass = $this->bootFull($modelClassName);
    $model = new $modelClass();

    $dynaForm = new DynaVisual();
    if (!empty($coreDyna->config)) {

        //start|MurodovMirbosit|02.11.2020
        $isCard = $dynaForm->isCard;

        $dynaForm->configs->options = [
            'title' => [
                'value' => $model->configs->title,
            ],
            'pageSize' => [
                'value' => $model->configs->pageSize,
            ],
            'isCard' => [
                'value' => $dynaForm->attributes['isCard'],
            ],
        ];
                           
        //end|MurodovMirbosit|02.11.2020
        //$dynaForm->attributes = $coreDyna->config;
    }

    $dynaForm->columns();

    echo ZFormBuildWidget::widget([
        'model' => $dynaForm,
        'form' => $form,
        'config' => [
            'topBtn' => false,
            'botBtn' => false,
        ],
    ]);

    $this->activeEnd();

    ZCardWidget::end();

    ?>
</div>
<script>
    $('#visualDyna').on('change', function () {

        $.ajax({
            method: 'POST',
            url: 'configs.aspx?model=<?=$this->httpGet('model')?>&dynaId=<?=$this->httpGet('dynaId')?>',
            data: $(this).serialize(),
        })

    })
</script>




