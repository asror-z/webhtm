<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\models\App\eyuf\EyufRequest;
use zetsoft\service\forms\Active;
use zetsoft\system\Az;
use yii\web\View;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZFormBuildWidget;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;


/** @var ZView $this */
$action = new WebItem();

$action->title = Azl . 'Создание потребности';
$action->icon = 'fa fa-dashboard';
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

                /** @var EyufRequest $request */
                $model = EyufRequest::findOne($id);

                if ($model === null)
                    return $this->alertDanger( $id, Az::l('EyufRequest Not Exists'));


                $model->configs->denyDB = $model->value;

                $model->configs->changeSave = true;
                $model->configs->changeReload = true;

               /* $model->configs->nameAuto = false;
                $model->configs->nameValidatorUnique = false;*/

                $model->columns();


                if ($this->modelSave($model)) {
                    $this->urlRedirect(['index', true]);
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


        <?php

        $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>
