<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\models\place\PlaceCountry;
use zetsoft\service\forms\Active;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZUrl;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;

use zetsoft\widgets\former\ZFormBuildWidget;
use zetsoft\widgets\former\ZFormWidget;
use zetsoft\widgets\former\ZFormWizardWidget;
use zetsoft\widgets\menus\ZMmenuWidget;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;
use zetsoft\widgets\themes\ZCardWidget;
use zetsoft\models\auto\Auto;

/** @var ZView $this */


/**
 *
 * Action Params
 */

$action = new WebItem();

$action->title = Azl . 'Создание Адреса';
$action->icon = 'fal fa-location-arrow';
$action->type = WebItem::type['html'];
$action->csrf = true;

if ($this->httpGet('spa'))
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

  //  echo ZSessionGrowlWidget::widget();



    ?>

    <div id="content" class="content-footer p-3">

        <div class="row">
            <div class="col-md-12">

                <?

                $id = $this->httpGet('id');

                if (!empty($id))
                    $model = Auto::findOne($id);
                else
                    $model = new Auto();

                if ($this->httpGet('spa') && empty($id)) {
                    $model->configs->rules = [[validatorSafe]];
                    if ($model->save()) {
                        $this->urlRedirect([
                            'create',
                            'id' => $model->id,
                            'isNew' => true,
                            'spa' => 1,
                        ]);
                    }
                }

                $model->configs->changeSave = true;
                $model->columns();

                if ($this->modelSave($model)) {

                    $this->paramSet(paramIframe, true);
                    $this->urlRedirect([
                        '/' . $this->prelastUrl() . '/index'
                    ]);

                }

                $active = new Active();

                $form = $this->activeBegin($active);

                $isCard = ZFormBuildWidget::stepType['card'];
                if ($this->httpGet('spa'))
                    $isCard = ZFormBuildWidget::stepType['none'];

                echo ZFormBuildWidget::widget([
                    'model' => $model,
                    'form' => $form,
                    'config' => [
                        'stepType' => $isCard,
                        'isStepsVertical' => false
                    ]
                ]);

                $this->activeEnd();

                ?>

            </div>
        </div>


    </div>
    <?

    if (!$this->httpGet('spa'))
        $this->require( '/webhtm\block\footer\mplace\footerAll.php')

    ?>
</div>


<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>
