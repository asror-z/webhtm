<?php

use kartik\builder\Form;
use rmrevin\yii\fontawesome\FA;
use zetsoft\models\ALL\CoreCountry;
use zetsoft\models\App\eyuf\EyufDocument;
use zetsoft\models\App\eyuf\EyufReport;
use zetsoft\models\App\eyuf\EyufScholar;
use zetsoft\system\assets\ZColor;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\former\ZFormWidget;
use zetsoft\widgets\former\ZViewWidget;
use zetsoft\widgets\inputes\ZFileInputWidget;
use zetsoft\widgets\navigat\ZButtonWidget;
use zetsoft\widgets\notifier\ZKAlertBlockWidget;
use zetsoft\widgets\notifier\ZModalNewWidget;
use zetsoft\widgets\themes\ZCardWidget;


$model = $this->userIdentity();

if ($this->userIsGuest())
    return Az::l('You have login to page');

$scholar = EyufScholar::findOne([
    'user_id' => $model->id
]);

ZModalNewWidget::begin([
    'id' => 'profPic'
]);
$active = new Active();
$active->type = Active::type['horizontal'];
$form = $this->activeBegin($active);

$model->configs->nameOn = [
    'photo'
];

$model->configs->rulesAll = [
    [
        validatorSafe
    ]
];
$this->modelSave($model);

echo ZFormWidget::widget([
    'model' => $model,
    'form' => $form,
]);

$this->activeEnd();


ZModalNewWidget::end();

$imageUrl = $this->userPhoto();

$list = Az::$app->App->eyuf->getDocs()->getDocListHTM();
if (!($list === null)) {
    echo ZKAlertBlockWidget::widget([
        'config' => [
            'isUseSessionFlash' => false,
            'delay' => 2000,
            'body' => $list,
            'title' => 'asdasd',
            'alert' => 'asdsadas',
            'titleOptions' => [
                'tag' => 'span',
                'class' => 'kv-alert-title'
            ],
        ],
    ]);
}

?>

<div class="row">
    <div class="col-md-4">
        <?php
        $country = CoreCountry::find()->where(['id' => $scholar['core_country_id']])->one();

        $ProfileRightButton = ZButtonWidget::widget([
            'config' => [
                'icon' => 'fas fa-' . FA::_EDIT,
                'type' => ZButtonWidget::btnType['button'],
                'btnStyle' => ZButtonWidget::btnStyle['btn-transparent'],
                'class' => 'text-white',
                'btnFloating' => false,
                'btn' => false,
                'hasIcon' => true,
                'iconColor' => '#ffffff',

            ],
            'event' => [
                'click' => ' $(profPic).modal(\'show\') '
            ]

        ]);


        ZCardWidget::begin([
            'config' => [
                'type' => ZCardWidget::type['profileCard'],
                'imageUrl' => $imageUrl,
                'color' => ZColor::color['primary-color'],
                'title' => $model->title,
                'ProfileRightButton' => $ProfileRightButton,
            ]
        ]);

        ?>

        <?php ZCardWidget::end();

        $Sch = EyufScholar::findOne(['user_id' => $model->id]);

        echo ZViewWidget::widget([
            'model' => $Sch,
        ]);
        ?>
    </div>
    <div class="col-md-8">
        <?php

        $action->title = Azl . 'Профиль';
        $action->icon = '';

        $docs = new EyufDocument();
        $docs->configs->query = EyufDocument::find()
            ->where([
                'eyuf_scholar_id' => $Sch->id
            ]);

        $docs->configs->edit = true;
        if ($this->userRole() === 'scholar') {
            $docs->configs->nameOff = [
                'correct'
            ];
            $docs->configs->editsEx = [
                'status',
                'correct'
            ];
        }

        /** @var ZView $this */
        echo ZDynaWidget::widget([
            'model' => $docs,
            'config' => [
                'title' => Az::l('Мои документы'),
                'titleCreate' => Az::l('Добавить документ'),
                'actionClone' => false,
                'createUrl' => '/logics/scholar/doc-add.aspx',
                'viewUrl' => '/logics/scholar/doc-show',
                'updateUrl' => '/logics/scholar/doc-update',
                'btnEdit' => function ($url, $model) {
                    if ($model->status !== true)
                        return ZButtonWidget::widget([
                            'config' => [

                                'title' => Az::l('Изменить'),
                                'url' => '/eyuf/logics/scholar/doc-update?id=' . $model->id,
                                'hasIcon' => true,
                                'btnRounded' => false,
                                'btn' => false,
                                'icon' => 'fa fa-' . FA::_EDIT,
                                'confirm' => 'Are you sure you want DELETE columns?'
                            ]
                        ]);
                }
            ],

        ]);


        $report = new EyufReport();
        $report->configs->query = EyufReport::find()
            ->where([
                'eyuf_scholar_id' => $Sch->id
            ]);



        $report->configs->edit = true;
        $report->configs->nameOff = [
            'correct'
        ];

        /** @var ZView $this */
        echo ZDynaWidget::widget([
            'model' => $report,
            'config' => [
                'title' => Az::l('Мои отчеты'),
                'edit' => false,
                'columnCheckbox' => false,
                'search' => false,
                'topCreate' => true,
                'topUpdate' => true,
                'actionDelete' => false,
                'actionClone' => false,
                'topFilter' => false,
                'topSort' => false,
                'topSetting' => true,
                'topExport' => true,
                'titleCreate' => Az::l('Добавить отчет'),
                'createUrl' => '/logics/scholar/add-report.aspx'
            ]
        ]);

        ?>
    </div>
</div>
