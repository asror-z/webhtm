<?php


use zetsoft\dbitem\core\WebItem;
use zetsoft\system\actives\ZActiveRecord;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\themes\ZTabWidget;

/** @var ZView $this */

$action = new WebItem();
$action->type = WebItem::type['html'];
$action->debug = false;
Az::$app->controller->layout = 'empty';

/** @var ZActiveRecord $model */
$modelName = str_replace('/', '\\', $this->httpGet('model'));
$id = $this->httpGet('id');
$model = new $modelName();

echo ZTabWIdget::widget([
    'data' => [
        'Columns' => '11111',
        'Table configs' => '22222',
        'Sorting' => '433333',
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

    const urlArray = {
        'Columns': 'columns',
        'Table configs': 'configs',
        'Sorting': 'sorting',
    };

    const divArray = {
        'Columns': 'id-aa-classic',
        'Table configs': 'id-ab-classic',
        'Sorting': 'id-ac-classic',
    };

    $('.waves-light').click(function (event) {
    if (!$(event.target).hasClass('active')) {

        let text = $(event.target).text();
        $.ajax({
            type: 'GET',
            url: "/core/dynasettings/" + urlArray[text] + ".aspx" +
                "?model=<?=$this->httpGet('model')?>&id=<?=$this->httpGet('id')?>",
            success: function (response) {
                $('#' + divArray[text]).html(response);
            }
        });

    }
    });


</script>
