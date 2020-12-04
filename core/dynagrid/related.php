<?php


use rmrevin\yii\fontawesome\FA;
use zetsoft\dbitem\core\WebItem;
use zetsoft\models\dyna\DynaConfig;
use zetsoft\models\page\PageAction;
use zetsoft\system\actives\ZActiveRecord;
use zetsoft\dbitem\data\TabItem;
use zetsoft\system\assets\ZColor;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZUrl;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\system\module\Models;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZCheckButtonWidget;
use zetsoft\widgets\former\ZDynaDialogWidget;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\former\ZExportBtnWidget;
use zetsoft\widgets\former\ZListWidget;
use zetsoft\widgets\inputes\ZHRadioButtonGroupWidget;
use zetsoft\widgets\navigat\ZButtonWidget;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;
use zetsoft\widgets\navigat\ZSmartTabWidget;
use zetsoft\widgets\themes\ZTabForDynaWidget;

$action = new WebItem();

$action->title = Azl . 'Страны';
$action->icon = 'fal fa-landmark';
$action->type = WebItem::type['html'];
$action->csrf = true;
$action->debug = false;

$action->cache = false;

$action->call = null;
$action->loader = false;
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


    /** @var ZView $this */
    //$this->fileCss('/block/assets/ALL/all.css');

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

        <?php
        
        $modelName = $this->httpGet('modelName');
        $relateName = $this->httpGet('relateName');
        $modelId = $this->httpGet('modelId');
        $attribute = $this->httpGet('attribute');
        $fullWebId = $this->httpGet('fullWebId');

        $back = $this->urlGetBack();
        $fkQuery = $this->httpGet('fkQuery');
        $fkAndQuery = $this->httpGet('fkAndQuery');
        $fkOrQuery = $this->httpGet('fkOrQuery');

        $modelClass = $this->bootFull($relateName);

        /** @var Models $model */

        $model = new $modelClass();

        $Q = $modelClass::find();
        if (!empty($fkQuery))
            $Q->where($fkQuery);

        if (!empty($fkAndQuery))
            $Q->where($fkAndQuery);

        if (!empty($fkOrQuery))
            $Q->where($fkOrQuery);

        $model->configs->query = $Q;

        $model->configs->dynaButtons = [
            'update' => [
                'content' => ZButtonWidget::widget([
                        'config' => [

                            'btnType' => ZButtonWidget::btnType['link'],
                            'btnStyle' => ZButtonWidget::btnStyle['btn-transparent'],
                            'btnSize' => ZColor::btnSize['default'],
                            'btnRounded' => false,
                            'title' => Az::l('Назад'),
                            'toggle' => ZButtonWidget::toggle['tooltip'],
                            'hasIcon' => false,
                            'icon' => 'fal fa-times',
                            'class' => 'btn-round mx-2',
                            'data-pjax' => 1,
                        ],
                        'event' => [
                            'click' => <<<JS
            function() {
                    
                var parentWindow = window.parent.document;
                var iframe = parentWindow.getElementById('dynaIframe')
                
                $(iframe).attr('src', '{$fullWebId}');
                 
            }
JS,
                        ]
                    ]) . '{update}',
                'options' => ['class' => 'btn-group p-1 mr-0 {btnSize} {iconSize}']
            ],
            'add-clone-delete' => [
                'content' => '{add}',
                'options' => ['class' => 'btn-group p-1 mr-0 {btnSize} {iconSize}']
            ],
        ];

        $radio = 'radio';
        if ($this->httpGet('isMulti'))
            $radio = 'checkbox';

        $model->columns();

        echo ZDynaWidget::widget([
            'model' => $model,
            'leftBtn' => [
                'search' => [
                    'content' => ZCheckButtonWidget::widget([
                        'model' => $model,

                        'config' => [

                            'btnStyle' => ZButtonWidget::btnStyle['btn-transparent'],
                            'btnSize' => ZExportBtnWidget::btnSize['btn-md'],
                            'btnType' => ZButtonWidget::btnType['link'],
                            'text' => Az::l('Выбрать'),
                            'btnRounded' => false,
                            'icon' => '',
                            'class' => 'btn-sm',
                            'hasIcon' => false,
                            'url' => ZUrl::to([
                                '/api/core/dyna/saveUpdate',
                                'modelName' => $modelName,
                                'modelId' => $modelId,
                                'attribute' => $attribute,
                                'fullWebId' => $fullWebId,
                            ]),
                            'title' => Az::l('Подборка'),
                        ],
                        'event' => [
                            'ajaxSuccess' =>  <<<JS
            function(response) {
             
                var jsPanel = window.parent.document.getElementById('jsPanel-related')
                var dynaFrame = window.parent.document.getElementById('jsPanel-dyna-iframe')
               
                if (dynaFrame)
                    dynaFrame.contentWindow.document.location.reload()
                else
                    window.parent.location.reload()
                
                jsPanel.close()
                
            }
JS,

                        ]
                    ]),
                    'options' => ['class' => 'btn-group p-1 mr-0 {btnSize} {iconSize}']
                ],

            ],
            'config' => [
                'isNewRecord' => true,
                'search' => false,
                'columnBefore' => [
                    $radio,
                    'action'
                        ],
                'actionButtons' => [
                     'clone',
                     'delete'
                ],
                'columnAfter' => false,

            ]
        ])

        ?>

    </div>

</div>

<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>



