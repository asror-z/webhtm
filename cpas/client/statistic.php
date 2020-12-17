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
$action->csrf = false;
$action->debug = false;


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
    $subs = [
        'sub_id_1' => 'Sub ID1',
        'sub_id_2' => 'Sub ID2',
        'sub_id_3' => 'Sub ID3',
        'sub_id_4' => 'Sub ID4',
        'sub_id_5' => 'Sub ID5',
        'sub_id_6' => 'Sub ID6',
    ]
    //vdd($filter);
    ?>

</head>

<body class="hold-transition sidebar-mini">

<?php
$this->beginBody();
echo $this->require('\webhtm\cpas\blocks\header.php')
?>

<div class="container-fluid">

  <div class="row">

    <div class="col-md-12">
      <button type="button" class="btn btn-primary" disabled><?= Az::l('Статистика')?></button>
      <a href="/cpas/client/track.aspx"><button type="button" class="btn btn-primary" ><?= Az::l('Конверсии')?></button></a>
      <div class="col-md-11 ml-auto mr-auto statistic-header">

        <div class="statistic-nav">

          <button class="btn statistic-nav--links select-btns" value="time"><?= Az::l('Дата') ?></button>
          <button class="btn statistic-nav--links select-btns" value="offer"><?= Az::l('Офферы') ?></button>
          <button class="btn statistic-nav--links select-btns" value="stream"><?= Az::l('Потоки') ?></button>
          <button class="btn statistic-nav--links select-btns" value="lands"><?= Az::l('Лендинги') ?></button>
          <button class="btn statistic-nav--links select-btns" value="prelands"><?= Az::l('Прелендинг') ?></button>
          <button class="btn statistic-nav--links select-btns"
                  value="preland_with_form"><?= Az::l('Прелендинг с формой') ?></button>
          <button class="btn statistic-nav--links select-btns" value="country"><?= Az::l('Страны') ?></button>
          <button class="btn statistic-nav--links select-btns" value="device"><?= Az::l('Устройства') ?></button>
          <button class="btn statistic-nav--links select-btns" value="sub"><?= Az::l('Метки') ?></button>


        </div>

        <form method="get" action="#" id="filterForm">
            <?php if ($this->httpGet('selectedBtnValue') === 'sub') { ?>
              <div>
                <div class="row">
                    <?php
                    $default = true;
                    if ($this->httpGet('selectedSub')) {
                        if (ZArrayHelper::isIn($this->httpGet('selectedSub'), $subs))
                            $default = false;
                    }
                    foreach ($subs as $key => $sub):
                        $text ='';
                        if ($this->httpGet('selectedSub') === $key) {
                            $text = 'checked';
                        }
                        if ($key === 'sub_id_1' && $default){
                            $text = 'checked';
                        }
                        ?>
                      <div class="form-check form-check-inline">
                        <input type="radio" class="form-check-input" id="<?= $key ?>" value="<?= $key ?>"
                               name="selectedSub" <?= $text?>>
                        <label class="form-check-label" for="<?= $key ?>"><?= $sub ?></label>
                      </div>
                    <?php endforeach; ?>

                  <!-- Material inline 2 -->

                  <!-- Material inline 3 -->
                  <!--              <select class="browser-default custom-select" id="sub" name="sub">-->
                  <!---->
                  <!--                --><?php
                    //
                    //                foreach ($subs as $key => $sub){
                    //                    $selected = false;
                    ////                    if (!$this->httpGet()){
                    ////                      $selected = false;
                    ////                    }
                    //                    if ($sub === $this->httpGet('sub')){
                    //                      $selected = true;
                    //                    }
                    //
                    //                  ?>
                  <!--                <option value="--><? //= $key === 0 ? '' : $sub?><!--" -->
                    <? //= $selected ? 'selected' : ''?><!--<? //= $sub?></option>-->
                  <!--                --><?php //}?>
                  <!--              </select>-->
                </div>
                <div class="row">

<!--                  <div class="col-md-2">-->
<!--                    <button class="btn btn-success text-white"-->
<!--                            id="apply">--><?//= Az::l('Применить') ?><!--</button>-->
<!--                  </div>-->
                </div>
              </div>
            <?php } ?>
          <input type="hidden" name="selectedBtnValue" id="selectedBtnValue" value="<?= $filter->selectedBtnValue ?>">
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
                      'value' => $filter->enddate ? $filter->enddate : $today,
                      'config' => [
                          'type' => DateTimePicker::TYPE_INPUT,
                          'format' => Date::formatDate,

                      ]
                  ]);
                  ?>
              </div>

<!--              <a class="statistic-search" id="dataselect">-->
<!--                <i class="fal fa-search"></i>-->
<!--              </a>-->


            </div>
            <div class="statistic-data-btns">

              <div class="btn-group">
                  <?
                  $days = Az::$app->cpas->cpa->getDayByName();
                  //vdd($days);
                  ?>

                <button value="<?= $days['today'] ?>" class="btn time-btns statistic-btn--first"
                        id="todayTime"><?= Az::l('Сегодня') ?></button>
                <button value="<?= $days['yesterday'] ?>" class="btn time-btns statistic-btn"
                        id="yesterdayTime"><?= Az::l('Вчера') ?></button>
                <button value="<?= $days['week'] ?>" class="btn time-btns statistic-btn"><?= Az::l('Неделя') ?></button>
                <button value="<?= $days['month'] ?>" class="btn time-btns statistic-btn"><?= Az::l('Месяц') ?></button>
                <button value="<?= $days['year'] ?>"
                        class="btn time-btns statistic-btn--second"><?= Az::l('Год') ?></button>

              </div>


            </div>
            <div class="col-md-3 ml-auto d-flex">


                <?
                echo ZButtonWidget::widget([
                    'config' => [
                        'btn' => false,
                        'url' => '/cpas/client/statistic.aspx',
                        'title' => Az::l('Сбросить все фильтры'),
                        'class' => 'reloads',
                        'btnRounded' => false,
                        'icon' => 'fal fa-undo',
                    ]
                ]);

//                echo ZButtonWidget::widget([
//                    'config' => [
//                        'btn' => false,
//                        'url' => '',
//                        'title' => Az::l('Обновить'),
//                        'class' => 'reloads',
//                        'btnRounded' => false,
//                        'icon' => 'fal fa-refresh',
//                    ]
//                ]);
                ?>
              <a  id="applyFilter" style="
  width: 70%;
height: 100%;
padding: 5px;
background-color: #18f988;
color: #fff;
border-radius: 5px;
margin-left: 5px;
text-align: center;
">
                <?php echo Az::l('Обновить') ?>
              </a>
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
        $data = Az::$app->cpas->cpasStats->generateClientStats($user_id, $filter_data);
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
                    'content' => '{JsonExcel}',
                    'options' => ['class' => 'btn-group p-1 {btnSize} {iconSize}']
                ],
                'filter-sort-id' => [
                    'content' => '',
                    'options' => ['class' => 'btn-group p-1 mr-0 {btnSize} {iconSize}']
                ],
            ],
            'config' => [
                'title' => Az::l('Статистика пользователей'),
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
    <?php
    if($this->httpGet('selectedBtnValue') === null){
    ?>
    $(".select-btns[value='time']").addClass('activeBtn');
    <?php
    }
    ?>
    $(".select-btns[value='<?= $filter->selectedBtnValue?>']").addClass('activeBtn');
    $(".time-btns[value='<?= $filter->startdate?>']").addClass('activeBtn');
    $(".year-btn[value='<?= $filter->selectTimes ? $filter->selectTimes : $def?>']").addClass('active-year');
    $('#apply').on('click', function () {
        // let selectedVal = $(this).val();
        $('#filterForm').submit();
    });
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
    $('#applyFilter').on('click', function () {
        $('#filterForm').submit();

    });
    $('.select-times').on('click', function () {
        let selectedVal = $(this).val();
        $('#selectTimes').val(selectedVal);
        $('#filterForm').submit();

    });
    $('#filterForm').submit(function (){
       if ($('#selectedBtnValue').val() !== 'sub'){
           $('#selectedSub').val('')
       }
      return true;
    });

</script>

<?php
//end|JakhongirKudratov|

echo $this->require('\webhtm\cpas\blocks\footer.php');
$this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>
