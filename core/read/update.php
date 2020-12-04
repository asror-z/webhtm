<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\service\forms\Active;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZInflector;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZFormBuildWidget;
use zetsoft\widgets\former\ZFormWidget;
use zetsoft\widgets\menus\ZMmenuWidget;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;
use zetsoft\widgets\themes\ZCardWidget;
use zetsoft\models\App\eyuf\EyufNeed;

/** @var ZView $this */


/**
 *
 * Action Params
 * @license Shahzod Gulomqodirov
 */

$action = new WebItem();

$action->title = Azl . 'Редактирование Адреса';


$action->icon = 'fal fa-location-arrow';
$action->type = WebItem::type['html'];
$action->csrf = true;

if ($this->httpGet('spa'))
    $action->debug = false;



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

    if (!$this->httpGet('spa'))
        require Root . '/webhtm/block/navbar/admin.php';

    echo ZSessionGrowlWidget::widget();?>

    <div id="content" class="content-footer p-3">


        <div class="row">
            <div class="col-md-12 col-12">

                <?

                $id = $this->httpGet('id');
                if(!(integer)$id){
                    vdd($id);
                }
                $model = $modelClassName::findOne($id);

                if ($this->modelSave($model)) {

                     $this->paramSet(paramIframe, true);

                     $this->urlRedirect([
                         'index',
                         'sort' => '-id'
                     ]);
                }


                //$active = new Active();

                $form = $this->activeBegin();

                $connection = Az::$app->db;

                $transaction = $connection->beginTransaction();
                try {
                       //vdd(Az::$app->request->post());
                    if ($model->load(Az::$app->request->post())) {

                        $transaction->commit();
                        $this->paramSet(paramIframe, true);

                        $this->urlRedirect([
                            'index',
                            'sort' => '-id'
                        ]);


                    } else {
                    }


                } catch (Exception $e) {
                    $transaction->rollback();
                }


                $stepType = ZFormBuildWidget::stepType['card'];
                if ($this->httpGet('spa'))
                    $stepType = ZFormBuildWidget::stepType['none'];
                echo ZFormBuildWidget::widget([
                    'model' => $model,
                    'form' => $form,
                    'config' => [
                        'stepType' => $stepType,
                        'blockType' => ZFormBuildWidget::blockType['naked'],
                        'topBtn' => true,
                        'botBtn' => true,
                    ],
                ]);

                $this->activeEnd();


                ?>

            </div>
        </div>


    </div>
</div>


<?php $this->endBody() ?>
</body>
</html>

<?php $this->endPage() ?>       
