<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\models\ware\WareExit;
use zetsoft\models\ware\WareExitItem;
use zetsoft\service\forms\Active;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZFormBuildWidget;
use zetsoft\widgets\former\ZFormWidget;
use zetsoft\widgets\inputes\ZHHiddenInputWidget;
use zetsoft\widgets\inputes\ZInputWidget;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;
use zetsoft\widgets\themes\ZCardWidget;
use zetsoft\models\ware\WareEnterItem;


/** @var ZView $this */


/**
 *
 * Action Params
 */

$action = new WebItem();

$action->title = Azl . 'Создание'; /*Элементы перемещения между складами*/
$action->icon = 'fal fa-barcode-read';
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

?>

<div id="page">

    <?

    echo ZSessionGrowlWidget::widget();?>

    <div id="content" class="content-footer p-3">

        <div class="row justify-content-center">
            <div class="col-md-10 col-10">
                <?
                $id = $this->httpGet('id');
                $ware_id = $this->httpGet('ware_id');
                $user_company_id = $this->httpGet('user_company_id');

                $model = new WareExitItem();

                if ($this->modelSave($model)) {
                    /**
                     * Post save Actions
                     */
                    $this->paramSet(paramIframe, true);
                    $this->urlRedirect([
                        'process',
                        'id' => $id
                    ]);
                }

                $get = $this->httpGet();

                $active = new Active();
                $active->id = ZArrayHelper::getValue($get, 'formId');

                $form = $this->activeBegin($active);

                $model->ware_exit_id = $id;
                $model->configs->widget = [
                    'ware_exit_id' => ZHHiddenInputWidget::class
                ];

                $model->configs->options = [
                    'shop_catalog_id' => [
                         'data' => Az::$app->inputs->depend->getCatalogsByWareExitId($ware_id, $user_company_id)
                    ]
                ];
                $model->columns();


                echo ZFormWidget::widget([
                    'model' => $model,
                    'form' => $form,
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
