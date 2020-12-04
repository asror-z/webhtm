<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\models\cpas\CpasOffer;
use zetsoft\models\ware\WareEnter;
use zetsoft\models\ware\WareEnterItem;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZUrl;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZFormBuildWidget;
use zetsoft\widgets\former\ZProcessWidget;
use zetsoft\widgets\navigat\ZButtonWidget;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;

/** @var ZView $this */
/**
 *
 * Action Params
 */

$action = new WebItem();
$action->title = Azl . 'Новое поступление товаров в склад';
$action->icon = 'fal fa-film';
$action->type = WebItem::type['html'];
$action->csrf = true;
if ($this->httpGet('spa'))
    $action->debug = false;
$action->cache = false;
$action->call = null;
$action->cacheHttp = false;
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
    require Root . '/webhtm/block/assets/App/main_arbit.php';

    $this->head();
    ?>
</head>
<body class="<?= ZWidget::skin['white-skin'] ?>">
<?php
$this->beginBody();
echo ZNProgressWidget::widget([]);

echo $this->require( '\webhtm\cpas\blocks\header.php');

?>
<div id="page">
    <div id="content" class="content-footer p-3">

        <div class="row">
            <div class="mx-auto col-md-11 col-11">
                <?
                $id = $this->httpGet('id');
                $model = $this->httpGet('model');

                $user_id = $this->httpGet('user_id');
               // vdd($user_id);
                $related = $this->httpGet('related');
                $attribute = $this->httpGet('attribute');
                if ($this->httpGet('id'))
                    $model = $this->bootFull($model)::findOne($id);
                else {
                    $newModel = $this->bootFull($model);
                    $model = new $newModel();

                }
                echo ZProcessWidget::widget([
                    'model' => $model,
                    'config' => [
                        'relatedClass' => $related,
                        'relatedAttr' => $attribute,
                        'readonly' => ['user_id', 'cpas_offer_id'],
                        'dynaConfig' => [
                            'hasToolbar' => true,
                            'columnBefore' => [
                                'false',

                            ],
                            'viewUrl' => '{fullUrl}/view-process.aspx?id={id}',
                            'actionButtons' => [
                                //'clone',
                                //'delete',
                                'view'
                            ],
                            'spaHeight' => [
                                'create' => '800px',
                                'view' => '800px',
                            ],

                            'columnAfter' => false,
                            // 'deleteAllUrl' => '/api/core/dyna/delete-all.aspx?modelClassName={modelClassName}&ware_enter_id=' . $id,

                            'createUrl' => '{fullUrl}/create-process.aspx?model=' . $this->httpGet('model') . '&model_id=' . $id . '&className=' . $related . '&attribute=' . $attribute. '&user_id='.$user_id,
                            'createTitle' => Az::l('Создание поток')

                        ],

                        'formConfig' => [
                                'btnTitle' => Az::l('Сохранить'),
                            //'botBtn' => false,
                            'topBtn' => false,
                            'stepType' => ZFormBuildWidget::stepType['none'],
                            'blockType' => ZFormBuildWidget::blockType['naked']
                        ],
                        'modelNamesEx' => [
                                'user_id',
                                'name'
                        ],
                        'relatedModelNamesEx' => [
                                'created_at',
                                'modified_at',
                                'created_by',
                                'modified_by',
                                'id',
                                'name',
                                'user_id',
                            'click',
                            'lead',
                            'accept',
                            'cancel',
                            'trash',
                            'EPC',
                            'CPC',
                            'CR',
                            'revenue',
                            'expense',
                            'profit',
                            'ROI',
                        ],
                        'modelReadOnlyWidget' => [
                                'cpas_offer_id'
                        ],
                        'card' => [
                            [
                                'title' => Az::l('Первый этап'),
                                'shows' => true,
                                'items' => [
                                    [
                                        'title' => Az::l('Форма'),
                                        'shows' => true,
                                        'items' => [
                                            [
                                                'id',
                                                'name',
                                                'cpas_offer_id',
                                                'user_id',
                                                'title',
                                                'counter',
                                                'widget',
                                                'postback',
                                                'trafficback',
                                                
                                                    [
                                                        'sub1',
                                                        'sub2',
                                                        'sub3',
                                                        'sub4',
                                                        'sub5',
                                                    ],
                                                    [
                                                        'utm_source',
                                                        'utm_company',
                                                        'utm_content',
                                                        'utm_term',
                                                        'created_at',
                                                        'modified_at',
                                                        'created_by',
                                                        'modified_by',
                                                    ]

                                            ],
                                        ],
                                    ],
                                ],
                            ],
                        ]

                    ]
                ]);
                ?>
                    <div class="text-right">
                    <?php

                    if ($this->modelSave($model)) {

                        $this->urlRedirect([
                            '/cpas/client/viewFlow',
                            'id' => $id,

                        ]);

                    }
                  
                    ?>
                    </div>

            </div>
        </div>


    </div>

</div>


<? echo $this->require( '\webhtm\cpas\blocks\footer.php'); ?>
<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>
