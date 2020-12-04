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

use zetsoft\dbitem\data\ZForm;
use zetsoft\models\App\eyuf\EyufScholar;
use zetsoft\system\Az;
use zetsoft\system\column\ZKDataColumn;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\helpers\ZUrl;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\navigat\ZButtonWidget;
use zetsoft\dbitem\core\WebItem;

/** @var ZView $this */

$action = new WebItem();
$action->title = Azl . 'Стипендианты';
$action->icon = 'fal fa-print';
$action->type = WebItem::type['html'];
$action->layout = true;
$action->debug = false;
$this->paramSet(paramAction, $action);
$this->title();
$this->toolbar();


$model = new EyufScholar();

$where[] = EyufScholar::status['stipend'];
$where[] = EyufScholar::status['accounter'];

$model->configs->query = EyufScholar::find()
    ->where([
        'status' => ['stipend', 'accounter'],
    ]);
    
$model->configs->edit = false;
$model->configs->after = [
    'title' => [
        [
            'class' => ZKDataColumn::class,
            'label' => Az::l('Расходы'),
            'width' => '100px',
            'value' => function ($model, $key, $index, ZKDataColumn $dataColumn) {
                $modelId = ZArrayHelper::getValue($model, 'id');
                return ZButtonWidget::widget([
                        'config' => [
                            'text' => Az::l('Расходы'),
                            'btnStyle' => ZButtonWidget::btnStyle['btn-outline-primary'],

                            'url' => ZUrl::to('/eyuf/logics/accounter/invoice-index.aspx?scholarId=' . $modelId)
                        ],
                        'event' => [
                            'click' => <<<JS
                                function (event) {
                                    event.preventDefault();
                                    window.open('/eyuf/logics/accounter/invoice-index.aspx?scholarId={$modelId}', '_blank');
                                }
JS,
                        ]
                    ]
                );
            }
        ],
        [
            'class' => ZKDataColumn::class,
            'label' => Az::l('Авиабилети'),
            'width' => '100px',
            'value' => function ($model, $key, $index, ZKDataColumn $dataColumn) {
                $modelId = ZArrayHelper::getValue($model, 'id');
                return ZButtonWidget::widget([
                        'config' => [
                            'text' => Az::l('Авиабилети'),
                            'btnStyle' => ZButtonWidget::btnStyle['btn-outline-primary'],

                            'url' => ZUrl::to('/eyuf/logics/accounter/ticket-index.aspx?scholarId=' . $modelId)
                        ],
                        'event' => [
                            'click' => <<<JS
                                function (event) {
                                    event.preventDefault();
                                    window.open('/eyuf/logics/accounter/ticket-index.aspx?scholarId={$modelId}', '_blank');
                                }
JS,
                        ]
                    ]
                );
            }
        ],
    ]
];

$model->configs->readonly = [
    'id',
    'name',
    'program',
    'passport',
    'passport_give',
    'birthdate',
    'user_id',
    'place_country_id',
    'status',
    'edu_start',
    'age',
    'user_company_id',
    'company_type',
    'edu_area',
    'edu_sector',
    'edu_type',
    'speciality',
    'edu_place',
    'finance',
    'address',
    'phone',
    'home_phone',
    'email',
    'position',
    'experience',
];
$model->columns();
?>

<div class="row">
    <div class="col-12">
        <?

        $this->pjaxBegin();
        
        echo ZDynaWidget::widget([
            'model' => $model,
            'rightBtn' => [
                'update' => [
                    'content' => '',
                    'options' => ['class' => 'btn-group p-1 mr-0 {btnSize} {iconSize}']
                ],
                'clear_update' => [
                    'content' => '{clear_update}',
                    'options' => ['class' => 'btn-group p-1 mr-0 {btnSize} {iconSize}']
                ],
                'system' => [
                    'content' => '',
                    'options' => ['class' => 'btn-group p-1 mr-0 {btnSize} {iconSize}']
                ],
                'add-clone-delete' => [
                    'content' => '',
                    'options' => ['class' => 'btn-group p-1 mr-0 {btnSize} {iconSize}']
                ],
                'filter-sort-id' => [
                    'content' => '',
                    'options' => ['class' => 'btn-group p-1 mr-0 {btnSize} {iconSize}']
                ],
                'statistics' => [
                    'content' => '',
                    'options' => ['class' => 'btn-group p-1 mr-0 {btnSize} {iconSize}']
                ],
                'export' => [
                    'content' => '{jsonExcel}{export}',
                    'options' => ['class' => 'btn-group p-1 {btnSize} {iconSize}']
                ],
                'toggleData' => [
                    'content' => '{all}',
                    'options' => ['class' => 'btn-group p-1 {btnSize} {iconSize}']
                ],
                'filterPjax' => [
                    'content' => '',
                    'options' => ['class' => 'btn-group p-1 {btnSize} {iconSize}']
                ],
            ],
            'config' => [
                'title' => Az::l('Cтипендианты'),
                'topCreate' => false,
                'actionDelete' => false,
                'actionClone' => false,
                'edit' => false,
                'columnAction' => false,
                'search' => false,
                'perfectScrollbar' => true,
                'columnAfter' => false,
                'columnBefore' => [
                    'false'
                ]
            ],
        ]);

        $this->pjaxEnd();
        ?>
    </div>
</div>


