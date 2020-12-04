<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\models\calls\CallsStats;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\inputes\ZKDateRangePickerWidget;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;

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
    require Root . '/webhtm/shop/agent/manual/header.php';
    require Root . '/webhtm/shop/agent/manual/navbar.php';
?>


<div id="page">

    <?
    /*
     * Dilmurod Axmadov
     *
     */
    echo ZKDateRangePickerWidget::widget([
        'id' => 'date',
        'name' => 'asdasd',
        'config' => [
            'format' => 'Y-m-d'
        ],
        'event' => [
            'apply' => <<<JS
                function (e) {
                             $.ajax({
                                method: "GET",
                                url: '/core/agent/superviserStats.aspx',
                                data: {
                                    date: e.target.value,
                                },
                                succsess: function(response) {
                                }
                             })
                }
JS,

        ]
    ]);

    ?>

    <? require Root . '\webhtm\block\footer\footerAdmin.php' ?>

</body>
</html>

<?php $this->endPage() ?>


