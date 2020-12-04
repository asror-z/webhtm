<?php

use kartik\form\ActiveForm;
use yii\base\Model;
use yii\web\NotFoundHttpException;
use zetsoft\dbitem\core\WebItem;
use zetsoft\system\helpers\ZInflector;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZTabularWidget;
use zetsoft\widgets\menus\ZMmenuWidget;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;

use zetsoft\models\App\eyuf\EyufNeed;


/** @var ZView $this */


/**
 *
 * Action Params
 */

$action = new WebItem();

$action->title = Azl . 'Изменить все - Потребности';
$action->icon = 'fal fa-graduation-cap';
$action->type = WebItem::type['html'];
$action->csrf = true;
$action->debug = true;



$this->paramSet(paramAction, $action);

$this->title();
$this->toolbar();


$modelClassName = $this->bootFullUrl();
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
    require Root . '/webhtm/block/assets/App/main_arbit.php';

    $this->head();

    ?>

</head>


<body class="<?= ZWidget::skin['white-skin'] ?>">

<?php

$this->beginBody();

require Root . '/webhtm/block/navbar/mainArbit.php';;

echo ZNProgressWidget::widget([]);
if (!$this->httpGet('spa'))
    echo ZMmenuWidget::widget();
?>

<div id="page">

    <?


    echo ZSessionGrowlWidget::widget();?>

    <div id="content" class="content-footer p-3">




        <div class="row">
            <div class="col-md-12 col-12">

                <?

                /*
                 * Models save
                 * */

                $allModel = $modelClassName::find()->indexBy('id')->all();

                if (Model::loadMultiple($allModel, Yii::$app->request->post()) && Model::validateMultiple($allModel)) {
                    foreach ($allModel as $model) {
                        $model->save(false);
                    }
                }

                /*
                 * Generate Tabular form
                 * */
                if (class_exists($modelClassName)) {
                    $model = new $modelClassName();
                }else{
                    throw new NotFoundHttpException();
                }
                $form = ActiveForm::begin();
                echo ZTabularWidget::widget([
                    'model' => $model,
                    'form' => $form,
                    'config' => [
                       
                    ]
                ]);
                $form->end();

                ?>
              

            </div>
        </div>


    </div>
    $this->require( '/webhtm/block/footer/mplace/footerAll.php') ?>
</div>


<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>
