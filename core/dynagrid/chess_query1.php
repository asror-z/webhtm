<?php


use zetsoft\dbitem\core\WebItem;
use zetsoft\models\dyna\DynaChessQuery;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\former\ZDynaWidget;
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

    echo ZSessionGrowlWidget::widget(); ?>

    <div id="content" class="content-footer p-3">

        <?php

        $modelClass = $this->httpGet('modelClass');
        $id = (int)$this->httpGet('id');

        if (empty($id) || empty($modelClass))
            throw new Exception('Необходимый параметр не найден');

        $model = new DynaChessQuery();

        $model->configs->query = DynaChessQuery::find()
            ->where([
                'dyna_chess_id' => $id
            ]);

        $model->columns();

        echo ZDynaWidget::widget([
            'model' => $model,
            'config' => [
                'isNewRecord' => true,
                'newRecordValues' => [
                    'models' => $modelClass,
                    'dyna_chess_id' => $id,
                    'active' => true,
                    'group' => $model::group['and']
                ],

            ]
        ]);

        ?>

    </div>

</div>

<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>



