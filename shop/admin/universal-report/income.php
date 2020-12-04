<?php

/**
 *
 * @author OtabekNosirov
 * @author JaloliddinovSalohiddin
 * @author AkromovAzizjon
 *
 */

use Afosto\Acme\Data\Order;
use zetsoft\dbitem\core\WebItem;
use zetsoft\former\order\OrderForm;
use zetsoft\former\reports\ReportsSoldProductsForm;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZDynaWidget;
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

$action->title = Azl . 'Расчет прибыли';
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

    $model = new ReportsSoldProductsForm();

    $model->configs->spa = false;
    //$model->configs->nameShowEx=[];
    $data = Az::$app->market->reports2->soldProductsReport();
    
    $model->columns();


    /** @var ZView $this */
    echo ZDynaWidget::widget([
        'data' => $data,
        'model' => $model,
        'type' => ZDynaWidget::type['form'],
        'rightName' => [
            'export'
        ],
        'leftNameEx' => [
            'search'
        ],
        'config' => [
            'title'=>'Расчет прибыли',
            'type' => 'form',
            'hasToolbar' => true,
            'editableLink' => true,
            'search' => true,
            'copy' => false,
            'columnBefore' => [
                'false'
            ],
            'isCard' => false,
            'columnAfter' => ['asd'],
            'theme' => 'success',
            'xbordered' => false,
                'striped' => false,

        ]
    ]);

    ?>

</div>
<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>
