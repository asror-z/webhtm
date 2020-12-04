<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\former\calls\CallsStatsAgentForm;
use zetsoft\models\shop\ShopCatalog;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\former\ZDynaWidgetFilter;
use zetsoft\widgets\former\ZDynaWidgetShahzodarch;


/** @var ZView $this */


/**
 *
 * Action Params
 */

$action = new WebItem();

$action->title = Azl . 'Cтатистика';
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

    ?>

</head>


<body class="<?= ZWidget::skin['white-skin'] ?>">

<?php

$this->beginBody();

?>

<div class="col-md-12">

<?php

$model = new ShopCatalog();
//$model = new CallStatsAgentForm();
//$model->isNewRecord = false;
echo ZDynaWidgetFilter::widget([
    'model' => $model,
    'config' => [
        'dynaFilter' => true,
        'filter' => true
    ],
]);

?>

</div>


<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>










