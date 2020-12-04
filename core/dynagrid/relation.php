<?php


use rmrevin\yii\fontawesome\FA;
use zetsoft\dbitem\core\WebItem;
use zetsoft\models\dyna\DynaConfig;
use zetsoft\models\page\PageAction;
use zetsoft\system\actives\ZActiveRecord;
use zetsoft\system\assets\ZColor;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\helpers\ZInflector;
use zetsoft\system\helpers\ZUrl;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\former\ZListWidget;
use zetsoft\widgets\navigat\ZButtonWidget;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;
use zetsoft\widgets\notifier\ZSweetAlert2Widget;
use zetsoft\widgets\themes\ZCardWidget;
use zetsoft\widgets\themes\ZTabForDynaWidget;

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

    echo ZSessionGrowlWidget::widget();$model = $this->model;

    $returns = '';
    $hasMany = $this->httpGet('hasMany');
    foreach ($this->_config['hasMany'] as $className => $relation) {

        $relatedTable = ZArrayHelper::getValue(array_keys($relation), 0);

        $relatedColumn = ZArrayHelper::getValue(array_values($relation), 0);

        $url = $className . '[' . $relatedTable . ']';

        $url = ['/cruds/' . ZInflector::dash($className) . '/index', $url => $model->{$relatedColumn}];

        //  vdd($url);

        $class = $this->bootFull($className);

        if (!class_exists($class))
            continue;

        /** @var Models $item */

        $item = new $class();

        $title = $item->configs->title;


        /**
         *
         * Icon
         */


        $icon = Az::$app->utility->mains->icon();

        $returns .= ZButtonWidget::widget([
            'config' => [
                'btnSize' => ZColor::btnSize['btn-lg'],
                'text' => $title,
                'url' => ZUrl::to($url),
                'icon' => $icon,
                'pjax' => 0,
                'btnRounded' => false,
                'class' => 'ZDynaBTN',
                'btn' => true,
                'target' => ZButtonWidget::target['_self'],
                'btnStyle' => ZButtonWidget::btnStyle['none'],
                'blank' => true,
                'hasIcon' => true,

            ],
            'event' => [
                'click' => 'function (event){e.preventDefault()}'
            ]

        ]);

    }

    $icon = $this->httpGet('icon');
    ZSweetAlert2Widget::begin([
        'id' => $this->id,
        'config' => [

            'title' => $title,
            'class' => '',
            'isFooter' => false,
            'isBtn' => false,
            'icon' => $icon,
        ]
    ]);

    echo $returns;

    ZSweetAlert2Widget::end();




    ?>
</div>
<style>
    #content-panel-id {
        padding: 0;
    }

    .bootstrap-switch .bootstrap-switch-handle-on, .bootstrap-switch .bootstrap-switch-handle-off, .bootstrap-switch .bootstrap-switch-label {
        padding: 0 !important;
        width: 20%;
    }
</style>

<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>



