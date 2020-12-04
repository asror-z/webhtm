<?php

use zetsoft\dbitem\data\FormDb;
use zetsoft\dbitem\data\ZFormDB;
use zetsoft\models\App\eyuf\EyufDocument;
use zetsoft\system\Az;
use yii\web\View;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZViewWidget;
use zetsoft\widgets\inputes\ZInputWidgetOLD;
use zetsoft\dbitem\core\WebItem;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;


$action = new WebItem();

$action->title = Azl . 'eyuf';
$action->icon = 'fal fa-print';
$action->type = WebItem::type['html'];
$action->csrf = true;
$action->debug = true;


$this->paramSet(paramAction, $action);


/**
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

//require Root . '/webhtm/block/navbar/eyuf_navbar.php';
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

                /** @var EyufDocument $model */
                $model = EyufDocument::findOne(['id' => $id]);

                $model->configs->edit = false;

                $model->configs->replace = [
                    'eyuf_scholar_id' => function (FormDb $column) {
                        $column->index = true;
                        $column->indexUnique = true;
                        $column->showForm = false;
                        $column->dbType = dbTypeInteger;
                        $column->title = Az::l('Пользователь');
                        $column->widget = ZInputWidgetOLD::class;
                        $column->options = [
                            'config' => [
                                'readonly' => true
                            ]
                        ];

                        return $column;
                    },
                ];

                if ($this->modelSave($model))
                    $this->urlRedirect(['index', true]);


                /*echo ZKAlertBlockWidget::widget([
                    'config' => [
                        'isUseSessionFlash' => false,
                        'delay' => 2000,
                        'body' => Az::$app->App->eyuf->getDocs()->getDocListHTM(),
                        'title' => 'asdasd',
                        'alert' => 'asdsadas',
                        'titleOptions' => [
                            'tag' => 'span',
                            'class' => 'kv-alert-title'
                        ],
                    ],
                ]);*/
                ?>


                <div class="row">
                    <div class="col-md-12 col-12">

                        <?

                        echo ZViewWidget::widget([
                            'model' => $model,
                        ]);


                        ?>

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
