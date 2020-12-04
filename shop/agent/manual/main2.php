<?php

use kartik\grid\DataColumn;
use zetsoft\dbitem\core\WebItem;
use zetsoft\dbitem\data\ALLApp;
use zetsoft\dbitem\data\Form;
use zetsoft\dbitem\App\eyuf\SIPMLItem;
use zetsoft\system\assets\ZColor;
use zetsoft\system\Az;
use zetsoft\system\column\ZKDataColumn;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\ajaxify\ZStatusWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZCheckButtonWidget;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\former\ZEditKartikWidget;
use zetsoft\widgets\former\ZFormWidget;
use zetsoft\widgets\inputes\ZHHiddenInputWidget;
use zetsoft\widgets\inputes\ZKSelect2Widget;
use zetsoft\widgets\inputes\ZMImageRadioWidget;
use zetsoft\widgets\inputes\ZPeriodPickerCallWidget;
use zetsoft\widgets\inputes\ZPeriodPickerWidget;
use zetsoft\widgets\navigat\ZButtonWidget;
use zetsoft\widgets\notifier\ZJspanelWidgetWebphone;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;
use zetsoft\models\shop\ShopOrder;
use zetsoft\widgets\phone\ZJsSipWidget;
use zetsoft\widgets\phone\ZJsSipWidgetX;


/** @var ZView $this */


/**
 *
 * Action Params
 */

$action = new WebItem();

$action->title = Azl . 'Заказы';
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

    echo ZSessionGrowlWidget::widget();$model = new ShopOrder();

    $model->configs->query = ShopOrder::find()
        ->where([
            'status_callcenter' => ['ring', 'autodial']
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
        $this->urlRedirect(['/agent/manual/main'], true);

    }

    if ($startRange) {
        $beginDate = $this->sessionGet('agentRangeDatePeriod')[0];
        $endDate = $this->sessionGet('agentRangeDatePeriod')[1];


        if ($beginDate && $endDate) {
            $model->configs->query = ShopOrder::find()->where(['between', 'created_at', $beginDate, $endDate]);
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
                            'user_company_ids',
                            'created_at',
                            'comment_agent',
                            'status_callcenter',
                            'date_deliver'

                            /*'contact_phone',
                            'date_deliver',*/
                        ];


                        $model->configs->after = [
                            'contact_name' => [
                                [
                                    'class' => ZKDataColumn::class,
                                    'label' => Az::l('звонки'),
                                    'width' => '50px',
                                    'value' => function ($model, $key, $index, DataColumn $dataColumn) {


                                        $clickedNumber = $model->contact_phone;

                                        $code = <<<JS
                                        function (event)
                                        {
                                        var callButton = document.getElementById('callButton');
                                           e.preventDefault(); 
                                          document.getElementById("txtPhoneNumber").value = "309";
                                          
                                           callButton.click();
                                          
                                           var currentId = e.currentTarget.parentNode.parentNode.getAttribute("data-key");
                                     
                                           console.log(currentId);
                                           
                                            $.ajax({
                                                type: "GET",
                                                url: '/core/agent/setCallDate.aspx',
                                                data:{
                                                  currentId: currentId,
                                                }, 
                                                /*success: function (data) {
                                                    console.log(data);
                                                }*/
                                            });
                                            
                                            window.currentId = currentId;
                                            
                                            openModal();
                                            
                                            setIdNumber();
                                           
                                        }
JS;

                                        $code = strtr($code, [
                                            '{number}' => $clickedNumber,
                                        ]);


                                        ZJspanelWidgetWebphone::begin([
                                            
                                            'config' => [
                                                'id' => 'jspanel',
                                                'begin' => true,
                                                'height' => '550px',
                                                'width' => '50%',
                                                'my' => 'center',
                                                'at' => 'center',
                                                'autoposition' => 'down',
                                                'offsetX' => '-40',
                                                'offsetY' => '0',
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


                        $model->columns();

                        $model->configs->dynaButtons = [
                            'update' => [
                                'content' => '{update}',
                                'options' => ['class' => 'btn-group p-1 mr-0 {btnSize} {iconSize}']
                            ],
                        ];




                        /** @var ZView $this */
                        echo ZDynaWidget::widget([
                            'model' => $model,
                            'rightNameEx' => [
                                'system'
                            ],
                            'config' => [
                                'hasToolbar' => true,
                                // 'actionButtons' => ['false'],
                                'columnBefore' => ['false'],
                                'columnAfter' => ['false'],

                                'paginationOptions' => [
                                    'defaultPageSize' => 5,
                                ],
                            ],
                            'leftBtn' => [
                                'newBtn' => [
                                    'content' => '<div class="d-inline-flex">'.$this->require('/webhtm/shop/agent/manual/periodFilter.php', [
                                            'model_d'=>$model_d,
                                        ]
                                    ).'</div>',
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
                $item->impu = '@10.10.3.31:5060';
                $item->impi = '505';
                $item->password = 505;
                $item->websocket_proxy_url = 'wss://zoft.uz:8089/ws';
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

    function openModal(event) {

        var currentId = window.currentId;

        $('#jspanel').toggle();

        var iframe = $('#myIframe');

        iframe.attr('src', '/agent/manual/update.aspx?id=' + currentId);
        iframe.attr('height', '95%');
        iframe.attr('width', '100%');


        iframe.on('load', function () {

            var form = iframe.contents().find('#callsForm')

            form.on('submit', function() {
                alert()
                window.parent.closeSweet()
                $('#ShopOrder_Grid_Reset').click();

            })

        })

        console.log('SUCCESS');

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
