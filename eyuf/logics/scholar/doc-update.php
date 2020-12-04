<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\dbitem\data\ZFormDB;
use zetsoft\models\App\eyuf\EyufDocument;
use zetsoft\service\socket\start;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZFormBuilderWidget;
use zetsoft\widgets\former\ZFormBuildWidget;
use zetsoft\widgets\inputes\ZInputWidget;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;



/** @var ZView $this */
$action = new WebItem();

$action->title = Azl . 'Добавить документ';
$action->icon = 'fa fa-cropLength';


$action->layout = false;

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
    require Root . '/webhtm/block/assets/App/main_eyuf.php';

    $this->head();
    ?>

</head>

<body class="<?= ZWidget::skin['white-skin'] ?>">

<?php
$this->beginBody();
echo ZNProgressWidget::widget([]);

?>

<div id="page">

    <?
    echo ZSessionGrowlWidget::widget();
    ?>

    <div id="content" class="content-footer p-3">
        <div class="row">
            <div class="col-md-12 col-12">

                <?

                $id = $this->httpGet('id');

                $model = EyufDocument::findOne(['id' => $id]);

              
                if ($model === null)
                    return null;

                if ($model->status === true)
                    return $this->urlRedirect('/logics/scholar/index.aspx');

                $model->configs->nameOff = [
                    'status',
                    'scholar_id'
                ];

                $model->configs->replace = [
                    '' => static function (ZFormDb $column) {
                        $column->index = true;
                        $column->indexUnique = true;
                        $column->showForm = false;
                        $column->dbType = dbTypeInteger;
                        $column->title = Az::l('Пользователь');
                        $column->widget = ZHInputWidget::class;
                        $column->options = [
                            'config' => [
                                'readonly' => true
                            ]
                        ];

                        return $column;
                    },
                ];


                if ($this->modelSave($model)) {
                    $this->paramSet(paramIframe, true);
                    $this->urlRedirect(['index', true]);
                }


                ?>


                <div class="row">
                    <div class="col-md-12 col-12">

                        <?

                        echo ZFormBuildWidget::widget([
                            'model' => $model,
                        ]);

                        ?>

                    </div>
                </div>


            </div>
        </div>


    </div>
</div>
</div>
</div>


<?php


$this->endBody()

?>

</body>
</html>

<?php $this->endPage() ?>
