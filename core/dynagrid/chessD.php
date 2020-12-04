<?php


use kartik\grid\DataColumn;
use rmrevin\yii\fontawesome\FA;
use zetsoft\dbitem\core\WebItem;
use zetsoft\models\dyna\DynaChess;
use zetsoft\models\user\User;
use zetsoft\service\smart\Dyna;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZUrl;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\navigat\ZButtonWidget;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;

$action = new WebItem();

$action->title = Azl . 'Страны';
$action->icon = 'fal fa-landmark';
$action->type = WebItem::type['html'];
$action->csrf = true;
$action->debug = false;


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

    /** @var ZView $this */
    //$this->fileCss('/block/assets/ALL/all.css');

    $this->head();
    ?>
    <title></title>
</head>

<body class="<?= ZWidget::skin['white-skin'] ?>">

<?php
$this->beginBody();
?>

<div id="page">

    <?
    echo ZSessionGrowlWidget::widget();?>

    <div id="content" class="content-footer p-3">

        <?php
        $models = $this->httpGet('modelClass');
        if (empty($models))
            throw new Exception('Необходимый параметр не найден');

        $query = $this->httpGet('query');

        $model = new DynaChess();
        $model->configs->query = DynaChess::find()
            ->where([
                'id' => 1
            ]);



        $model->columns();
        echo ZDynaWidget::widget([
            'model' => $model,

        ]);
        ?>

    </div>

</div>

<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>



