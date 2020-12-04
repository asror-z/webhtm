<?php


use zetsoft\dbitem\core\SessionItem;
use zetsoft\dbitem\core\WebItem;
use zetsoft\dbitem\data\ALLApp;
use zetsoft\dbitem\data\Config;
use zetsoft\dbitem\data\Form;
use zetsoft\former\shop\shopSizeForm;
use zetsoft\models\dyna\DynaConfig;
use zetsoft\models\dyna\DynaMulti;
use zetsoft\system\actives\ZActiveRecord;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\helpers\ZUrl;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\former\ZFormWidget;
use zetsoft\widgets\inputes\ZHInputWidget;
use zetsoft\widgets\inputes\ZKDatepickerWidget;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;

$action = new WebItem();

$action->title = Azl . 'Страны';
$action->icon = 'fal fa-landmark';
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

    /** @var ZView $this */

    $this->head();

    ?>

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

            $dyna_config = DynaConfig::findOne([
                'dynaId' => $dynaId,
                'active' => true
            ]);

            if ($dyna_config !== null) {
                $dyna_config = new DynaConfig();
                $dyna_config->title = Az::l("Настройки по умолчанию для $dynaId");
                $dyna_config->dynaId = $dynaId;
                $dyna_config->active = true;
                $dyna_config->save();
            }

            $dyna_config_id = ZArrayHelper::getValue($dyna_config, 'id');

            $model = new DynaMulti();
            $model->configs->query = DynaMulti::find()
                ->where([
                    'dynaId' => $dynaId,
                    'active' => true,
                    'dyna_config_id' => $dyna_config_id
                ]);

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

            $model->configs->nameOn = [
                'id',
                'attr',
                'operator',
                'val',
                'group',
            ];


            $model->configs->filter = false;

            $model->columns();

            $iframeUrl = ZUrl::to([
                "/$url",
                'dynaMulti' => $dynaId,
                'dyna_config_id' => $dyna_config_id
            ]);

           
            echo ZDynaWidget::widget([
                'model' => $model,
                'config' => [
                    'isNewRecord' => true,
                    'search' => false,
                    'columnBefore' => [
                        'serial',
                        'sort',
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
                        'operator' => '=',
                        'group' => 'and',
                        'dyna_config_id' => $dyna_config_id,
                        'models' => $this->httpGet('modelName'),
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
