<?php

use kartik\grid\DataColumn;
use zetsoft\dbitem\core\WebItem;
use zetsoft\system\assets\ZColor;
use zetsoft\system\Az;
use zetsoft\system\column\ZKDataColumn;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\former\ZEditKartikWidget;
use zetsoft\widgets\inputes\ZKSelect2Widget;
use zetsoft\widgets\navigat\ZButtonWidget;
use zetsoft\widgets\notifier\ZJspanelWidgetWebphone;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;
use zetsoft\models\shop\ShopOrder;



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

?>

<div id="page">

    <?

    //require Root . '/webhtm/block/navbar/main.php';

    echo ZSessionGrowlWidget::widget();?>

    <!--<div id="rootModal"></div>-->


    <div id="content" class="content-footer p-3">


        <div class="row">


            <!--DynaWidget begin-->
            <div class="col-md-10">

                <div class="row">
                    <div class="col-md-12 col-12">

                        <?

                        $model = new ShopOrder();

                        $model->configs->nameOff = [
                            'contact_phone',
                            'date_deliver'
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
                                           e.preventDefault(); 
                                          document.getElementById("txtPhoneNumber").value = "306";
                                          sipCall("call-audio");
                                           
                                           var currentId = e.currentTarget.parentNode.parentNode.getAttribute("data-key");
                                     
                                           console.log(currentId);
                                           
                                            $.ajax({
                                                type: "GET",
                                                url: '/core/agent/setCallDate.aspx',
                                               
                                        
                                                data:{
                                                  currentId: currentId,
                                                }, 
                                                success: function (data) {
                                                    console.log(data);
                                                }
                                            });
                                            
                                            window.currentId = currentId;
                                            
                                            openModal();
                                          
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
                            'config' => [
                                'hasToolbar' => true,
                                'actionButtons' => ['false'],
                                'columnBefore' => ['false'],
                                'columnAfter' => ['false'],

                                'paginationOptions' => [
                                    'defaultPageSize' => 5,
                                ],
                            ]
                        ]);

                        ?>

                    </div>
                </div>

            </div>


            <!--SIPML5 begin-->

            <div class="col-md-2">

                <?


                /* @var ZView $this */
                if (!$this->userIsGuest())
                    $ext = $this->userIdentity()->phone;
                else
                    $ext = 4444;


                $sipml = [];
                $SIPMLItem = new \zetsoft\dbitem\App\eyuf\SIPMLItem();
                $SIPMLItem->realm = '10.10.3.31:5060';
                $SIPMLItem->impi = $ext;
                $SIPMLItem->impu = "sip:$ext@10.10.3.31:5060";
                $SIPMLItem->password = $ext;
                $SIPMLItem->websocket_proxy_url = 'wss://zoft.uz:8089/ws';
                $SIPMLItem->display_name = $ext;
                $SIPMLItem->keypad = true;
                $SIPMLItem->callBtn = true;
                $SIPMLItem->videoCallBtn = false;
                $SIPMLItem->btnHangUp = true;

                $sipml[] = $SIPMLItem;


                echo \zetsoft\widgets\phone\ZSipmlWidget::widget([
                    'data' => $sipml
                ]);

                ?>

                <div class=" mt-5 pt-2">
                    <div class="btn btn-outline-success rounded-7 px-5 py-1 text-white">
                        <?
                        $modelNew = $this->modelGet(\zetsoft\models\user\User::class ,124);


                        echo ZEditKartikWidget::widget([
                            'model' => $modelNew,
                            'attribute' => 'status',
                            'config' => [
                                'widgetClass' => ZKSelect2Widget::class,
                                'asPopover' => true,
                                'placement' => ZEditKartikWidget::placement['ALIGN_LEFT']

                            ]

                        ]);
                        ?>
                    </div>

                </div>

                <!--<div class = "btn btn-danger">
                     <? /*
                     $modelNew = $this->modelGet(\zetsoft\models\user\User::class ,124);


                     echo ZEditKartikWidget::widget([
                         'model' => $modelNew,
                         'attribute' => 'status',
                         'config' => [
                             'widgetClass' => ZKSelect2Widget::class,
                             'asPopover' => true,
                             'placement' => ZEditKartikWidget::placement['ALIGN_BOTTOM']

                         ]

                     ]);
                     */ ?>
                </div>-->
            </div>

        </div>

    </div>

</div>

<script>


    function openModal(event) {

        /* timerShow.classList.remove('d-none');*/

        tsk_utils_log_info("onSetRemoteDescriptionSuccess");

        var currentId = window.currentId;


        /*Run timer*/

        /*startTimer();
        resetTimer();*/

        $('#jspanel').toggle();

        /*dynaSweetCall();*/

        var iframe = $('#myIframe');

        iframe.attr('src', '/agent/xolmat/update.aspx?id=' + currentId);
        iframe.attr('height', '95%');
        iframe.attr('width', '100%');


        iframe.on('load', function () {

            var form = iframe.contents().find('#callsForm')
         
            form.on('submit', function() {
                alert()
                window.parent.closeSweet()
                $('#ShopOrder_Grid_Reset').click()

            })

        })

        console.log('SUCCESS');

        var b = (tmedia_session_jsep01.mozThis || event);
        if (b) {
            if (!b.b_sdp_ro_pending && b.b_sdp_ro_offer) {
                b.o_sdp_lo = null
            }
        }
    }


    var buttons = $("[aria-label='Звонить']");

    var selectedButtons = [];
    selectedButtons.push(buttons);


    /*Test*/

    tmedia_session_jsep01.onSignalingstateChange = function (b, a) {
        var c = (tmedia_session_jsep01.mozThis || a);
        if (!c || !c.o_pc) {
            return
        }
        tsk_utils_log_info("onSignalingstateChange:" + c.o_pc.signalingState);
        if (c.o_local_stream && c.o_pc.signalingState === "have-remote-offer") {
            tmedia_session_jsep01.onGetUserMediaSuccess(c.o_local_stream, c)
        }
    };

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
