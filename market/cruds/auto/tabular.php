<?php

use kartik\form\ActiveForm;
use yii\base\Model;
use zetsoft\dbitem\core\WebItem;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZTabularWidget;
use zetsoft\widgets\menus\ZMmenuWidget;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;

use zetsoft\models\auto\Auto;


/** @var ZView $this */


/**
 *
 * Action Params
 */

$action = new WebItem();

$action->title = Azl . 'Изменить все - Транспортные средства';
$action->icon = 'fa fa-car';
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

<?php

$this->beginBody();

echo ZNProgressWidget::widget([]);
if (!$this->httpGet('spa'))
    echo ZMmenuWidget::widget();
?>

<div id="page">

    <?

    require Root . '/webhtm/block/navbar/admin.php';

  //  echo ZSessionGrowlWidget::widget();



    ?>

    <div id="content" class="content-footer p-3">




        <div class="row">
            <div class="col-md-12">

                <?

                /*
                 * Models save
                 * */

                $allModel = Auto::find()->indexBy('id')->all();

                if (Model::loadMultiple($allModel, Yii::$app->request->post()) && Model::validateMultiple($allModel)) {
                    foreach ($allModel as $model) {
                        $model->save(false);
                    }
                }

                /*
                 * Generate Tabular form
                 * */
                $model = new Auto();
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
