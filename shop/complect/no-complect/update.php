<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\widgets\inputes\ZHInputWidget;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZFormBuildWidget;
use zetsoft\widgets\former\ZFormWidget;
use zetsoft\widgets\inputes\ZInputBtnWidget;
use zetsoft\widgets\inputes\ZLibraInputWidget;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;
use zetsoft\widgets\themes\ZCardWidget;
use zetsoft\models\shop\ShopOrder;


/** @var ZView $this */


/**
 *
 * Action Params
 */

$action = new WebItem();

$action->title = Azl . 'Редактирование заказа';


$action->icon = 'fa fa-line-chart';
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


        <div class="row">
            <div class="col-md-12">

                <?

                $id = $this->httpGet('id');
                $model = ShopOrder::findOne($id);
                $model->configs->readonlyWidget = [
                    'name',
                ];


                $model->configs->widget = [
                    'weight' => ZHInputWidget::class,
                ];
                $model->configs->nameOn = [
                    'name',
                    'weight',
                    'weight_plan',
                    'packaging',
                    'labelled',
                    'fragile',
                    'size',
                    'volume',
                ];

                $model->configs->widget = [
                    'weight' => ZHInputWidget::class,
                ];
                $model->configs->options = [
                    'weight' => [
                        'config' => [
                            'buttonText' => Azl . 'Установить вес',
                            'buttonId' => 'qwerty'
                        ],
                    ],
                ];


                if ($this->modelSave($model)) {
                    $this->paramSet(paramIframe, true);
                    $this->urlRedirect(['index']);
                }
                $model->configs->changeSave = true;
                $model->columns();

                $form = $this->activeBegin();

                echo ZLibraInputWidget::widget([
                    'config' => [
                        'funcName' => 'libra',
                        'inputSelector' => '#shoporder-weight',
                        'buttonSelector' => '#w13',
                    ]
                ]);

                echo ZFormBuildWidget::widget([
                    'model' => $model,
                    'form' => $form,
                    'config' => [
                        'isCard' => false,
                        'topBtn' => false,
                    ],
                    'event' => [
                        'formOpen' => 'libra'
                    ]
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
