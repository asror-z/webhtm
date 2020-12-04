<?php


use zetsoft\dbitem\core\WebItem;
use zetsoft\system\actives\ZActiveRecord;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\themes\ZTabWidget;

/** @var ZView $this */
$action = new WebItem();

$action = new WebItem();
$action->debug = false;

Az::$app->controller->layout = 'empty';


/** @var ZActiveRecord $model */
$modelName = str_replace('/', '\\', $this->httpGet('model'));
$id = $this->httpGet('id');

$model = new $modelName();

echo ZTabWIdget::widget([
    'data' => [
        'Columns' => [
            'url' => '/core/dynasettings/visualdyna.aspx?model='
                . $this->httpGet('model') . '&id=' . $this->httpGet('id'),
            'icTarget' => '.tab-content',
            'pushUrl' => false
        ],
        'Table configs' => [
             'url' => '/core/dynasettings/visualdyna.aspx?model='
                 . $this->httpGet('model') . '&id=' . $this->httpGet('id'),
             'icTarget' => '.tab-content',
             'pushUrl' => false
        ],
        'Sorting' => [
            'url' => '/core/dynasettings/sorting.aspx?model=' . $this->httpGet('model') .
                '&id=' . $this->httpGet('id') .
                '&columns=' . $this->httpGet('columns') .
                '&hidden=' . $this->httpGet('hidden'),

            'icTarget' => '.tab-content',
            'pushUrl' => false
        ],
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

    $('.waves-light').click(function (event) {

        $('.nav-item').find('.active').removeClass('active');
        if (!$(event.target).hasClass('active'))
            $(event.target).addClass('active');

    });


</script>


