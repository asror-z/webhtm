<?php

use kartik\grid\DataColumn;
use rmrevin\yii\fontawesome\FA;
use zetsoft\dbitem\core\WebItem;
use zetsoft\dbitem\data\ALLApp;
use zetsoft\dbitem\data\Form;
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
use zetsoft\widgets\inputes\ZPeriodPickerWidget;
use zetsoft\widgets\inputes\ZPeriodPickerWidgetX;
use zetsoft\widgets\navigat\ZButtonWidget;
use zetsoft\widgets\notifier\ZJspanelWidgetWebphone;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;
use zetsoft\models\shop\ShopOrder;
use zetsoft\widgets\phone\ZJsSipWidget;
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

if ($this->userIsGuest())
    $this->urlRedirect(['/core/user/user-auth/login-register'], true);


$this->beginBody();

require Root . '/webhtm/shop/agent/manual/navbar.php';
?>

<div id="page">
    <?

    echo ZSessionGrowlWidget::widget();

    
    $model = new ShopOrder();

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

    if ($this->userIsGuest())
        $this->urlRedirect(['/core/user/user-auth/login-register']);

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

                        $model->configs->after = [
                            'contact_name' => [
                                [
                                    'class' => ZKDataColumn::class,
                                    'label' => Az::l('звонки'),
                                    'width' => '50px',
                                    'value' => function ($model, $key, $index, DataColumn $dataColumn) {

                                        $clickedNumber = $model->contact_phone;
                                        #search
                                        $code = <<<JS
                                        function (event)
                                        {
                                           e.preventDefault(); 
                                          document.getElementById("txtPhoneNumber").value = '{number}';
                                          console.log(document.getElementById("txtPhoneNumber").value); 
                                          console.log("PHONE NUMBER");
                                          console.log(document.getElementById("txtPhoneNumber").value);
                                      
                                           var callButton = document.getElementById('callButton');
                                           
                                           callButton.click();
                                          
                                           var currentId = e.currentTarget.parentNode.parentNode.getAttribute("data-key");
                                     
                                           console.log(currentId);
                                           
                                            $.ajax({
                                                type: "GET",
                                                url: '/core/agent/setCallDate.aspx',
                                                data:{
                                                  currentId: currentId,
                                                }, 
                                            
                                            });
                                            
                                            window.currentId = currentId;
                                            
                                            openModal();
                                            
                                            setIdNumber();
                                           
                                        }
JS;


                                        $clickedNumber = strtr($clickedNumber, [
                                            '-' => ''
                                        ]);

                                        $code = strtr($code, [
                                            '{number}' => $clickedNumber,
                                        ]);

                                        $id = $model->id;
                                        
                                        ZJspanelWidgetWebphone::begin([
                                        
                                            
                                            
                                            'config' => [
                                                'id' => 'jspanel',
                                                
                                                'begin' => true,
                                                'height' => '70vh',
                                                'width' => '80vw',
                                                'my' => 'center',
                                                'at' => 'center',
                                                'autoposition' => 'down',
                                                'offsetX' => '-40',
                                                'offsetY' => '0',
                                                'headt' => ''
                                            ]
                                        ]);

                                        ?>

                                        <iframe id="myIframe" src=""></iframe>

                                        <?php

                                        ZJspanelWidgetWebphone::end();

                                        /*Button*/

                                        return ZButtonWidget::widget([
                                            //'id' => 'settings-widget-' . $key,
                                            'config' => [
                                                'title' => Az::l('Звонить'),
                                                'icon' => 'fa fa-phone fa-2x text-success',
                                                'pjax' => 0,
                                                'btnSize' => ZColor::btnSize['btn-sm'],
                                                'btnRounded' => true,
                                                'btn' => false,
                                                'hasIcon' => true,
                                                'btnType' => ZButtonWidget::btnType['link'],
                                                'url' => '',
                                                //'color' => ZColor::color['green'],
                                            ],
                                            'event' => [
                                                'click' => $code


                                            ]
                                        ]);


                                    }
                                ],
                            ],

                        ];

                        $model->configs->readonly = true;

                        $model->columns();

                        $all = ZButtonWidget::widget([
                            'config' => [
                                'hasIcon' => true,
                                'title' => '',
                                'target' => ZButtonWidget::target['_blank'],
                                'grapes' => false,
                                'url' => $this->urlGetBase() . '/shop/agent/manual/all.aspx',
                                'class' => "pb-4 ml-1 rounded-0",
                                'btnStyle' => ZButtonWidget::btnStyle['btn-transparent'],
                                'btnRounded' => false,
                                'icon' => 'text-muted  fa-lg fal fa-' . FA::_CLIPBOARD,
                            ],

                        ]);

                        $model->configs->dynaButtons = [
                            'update' => [
                                'content' => "{update}{$all}",
                                'options' => ['class' => 'btn-group p-1 mr-0 {btnSize} {iconSize}']
                            ],
                        ];

                        $model->configs->pageSize = 9;

                        $model->configs->autoSave = true;

                        $model->columns();
                        /** @var ZView $this */
                        echo ZDynaWidget::widget([
                        
                            'model' => $model,
                            
                            'rightNameEx' => [
                            
                                'system'
                                
                            ],

                            'config' => [
                            
                                'pjax' => false,
                                'hasToolbar' => true,
                                'actionButtons' => ['view'],

                                'columnBefore' => [paramAction],
                                'columnAfter' => ['false'],

                                'paginationOptions' => [
                                    'defaultPageSize' => 5,
                                ],

                                'heighbody' => '75vh',
                                
                            ],
                            
                            'leftBtn' => [
                            
                                'newBtn' => [
                                
                                    'content' => '<div class="d-inline-flex">' . $this->require( '/webhtm/shop/agent/manual/periodFilter.php', [
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


            <!--SIPML5 begin-->

            <div class="col-xl-2 col-lg-3 col-md-4">

                <?

                $sipml = [];
                $item = new \zetsoft\dbitem\App\eyuf\SIPMLItem();
                $item->impu = '@10.10.3.60:5060';

                /*
                    $item->impi = '301';
                    $item->password = '301';
                */

                $item->impi = $this->userIdentity()->number ?? '238498';
                $item->password = $this->userIdentity()->number ?? '238498';

                $item->websocket_proxy_url = 'wss://10.10.3.60:8089/ws';
                $item->keypad = true;
                $item->phoneInputDisplay = false;
                $item->orderInputDisplay = true;
                $item->buttonClass = 'disabled';

                $sipml[] = $item;

                echo ZJsSipWidget::widget([
                    'data' => $sipml
                ]);

                //echo $this->require( '/render/phone/ZJSSipWidget/local31-sher/cleanX2.php');

                ?>

            </div>

        </div>

    </div>

</div>

<script>

    $(document).ready(function () {
        $('body').click();
        console.log('BODY Clicked')
    });

    var agentId = '<?=$this->userIdentity()->id?>';

    function openModal(event) {

        var currentId = window.currentId;

        $('#jspanel').toggle();

        var iframe = $('#myIframe');

        iframe.attr('src', '/shop/agent/manual/update.aspx?id=' + currentId + '&callFrom=manual');
        iframe.attr('height', '95%');
        iframe.attr('width', '100%');

        $.ajax({
            type: "GET",
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
