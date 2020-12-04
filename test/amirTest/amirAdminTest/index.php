<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;

/** @var ZView $this */

$action = new WebItem();

$action->title = Azl . 'My Site';
$action->icon = 'fa fa-globe';
$action->type = WebItem::type['html'];
$action->debug = true;

$this->paramSet(paramAction, $action);

$this->title();
$this->toolbar();

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

?>

<div id="page">

<?php
    ///$test_model = \zetsoft\models\test\TestOrder::findAl();
    $model = \zetsoft\models\shop\ShopOrder::find()
        ->where(['id' => 5])
        ->one();
?>

    <pre>
        <?php echo $model;?>
    </pre>

</div>

<?php $this->endBody() ?>
</body>
</html>

<?php $this->endPage() ?>

