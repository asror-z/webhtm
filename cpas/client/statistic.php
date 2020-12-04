<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\former\cpas\CpasTrackForm;
use zetsoft\models\cpas\CpasLand;
use zetsoft\models\cpas\CpasOffer;
use zetsoft\models\cpas\CpasStream;
use zetsoft\models\cpas\CpasStreamItem;
use zetsoft\models\cpas\CpasTracker;
use zetsoft\models\place\PlaceCountry;
use zetsoft\models\place\PlaceRegion;
use zetsoft\service\cores\Date;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\inputes\ZKDatepickerWidget;
use zetsoft\widgets\inputes\ZKDateRangePickerWidget;
use zetsoft\widgets\inputes\ZKDateTimePickerWidget;
use kartik\widgets\DateTimePicker;
use zetsoft\widgets\inputes\ZKSelect2Widget;
use zetsoft\widgets\inputes\ZSelect2Widget;
use zetsoft\widgets\navigat\ZButtonWidget;


/** @var ZView $this */


/**
 *
 * Action Params
 * @author Jakh Kudratov
 */

$action = new WebItem();

$action->title = Azl . 'Статистика';
$action->icon = 'fa fa-globe';
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
    require Root . '/webhtm/block/assets/App/main_arbit.php';

    $this->head();

    //start|JakhongirKudratov

    $filter = Az::$app->cpas->cpa->getFilters();
    $filter_data = $this->httpGet();
    $def = 'byday';
    $def_attr = 'day';

    //vdd($filter);
    ?>

</head>

<body class="hold-transition sidebar-mini">

<?php
$this->beginBody();
echo $this->require( '\webhtm\cpas\blocks\header.php')
?>

<div class="container-fluid">

    <div class="row">

        <div class="col-md-12">

            <div class="col-md-11 ml-auto mr-auto statistic-header">

                <div class="statistic-nav">

                    <button class="btn statistic-nav--links select-btns" value="time"><?= Az::l('Время')?></button>
                    <button class="btn statistic-nav--links select-btns" value="offer"><?= Az::l('Офферы')?></button>
                    <button class="btn statistic-nav--links select-btns" value="stream"><?= Az::l('Потоки')?></button>
                    <button class="btn statistic-nav--links select-btns" value="lands"><?= Az::l('Лендинги')?></button>
                    <button class="btn statistic-nav--links select-btns" value="prelands"><?= Az::l('Прелендинг')?></button>
                    <button class="btn statistic-nav--links select-btns" value="preland_with_form"><?= Az::l('Прелендинг с формой')?></button>
                    <button class="btn statistic-nav--links select-btns" value="country"><?= Az::l('Страны')?></button>
                    <button class="btn statistic-nav--links select-btns" value="device"><?= Az::l('Устройства')?></button>
                    

                </div>

                <form method="get" action="#" id="filterForm">

                    <input type="hidden" name="selectedBtnValue" id="selectedBtnValue" value="<?= $filter->selectedBtnValue?>">
                    <div class="statistic-filters d-flex">

                       <div class="statistic-data col-md-4 d-flex">
                                <div class="col-md-4 p-0 m-0">
                                    <?

                                    $user_id = $this->userIdentity()->id;
                                    $today = date('Y-m-d');
                                    
                                    echo ZKDatepickerWidget::widget([
                                        'name' => 'startdate',
                                        'value' => $filter->startdate,
                                        'config' => [
                                            'type' => DateTimePicker::TYPE_INPUT,
                                            'format' => Date::formatDate,

                                        ]
                                    ]);

                                    ?>
                                </div>
                                <div class="do">
                                    <p>до</p>
                                </div>
                               <div class="col-md-4 p-0 m-0">
                                   <?
                                   //vdd($today);
                                   echo ZKDatepickerWidget::widget([
                                       'name' => 'enddate',
                                       'value' => $filter->enddate? $filter->enddate : $today,
                                       'config' => [
                                           'type' => DateTimePicker::TYPE_INPUT,
                                           'format' => Date::formatDate,

                                       ]
                                   ]);
                                   ?>
                               </div>

                           <a class="statistic-search" id="dataselect">
                               <i class="fal fa-search"></i>
                           </a>



                       </div>
                        <div class="statistic-data-btns">

                            <div class="btn-group">
                                <?
                                    $days = Az::$app->cpas->cpa->getDayByName();
                                    //vdd($days);
                                ?>
                                
                                <button value="<?= $days['today']?>" class="btn time-btns statistic-btn--first" id="todayTime"><?= Az::l('Сегодня')?></button>
                                <button value="<?= $days['yesterday']?>" class="btn time-btns statistic-btn" id="yesterdayTime"><?= Az::l('Вчера')?></button>
                                <button value="<?= $days['week']?>" class="btn time-btns statistic-btn"><?= Az::l('Неделя')?></button>
                                <button value="<?= $days['month']?>" class="btn time-btns statistic-btn"><?= Az::l('Месяц')?></button>
                                <button value="<?= $days['year']?>" class="btn time-btns statistic-btn--second"><?= Az::l('Год')?></button>

                            </div>


                        </div>
                        <div class="col-md-3 ml-auto d-flex">

                            <!--<a href="/cpas/client/statistic.aspx" class="reloads">
                                <i class="fal fa-undo"></i>
                            </a>-->
                            <?
                                echo  ZButtonWidget::widget([
                                    'config' => [
                                        'btn' => false,
                                        'url' => '/cpas/client/statistic.aspx',
                                        'title' => Az::l('Сбросить все фильтры'),
                                        'class' => 'reloads',
                                        'btnRounded' => false,
                                        'icon' =>  'fal fa-undo',
                                    ]
                                ]);

                                echo  ZButtonWidget::widget([
                                    'config' => [
                                        'btn' => false,
                                        'url' => '',
                                        'title' => Az::l('Обновить'),
                                        'class' => 'reloads',
                                        'btnRounded' => false,
                                        'icon' =>  'fal fa-refresh',
                                    ]
                                ]);
                            ?>

                        </div>
                    </div>


                    <div class="d-flex col-md-4 mt-3">
                   <!-- <div class="dates">
                        <button value="byday" class="btn year-btn select-times">Дни</button>
                    </div>-->
                </div>
                </form>


            </div>
            
        </div>
        
        <div class="col-md-12 mt-5">
            <?
            $attr_dyna = $filter->selectedBtnValue ? $filter->selectedBtnValue : $def_attr;
            if ($attr_dyna === 'lands' || $attr_dyna === 'prelands' || $attr_dyna === 'preland_with_form')
                $attr_dyna = 'land';
            if ($attr_dyna === 'time')
                $attr_dyna = $def_attr;
            $model = new CpasTrackForm();
            $model->configs->nameOn = [
                $attr_dyna,
                'click',
                'unique_click',
                'cr',
                'EPC',
                'approve',
                'Valid',
                'confirmed',
                'await',
                'canceled',
                'all',
                'trash',
                'earned_money',
            ];
            $model->columns();
            $data = Az::$app->cpas->cpasStats->generateClientStats($user_id,$filter_data);
            echo ZDynaWidget::widget([
                'data' => $data,
                'model' => $model,
                'type' => ZDynaWidget::type['form'],
                'rightBtn' => [
                    'system' => [
                        'content' => '',
                        'options' => ['class' => 'btn-group p-1 mr-0 {btnSize} {iconSize}']
                    ],

                    'toggleData' => [
                        'content' => '',
                        'options' => ['class' => 'btn-group p-1 {btnSize} {iconSize}']
                    ],

                    'statistics' => [
                        'content' => '',
                        'options' => ['class' => 'btn-group p-1 mr-0 {btnSize} {iconSize}']
                    ],

                    'add-clone-delete' => [
                        'content' => '',
                        'options' => ['class' => 'btn-group p-1 mr-0 {btnSize} {iconSize}']
                    ],

                    'export' => [
                        'content' => '{jsonExcel}',
                        'options' => ['class' => 'btn-group p-1 {btnSize} {iconSize}']
                    ],
                    'filter-sort-id' => [
                        'content' => '',
                        'options' => ['class' => 'btn-group p-1 mr-0 {btnSize} {iconSize}']
                    ],
                ],
                'config' => [
                    'title'=>Az::l('Статистика пользователей'),
                    'type' => 'form',
                    'hasToolbar' => true,
                    'editableLink' => true,
                    'search' => false,
                    'copy' => false,
                    'columnBefore' => [
                        'false'
                    ],
                    'isCard' => false,
                    'columnAfter' => ['asd'],
                    'theme' => 'success',
                    'bordered' => false,
                    'striped' => true,
                    'showPageSummary' => true,

                ]
            ]);

            ?>
        </div>

    </div>

</div>

<script>
    //alert(<?=$filter->selectedBtnValue?>);
    $(".select-btns[value='<?= $filter->selectedBtnValue?>']").addClass('activeBtn');
    $(".time-btns[value='<?= $filter->startdate?>']").addClass('activeBtn');
    $(".year-btn[value='<?= $filter->selectTimes?$filter->selectTimes:$def?>']").addClass('active-year');
    $('.select-btns').on('click', function () {
        let selectedVal = $(this).val();
        //alert(selectedVal);
        $('#selectedBtnValue').val(selectedVal);
        //alert($('#selectedBtnValue').val());
        $('#filterForm').submit();
    });
    $('#todayTime').on('click', function () {
        let selectedVal = $(this).val();
        //alert(selectedVal);
        $('[name="startdate"]').val(selectedVal);
        $('[name="enddate"]').val(selectedVal);

        $('#filterForm').submit();
    });

    $('#yesterdayTime').on('click', function () {
        let selectedVal = $(this).val();
        //alert(selectedVal);
        $('[name="startdate"]').val(selectedVal);
        $('[name="enddate"]').val(selectedVal);

        $('#filterForm').submit();
    });
    $('.time-btns').on('click', function () {
        let selectedVal = $(this).val();
        //alert(selectedVal);
        $('[name="startdate"]').val(selectedVal);

        $('#filterForm').submit();
    });
    $('#dataselect').on('click', function () {
        $('#filterForm').submit();

    });
    $('.select-times').on('click', function () {
        let selectedVal = $(this).val();
        $('#selectTimes').val(selectedVal);
        $('#filterForm').submit();

    });

   
</script>

<?php
//end|JakhongirKudratov|

echo $this->require( '\webhtm\cpas\blocks\footer.php');
 $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>
