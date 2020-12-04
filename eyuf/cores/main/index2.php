<?php

/**
 *
 * @author MurodovMirbosit
 *
 **/


use zetsoft\dbitem\core\WebItem;
use zetsoft\former\eyuf\EyufProgramForm;
use zetsoft\former\shop\ShopDailyReportForm;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;
use zetsoft\system\Az;

/** @var ZView $this */

/**
 *
 * Action Params
 */

$action = new WebItem();

$action->title = Azl . 'Ежедневный отчёт';
$action->icon = 'fal fa-calendar-times-o';
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

    echo ZSessionGrowlWidget::widget(); ?>

    <div id="content">
        <?php
        
        $model = new EyufProgramForm();

        /** @var ZView $this */

        echo ZDynaWidget::widget([
            'model' => $model,
            'data' => Az::$app->App->eyuf->main->formByCountries(),
            'type' => ZDynaWidget::type['form'],
            'config' => [
                'type' => 'form',
                'hasToolbar' => true,
                'columnBefore' => false,
                'actionButtons' => false,
                'columnAfter' => false,
                'createTitle' => Az::l('Создание прихода в склад')
            ],
            'rightBtn' => [
                'update' => [
                    'content' => '',
                    'options' => ['class' => 'btn-group p-1 mr-0 {btnSize} {iconSize}']
                ],

                'system' => [
                    'content' => '',
                    'options' => ['class' => 'btn-group p-1 mr-0 {btnSize} {iconSize}']
                ],

                'add-clone-delete' => [
                    'content' => '',
                    'options' => ['class' => 'btn-group p-1 mr-0 {btnSize} {iconSize}']
                ],

                'filter-sort-id' => [
                    'content' => '',
                    'options' => ['class' => 'btn-group p-1 mr-0 {btnSize} {iconSize}']
                ],

                'statistics' => [
                    'content' => '',
                    'options' => ['class' => 'btn-group p-1 mr-0 {btnSize} {iconSize}']
                ],
                'toggleData' => [
                    'content' => '',
                    'options' => ['class' => 'btn-group p-1 {btnSize} {iconSize}']
                ],
            ],
        ])

        ?>

    </div>
    <?php require Root . '\webhtm\block\footer\footerAdmin.php' ?>
</div>
<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>
