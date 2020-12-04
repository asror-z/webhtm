<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\models\ware\WareEnterItem;
use zetsoft\models\ware\WareExit;
use zetsoft\models\ware\WareExitItem;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZUrl;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\former\ZFormWidget;
use zetsoft\widgets\inputes\ZHHiddenInputWidget;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;
use zetsoft\widgets\themes\ZCardWidget;
use zetsoft\models\ware\WareEnter;


/** @var ZView $this */


/**
 *
 * Action Params
 */

$action = new WebItem();

$action->title = Azl . 'Редактирование'; /*Поступление товаров в склад*/


$action->icon = 'fal fa-film';
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

?>

<div id="page">

    <?

    require Root . '/webhtm/block/navbar/main.php';

    echo ZSessionGrowlWidget::widget();?>

    <div id="content" class="content-footer p-3">


        <div class="row">
            <div class="col-md-12 col-12">

                <?
                $id = $this->httpGet('id');
                $ware = WareExit::findOne($id);
                
                if ($this->modelSave($ware))
                    $this->urlRedirect(['index', true]);

                $ware->columns();

                ZCardWidget::begin([
                    'config' => [
                        'title' => Az::$app->view->title,
                        'type' => ZCardWidget::type['dynCard'],
                    ]
                ]);

                $form = $this->activeBegin();

                echo ZFormWidget::widget([
                    'model' => $ware,
                    'form' => $form,
                ]);

                $this->activeEnd();

                ZCardWidget::end();

                $model = new WareExitItem();
                $model->configs->query = WareExitItem::find()
                    ->where([
                        'ware_exit_id' => $id
                    ]);


                $model->columns();

                /** @var ZView $this */
                echo ZDynaWidget::widget([
                    'model' => $model,
                    'rightBtn' => [
                        'add-tabular-clone-delete' => [
                            'content' => "{add}{tabular}",
                            'options' => ['class' => 'btn-group p-1 mr-2 {btnSize} {iconSize}']
                        ],
                    ],
                    'config' => [
                        'spaHeight' => '500px',
                        'spa' => true,
                        'hasToolbar' => true,
                        'reloadUrl' => ZUrl::to([
                            'process',
                            'id' => $this->httpGet('id')
                        ]),
                        'createUrlAjax' => ZUrl::to([
                            'create-process-item',
                            'id' => $this->httpGet('id'),
                            'ware_id' => $ware->ware_id,
                            'user_company_id' => $ware->user_company_id
                        ]),
                        'createUrl' => 'create-item',
                        'columnBefore' => [
                            'serial',
                            'radio',
                        ],
                        'actionButtons' => [
                        ],
                    ]

                ]);

                ?>

            </div>
        </div>


    </div>

</div>


<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>
