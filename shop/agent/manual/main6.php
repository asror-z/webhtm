<?php

use kartik\grid\DataColumn;
use rmrevin\yii\fontawesome\FA;
use zetsoft\dbitem\core\WebItem;
use zetsoft\dbitem\data\ALLApp;
use zetsoft\dbitem\data\Form;
use zetsoft\models\shop\ShopOrder;
use zetsoft\system\assets\ZColor;
use zetsoft\system\Az;
use zetsoft\system\column\ZKDataColumn;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\inputes\ZHHiddenInputWidget;
use zetsoft\widgets\inputes\ZPeriodPickerCallWidget;
use zetsoft\widgets\navigat\ZButtonWidget;
use zetsoft\widgets\notifier\ZJspanelWidgetWebphoneX;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;
use zetsoft\widgets\phone\ZJsSipWidget;
use zetsoft\widgets\phone\ZJsSipWidgetX;
use zetsoft\widgets\values\ZDateFormatWidget;

/**
 *
 * @var ZView $this
 *
 */


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

require Root . '/webhtm/shop/agent/manual/navbar.php';
?>

<div id="page">
    <?

    echo ZSessionGrowlWidget::widget();


    $model = new ShopOrder();

    $addBoolen = (bool)$this->bootEnv('OPERATOR_ADD');

    $add = '';
    $clone = '';


    if ($addBoolen) {
        $add = '{add}';
        $clone = '{clone}';
    }

    $model->configs->valueWidget = [
        'date_deliver' => ZDateFormatWidget::class,
    ];

    $model->configs->valueOptions = [
        'date_deliver' => [
            'config' => [
                'hour' => true,
            ]
        ]
    ];

    $model->configs->query = ShopOrder::find()
        ->where([
            'operator' => $this->userIdentity()->id,
            'status_callcenter' => ['ring', 'autodial', 'check']
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

        $dateBegin = ZArrayHelper::getValue($period, 0);
        $dateEnd = ZArrayHelper::getValue($period, 1);

        $this->sessionSet('agentRangeDatePeriod', $period);
        $this->urlRedirect(['/shop/agent/manual/main'], true);

    }

    if ($startRange) {

        $beginDate = ZArrayHelper::getValue($this->sessionGet('agentRangeDatePeriod'), 0);
        $endDate = ZArrayHelper::getValue($this->sessionGet('agentRangeDatePeriod'), 1);

        $beginDate = strtotime($beginDate);
        $endDate = strtotime($endDate);

        $beginDate = date('d/m/Y H:i:s', $beginDate);
        $endDate = date('d/m/Y H:i:s', $endDate);

        if ($beginDate && $endDate) {
            $model->configs->query = ShopOrder::find()
                ->where(['between', 'created_at', $beginDate, $endDate])
                ->andWhere([
                    'operator' => $this->userIdentity()->id,
                    'status_callcenter' => ['ring', 'autodial', 'check']
                ]);
        }
    }

    ?>

    <div id="content" class="content-footer p-3">

        <div class="row">

            <!--DynaWidget begin-->
            <div class="col-md-10">

                <div class="row">

                    <div class="col-md-12 col-12">

                        <?

                        echo ZJspanelWidgetWebphoneX::widget([
                            'model' => $this->model,
                            'id' => 'jsPanel-webPhone',
                            'config' => [
                                'funcName' => 'webphonePanel',
                            ]
                        ]);

                        $model->configs->nameOn = [

                            'id',
                            'contact_name',
                            //'user_company_ids',
                            'shop_element_ids',
                            'created_at',
                            'comment_agent',
                            'status_callcenter',
                            'date_deliver',

                            /*'contact_phone',
                            'date_deliver',*/

                        ];


                        //  $model->configs->pageSize = 12;

                        $model->columns();

                        $all = ZButtonWidget::widget([
                            'config' => array(
                                'hasIcon' => true,
                                'title' => '',
                                'target' => ZButtonWidget::target['_blank'],
                                'grapes' => false,
                                'url' => $this->urlGetBase() . '/shop/agent/manual/all.aspx',
                                'class' => 'pb-4 ml-1 rounded-0',
                                'btnStyle' => ZButtonWidget::btnStyle['btn-transparent'],
                                'btnRounded' => false,
                                'icon' => 'text-muted  fa-lg fal fa-' . FA::_CLIPBOARD,
                            ),
                        ]);


                        $model->configs->dynaButtons = [
                            'update' => [
                                'content' => "{update}{$all}",
                                'options' => [
                                    'class' => 'btn-group p-1 mr-0 {btnSize} {iconSize}'
                                ]
                            ],
                        ];

                        $model->configs->pageSize = 9;

                        //$model->configs->changeSave = true;

                        $model->columns();


                        /** @var ZView $this */

                        echo ZDynaWidget::widget([

                            'model' => $model,

                            'rightNameEx' => [
                                'system',
                            ],

                            'config' => [
                                'hasItems' => false,
                                'pjax' => false,
                                'hasToolbar' => true,
                                'actionButtons' => ['view'],
                                'columnBefore' => [
                                    /*'serial',
                                    'sort',*/
                                    'checkbox',
                                    'action',
                                    //'action'
                                ],

                                'paginationOptions' => [
                                    'defaultPageSize' => 5,
                                ],
                                'heighbody' => '75vh',
                            ],

           
                        ]);

                        ?>

                    </div>
                </div>

            </div>


            <!--SIPML5 begin-->

            <div class="col-xl-2 col-lg-3 col-md-4">

                <?

                $sipml = [];
                $item = new \zetsoft\dbitem\App\eyuf\SIPMLItem();
                $item->impu = '@10.10.3.60:5060';

                //$item->impi = '600';
                //$item->password = 600;

                $item->impi = $this->userIdentity()->number ?? '238498';
                $item->password = $this->userIdentity()->number ?? '238498';

                $item->websocket_proxy_url = 'wss://10.10.3.60:8089/ws';
                $item->keypad = true;
                $item->phoneInputDisplay = false;
                $item->orderInputDisplay = true;
                $item->buttonClass = 'disabled';

                $sipml[] = $item;

                echo ZJsSipWidgetX::widget([
                    'data' => $sipml
                ]);
                ?>

            </div>

        </div>

    </div>

</div>

<script>

    $(document).ready(function () {
        $('body').click();
        console.log('BODY Clicked');
    });

    var agentId = '<?=$this->userIdentity()->id?>';

    function openModal(event) {

        var currentId = window.currentId;
        // console.log(currentId);
        window.webphonePanel();

        var iframe = $('#jsPanel-webPhone-iframe');

        iframe.attr('src', '/shop/agent/manual/update.aspx?id=' + currentId + '&callFrom=manual');
        iframe.attr('height', '95%');
        iframe.attr('width', '100%');

        $.ajax({
            type: 'GET',
            url: '/core/agent/setInProsess.aspx',
            data: {
                agentId: agentId,
                callFrom: 'manual',
            },
        });


    }

</script>

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
