<?php

use kartik\grid\DataColumn;
use zetsoft\dbitem\core\WebItem;
use zetsoft\models\calls\CallsStats;
use zetsoft\system\Az;
use zetsoft\system\column\ZKDataColumn;
use zetsoft\system\kernels\ZView;
use \zetsoft\models\user\User;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\menus\ZMmenuWidget;
use zetsoft\widgets\navigat\ZButtonWidget;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;

/** @var ZView $this */


/**
 *
 * Action Params
 */

$action = new WebItem();

$action->title = Azl . 'Управление статусом оператора';
$action->icon = 'fa fa-pie-chart';
$action->type = WebItem::type['html'];
$action->csrf = true;
$action->debug = true;
$action->layout = true;
$action->layoutFile = 'admin';


$this->paramSet(paramAction, $action);

$this->title();
$this->toolbar();

?>
<div class="d-flex justify-content-end">
    <?
    echo ZButtonWidget::widget([
        'config' => [
            'title' => Az::l('Autodial Restart'),
            'text' => Az::l('Restart'),
            'btnType' => ZButtonWidget::btnType['button'],
            'btnRounded' => false,
            'btnStyle' => 'text-white',
            'btnSize' => 'btn-ml',
            'class' => 'p-1 btn-outline-info rounded-lg z-depth-0',
        ],
        'event' => [
            'click' => <<<JS
          function() {
        
                  $.ajax({
                      type: 'GET',
                      url: '/shop/supervisor/stats/autodial-process.aspx',
                      data: {
                        type: 'restart',
                      }
                  });
              
          }
        JS
        ],
    ]);

    echo ZButtonWidget::widget([
        'config' => [
            'title' => Az::l('Autodial Start'),
            'text' => Az::l('Start'),
            'btnType' => ZButtonWidget::btnType['button'],
            'btnRounded' => false,
            'btnStyle' => 'text-white',
            'btnSize' => 'btn-ml',
            'class' => 'p-1 btn-outline-success rounded-lg z-depth-0',
        ],
        'event' => [
            'click' => <<<JS
          function() {
        
                  $.ajax({
                      type: 'GET',
                      url: '/shop/supervisor/stats/autodial-process.aspx',
                      data: {
                        type: 'start',
                      }
                  });
              
          }
        JS
        ],
    ]);

    echo ZButtonWidget::widget([
        'config' => [
            'title' => Az::l('Autodial Stop'),
            'text' => Az::l('Stop'),
            'btnType' => ZButtonWidget::btnType['button'],
            'btnRounded' => false,
            'btnStyle' => 'text-white',
            'btnSize' => 'btn-ml',
            'class' => 'p-1 btn-outline-danger rounded-lg z-depth-0',
        ],
        'event' => [
            'click' => <<<JS
          function() {
        
                  $.ajax({
                      type: 'GET',
                      url: '/shop/supervisor/stats/autodial-process.aspx',
                      data: {
                        type: 'exit',
                      }
                  });
              
          }
        JS
        ],
    ]);
    ?>
</div>
<?

$userId = $this->userIdentity()->id;
if ($userId === null)
    $userId = 109;
$model = new User();
$model->configs->query = User::find()
    ->where(['role' => 'agent']);

$model->configs->nameOn = [
    'id',
    'title',
    'status',
    'autodial',
    'number',
];
//start|Lobar|27-10-2020
$model->configs->readonly = [
    'title',
    'status',
    'number',
];
//end|Lobar|27-10-2020
$model->configs->readonlyOff = [
    'autodial',
];

$model->configs->title = Az::l('Статус операторов');

$model->configs->pageSize = 100;

$model->columns();

/** @var ZView $this */
echo ZDynaWidget::widget([

    'model' => $model,

    'rightNameEx' => [
        'system'
    ],

    'config' => [

        'search' => false,

        'hasToolbar' => false,

        'actionButtons' => ['false'],

        'heighbody' => '100vh',

        'columnBefore' => ['false'],

        'columnAfter' => ['false'],
    ]

]);

?>


