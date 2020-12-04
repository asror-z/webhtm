

<?php




//use zetsoft\dbitem\data\Form;
use rmrevin\yii\fontawesome\FA;
use zetsoft\models\core\CoreInput;
use zetsoft\widgets\charts\ZChartJsPieWidget;
use zetsoft\widgets\former\ZFormWidget;
use zetsoft\widgets\images\ZNanoGaleryWidget;
use zetsoft\widgets\inputes\ZPeriodPickerWidget;
use zetsoft\widgets\inputes\ZPeriodPickerWidgetNew;
use zetsoft\widgets\inputes\ZPeriodPickerWidgetNew2;
use zetsoft\widgets\navigat\ZButtonWidget;

use zetsoft\dbitem\core\WebItem;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\former\ZDynaWidgetBosya;
use zetsoft\widgets\former\ZDynaWidgetnarm;
use zetsoft\widgets\former\ZDynaWidgetRav;
use zetsoft\widgets\menus\ZMmenuWidget;
use zetsoft\widgets\menus\ZMmenuWidgetSh;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;
use zetsoft\models\shop\ShopOrder;
use kartik\builder\Form;
use zetsoft\widgets\themes\ZAdminCardWidgetNew;


/** @var ZView $this */

/**
 *
 * Action Params
 */

$action = new WebItem();

$action->title = Azl . 'Заказы';
$action->icon = 'fal fa-lock';
$action->type = WebItem::type['html'];
$action->csrf = true;
$action->debug = true;
if ($this->httpGet('spa')) {
    $action->debug = false;
}



$this->paramSet(paramAction, $action);

$this->title();
$this->toolbar();


$model = $this->modelGet(CoreInput::class, 4);
/** @var ZView $this */

$items = $this->modelData();
$form = $this->activeBegin();
$this->modelSave($model);
require Root . '/webhtm/block/metas/main.php';
require Root . '/webhtm/block/assets/main.php';

?>


</head>
<body>
<div class="p20 container">



    <button type="button" class="btn btn-lg btn-danger" data-toggle="popover" title="Popover title" data-content="And here's some amazing content. It's very engaging. Right?">Click to toggle popover</button>
</div>


<?php
//echo \zetsoft\widgets\former\ZJqueryScriptDatePickerWidget::widget();
?>


</body>


