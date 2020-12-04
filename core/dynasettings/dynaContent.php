<?php


use zetsoft\dbitem\core\WebItem;
use zetsoft\system\actives\ZActiveRecord;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\themes\ZTabWidget;

$action = new WebItem();
$action->debug = false;
Az::$app->controller->layout = 'empty';

/** @var ZActiveRecord $model */
$modelName = str_replace('/', '\\', $this->httpGet('model'));
$id = $this->httpGet('id');
$model = new $modelName();

echo ZTabWidget::widget([
    'data' => [
        'Columns' => [
             'icTarget' => '#id-aa-classic',
             'pushUrl' => false,
             'url' => '/core/dynasettings/columns.aspx?model=' . $this->httpGet('model')
        ],
        'Table configs' => '222',
        'Sorting' => '333',
    ],
    'config' => [
        'type' => ZTabWidget::Type['classic'],
        'mdTabColor' => ZTabWidget::MdTabColor['blue'],
        'classicTabColor' => ZTabWidget::ClassicTabColor['tabs-primary'],
        'mdPills' => true,
    ]
]);

?>
<script src="https://cdn.jsdelivr.net/npm/intercooler@1.2.3/dist/intercooler.js"></script>

<script>

    $('.nav-link.waves-light').click(function (event) {
        if (!$(event.target).hasClass('active')) {

            let tabText = $(event.target).text();


        }
    });


</script>
