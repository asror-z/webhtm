<?php

/**
 *
 *
 * Author:  Asror Zakirov
 * https://www.linkedin.com/in/asror-zakirov
 * https://github.com/asror-z
 *
 */

use zetsoft\dbitem\core\WebItem;
use zetsoft\models\calls\CallsStatus;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;

/** @var ZView $this */

/**
 *
 * Action Params
 */

$action = new WebItem();

$action->title = Azl . 'Расчет прибыли';
$action->apps = [
    'shop',
    'shop',
];
$action->icon = 'fal fa-calendar-times-o';
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


<div id="page">

    <?
    echo ZSessionGrowlWidget::widget();

    ?>

    <?
    $this->pjaxBegin();
    $model = new CallsStatus();

    $model->configs->spa = false;
    $model->configs->nameShowEx = [];

    $model->columns();
    $data = Az::$app->market->operatorStats->getOperatorStats();

    /** @var ZView $this */
    echo ZDynaWidget::widget([
        'data' => $data,
        'model' => $model,
        'config' => [
            'pjax'=>false,
            'title' => 'Расчет прибыли',
            'type' => 'form',
            'hasToolbar' => true,
            'editableLink' => true,
            'search' => true,
            'copy' => false,
            'columnBefore' => [
                'false'
            ],
            'isCard' => true,
            'columnAfter' => ['asd'],
            'theme' => 'success',
            'bordered' => false,
            'striped' => false,

        ]
    ]);
    $this->pjaxEnd();
    ?>

</div>
<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>
