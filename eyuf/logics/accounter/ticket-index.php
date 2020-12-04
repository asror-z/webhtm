<?php

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

$action->title = Azl . 'Список авиабилетов';
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

?>

<div class="row">
    <div class="col-md-4">
        <?php
        ZCardProfileWidget::begin([
            'config' => [
                'url' => $this->userPhoto(),
                'color' => ZColor::color['primary-color'],
                'title' => $scholar->name,
            ]
        ]);

        /*if (!empty($scholar->status))
            echo 'Статус: ' . (new EyufScholar())->_status[$scholar->status];*/

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
        $ticket = new EyufTicket();
        $ticket->configs->query = EyufTicket::find()
            ->where([
                'eyuf_scholar_id' => $scholarId
            ]);

        $ticket->configs->nameOn = [
            'id',
            'name',
            'eyuf_scholar_id',
            'visa',
            'payment_file',
            'start_date',
            'end_date',
        ];

        $ticket->columns();

        /** @var ZView $this */
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
                'title' => Az::l('Список авиабилетов'),
                'titleSummary' => false,
                'titleCreate' => 'Добавить авиабилет',
                'createUrl' => '/eyuf/logics/accounter/add-ticket.aspx?scholarId=' . $scholarId,
                'columnAfter' => false
            ]
        ]);
        ?>
    </div>
</div>














