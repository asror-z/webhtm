<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\dbitem\data\ZFormDB;
use zetsoft\models\App\eyuf\EyufDocument;
use zetsoft\models\App\eyuf\EyufScholar;
use zetsoft\system\kernels\ZView;
use yii\web\View;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZFormWidget;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;
use zetsoft\widgets\themes\ZCardWidget;


/** @var ZView $this */
$action = new WebItem();

$action->title = Azl . 'Добавить документ';

$action->icon = 'fa fa-cropLength';


$action->layout = false;
//$action->layoutFile = 'mainFrame';

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
                
                $user_id = $this->userIdentity()->id;
                $scholar = EyufScholar::findOne(['user_id' => $user_id]);


                /** @var EyufDocument $model */
                $model = new EyufDocument();

                $model->eyuf_scholar_id = $scholar->id;

                $model->configs->nameOff = [
                    'eyuf_scholar_id',
                    'status',
                    'file_comment',
                    'comment',
                    'name',
                    'need_verify',
                    'verified_email'
                ];

                $model->status = false;

                $url = $this->bootEnv('urlScholarIndex');

                $model->columns();

                if ($this->modelSave($model)) {
                    $this->paramSet(paramIframe, true);
                    $this->urlRedirect([$url]);

                }

                ?>
                <div class="row">
                    <div class="col-md-12 col-12">

                        <?

                        $form = $this->activeBegin();

                        ZCardWidget::begin([
                            'config' => [
                                'title' => $this->title,
                                'type' => ZCardWidget::type['dynCard'],
                            ]
                        ]);

                        echo ZFormWidget::widget([
                            'model' => $model,
                            'form' => $form,
                        ]);


                        ZCardWidget::end();

                        $this->activeEnd();
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
