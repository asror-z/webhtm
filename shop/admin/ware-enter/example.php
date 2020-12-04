<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\models\cpas\CpasOffer;
use zetsoft\models\ware\WareEnter;
use zetsoft\models\ware\WareEnterItem;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZFormBuildWidget;
use zetsoft\widgets\former\ZProcessWidget;
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
    echo ZSessionGrowlWidget::widget();

    ?>
    <div id="content" class="content-footer p-3">

        <div class="row">
            <div class="mx-auto col-md-11 col-11">
                <?
                $id = $this->httpGet('id');
                $model = $this->httpGet('model');
                $related = $this->httpGet('related');
                $attribute = $this->httpGet('attribute');
                $model = $this->bootFull($model)::findOne($id);
                echo ZProcessWidget::widget([
                    'model' => $model,
                    'config' => [
                        'relatedClass' => $related,
                        'relatedAttr' => $attribute,
                        'dynaConfig' => [
                            'hasToolbar' => true,
                            'columnBefore' => [
                                'serial',
                                'action',
                                'checkbox',
                                'id'
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
                            'createUrl' => '{fullUrl}/create-process.aspx?model-id=' . $id . '&className=' . $related . '&attribute=' . $attribute,
                            'createTitle' => Az::l('Создание прихода в склад')
                        ],
                        'formConfig' => [
                            'btnTitle' => Az::l('Сформировать и закрыть'),
                            'botBtn' => false,
                            'stepType' => ZFormBuildWidget::stepType['none'],
                            'blockType' => ZFormBuildWidget::blockType['naked']
                        ],
                    ]
                ]);
                ?>
            </div>
        </div>


    </div>

</div>

<?
/*if (!$this->httpGet('spa'))
    require(Root . '/webhtm/block\footer\mplace\footerAll.php')*/

?>


<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>
