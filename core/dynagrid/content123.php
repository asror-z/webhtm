<?php


use zetsoft\dbitem\core\WebItem;
use zetsoft\models\page\PageAction;
use zetsoft\models\dyna\DynaConfig;
use zetsoft\system\actives\ZActiveRecord;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\former\ZListWidget;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;
use zetsoft\widgets\themes\ZCardWidget;
use zetsoft\widgets\themes\ZTabForDynaWidget;

$action = new WebItem();

$action->type = WebItem::type['html'];
$action->debug = false;

$this->paramSet(paramAction, $action);

Az::$app->controller->layout = 'dyna';



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
    require Root . '/webhtm/block/assets/' . App . '/dyna.php';

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


        /** @var ZActiveRecord $model */
        $modelName = str_replace('/', '\\', $this->httpGet('model'));
        $id = $this->httpGet('id');

        $service = Az::$app->smart->dyna;
        $model = new $modelName();
        $columns = $service->getModelColumns($model->columns);

        $coreDyna = DynaConfig::findOne([
            'dynaId' => $this->httpGet('id')
        ]);

        if ($coreDyna)
            if (!empty($coreDyna->sort))
                $columns = $service->fixSortMenu($coreDyna->sort, $model);

        echo ZTabForDynaWidget::widget([
            'data' => [
                Az::l('Колонки') => [
                    'url' => '/core/dynagrid/columns.aspx?model='
                        . $this->httpGet('model') . '&id=' . $this->httpGet('id'),
                    'icTarget' => '#content-options',
                    'pushUrl' => false
                ],
                Az::l('Настройки таблицы') => [
                    'url' => '/core/dynagrid/configs.aspx?model='
                        . $this->httpGet('model') . '&id=' . $this->httpGet('id'),
                    'icTarget' => '#content-options',
                    'pushUrl' => false
                ],
                Az::l('Сортировка') => [
                    'url' => '/core/dynagrid/sorting.aspx?model=' . $this->httpGet('model') .
                        '&id=' . $this->httpGet('id') .
                        '&columns=' . $this->httpGet('columns') .
                        '&hidden=' . $this->httpGet('hidden'),

                    'icTarget' => '#content-options',
                    'pushUrl' => false
                ],
            ],
            'config' => [
                'type' => ZTabForDynaWidget::Type['classic'],
                'mdTabColor' => ZTabForDynaWidget::MdTabColor['blue'],
                'classicTabColor' => ZTabForDynaWidget::ClassicTabColor['tabs-primary'],
                'mdPills' => true,
            ]
        ]);

        ?>

        <div class="container" id="content-options">

            <div class="columns-row">

                <div class="columns-model">
                    <?

                    echo ZListWidget::widget([
                        'data' => $columns,
                        'config' => [
                            'class' => 'get-columns',
                            'hasIcon' => true,
                            'icon' => 'fas fa-list',
                        ]
                    ]);

                    ?>
                </div>

                <?php
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

                <?php

                ZCardWidget::end();
                ?>

            </div>

        </div>

        <script src="https://cdn.jsdelivr.net/npm/intercooler@1.2.3/dist/intercooler.js"></script>

        <script>
            $(document).on('click', '.get-columns', function (e) {
                let attribute = $(e.target).data('item');
                $.ajax({
                    type: 'GET',
                    url: '/core/dynagrid/dynaform.aspx?id=<?=$this->httpGet('id')?>&attribute=' + attribute + "&model=<?=$this->httpGet('model')?>",
                    success: function(response) {
                        let icon = $(e.target).find('i').attr('class');
                        let text = $(e.target).text().trim();

                        $('.optionsCard-title').text(text);
                        $('.optionsCard-icon').attr('class', 'optionsCard-icon ' + icon);
                        $('#optionsDyna').html(response);
                    }
                });
            });

            $(document).on('click', '.nav-link', function (event) {
                let parent = $('.nav-item');

                parent.find('.active').removeClass('active');
                parent.find('.disabled-tab').removeClass('disabled-tab');

                if (!$(event.target).hasClass('active')) {

                    $(event.target).addClass('active');
                    $(event.target).addClass('disabled-tab');
                }
            });
        </script>

    </div>

</div>


<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>



