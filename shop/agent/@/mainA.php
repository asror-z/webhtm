<?php

use kartik\grid\DataColumn;
use zetsoft\dbitem\core\WebItem;
use zetsoft\models\drag\DragFormDb;
use zetsoft\system\assets\ZColor;
use zetsoft\system\Az;
use zetsoft\system\column\ZKDataColumn;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZCheckButtonWidget;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\former\ZEditKartikWidget;
use zetsoft\widgets\inputes\ZKSelect2Widget;
use zetsoft\widgets\navigat\ZButtonWidget;
use zetsoft\widgets\notifier\ZJspanelWidget;
use zetsoft\widgets\notifier\ZJspanelWidgetWebphone;
use zetsoft\widgets\notifier\ZModalWidgetRavshan;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;
use zetsoft\models\shop\ShopOrder;
use zetsoft\widgets\notifier\ZSweetAlert2Widget;
use zetsoft\widgets\phone\ZSipml5Widget44;
use zetsoft\widgets\phone\ZSipml5WidgetX;


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
            <div class="col-md-9">

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
                                          var phoneNumber = document.getElementById("txtPhoneNumber").value = "306";
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
                                                'height' => '500px',
                                                'width' => '50%',
                                                'my' => 'center',
                                                'at' => 'center',
                                                'autoposition' => 'down',
                                                'offsetX' => '-50',
                                                'offsetY' => '0',
                                            ]
                                        ]);


                                        ?>

                                        <iframe id="myIframe" src=""></iframe>
                                        <iframe id="myIframeIn" src=""></iframe>

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


                        /** @var ZView $this */
                        echo ZDynaWidget::widget([
                            'model' => $model,
                            'config' => [
                                'hasToolbar' => false,
                                'actionButtons' => ['false'],
                                'columnBefore' => ['false'],
                                'columnAfter' => ['false'],

                                'paginationOptions' => [

                                    'defaultPageSize' => 4,

                                ],
                            ]
                        ]);

                        ?>

                    </div>
                </div>

            </div>


            <!--SIPML5 begin-->

            <div class="col-md-3">

                <?
                echo $this->require( '/render/phone/ZSipml5Widget/local31/SipML5X.php');
                ?>
                    <br>
                    <br>
                    <br>
                <div>
                <div class="d-flex justify-content-center">
                    <div type="button" class="btn btn-link text-info border rounded-lg" style="text-decoration: none">

                        <?
                        $modelNew = $this->modelGet(\zetsoft\models\user\User::class ,125);


                        echo ZEditKartikWidget::widget([
                            'model' => $modelNew,
                            'attribute' => 'status',
                            'config' => [
                                'widgetClass' => ZKSelect2Widget::class,
                                'asPopover' => true,
                                'placement' => ZEditKartikWidget::placement['ALIGN_BOTTOM']

                            ]

                        ]);


                        ?>

                    </div>
                    </div>

                </div>
            </div>

        </div>

    </div>

</div>

<script>


        function openModal (event) {

           /* timerShow.classList.remove('d-none');*/

            tsk_utils_log_info("onSetRemoteDescriptionSuccess");

            var currentId = window.currentId;


            /*Run timer*/

            /*startTimer();
            resetTimer();*/

            $('#jspanel').toggle();

            /*dynaSweetCall();*/

            var iframe = $('#myIframe');

            iframe.attr('src', '/agent/xolmat/update.aspx?id=' + currentId)
            iframe.attr('height', '450px')
            iframe.attr('width', '100%')


            console.log('SUCCESS');

            var b = (tmedia_session_jsep01.mozThis || event);
            if (b) {
                if (!b.b_sdp_ro_pending && b.b_sdp_ro_offer) {
                    b.o_sdp_lo = null
                }
            }
        }




        var buttons = $( "[aria-label='Звонить']" );

        var  selectedButtons = [];
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
    .jsPanel{
        z-index: 9999!important;
    }


</style>


<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>
