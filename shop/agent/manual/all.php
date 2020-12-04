<?php


use zetsoft\dbitem\core\WebItem;
use zetsoft\dbitem\data\ALLApp;
use zetsoft\dbitem\data\Form;
use zetsoft\models\shop\ShopOrder;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\inputes\ZHHiddenInputWidget;
use zetsoft\widgets\inputes\ZPeriodPickerCallWidget;
use zetsoft\widgets\navigat\ZButtonWidget;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;
use zetsoft\widgets\values\ZDateFormatWidget;


/** @var ZView $this */


/**
 *
 * Action Params
 */

$action = new WebItem();

$action->title = Azl . 'Панель Оператора';
$action->icon = 'fa fa-pie-chart';
$action->type = WebItem::type['html'];
$action->csrf = true;
$action->debug = true;


$this->paramSet(paramAction, $action);

$this->title();
$this->toolbar();


/**
 *
 * Start Page
 */

$this->beginPage();
?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>

    <?php

    require Root . '/webhtm/block/metas/main.php';
    require Root . '/webhtm/block/assets/main.php';

    $this->head();

    ?>

</head>


<body class="<?= ZWidget::skin['white-skin'] ?>">


<?php

$this->beginBody();

echo ZNProgressWidget::widget([]);


$this->beginBody();
//require Root . '/webhtm/shop/agent/manual/header.php';
require Root . '/webhtm/shop/agent/manual/navbar.php';
?>

<div id="page">
    <?


    echo ZSessionGrowlWidget::widget();



    $model = new ShopOrder();

    $model->configs->valueWidget = [
        'date_deliver' => ZDateFormatWidget::class,
        'date_approve' => ZDateFormatWidget::class,
    ];

    $model->configs->valueOptions = [
        'date_deliver' => [
            'config' => [
                'hour' => true,
            ]
        ]
    ];

    $model->configs->order = [
        'modified_at' => SORT_DESC,
    ];

    $model->configs->query = ShopOrder::find()
        ->where([
            'operator' => $this->userIdentity()->id,
        ]);

    $startRange = $this->sessionGet('agentRangeDatePeriod');


    $app = new ALLApp();

    $column = new Form();
    $column->dbType = dbTypeDate;
    $column->widget = ZHHiddenInputWidget::class;
    $app->columns['start'] = $column;

    $column = new Form();
    $column->dbType = dbTypeDate;
    $column->widget = ZHHiddenInputWidget::class;
    $app->columns['end'] = $column;

    $column = new Form();
    $column->title = 'form_id';
    $column->widget = ZPeriodPickerCallWidget::class;
    $column->options = [
        'config' => [
            'valueStart' => 'start',
            'valueEnd' => 'end',
            'timepicker' => true,
        ],
        'value' => $startRange,
    ];

    $app->columns['period'] = $column;


    $model_d = Az::$app->forms->former->model($app);

    $post = $this->httpPost('ZDynamicModel');

    $period = ZArrayHelper::getValue($post, 'period');

    if ($period && $post !== null) {
        $dateBegin = $period[0];
        $dateEnd = $period[1];

        $this->sessionSet('agentRangeDatePeriod', $period);
        $this->urlRedirect(['/shop/agent/manual/all'], true);

    }

    if ($startRange) {

        $beginDate = $this->sessionGet('agentRangeDatePeriod')[0];
        $endDate = $this->sessionGet('agentRangeDatePeriod')[1];

        $beginDate = strtotime($beginDate);
        $endDate = strtotime($endDate);

        $beginDate = date('d/m/Y H:i:s', $beginDate);
        $endDate = date('d/m/Y H:i:s', $endDate);

        if ($beginDate && $endDate) {

            $model->configs->query = ShopOrder::find()
                ->where(['between', 'created_at', $beginDate, $endDate])
                ->andWhere([
                    'operator' => $this->userIdentity()->id,
                ]);
        }
    }


    ?>

    <div id="content" class="content-footer p-3">

        <div class="row">

            <div class="col-md-12 col-12">

                <?

                $model->configs->nameOn = [

                    'id',
                    'contact_name',
                    //'user_company_ids',
                    'created_at',
                    'comment_agent',
                    'status_callcenter',
                    'status_logistics',
                    'date_deliver',
                    'date_approve',
                    'place_adress_id',

                    /*'contact_phone',
                    'date_deliver',*/
                    
                ];

                $model->configs->spa = false;

                $model->columns();


                $all = ZButtonWidget::widget([
                    'config' => [
                        'hasIcon' => true,
                        'title' => '',
                        'grapes' => false,
                        'url' => $this->urlGetBase() . '/shop/agent/manual/main.aspx',
                        'class' => "pb-4 ml-1 rounded-0",
                        'btnStyle' => ZButtonWidget::btnStyle['btn-transparent'],
                        'btnRounded' => false,
                        'icon' => 'text-muted  fa-lg fal fa-home',
                    ],
                ]);


                $model->configs->dynaButtons = [
                    'update' => [
                        'content' => "{update}{$all}",
                        'options' => ['class' => 'btn-group p-1 mr-0 {btnSize} {iconSize}']
                    ],
                ];

                $model->configs->readonly = true;

                $model->configs->pageSize = 10;

                $model->columns();

                /** @var ZView $this */
                echo ZDynaWidget::widget([

                    'model' => $model,

                    'rightNameEx' => [
                        'system'
                    ],

                    'config' => [

                        'hasItems' => false,
                        'relations' => false,

                        'relateMulti' => false,

                        'spaArray' => [
                            'update' => false
                        ],

                        'pjax' => false,

                        'hasToolbar' => true,

                        //'actionButtons' => ['false'],

                        'columnBefore' => [
                            'serial',
                            'action'
                        ],

                        'columnAfter' => ['false'],

                        'paginationOptions' => [

                            'defaultPageSize' => 5,
                            'limit' => 30,

                        ],

                        'actionButtons' => [
                            'view'
                        ],
                        // 'updateUrl' => '{fullUrl}/update-after.aspx?id={id}',

                        //'viewUrl' => '{fullUrl}/view.aspx?id={id}',
                    ],

                    'leftBtn' => [
                        'newBtn' => [
                            'content' => '<div class="d-inline-flex">' . $this->require('/webhtm/shop/agent/manual/periodFilter.php', [
                                        'model_d' => $model_d,
                                    ]
                                ) . '</div>',
                            'options' => [
                                'class' => '',
                            ]
                        ]
                    ],
                ]);
                
                ?>
            </div>
        </div>
    </div>
</div>

<style>

    .main_block .block_item:last-child {
        width: 100%;
    }

    .main_block .or2 {
        padding-top: 0;
    }

    .main_block .block_item:first-child {
        height: auto;
    }

    .jsPanel {
        z-index: 9999 !important;
    }
</style>


<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>
