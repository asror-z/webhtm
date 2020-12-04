<?php


use zetsoft\dbitem\core\WebItem;
use zetsoft\models\dyna\DynaConfig;
use zetsoft\system\actives\ZActiveRecord;
use zetsoft\system\assets\ZColor;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\helpers\ZUrl;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;use zetsoft\widgets\former\ZListWidget;
use zetsoft\widgets\menus\ZMmenuWidget;
use zetsoft\widgets\themes\ZCardWidget;

$action = new WebItem();

$action->title = Azl . 'Страны';
$action->icon = 'fal fa-landmark';
$action->type = WebItem::type['html'];
$action->csrf = true;
$action->debug = false;



$this->paramSet(paramAction, $action);


/** @var ZActiveRecord $model */

/** @var ZView $this */
$modelGet = $this->httpGet('model');

$modelName = $this->bootFull($modelGet);
$model = new $modelName();
   
//Get array from model->columns for exmp: 'name' => 'Название'
$dynaId = $this->httpGet('dynaId');
$coreDyna = DynaConfig::findOne([
    'dynaId' => $dynaId,
    'active' => true
]);

$service = Az::$app->smart->dyna;
$model->kernel();
$columns = $service->getModelColumns($model->columns);

if ($coreDyna) {
    if (!empty($coreDyna->sort)) {
        $columns = $service->fixSortMenu($coreDyna->sort, $model);
    }
}

$theme = $this->httpGet('theme');
$theme = str_replace('panel-', '', $theme);

?>

<div class="row p-3">

    <div class="model col-4">
        <?php

        echo ZListWidget::widget([
            'data' => $columns,
            'config' => [
                'class' => 'get-columns text-dark',
                'hasIcon' => true,
                'icon' => 'fas fa-list',
                'bgcolor' => 'bg-light',
            ]
        ]);
        ?>
    </div>

    <div class="model col-8">
        <?php

        ZCardWidget::begin([
            'id' => 'optionsCard',
            'config' => [
                'hasIcon' => true,
                'icon' => 'fas fa-cog',
                'title' => Az::l('Панель настроек - ') . bname($modelName),
                'type' => ZCardWidget::type['dynCard'],
                'headerColor' => ZColor::color['grey'],
                'footerColor' => ZColor::color['primary-color'],
                'classHeadColor' => 'bg-transparent text-dark',
            ]
        ]);

        $title = Az::l('Выберите колонку с левого меню');
        ?>


    <div id="optionsDyna">
        <h3 class="mt-2"><?= $title ?></h3>
    </div>

    <?php
    ZCardWidget::end();

    ?>
    </div>

</div>

<style>
    .positionClass{
        position: fixed;
        max-width: inherit;
        margin-left: 20em;
        padding-left: 1em;
        padding-right: 3em;
    }
</style>

<script>

    $('.get-columns').on('click', function (e) {

        let attribute = $(e.target).data('item');

        $('#page').loader('show')

        $.ajax({
            type: 'GET',
            url: '/core/dynagrid/dynaform.aspx?dynaId=<?=$dynaId?>&model=<?=$modelGet?>&attribute=' + attribute,
            success: function (response) {

                let icon = $(e.target).find('i').attr('class');
                let text = $(e.target).text().trim();

                $('#page').loader('hide');

                $('.optionsCard-title').text(text);
                $('.optionsCard-icon').attr('class', 'optionsCard-icon ' + icon);

                $('#optionsDyna').html(response);
            }
        });
    });
</script>

