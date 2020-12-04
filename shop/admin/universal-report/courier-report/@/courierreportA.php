<?php

/**
 *
 *
 * Author:  Asror Zakirov
 * https://www.linkedin.com/in/asror-zakirov
 * https://github.com/asror-z
 *
 */

use Afosto\Acme\Data\Order;
use zetsoft\dbitem\core\WebItem;
use zetsoft\former\order\OrderForm;
use zetsoft\former\reports\ReportsCourierForm;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\inputes\ZKSelect2Widget;
use zetsoft\widgets\inputes\ZSelect2Widget;
use zetsoft\widgets\navigat\ZButtonWidget;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;
use zetsoft\models\shop\ShopBrand;
use zetsoft\former\order\PayBackCCForm;
use zetsoft\models\shop\ShopOrder;
use zetsoft\system\Az;

/** @var ZView $this */

/**
 *
 * Action Params
 */

$action = new WebItem();

$action->title = Azl . 'Отчёт по курьерам';
$action->icon = 'fal fa-calendar-times-o';
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

<div id="page">

    <?
    echo ZSessionGrowlWidget::widget();

    ?>

    <?

    $model = new ReportsCourierForm();

    $model->configs->spa = false;
    //  $model->configs->nameShowEx=[];
    $model->configs->addSort = true;
    $model->columns();
    $data = Az::$app->market->reports->courierReport();

    /** @var ZView $this */

    echo ZButtonWidget::widget([
        'event' => [
            'click' => <<<JS
function(){
        /* var val=$('#id123').children()[1];
         $('#select2-id123-container').html('<span class="select2-selection__clear" title="Удалить все элементы" data-select2-id="3">×</span>'+val.text);
       */
       ///$('#id123').val('1')
       $("#id123").select2("val", "1");
            
}
JS


        ]
    ]);


    echo ZKSelect2Widget::widget([
        'name' => 'dsad',
        'id' => 'id123',
        'config' => [

        ],
        'data' => ['0' => 1, '1' => 2],
        'event' => [
            'opening' => ' console.log("sdadsa") '

        ]
    ]);


    ?>

</div>

<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>
