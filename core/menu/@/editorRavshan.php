<?php

use kartik\form\ActiveForm;
use rmrevin\yii\fontawesome\FA;
use zetsoft\dbdata\ALL\RoleData;
use zetsoft\models\page\PageAction;
use zetsoft\models\menu\Menu;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\helpers\ZJsonHelper;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\inptest\ZMaterialCheckboxWidget;
use zetsoft\widgets\inputes\ZInputWidget;
use zetsoft\widgets\inputes\ZKSelect2Widget;
use zetsoft\widgets\inputes\ZSelect2Widget;
use zetsoft\widgets\navigat\ZButtonWidget;
use zetsoft\widgets\themes\ZCardWidget;

//assets CSS
$this->fileJs('https://cdn.jsdelivr.net/npm/html5shiv@3.7.3/dist/html5shiv.min.js');
$this->fileJs('https://cdn.jsdelivr.net/npm/jquery-sortable-lists@1.4.0/jquery-sortable-lists.js');
$this->fileJs('https://cdn.jsdelivr.net/npm/respond.js@1.4.2/dest/respond.min.js');

/** @var ZView $this */

$id = $this->httpGet('id');

if (empty($id))
    return $this->alertDanger( $this->httpGet(), 'Please put an ID');

$model = Menu::findOne($id);

if (empty($model))
    return $this->alertDanger( 'Model not found', 'Error');


$json = Az::$app->App->shop->json->run($model);

$actions = PageAction::find()
    ->select([
        'id',
        'name',
        'icon',
        'title',
        'data'
    ])
    ->all();


if (Az::$app->request->isPost && $model->load(Az::$app->request->post())) {
    $model->json = json_decode((string)$model->json, true, 512, JSON_THROW_ON_ERROR);

    if ($model->save())
        Az::$app->controller->refresh();
}


$titles = ZArrayHelper::map($actions, 'name', 'title');
$action = ZArrayHelper::map($actions, 'name', 'data');
$icons = ZArrayHelper::map($actions, 'name', 'icon');

$roles = (new RoleData)->lang();

$titleJS = ZJsonHelper::encode($titles);
$iconJS = ZJsonHelper::encode($icons);
$actionJS = ZJsonHelper::encode($action);

$menutable = 'CoreMenu';
?>


<div class="container-fluid">

    <div class="row">

        <div class="col-sm-6"></div>


        <div class="col-sm-6">

            <?
            ZCardWidget::begin([
                'config' => [
                    'hasIcon' => true,
                    'icon' => 'fas fa-user',
                    'title' => 'Change element',
                    'type' => ZCardWidget::type['venCard'],
                ]
            ]);

            $form = ActiveForm::begin(['id' => 'formEdit'])

            ?>

            <div class="row">

                    <?
                    echo ZButtonWidget::widget([
                        'id' => 'ac_btn',
                        'config' => [
                            'btnType' => ZButtonWidget::btnType['button'],
                            'btnStyle' => ZButtonWidget::btnStyle['btn-primary'],
                            'btnSize' => ZButtonWidget::btnSize['btn-sm'],
                            'btnRounded' => false,
                            'hasIcon' => true,
                            'icon' => 'far fa-' . FA::_COPY,
                        ]
                    ]);

                    echo ZKSelect2Widget::widget([
                        'id' => 'web-action',
                        'data' => $action,
                        'name' => 'action',
                        'config' => [
                            'multiple' => false,
                            'placeholder' => Az::l('Веб действия')
                        ]
                    ]);
                    ?>

            </div>
            <div class="row"></div>
            <div class="row"></div>
            <div class="row"></div>
            <div class="row"></div>
            <div class="row"></div>



            <?

            ActiveForm::end();

            ZCardWidget::end();
            ?>

        </div>

    </div>

</div>


<?php

$createMenuJS = file_get_contents(Root . '/webhtm/core/menu/assets/editor/editor_new_refactor_JK.js');
$editor_js = file_get_contents(Root . '/webhtm/core/menu/assets/editor/editor_js.js');


$editor_js = strtr($editor_js, [
    '{titles}' => $titleJS,
    '{action}' => $actionJS,
    '{icons}' => $iconJS,
    '{json}' => $json,
    '{menutable}' => $menutable
]);

$createMenuJS = strtr($createMenuJS, [
    '{titles}' => $titleJS,
    '{action}' => $actionJS,
    '{icons}' => $iconJS,
    '{json}' => $json,

]);

$this->registerJs($createMenuJS);
$this->registerJs($editor_js);

?>









