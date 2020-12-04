<?php
/** @var ZView $this */

use kartik\ipinfo\IpInfo;
use zetsoft\dbitem\data\ALLApp;
use zetsoft\dbitem\data\Config;
use zetsoft\dbitem\data\Form;
use zetsoft\former\test\TestLaptopForm;
use zetsoft\former\eyuf\EyufProgramForm;
use zetsoft\former\eyuf\RavshanForm;
use zetsoft\models\user\UserBlocked;
use zetsoft\models\core\CoreSession;
use zetsoft\models\user\User;
use zetsoft\system\assets\ZColor;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZVarDumper;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\former\ZArrayWidget;
use zetsoft\widgets\former\ZFormWidget;
use zetsoft\widgets\former\ZFormWizardWidget;
use zetsoft\widgets\inputes\ZHInputWidget;
use zetsoft\widgets\inputes\ZKSelect2Widget;
use zetsoft\widgets\notifier\ZModalNewWidget;
use zetsoft\widgets\themes\ZAdminCardWidget;

global $boot;
$this->cache = true;
$action->debug = true;
//Az::$app->cores->session->setUserSession();
global $boot;
echo $boot->macUser


//$browser = get_browser(null, true);
//print_r($browser);
?>

<div class="row" style="margin-bottom: -30px!important;">
    <div class="col-md-12">

    </div>
    <div class="col-lg-4 col-md-6">
        <script>
            $(document).ready(function () {
                //при нажатию на любую кнопку, имеющую класс .btn
                $(".cardContent").click(function () {
                    //открыть модальное окно с id="myModal"
                    $("#myModal").modal('show');
                });


            });
        </script>

        <?php


        if ($this->userIsGuest()) {

            ZModalNewWidget::begin([
                'id' => 'myModal',
                'config' => [
                    'title' => Az::l('Вход в систему'),
                    'size' => ZModalNewWidget::size['lg']
                ]
            ]);

            ?>

            <div class="col-lg-12 col-md-8 col-sm-6" style="overflow: hidden;">
                <iframe src="/shop/cores/auth/login-frame.aspx" height="600" width="100%" class="border-0"
                        scrolling="no"></iframe>
            </div>

            <?

            ZModalNewWidget::end();
        }
        //        vdd(Az::$app->cores->auth->isGuest());
        //    firstCard
        ?>
    </div>


</div>
<br>
<br>


<!--<iframe src="/cores/main/table.aspx"
    width="100%"
    height="700"
    style="border: none"
    ></iframe>
-->
<?
//$models = new LaptopForm();
//$app = $models->allApp();
//
//$model = Az::$app->forms->formerShax->model($app);
//
//Az::$app->forms->modelz->form($model);
//
//Az::$app->forms->zPjax->begin();
//
//
//
//Az::$app->forms->modelz->post();
//
////Az::$app->forms->active->enableLabel = true;
////Az::$app->forms->active->labelSpan = 4;
//$form = $this->activeBegin();
//
//echo ZFormWidget::widget([
//    'model' => $model,
//    'form' => $form,
//    'config' => [
//        'isCnt' => false,
//        'type' => ZFormWidget::type['allbl'],
//    ]
//]);
//
//
//$this->activeEnd();
//Az::$app->forms->zPjax->end();

$app = new ALLApp();

$config = new Config();
$config->title = Az::l('Компьютеры');

$app->configs = $config;
$app->configs->columnCount = 1;

$app->columns = [

    'name' => function (Form $column) {

        $column->title = Az::l('Название');
        $column->widget = ZHInputWidget::class;
        $column->rules = [
            [
                'zetsoft\\system\\validate\\ZRequiredValidator',
            ],
        ];

        return $column;
    },



    'title' => function (Form $column) {

        $column->title = Az::l('Тайтл');
        $column->widget = ZKSelect2Widget::class;
        $column->data = [
            'default' => 'default',
            'classic' => 'classic',
            'bootstrap' => 'bootstrap',
            'material' => 'material',
            'krajee' => 'krajee',
            'krajee-bs4' => 'krajee-bs4',
        ];
        $column->rules = [
            [
                'zetsoft\\system\\validate\\ZRequiredValidator',
            ],
        ];

        return $column;
    },

    'title2' => function (Form $column) {

        $column->title = Az::l('Тайтл2');
        $column->widget = ZKSelect2Widget::class;
        $column->data = [
            'default' => 'default',
            'classic' => 'classic',
        ];
        $column->rules = [
            [
                'zetsoft\\system\\validate\\ZRequiredValidator',
            ],
        ];

        return $column;
    },
];

$app->cards = [];

$model = Az::$app->forms->former->model($app);


//Az::$app->forms->modelz->form($model);
Az::$app->forms->zPjax->begin();
/*
Az::$app->forms->modelz->post();

Az::$app->forms->active->enableLabel = true;
Az::$app->forms->active->labelSpan = 4;*/
$form = $this->activeBegin();

echo ZFormWidget::widget([
    'model' => $model,
    'form' => $form,
    'config' => [
        'isCnt' => false,
        'type' => ZFormWidget::type['allbl'],
    ]
]);


$this->activeEnd();
Az::$app->forms->zPjax->end();
//$models = new User();
//$form = $this->activeBegin();
//echo ZFormWidgetShakhrizod::widget([
//    'model' => $models,
//    'form' => $form,
//    'config' => [
//        'isCnt' => false,
//        'type' => ZFormWidget::type['allbl'],
//    ]
//]);
//$this->activeEnd();


$model = new EyufProgramForm();

/** @var ZView $this */
//$model->configs->filter = true;
//$model->configs->summary = true;

//$data = Az::$app->App->eyuf->main->formByCountries($model);

//$this->modelPost();

//echo ZArrayWidget::widget([
//    'model' => $model,
//    'data' => $data,
//    'config' => [
//        'title' => Az::l('Статистика в формате стран по программам'),
//        'exportBtn' => Az::$app->forms->export->run($model, $data),
//        'columnCheckbox' => false,
//    ]
//]);

?>

