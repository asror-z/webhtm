<?php


/**
 * Author:  Xolmat Ravshanov
 * https://www.linkedin.com/in/asror-zakirov
 * https://github.com/asror-z
 *
 */


use zetsoft\dbitem\core\WebItem;
use zetsoft\models\calls\CallsCdr;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\menus\ZMmenuWidget;

/** @var ZView $this */


/**
 *
 * Action Params
 */

$action = new WebItem();

$action->title = Azl . 'Заказы';
$action->icon = 'fa fa-pie-chart';
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


$this->beginBody();
//require Root . '/webhtm/shop/agent/manual/header.php';
//require Root . '/webhtm/shop/supervisor/stats/navbar.php';
if (!$this->httpGet('spa'))
    require Root . '/webhtm/block/navbar/admin.php';
if (!$this->httpGet('spa'))
    echo ZMmenuWidget::widget([
        //'data' => $this->cores->menus->create('mmenu'),
        'config' => [
            'theme' => 'white',
            'content.img.width' => 230,
            'iconbar.top' => [
                "<a href='#/'><i class='fa fa-home'></i>cc</a>",
                "<a href='#/'><i class='fa fa-home'></i>cc</a>",
            ],
            'iconbar.bottom' => [
                "<a href='#/'><i class='fa fa-home'></i>aa</a>",
                "<a href='#/'><i class='fa fa-home'></i>cc</a>",
            ],
            'all.border' => ZMmenuWidget::border['border-full'],
            'menu-effect-slide' => true,
        ],
    ]);
?>


<div id="page">


    <?
    $model = new CallsCdr();

    $operatorNumber = $this->httpGet('number');
    $attribute = $this->httpGet('attribute');
    $attribute = strtoupper($attribute);
    $attribute = str_replace('_', ' ', $attribute);

    $getValue = $this->sessionGet('stat_status');

    if ($getValue !== null && $getValue !== 0) {

        $dateBegin = ZArrayHelper::getValue($getValue, 0);

        $dateEnd = ZArrayHelper::getValue($getValue, 1);

        $dateBegin = strtotime($dateBegin);
        $dateEnd = strtotime($dateEnd);

        $dateBegin = date('d/m/Y H:i:s', $dateBegin);
        $dateEnd = date('d/m/Y H:i:s', $dateEnd);

        $model->configs->query = Az::$app->calls->stats->operatorCalls($operatorNumber, $attribute, $dateBegin, $dateEnd);

    } else
        $model->configs->query = Az::$app->calls->stats->operatorCalls($operatorNumber, $attribute);


    $model->configs->nameOff = [
        'name',
        'clid',
        'call_cdr_id',
        'cid_ani',
        'cid_rdnis',
        'cid_dnid',
        'context',
        'appname',
        'appdata',
        'accountcode',
        'uniqueid',
        'linkedid',
        'extra',
        'lastdata',
        'amaflags',
        'did',
        'cnum',
        'outbound_cnum',
        'outbound_cnam',
        'dst_cnam',
        'linkedid',
        'peeraccount',
        'sequence',

    ];


    $model->columns();


    echo ZDynaWidget::widget([
        'model' => $model,
        'rightNameEx' => [
            'system'
        ],
        'type' => ZDynaWidget::type['model'],
        'config' => [
            'hasToolbar' => true,
        ],
        'rightBtn' => [
            'add-clone-delete' => [
                'content' => '{tabular}{clone}{delete}',
                'options' => ['class' => 'btn-group p-1 mr-0 {btnSize} {iconSize}']
            ],
        ]


    ]);

    ?>


    <? require Root . '\webhtm\block\footer\footerAdmin.php' ?>

    <?php $this->endBody() ?>


</body>
</html>

<?php $this->endPage() ?>
