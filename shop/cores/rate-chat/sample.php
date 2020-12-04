<?php


use zetsoft\dbitem\core\WebItem;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\chates\ZRatChatWidget;

/** @var ZView $this */
$action = new WebItem();

$action->title = Azl . Az::l('Chat');
$action->icon = 'fa fa-area-chart';
$action->type = WebItem::type['html'];
$action->csrf = true;
$action->debug = false;



$this->paramSet(paramAction, $action);
//todo: service call end

$this->title();
$this->toolbar();

/** @var ZView $this */
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


echo ZRatChatWidget::widget([]);


$this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
