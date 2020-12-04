<?php

/**
 *
 *
 * Author:  Asror Zakirov
 *
 * https://www.linkedin.com/in/asror-zakirov
 * https://www.facebook.com/asror.zakirov
 * https://github.com/asror-z
 *
 */

use kartik\dynagrid\DynaGrid;
use kartik\editable\Editable;
use kartik\grid\DataColumn;
use rmrevin\yii\fontawesome\FAS;
use yii\data\ActiveDataProvider;
use yii\helpers\Html;
use yii\helpers\Url;
use zetsoft\enums\vade\OrderStatus;
use zetsoft\models\vade\Code;
use zetsoft\models\vade\Order;
use zetsoft\system\actives\ZActiveRecord;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\helpers\ZFormatter;
use zetsoft\system\helpers\ZUrl;
use zetsoft\system\helpers\ZVarDumper;
use zetsoft\widgets\animo\ZRefreshWidget;
use zetsoft\widgets\extend\ZEditable;
use zetsoft\widgets\extend\ZEditableColumn;
use zetsoft\widgets\extend\ZKEditColumn;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\inputes\ZHInputWidget;
use zetsoft\widgets\inputes\ZKDatepickerWidget;
use zetsoft\widgets\inputes\ZKPasswordInputWidget;
use zetsoft\widgets\inputes\ZKSelect2Widget;
use zetsoft\widgets\inputes\ZKSliderWidget;
use zetsoft\widgets\navigat\ZButtonWidget;

//ZRefreshWidget::widget([
//    'iInterval' => 2000,
//    'type' => ZRefreshWidget::Type_Pjax,
//    'sPjaxButton' => '#zGrid_Grid_Reset',
//]);

/** @var ActiveDataProvider $provider */
 
echo ZDynaWidget::widget([
    'id' => 'zGrid',

    'columnAction' => true,
    
    'model' => $form,

    'nameOn' => [
        'name' => [
            'class' => ZKEditColumn::class,
            'attribute' => 'name',
            'sWidget' => ZHInputWidget::class,
            'options'=> [

            ],
            'action' => Url::to(['/codes/order/edit']),
        ],
        'start' => [
            'class' => ZKEditColumn::class,
            'attribute' => 'start',
            'sWidget' => ZHInputWidget::class,
            'options'=> [

            ],
            'action' => Url::to(['/codes/order/edit']),
        ],
        'start_pin',
        'step',
//        'quantity' => [
//            'class' => ZEditColumn::class,
//            'attribute' => 'quantity',
//            'sWidget' => ZKDatepickerWidget::class,
//            'options'=> [
//            ],
//        ],
        'quantity' => [
            'class' => ZEditableColumn::class,
            'attribute' => 'quantity',
//            'sWidget' => ZKDatepickerWidget::class,
//            'options'=> [
//            ],
        ],
//        'quantity',
        'state' => [
            'class' => ZEditableColumn::class,
            'attribute' => 'state',
            'readonly' => true,
            'vAlign' => 'middle',
            'hAlign' => 'center',
            /*'width'=>'250px',*/
            'order' => DynaGrid::ORDER_MIDDLE,
            'value' => function (ZActiveRecord $model, $key, $index, DataColumn $widget) {
                $sAttr = $widget->attribute;

                /** @var Order $model */

                switch (true) {

                    case $model->status === OrderStatus::Sgenerirovan:
                        $sHtm = Html::img(Yii::getAlias(Cdn . '/publish/blocks/Loader/img/Ready.gif'), [
                            'alt' => 'Готово',
                            'title' => 'Готово',
                            'width' => 50,
                            'data-toggle' => 'tooltip',
                        ]);
                        break;

                    default:
                        $sHtm = Html::img(Yii::getAlias(Cdn . '/publish/blocks/Loader/img/Word.gif'), [
                            'alt' => 'В процессе',
                            'title' => 'В процессе',
                            'width' => 50,
                            'data-toggle' => 'tooltip',
                        ]);


                        break;

                }


                return $sHtm;


            },

            'format' => ZDynaWidget::Editable_Format_Raw,

            /*         'filterType' => null,
                     'filter' => null,
                     'filterWidgetOptions' => []*/
        ],
        'ready' => [
            'class' => ZEditableColumn::class,
            'attribute' => 'ready',
            'readonly' => true,
            'vAlign' => 'middle',
            'hAlign' => 'center',
            /*'width'=>'250px',*/
            'order' => DynaGrid::ORDER_MIDDLE,
            'value' => function (ZActiveRecord $model, $key, $index, DataColumn $widget) {

                /* $iCode = Code::find()
                     ->where([
                         'order_id' => $model->id
                     ])
                     ->count();*/

                $filePath = Az::$app->App->vade->code->filePath($model->id);

                if (!file_exists($filePath)){
                     return null;
                }
                $iCode = filesize($filePath);
                $sCode = ZFormatter::formatBytes($iCode);

                return $sCode;

            },

            'format' => ZDynaWidget::Editable_Format_Raw,
        ],


        'download' => [
            'class' => ZEditableColumn::class,
            'attribute' => 'download',
            'readonly' => true,
            'vAlign' => 'middle',
            'hAlign' => 'center',
            /*'width'=>'250px',*/
            'order' => DynaGrid::ORDER_MIDDLE,
            'value' => function (ZActiveRecord $model, $key, $index, DataColumn $widget) {


                $path = Az::$app->App->vade->code->filePath($model->id);

                if (file_exists($path))
                    return ZButtonWidget::widget([

                    ]);
                else
                    return Html::img(Yii::getAlias(Cdn . '/publish/blocks/Loader/img/Warning.png'), [
                        'alt' => 'Файл отсутствует',
                        'title' => 'Файл отсутствует',
                        'width' => 40,
                        'data-toggle' => 'tooltip',
                    ]);

            },

            'format' => ZDynaWidget::Editable_Format_Raw,
        ],
        'status',
        'company_id',
        'product_id',
        'event_id',
    ]

]);

$js2 = <<<JSS
    var grid = $('#' + gridId);
    grid.find('.' + css).each(function () {
        $(this).on('editableSuccess', function () {
            grid.yiiGridView("applyFilter");
        });
    });
JSS;


//$id = $this->grid->options['id'];
//$this->_view->registerJs("kvRefreshEC('{$id}','{$this->_css}');");

