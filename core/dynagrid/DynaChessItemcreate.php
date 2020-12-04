<?php


use kartik\grid\DataColumn;
use rmrevin\yii\fontawesome\FA;
use zetsoft\dbitem\core\WebItem;
use zetsoft\models\dyna\DynaChess;
use zetsoft\models\dyna\DynaChessItem;
use zetsoft\models\user\User;
use zetsoft\service\forms\Active;
use zetsoft\service\smart\Dyna;
use zetsoft\system\actives\ZActiveRecord;
use zetsoft\system\Az;
use zetsoft\system\except\ZForbiddenException;
use zetsoft\system\helpers\ZInflector;
use zetsoft\system\helpers\ZUrl;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\former\ZFormBuildWidget;
use zetsoft\widgets\navigat\ZButtonWidget;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;
use zetsoft\widgets\themes\ZCardWidget;

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
    echo ZSessionGrowlWidget::widget(); ?>

    <?

    $id = $this->httpGet('id');

    if (empty($id))
        return new ZForbiddenException();


    $model = new DynaChessItem();

    $model->dyna_chess_id = $id;

    $model->configs->changeSave = true;
    $model->columns();

    $active = new Active();
    $active->method = Active::method['post'];
    $active->type = Active::type['vertical'];
    $active->childClass = 'my-3';

    $form = $this->activeBegin($active);

    echo ZFormBuildWidget::widget([
        'model' => $model,
        'form' => $form,
        'config' => [
            'topBtn' => true,
            'botBtn' => true,
            'stepType' => ZFormBuildWidget::stepType['none'],
            'blockType' => ZFormBuildWidget::blockType['naked']
        ]
    ]);

    $this->activeEnd();

    ?>

</div>


<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>





