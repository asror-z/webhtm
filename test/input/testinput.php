<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\models\shop\ShopOrder;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\inputes\ZFileInputWidget;
use zetsoft\widgets\inputes\ZInputWidget;

/** @var ZView $this */

/**
 *
 * Action Params
 */


//start|NurbekMakhmudov|2020-10-23


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
$model = new  ShopOrder();
$attribute = $model->attribute;
?>

<div id="page">


    <div class="col-12 text-center">
        <br><br>
        <?
        echo ZFileInputWidget::widget([
            'id' => 'ZFileInputWidget_56398',
            'data' => [],
            'config' => [

            ],
            'model' => $model,
            'attribute' => $attribute
        ]);
        ?>

    </div>
</div>


<?php

$this->endBody()

//end|NurbekMakhmudov|2020-10-23

?>

</body>
</html>

<?php $this->endPage() ?>
