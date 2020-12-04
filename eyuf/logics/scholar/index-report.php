<?php

use kartik\popover\PopoverX;
use rmrevin\yii\fontawesome\FA;
use zetsoft\dbitem\core\WebItem;
use zetsoft\models\App\eyuf\CoreCountry;
use zetsoft\models\user\User;
use zetsoft\models\App\eyuf\EyufDocument;
use zetsoft\models\App\eyuf\EyufReport;
use zetsoft\models\App\eyuf\EyufScholar;
use zetsoft\service\forms\Active;
use zetsoft\system\assets\ZColor;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\former\aZGrapesJsWidget;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\former\ZFormBuildWidget;
use zetsoft\widgets\former\ZFormWidget;
use zetsoft\widgets\former\ZViewWidget;
use zetsoft\widgets\inputes\ZKSelect2Widget;
use zetsoft\widgets\navigat\ZButtonWidget;
use zetsoft\widgets\notifier\ZKAlertWidget;
use zetsoft\widgets\notifier\ZModalNewWidget;
use zetsoft\widgets\notifier\ZModalWidget;
use zetsoft\widgets\themes\ZCardProfileWidget;


/** @var ZView $this */
$action = new WebItem();

$action->title = Azl . 'Стипендианты';
$action->icon = 'fa fa-area-chart';
$action->type = WebItem::type['html'];
$action->layout = true;
$action->debug = false;

$this->paramSet(paramAction, $action);

$this->title();
$this->toolbar();


/** @var User $model */

$model = $this->userIdentity();

$id = $this->userIdentity()->id;

/** @var EyufScholar $scholar */
$scholar = EyufScholar::findOne(['user_id' => $id]);

if ($scholar === null)
    return $this->alertWarning($id, Az::l('Стипендиант не найден'));

require Root . '/webhtm/eyuf/logics/ALL/docListAlert.php';

?>

<div class="row">
    <div class="col-md-4">
        <?php

        $profileRightButton = ZButtonWidget::widget([
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
                /* start|AzimjonToirov|24-10-2020 */
                'click' => <<<JS
                    console.log('Modal opened !!!')
                    $('#profilePicture').modal('show')
JS,
                /* end|AzimjonToirov|24-10-2020 */
            ]
        ]);
        /* start|AzimjonToirov|24-10-2020 */
        ZModalNewWidget::begin([
            'id' => 'profilePicture',
        ]);

        $user = User::findOne($id);
        $user->configs->nameOn = [
            'photo'
        ];
        $user->columns();

        $active = new Active();
        $active->type = Active::type['horizontal'];

        $form = $this->activeBegin();
        echo ZFormBuildWidget::widget([
            'model' => $user,
            'form' => $form,
        ]);
        $this->activeEnd();

        ZModalNewWidget::end();
        /* end|AzimjonToirov|24-10-2020 */

        $photoUrl = 'uploaz/eyuf/photo/' . $id . '/' . $this->userPhoto();

        ZCardProfileWidget::begin([
            'config' => [
                'color' => ZColor::color['primary-color'],
                'title' => $model->name,
                'ProfileRightButton' => $profileRightButton,
                'url' => $photoUrl,
            ]
        ]);


        //$bdate = Az::$app->App->eyuf->userScholar->getAge($scholar->birthdate);

       /* if ($bdate !== null)
            echo 'Возраст: ' . $bdate . EOL;*/

        if (!empty($scholar->status))
            echo 'Статус: ' . (new EyufScholar())->_status[$scholar->status];

        ZCardProfileWidget::end();

        $scholar->configs->nameOff = [
            'created_at',
            'modified_at',
            'created_by',
            'modified_by',
        ];

        $scholar->columns();

        echo ZViewWidget::widget([
            'model' => $scholar,
        ]);


        ?>
    </div>
    <div class="col-md-8">
        <?php

        /**
         * Report section
         *
         */
        $report = new EyufReport();

        $report->configs->query = EyufReport::find()
            ->where([
                'eyuf_scholar_id' => $scholar->id
            ]);

        $report->configs->nameOff = [
            'correct',
            'eyuf_scholar_id',
        ];

        $report->configs->readonly = function ($model, $key, $index, $widget) {
            return $model->accept === true || ZArrayHelper::isIn($widget->attribute, [
                    'accept',
                    'correct',
                    'created_at',
                    'comment',
                    'verified',
                    'need_verify'
                ]);
        };


        $report->columns();

        /** @var ZView $this */
        echo ZDynaWidget::widget([
            'model' => $report,
            'rightBtn' => [
                'update' => [
                    'content' => '',
                    'options' => ['class' => 'btn-group p-1 mr-0 {btnSize} {iconSize}']
                ],


                'system' => [
                    'content' => '',
                    'options' => ['class' => 'btn-group p-1 mr-0 {btnSize} {iconSize}']
                ],

                'add-clone-delete' => [
                    'content' => '{add}',
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

                'toggleData' => [
                    'content' => '{all}',
                    'options' => ['class' => 'btn-group p-1 {btnSize} {iconSize}']
                ],
            ],

            'config' => [
                'title' => Az::l('Мои отчеты'),
                'edit' => false,
                'columnCheckbox' => false,
                'search' => false,
                'topCreate' => true,
                'perfectScrollbar' => true,
                'topUpdate' => true,
                'actionDelete' => false,
                'actionClone' => false,
                'topFilter' => false,
                'topSort' => false,
                'topSetting' => true,
                'topExport' => true,
                'filter' => false,
                'titleCreate' => Az::l('Добавить отчет'),
                'columnAfter' => false,

                'createUrl' => '/eyuf/logics/scholar/add-report.aspx?model={modelClassName}&identity=' . $id,

                'viewUrl' => '/eyuf/logics/scholar/view-report.aspx?id={id}&model={modelClassName}',
                'updateUrl' => '/eyuf/logics/scholar/update_report.aspx?id={id}&model={modelClassName}',

               
            ]
        ]);
        ?>

    </div>
</div>
