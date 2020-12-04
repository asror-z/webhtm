<?php


use kartik\builder\Form;
use kartik\grid\DataColumn;
use zetsoft\dbitem\core\WebItem;
use zetsoft\former\deps\DepsFilterForm;
use zetsoft\models\dyna\DynaConfig;
use zetsoft\models\dyna\DynaMulti;
use zetsoft\service\forms\Active;
use zetsoft\service\forms\ZPjax;
use zetsoft\system\actives\ZActiveRecord;
use zetsoft\system\assets\ZColor;
use zetsoft\system\Az;
use zetsoft\system\column\ZKDataColumn;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\helpers\ZUrl;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\former\ZFormWidget;
use zetsoft\widgets\former\ZListWidget;
use zetsoft\widgets\former\ZMultiWidget;
use zetsoft\widgets\inputes\ZHInputWidget;
use zetsoft\widgets\inputes\ZKSelect2Widget;
use zetsoft\widgets\inputes\ZSelect2Widget;
use zetsoft\widgets\menus\ZMmenuWidget;
use zetsoft\widgets\navigat\ZButtonWidget;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;
use zetsoft\widgets\themes\ZCardWidget;

$action = new WebItem();

$action->title = Azl . 'Страны';
$action->icon = 'fal fa-landmark';
$action->type = WebItem::type['html'];
$action->csrf = true;
$action->debug = false;
$action->loader = false;

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


    /** @var ZView $this */

    $this->head();

    ?>

    <title></title>

</head>

<body class="<?= ZWidget::skin['white-skin'] ?>">

<?php

$this->beginBody();

?>

<div id="page">

    <?

    echo ZSessionGrowlWidget::widget();?>

    <div id="content" class="content-footer p-3">

        <div id="page">

            <?php
            /** @var ZActiveRecord $model */
            /** @var ZView $this */

            $modelClassName = $this->httpGet('modelName');
            $modelClass = $this->bootFull($modelClassName);
            $url = $this->httpGet('url');
            $dynaId = $this->httpGet('dynaId');
            
            $model = new DynaConfig();
            $model->configs->query = DynaConfig::find()
                ->where([
                    'dynaId' => $dynaId,
                ]);

            $model->configs->nameOn = [
                'id',
                'name',
                'active',
            ];

            $model->configs->dynaButtons = [
                'update' => [
                    'content' => '{update}',
                    'options' => ['class' => 'btn-group p-1 mr-0 {btnSize} {iconSize}']
                ],

                'add-clone-delete' => [
                    'content' => '{add}{clone}{delete}',
                    'options' => ['class' => 'btn-group p-1 mr-0 {btnSize} {iconSize}']
                ],
            ];

            $model->configs->filter = false;
            $model->configs->after = [
    'title' => [
                    [
                        'class' => ZKDataColumn::class,
                        'label' => Az::l('Активировать настройки'),
                        'format' => 'raw',
                        'width' => '200px',
                        'value' => static function ($model, $key, $index, DataColumn $dataColumn) use ($url) {
                                      
                            $urlActive = ZUrl::to([
                                '/core/dynagrid/setActive.aspx',
                                'dyna_config_id' => $key,
                                'url' => $url
                            ]);

                            $active = ZArrayHelper::getValue($model, 'active');
                            if (!$active) {
                                return ZButtonWidget::widget([
                                    'config' => [
                                        'text' => Az::l('Активировать'),
                                        'btnType' => ZButtonWidget::btnType['button'],
                                        'btnRounded' => false,
                                        'btnSize' => ZColor::btnSize['btn-md'],
                                        'hasIcon' => false,
                                        'hasConfirm' => true,
                                        'confirm' => Az::l('Вы уверены?'),
                                    ],
                                    'event' => [
                                        'confirmEvent' => <<<JS
                        window.location.href = '$urlActive';
JS,
                                    ]
                                ]);
                            }

                            return Az::l('Активирован');

                        }
                    ]
                ]
            ];

            $model->columns();

            $iframeUrl = ZUrl::to([
                "/$url",
                'dynaMulti' => $dynaId
            ]);

            echo ZDynaWidget::widget([
                'model' => $model,
                'config' => [
                    'isNewRecord' => true,
                    'search' => false,
                    'columnBefore' => [
                        'serial',
                        'checkbox',
                        'action'
                        ],
                    'actionButtons' => [
                        'clone',
                        'delete'
                    ],
                    'columnAfter' => false,
                    'newRecordValues' => [
                        'dynaId' => $dynaId,
                        'active' => true,
                    ]
                ],
            ]);

            ?>

        </div>

    </div>

    <?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>
