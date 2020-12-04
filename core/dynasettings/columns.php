<?php


use zetsoft\dbitem\core\WebItem;
use zetsoft\system\actives\ZActiveRecord;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\menus\ZMmenuWidget;
use zetsoft\widgets\themes\ZCardWidget;

/** @var ZView $this */

$action = new WebItem();
$action->type = WebItem::type['ajax'];
$action->debug = false;

/** @var ZActiveRecord $model */

$modelName = str_replace('/', '\\', $this->httpGet('model'));
$model = new $modelName();
$columns = Az::$app->smart->dyna->getModelColumns($model->columns);
$data = Az::$app->smart->dyna->mmenuItems($columns);

echo ZMmenuWidget::widget([
    'data' => $data,
    'config' => [
        'home' => false,
        'isAll' => true,
        'navbarTitle' => Az::l('Columns ') . bname($modelName),
        'content' => '<div class="dynaMenu"><i class="fas fa-cog dynaSet"></i>&nbsp;&nbsp;<p class="dynaText">Columns Menu</p></div>',
        'theme' => ZMmenuWidget::theme['theme-light'],
    ]
]);

ZCardWidget::begin([
    'id' => 'optionsCard',
    'config' => [
        'hasIcon' => true,
        'icon' => 'fas fa-cog',
        'title' => Az::l('Панель настроек - ') . bname($modelName),
        'type' => ZCardWidget::type['dynCard'],
    ]
]);

?>

<div id="optionsDyna">
    <h3><?=Az::l('Выберите колонку с левого меню')?></h3>
</div>


<?

ZCardWidget::end();

?>

<script>
    $(document).on('click', '.get-columns', function (e) {

        let attribute = $(e.target).data('item');

        $.ajax({
            type: 'GET',
            url: '/core/dynasettings/dynaform.aspx?id=<?=$this->httpGet('id')?>&attribute=' + attribute + "&model=<?=$this->httpGet('model')?>",
            success: function(response) {
                let icon = $(e.target).find('i').attr('class');
                let text = $(e.target).text().trim();

                $('.optionsCard-title').text(text);
                $('.optionsCard-icon').attr('class', 'optionsCard-icon ' + icon);
                $('#optionsDyna').html(response);
            }
        });

    });
</script>
