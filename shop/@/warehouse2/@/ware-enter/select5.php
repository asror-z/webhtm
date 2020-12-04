<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\inputes\ZKSelect2Widget;
use zetsoft\widgets\inputes\ZSelect2Widget;

/** @var ZView $this */

/**
 *
 * Action Params
 */


$action = new WebItem();
$action->title = Azl . Az::l('create');
$action->icon = 'fal fa-calendar-edit';
$action->type = WebItem::type['html'];
$action->csrf = 1;
$action->cache = false;
$action->toolbar = false;
$action->debug = false;
$action->call = null;
$action->cacheHttp = false;

/**@var ZView $this */

$this->paramSet(paramAction, $action);
/**
 *
 * Start Page
 */


$this->beginPage();
?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.4.1/dist/jquery.min.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" rel="stylesheet"/>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>


    <?php


 //   require Root . '/webhtm/block/metas/main.php';
  //  require Root . '/webhtm/block/assets/main.php';

    $this->head();

    ?>

</head>

/warehouse/ware-enter/select2
<body class="<?= ZWidget::skin['white-skin'] ?>">

<?php

$this->beginBody();


?>

<div class="row">

    <div class="col-4">
        <?
        echo ZKSelect2Widget::widget([
            'name' => 'sda'
        ])
        ?>
    </div>

    <div class="col-4">
        <?
        echo ZKSelect2Widget::widget([
            'name' => 'sdssaa'
        ])
        ?>
    </div>

    <div class="col-4">
        <?
        echo ZKSelect2Widget::widget([
            'name' => 'sddsasada'
        ])
        ?>
    </div>

</div>

<?

$this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>




