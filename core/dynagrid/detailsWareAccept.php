<?php


/**
 * @author NurbekMakhmudov
 */


use zetsoft\dbitem\core\WebItem;
use zetsoft\system\helpers\ZUrl;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\navigat\ZButtonWidget;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;

//start|NurbekMakhmudov|2020-10-24

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

    $this->head();

    ?>
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

        $modelClassName = $this->httpGet('modelClass');

        $id = $this->httpGet('id');

        if (empty($modelClassName))
            throw new Exception('Необходимый параметр не найден');

        $modelFull = $this->bootFull($modelClassName);

        $model = new $modelFull();

        $model->configs->query = $modelFull::find()->where([
            'id' => $id
        ]);
         
        $model->configs->readonly = true;

        $model->columns();

        echo ZDynaWidget::widget([
            'model' => $model,
            'config' => [
                'hasToolbar' => true,
            ],
        ]);
        ?>

    </div>

</div>

<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage()

//end|NurbekMakhmudov|2020-10-24

?>



