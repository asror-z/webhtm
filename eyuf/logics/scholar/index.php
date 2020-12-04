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

$action->title = Azl . 'Стипендиант';
$action->icon = 'fa fa-area-chart';
$action->type = WebItem::type['html'];
$action->layout = true;
$action->debug = false;

$this->paramSet(paramAction, $action);

$this->title();
$this->toolbar();


/** @var User $model */

//$id1 = $this->httpGet('id', null, true);

$model = $this->userIdentity();

$id = $this->userIdentity()->id;

/** @var EyufScholar $scholar */
$scholar = EyufScholar::findOne(['user_id' => $id]);

if ($scholar === null)
    return $this->alertWarning(Az::l('Стипендиант не найден'), $id);




/* start|AzimjonToirov|24-10-2020 */

$documentsList = Az::$app->App->eyuf->docs->getDocList();
$documentsCount = count($documentsList);
$documentsHTML = Az::$app->App->eyuf->docs->getDocListHTM($documentsList);
$title = Az::l('Просим предоставить эти документы.');
if ($documentsCount !== 0) 
     $this->alertInfo($documentsHTML, $title);

/* end|AzimjonToirov|24-10-2020 */

//require Root . '/webhtm/eyuf/logics/ALL/docListAlert.php';

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
   
        /* end|AzimjonToirov|24-10-2020 */

        $photoUrl = $this->userPhoto();


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
         * Documents section
         *
         */

        $docs = new EyufDocument();

        $docs->configs->query = EyufDocument::find()
            ->where([
                'eyuf_scholar_id' => $scholar->id
            ]);

        if ($this->userRole() === 'scholar') {
            $docs->configs->nameOff = [
                'correct',
                //start|NurbekMakhmudov|2020-10-26
                'id',
                'verified_email',
                'need_verify'  ,
                'status'
                //end|NurbekMakhmudov|2020-10-26
            ];
        }


        $docs->configs->readonly = function ($model) {
            if (ZArrayHelper::getValue($model, 'status'))
                return true;
            return false;
        };

        $docs->configs->filter = [
            'eyuf_scholar_id',
            'comment'
        ];
/*
        $docs->configs->widget = [
            'name' => ZKSelect2Widget::class,
        ];*/

        /*$docs->configs->data = [
            'name' => ['1', '2'],
        ];*/

        $docs->columns();
        /** @var ZView $this */
        echo ZDynaWidget::widget([
            'id' => 'docs',
            'model' => $docs,
            'rightBtn' => [

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
                'title' => Az::l('Мои документы'),
                'titleCreate' => Az::l('Добавить документ'),
                'actionClone' => false,
                'actionDelete' => false,
                'topFilter' => false,
                'search' => false,
                'createUrl' => '/eyuf/logics/scholar/doc-add.aspx?model={modelClassName}',
                'columnCheckbox' => false,
                'topSort' => false,
                'perfectScrollbar' => true,
                'columnAfter' => false,
                'btnEdit' => function ($url, $model) use ($docs) {
                    if ($docs->status !== true)
                        return ZButtonWidget::widget([
                            'config' => [
                                'title' => Az::l('Изменить'),
                                'url' => '/eyuf/logics/scholar/doc-update.aspx?id=' . $docs->id,
                                'hasIcon' => true,
                                'btnRounded' => false,
                                'btn' => false,
                                'icon' => 'fa fa-' . FA::_EDIT,
                                'confirm' => Az::l('Are you sure you want DELETE columns?')
                            ]
                        ]);
                }
            ],
        ]);
        ?>

    </div>
</div>
