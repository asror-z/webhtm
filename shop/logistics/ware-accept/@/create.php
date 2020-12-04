<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\models\ware\WareAccept;
use zetsoft\service\forms\Active;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZUrl;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZFormBuildWidget;
use zetsoft\widgets\former\ZFormWidget;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;
use zetsoft\widgets\themes\ZCardWidget;


/** @var ZView $this */


/**
 *
 * Action Params
 */

$action = new WebItem();

$action->title = Azl . 'Приёмка от курьера';
$action->icon = 'fal fa-cube';
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
            <div class="col-md-11 mx-auto">

                <?

                $model = new WareAccept();
                //$model->configs->hasLabel = true;
                //$model->configs->beforeSave = false;

                if ($this->modelSave($model)) {

                    $this->paramSet(paramIframe, true);

                    $this->urlRedirect([
                        'process',
                        'ware_accept_id' => $model->id
                    ]);
                }


                $model->configs->nameShowEx = [];
                $model->cards = [
                    [
                        'title' => Az::l('Первый этап'),
                        'items' => [
                            [
                                'title' => Az::l('Форма'),
                                'items' => [
                                    [
                                        'date',
                                        'responsible',
                                        'shop_courier_id',
                                        'shop_shipment_id',
                                        'comment',
                                    ],
                                ],
                            ],
                        ],
                    ]
                ];

                $model->configs->readonlyWidget = [
                    'responsible',
                    'date'
                ]; 
                //$model->responsible = 265;
                $model->responsible = $this->userIdentity()->id;

                $model->columns();


                $active = new Active();
                $active->type = Active::type['vertical'];
                $active->childClass = 'my-3';

                $form = $this->activeBegin($active);

                echo ZFormBuildWidget::widget([
                    'model' => $model,
                    'form' => $form,
                    'config' => [
                        'cols' => 2,
                        'topBtn' => false,
                        'stepType' => ZFormBuildWidget::stepType['none'],
                        'blockType' => ZFormBuildWidget::blockType['naked']
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
