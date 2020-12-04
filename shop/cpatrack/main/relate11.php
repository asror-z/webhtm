<?php


?>



<?php


use zetsoft\dbitem\core\WebItem;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZDynaRelationWidget;
use zetsoft\widgets\former\ZViewWidget;

use zetsoft\models\track\CpasTeaser;


/**
 *
 * Action Params
 */

$action = new WebItem();

$action->type = WebItem::type['ajax'];
$action->csrf = true;
$action->debug = false;



$this->paramSet(paramAction, $action);


?>
<div class="row">
    <div class="col-md-12">

        <?

        $id = $this->httpPost('expandRowKey');
        $model = CpasTracker::findOne($id);

        if (!empty($this->model->configs->hasMany)) {
            $hasMany = $this->model->configs->hasMany;
            $isBtn = $this->model->configs->relationBtn;
            $width = $this->model->configs->relationWidth;

            return [
                'class' => ActionColumn::class,
                'template' => '{clone}',
                'headerOptions' => [
                    'class' => 'numeratsiya'
                ],
                'dropdown' => false,
                'header' => Az::l('Связи'),
                'width' => '2%',
                'buttons' => [
                    'clone' =>
                        function ($url, $model) use ($hasMany, $isBtn) {

                            /* @var Models  $model */

                            return ZDynaRelationWidget::widget([
                                
                                'id' => 'relation-' . $model->id,
                                'model' => $model,
                                'config' => [
                                    'hasIcon' => true,
                                    'icon' => 'fal text-muted fa-lg fa-link',
                                    'grapes' => false,
                                    'isBtn' => $isBtn,
                                    'width' => '700px',
                                    'height' => '800px',
                                    'hasMany' => $hasMany,
                                ]
                            ]);

                        },
                ],
            ];

        }

        return [];
/*

        echo ZViewWidget::widget([
            'model' => $model,
        ]);
        */?>

    </div>
</div>



