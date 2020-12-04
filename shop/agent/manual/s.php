<?php

use PhpPackages\Fs\Dir;
use zetsoft\dbitem\core\WebItem;
use zetsoft\models\cpas\CpasLand;
use zetsoft\models\cpas\CpasStream;
use zetsoft\models\cpas\CpasWidgets;
use zetsoft\models\shop\ShopOrder;
use zetsoft\models\shop\ShopOrderItem;
use zetsoft\system\assets\ZColor;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZCheckDependWidget;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\former\ZDynaWidget_16_iyun;
use zetsoft\widgets\former\ZDynaWidget_Axror2;
use zetsoft\widgets\former\ZDynaWidgetShah;
use zetsoft\widgets\former\ZFormBuildWidget;
use zetsoft\widgets\inputes\ZHHiddenInputWidget;
use zetsoft\widgets\inputes\ZInputWidget;
use zetsoft\widgets\navigat\ZBreadcrumbsWidget;
use zetsoft\widgets\navigat\ZButtonWidget;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;
use zetsoft\widgets\themes\ZCardWidget;
use function GuzzleHttp\Psr7\str;


/** @var ZView $this */


/**
 *
 * Action Params
 */

$action = new WebItem();

$action->title = Azl . 'Создание Бренды';
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
    require Root . '/webhtm/block/assets/main.php';

    $this->head();

    ?>

</head>


<body class="<?= ZWidget::skin['white-skin'] ?>">

<?php

$this->beginBody();


echo ZNProgressWidget::widget([]);

echo ZNProgressWidget::widget([]);


//$sit = $this->httpPost('sites');

?>

<div id="page">
   
    <?

    /*require(Root . '/upload/cpasz/site.php');*/
    
    $model = new CpasLand();
        echo ZDynaWidget::widget([
            'model' => $model,
            'config' => [
                /*'bordered' => false,
                'border' => true,*/

            ],

        ]);

    ?>



</div>


<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>
