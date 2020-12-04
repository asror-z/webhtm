 <?php


use rmrevin\yii\fontawesome\FA;
use zetsoft\system\actives\ZActiveRecord;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\menus\ZMmenuWidget;
use zetsoft\widgets\navigat\ZButtonWidget;
use zetsoft\widgets\themes\ZCardWidget;

$action = new WebItem();
$action->debug = false;
Az::$app->controller->layout = 'dyna';

/** @var ZActiveRecord $model */
$service = Az::$app->smart->dyna;
$modelName = str_replace('/', '\\', $this->httpGet('model'));
$model = new $modelName();
$columns = $service->getModelColumns($model->columns);

$data = $service->dataMmenuDyna($columns, $model);

echo ZMmenuWidget::widget([
    'data' => $data,
    'config' => [
        'home' => false,
        'isAll' => true,
        'navbarTitle' => Az::l('Главное меню настроек - ') . bname($modelName),
        'content' => '<div class="dynaMenu"><i class="fas fa-cog dynaSet"></i>&nbsp;&nbsp;<p class="dynaText">Меню DynaGrid</p></div>',
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
        <h3><?=Az::l('Выберите колонку с левого меню Настроек')?></h3>
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

        $(document).on('click', '.get-visuals', function (e) {

            let attribute = $(e.target).data('item');

            $.ajax({
                type: 'GET',
                url: "/core/dynasettings/visualdyna.aspx?id=<?=$this->httpGet('id')?>&model=<?=$this->httpGet('model')?>",
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


