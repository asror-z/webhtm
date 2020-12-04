<?php

use kartik\grid\CheckboxColumnAsset;
use zetsoft\dbitem\core\WebItem;
use zetsoft\dbitem\data\Config;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZFormBuildWidget;
use zetsoft\widgets\former\ZFormWidget;
use zetsoft\widgets\inputes\ZHInputWidget;
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
$action->csrf = false;
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


    echo ZSessionGrowlWidget::widget(); ?>

    <div id="content" class="content-footer p-3">
        <div class="row">
            <div class="col-md-12">

                <?

                echo ZLibraInputWidget::widget([
                    'config' => [
                        'objectName' => 'libra',
                        'mode' => ZLibraInputWidget::mode['manual'],
                        'inputSelector' => '#shoporder-weight',
                        'autorun' => false,
                    ]
                ]);

                $id = $this->httpGet('id');
                $model = ShopOrder::findOne($id);

                $model->configs->readonlyWidget = [
                    'name',
                ];

                $model->configs->widget = [
                    'weight' => ZHInputWidget::class,
                ];


                $model->configs->rules = [
                    'weight' => [['zetsoft\\system\\validate\\ZRequiredValidator']],
                ];

                $model->configs->options = [
                    'weight' => [
                        'config' => [
                            'buttonText' => Az::l('Установить вес'),
                            'buttonWeight' => true,
                            'classMain' => 'd-flex',
                        ],
                        'event' => [
                            'buttonClick' => <<<JS
                                function() {
                                    libra.updateWeight();
                                }
                            JS,
                        ],
                    ],
                ];

                if ($this->modelSave($model)) {

                    $action = str_replace(end($this->urlArray), 'index', $this->urlArrayStr);
                    $userId = $this->userIdentity()->id;

                    $sessionKey = "Checkdyna-$model->className-$action-$userId";
                    $checks = $this->sessionGet($sessionKey);

                    if (!empty($checks)) {
                        if (!ZArrayHelper::isIn($model->id, $checks)) {
                            $checks[] = $model->id;
                            $this->sessionSet($sessionKey, $checks);
                        }
                    } else {
                        $checks = [$model->id];
                        $this->sessionSet($sessionKey, $checks);
                    }

                    $this->paramSet(paramIframe, true);
                    $this->urlRedirect([
                        'index',
                        'updated' => true
                    ]);

                }

                $model->cards = [
                    [
                        'title' => Az::l('Первый этап'),
                        'shows' => true,
                        'items' => [
                            [
                                'title' => Az::l('Форма'),
                                'shows' => true,
                                'items' => [
                                    [
                                        'name',
                                    ],
                                    [
                                        'weight',
                                    ],
                                    [
                                        'weight_plan',
                                    ],
                                    [
                                        'packaging',
                                    ],
                                ],
                            ],
                        ],
                    ],
                ];
                $model->configs->changeSave = true;
                $model->columns();

                $form = $this->activeBegin();

                echo ZFormBuildWidget::widget([
                    'model' => $model,
                    'form' => $form,
                    'config' => [
                        'isCard' => false,
                        'topBtn' => false,
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
