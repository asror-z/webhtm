<?php

use zetsoft\system\Az;
use zetsoft\dbitem\core\WebItem;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\inputes\ZKDateRangePickerWidgetNurbek;
use zetsoft\widgets\inputes\ZKDateRangePickerWidgetNurbek2;


/** @var ZView $this */

$action = new WebItem();

$action->title = Azl . 'Widget  test';
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
?>

<div id="page">

    <?php

    $chat = Az::$app->tests->socketIoNodirbek->example();
    echo $chat;

    ?>

</div>


<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>
