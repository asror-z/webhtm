<?php


use zetsoft\models\core\CoreInput;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\former\ZDynaWidget;


$action->title = Azl . 'Список core input';
$action->icon = 'fa fa-th';


/*
 *
 * @property array $zktypeaheadwidget
 * @property array $zselectizewidget
 * @property string $zcheckboximagewidget
 * @property string $zclockpickerwidget
 * @property array $zprettycheckboxwidget
 * @property array $ztinycloudwidget
 * @property array $zfabianmultiselect
 * @property array $ztitatogglewidget
 * @property array $zcheckradiolistwidget
 * @property string $zckeditorwidget
 * @property array $zselectcountrieswidget
 * @property string $zinputwidget
 * @property string $ztextareawidget
 * @property string $zcmultiselectwidget
 * @property string $ziconpickerwidget
 * @property string $zfontawesomeiconpickerwidget
 * @property array $zhcheckboxbuttongroupwidget
 * @property array $zradiobuttongroup
 * @property array $zmultiselectwidget
 * @property array $zcheckboxlistwidget
 * @property int $zhcheckboxwidget
 * @property string $zckeditorjswidget
 * @property string $zhinputwidget
 * @property string $zinputmaskwidget
 * @property array $ztelinputwidget
 * @property string $zhpasswordinputwidget
 * @property array $zhradiobuttongroupwidget
 * @property array $zradiolistwidget
 * @property string $zhtextareawidget
 * @property string $zkcheckboxxwidget
 * @property array $zkdatecontrolwidget
 * @property string $zkdatepickerwidget
 * @property string $zkdaterangepickerwidget
 * @property string $zkdatetimepickerwidget
 * @property array $zfileinputwidget
 * @property string $zknumberwidget
 * @property string $zkpasswordinputwidget
 * @property string $zkrangeinputwidget
 * @property string $zselect2widget
 * @property array $zselect2widgetmultiple
 * @property string $zkselect2widget
 * @property array $zkselect2widgetmultiple
 * @property string $zksortableinputwidget
 * @property string $zkstarratingwidget
 * @property string $zkswitchinputwidget
 * @property array $zktimepickerwidget
 * @property string $zktouchspinwidget
 * @property array $ZMultiWidgetNew
 * @property array $zperiodpickerwidget
 * @property array $zpicklistwidget
 */
$model = new CoreInput();
$model->configs->nameOn = [
    'string_4', // norm
    'zhinputwidget', // norm
    'zpicklistwidget'

   
   
];
/** @var ZView $this */
echo ZDynaWidget::widget([
    'model' => $model,
]);










