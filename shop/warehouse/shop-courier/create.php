<?php

use yii\web\NotFoundHttpException;
use zetsoft\dbitem\core\WebItem;
use zetsoft\models\shop\ShopCourier;
use zetsoft\service\forms\Active;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZInflector;
use zetsoft\system\helpers\ZUrl;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;

use zetsoft\widgets\former\ZFormBuildWidget;
use zetsoft\widgets\former\ZFormWidget;
use zetsoft\widgets\former\ZFormWidgetShahzod;
use zetsoft\widgets\former\ZFormWizardWidget;
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

$action->title = Azl . 'Создание Адреса';
$action->icon = 'fal fa-location-arrow';
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
                $model = new ShopCourier();

                if ($this->modelSave($model)) {


                    /**
                     *
                     * Post save Actions
                     */
                    $this->paramSet(paramIframe, true);
                    $this->urlRedirect([
                        $this->prelastUrl() . '/index',
                    ]);
                }

                
                $active = new Active();

                $form = $this->activeBegin($active);

                $isCard = ZFormBuildWidget::stepType['card'];
                
                if ($this->httpGet('spa'))
                    $isCard = ZFormBuildWidget::stepType['none'];

                echo ZFormWidgetShahzod::widget([
                    'model' => $model,
                    'form' => $form,
                    'config' => [
                        'stepType' => $isCard,
                        'isStepsVertical' => false
                    ]
                ]);

                $this->activeEnd();

                /*ZCardWidget::end();*/

                ?>

            </div>
        </div>


    </div>
</div>


<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>
