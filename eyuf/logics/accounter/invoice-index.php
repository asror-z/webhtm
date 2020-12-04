<?php

use Monolog\Handler\IFTTTHandler;
use rmrevin\yii\fontawesome\FA;
use zetsoft\dbitem\core\WebItem;
use zetsoft\models\ALL\CoreNotify;
use zetsoft\models\App\eyuf\EyufDocument;
use zetsoft\models\App\eyuf\EyufInvoice;
use zetsoft\models\App\eyuf\EyufReport;
use zetsoft\models\App\eyuf\EyufScholar;
use zetsoft\models\App\eyuf\EyufTicket;
use zetsoft\models\chat\ChatNotify;
use zetsoft\models\user\User;
use zetsoft\service\forms\ZPjax;
use zetsoft\system\assets\ZColor;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\former\ZViewWidget;
use zetsoft\widgets\navigat\ZButtonWidget;
use zetsoft\widgets\themes\ZCardProfileWidget;


?>


<?php
/** @var ZView $this */

$action = new WebItem();

$action->title = Azl . 'Список Расходы';
$action->icon = 'fa fa-institution';
$action->layout = true;
$action->debug = false;

$this->paramSet(paramAction, $action);

$this->title();
$this->toolbar();

$scholarId = $this->httpGet('scholarId');

if (empty($scholarId))
    return $this->alertDanger( 'Отсутсвуют необходимые данные', 'Ошибка');

/** @var EyufScholar $scholar */
$scholar = EyufScholar::findOne($scholarId);

if ($scholar === null)
    return $this->alertDanger( 'Отсутсвуют необходимые данные', 'Ошибка');

$prof = User::findOne($scholar->user_id);

Az::$app->App->eyuf->docs->statusAccount($scholarId);

$userPhoto = $this->userIdentity()->photo;

$userPhotoUrl = '/uploaz/eyuf/User/photo/' . $scholarId .'/'. ZArrayHelper::getValue($userPhoto, 0);

if ($userPhoto === '')
    $userPhotoUrl = $this->userPhoto();

if ($scholar->name === '')
    $scholar->name = 'Scholar'

?>


<div class="row">
    <div class="col-md-4">
        <?php

        ZCardProfileWidget::begin([
            'config' => [
                'url' => $this->userPhoto(),
                'color' => ZColor::color['primary-color'],
                'title' => $scholar->name,
                'content' => !empty($scholar->status) ? 'Статус: ' . (new EyufScholar())->_status[$scholar->status] : ''
            ]
        ]);

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


        /** @var EyufInvoice $model */
        $model = new EyufInvoice();
        $model->configs->query = EyufInvoice::find()
            ->where([
                'eyuf_scholar_id' => $scholarId
            ]);
        $model->eyuf_scholar_id = $scholar->id;

        $model->configs->nameShowEx = [
            'current',
            'eyuf_scholar_id'
        ];

        if ($this->modelSave($model)) {

            $model = EyufInvoice::findOne($model->id);

            $this->notifyInfo('Успешно', 'Ваши данные приняты отделом бухгалтерии', $scholarId);

            $this->urlRedirect([
                'invoice-index',
                'userId' => 97
            ]);
        }


        $model->columns();

        /*$model->configs->readonly = function ($model, $key, $index, $widget) {
            return $model->status === true || ZArrayHelper::isIn($widget->attribute, [
                    'dollar',
                ]);
        };*/

        /** @var ZView $this */
        echo ZDynaWidget::widget([
            'model' => $model,
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
                'btnEdit' => function ($url, $model) {
                    if ($model) {
                        return ZButtonWidget::widget([
                            'config' => [
                                'title' => Az::l('Изменить'),
                                'url' => '/eyuf/admin/invoice/update.aspx?id=',
                                'hasIcon' => true,
                                'btnRounded' => false,
                                'btn' => false,
                                'icon' => 'fa fa-edit',
                                'confirm' => 'Are you sure you want DELETE columns?'
                            ]
                        ]);
                    }
                },
                'barCode' => false,
                'perfectScrollbar' => true,
                'title' => 'Список расходов',
                'titleSummary' => false,
                'titleCreate' => 'Добавить расход',
                'topUpdate' => false,
                'actionDelete' => false,
                'actionClone' => false,
                'topFilter' => false,
                'topSort' => false,
                'topSetting' => false,
                'panelFooter' => false,
                'hasToolbar' => true,
                'actionView' => false,
                'createUrl' => '/eyuf/logics/accounter/add-invoice.aspx?scholarId=' . $scholarId,
                'columnCheckbox' => false,
                'topExport' => false,
            ],
        ]);






        $ticket = new EyufTicket();
        $ticket->configs->query = EyufTicket::find()
            ->where([
                'eyuf_scholar_id' => $scholarId
            ]);
        $ticket->eyuf_scholar_id = $scholar->id;

        echo ZDynaWidget::widget([
            'model' => $ticket,
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
                'createUrl' => '{fullUrl}/add-ticket.aspx?scholarId=' . $scholarId
            ]
        ])


        ?>
    </div>
</div>














