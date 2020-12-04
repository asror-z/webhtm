<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\dbitem\data\FormDb;
use zetsoft\dbitem\data\ZFormDB;
use zetsoft\models\App\eyuf\EyufReport;
use zetsoft\models\App\eyuf\EyufScholar;
use zetsoft\service\forms\Active;
use zetsoft\system\Az;
use yii\web\View;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZFormBuildWidget;
use zetsoft\widgets\inputes\ZInputWidgetOLD;
use zetsoft\widgets\inputes\ZKSelect2Widget;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;
use function Clue\StreamFilter\fun;


/** @var ZView $this */

$action = new WebItem();

$action->title = Azl . 'Добавить новый отчет';
$action->icon = 'fa fa-cropLength';


//$action->layout = true;

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

                $id = $this->userIdentity()->id;
                $scholar = EyufScholar::findOne([
                    'user_id' => $id
                ]);
                $model = new EyufReport();
                $model->eyuf_scholar_id = $scholar->id;

                $model->configs->replace = [
                    'eyuf_scholar_id' => function (FormDb $column) use($scholar) {

                        $column->index = true;
                        $column->indexUnique = true;
                        $column->dbType = dbTypeInteger;
                        $column->title = Az::l('Пользователь');
                        $column->showForm = false;
                        $column->widget = ZKSelect2Widget::class;
                        $column->options = [
                            'config' => [
                                'readonly' => true
                            ]
                        ];
                        $column->auto = true;
                        $column->autoValue = function () use ($scholar){
                            return $scholar->id;
                        };
                        return $column;
                    },
                ];

                $model->configs->nameOn = [
                    'name',
                    'file',


                ];

                /*
                $model->configs->nameAuto  = false;
                $model->configs->nameValidatorUnique  = false;*/

                $model->columns();

                if ($this->modelSave($model)) {

                    $this->paramSet(paramIframe, true);

                    $this->urlRedirect([
                        '/eyuf/logics/scholar/reports'
                    ]);
                }

                ?>


                <div class="row">
                    <div class="col-md-12 col-12">

                        <?
                        $active = new Active();
                        $active->type = Active::type['horizontal'];
                        $form = $this->activeBegin($active);

                        echo ZFormBuildWidget::widget([
                            'model' => $model,
                            'form' => $form,
                            'config' => [
                                'stepType' => ZFormBuildWidget::stepType['none'],
                                'blockType' => ZFormBuildWidget::blockType['card'],
                            ]
                        ]);
                        $this->activeEnd();
                        ?>

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>


<?php

$this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>

