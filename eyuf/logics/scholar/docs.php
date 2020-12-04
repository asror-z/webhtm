<?php

use rmrevin\yii\fontawesome\FA;
use zetsoft\dbitem\core\WebItem;
use zetsoft\models\App\eyuf\EyufDocument;
use zetsoft\models\App\eyuf\EyufScholar;
use zetsoft\models\user\User;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\navigat\ZButtonWidget;


/** @var ZView $this */
$action = new WebItem();

$action->title = Azl . 'Мои документы';
$action->icon = 'fa fa-area-chart';
$action->layout = true;
$action->debug = false;


$this->paramSet(paramAction, $action);

$this->title();
$this->toolbar();

/** @var User $model */
$model = $this->userIdentity();

$user_id = $this->userIdentity()->id;
/** @var EyufScholar $scholar */

$scholar = EyufScholar::findOne(['user_id' => $user_id]);
    

if ($scholar === null)
    return $this->alertWarning(Az::l('Стипендиант не найден'), $this->userIdentity()->id);

    
$documentsList = Az::$app->App->eyuf->docs->getDocList();
$documentsCount = count($documentsList);
$documentsHTML = Az::$app->App->eyuf->docs->getDocListHTM($documentsList);
$title = Az::l('Просим предоставить эти документы.');
if ($documentsCount !== 0)
    $this->alertInfo($documentsHTML, $title);

?>

<div class="row">

    <div class="col-md-12">
        <?php


        $docs = new EyufDocument();
        
        $docs->configs->query = EyufDocument::find()
            ->where([
                'eyuf_scholar_id' => $scholar->id
            ]);

        //$docs->configs->edit = true;

        if ($this->userRole() === 'scholar') {
            $docs->configs->nameOff = [
                'correct',
            ];
        }

        /*$docs->configs->readonlyOn = function ($model, $key, $index, $widget) {
            return $model->status === true || ZArrayHelper::isIn($widget->attribute, [
                    'status',
                    'correct',
                    'created_at',
                    'comment',
                    'eyuf_scholar_id',
                    'verified',
                    'need_verify'
                ]);

        };*/

        $docs->configs->filter = [
            'eyuf_scholar_id',
            'comment'
        ];

        $docs->configs->nameOff = [
            'created_at',
            'created_by',
            'modify_at',
            'modify_by'
        ];
        
        $docs->columns();

        /** @var ZView $this */
        echo ZDynaWidget::widget([
            'model' => $docs,
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
                    'content' => '{add}{tabular}{clone}{delete}',
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
                'spaArray' => ['create'],
                'title' => Az::l('Мои документы'),
                'titleCreate' => Az::l('Добавить документ'),
                'actionClone' => false,
                'actionDelete' => false,
                'topFilter' => false,
                'search' => false,
                'columnCheckbox' => false,
                'perfectScrollbar' => true,
                'topSort' => false,
                'btnEdit' => function ($url, $model) {
                    if ($model->status !== true)
                        return ZButtonWidget::widget([
                            'config' => [
                                'title' => Az::l('Изменить'),
                                'url' => '/eyuf/logics/scholar/doc-update.aspx?id=' . $model->id,
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
