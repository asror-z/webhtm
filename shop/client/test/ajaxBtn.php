<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;

$action = new WebItem();

$action->title = Azl . 'Веб-действия';
$action->icon = 'fa fa-globe';
$action->type = WebItem::type['html'];
$action->csrf = false;
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
    require Root . '/webhtm/block/assets/main.php';
    $this->head();

    ?>

</head>


<body class="<?= ZWidget::skin['white-skin'] ?>">

<?php

$this->beginBody();

echo ZNProgressWidget::widget([]);

?>



<a class="btn btn-block btn-outline-primary">

    dobavit

</a>

<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>

