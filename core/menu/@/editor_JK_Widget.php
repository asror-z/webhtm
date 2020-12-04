<?php

use kartik\form\ActiveForm;
use rmrevin\yii\fontawesome\FA;
use zetsoft\dbdata\ALL\RoleData;
use zetsoft\models\page\PageAction;
use zetsoft\models\core\CoreMenuNew;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\helpers\ZHTML;
use zetsoft\system\helpers\ZJsonHelper;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\incores\ZDynaCheckboxWidget;
use zetsoft\widgets\incores\ZMaterialCheckboxWidget;
use zetsoft\widgets\inputes\ZInputWidget;
use zetsoft\widgets\inputes\ZSelect2WidgetOLD;
use zetsoft\widgets\navigat\ZButtonWidget;


$this->fileCss('https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.css');
$this->fileCss('https://cdn.jsdelivr.net/npm/bootstrap-iconpicker@1.8.2/bootstrap-iconpicker/css/bootstrap-iconpicker.min.css');
$this->fileCss('/publish/menus/editor/editor.css');
$this->fileCss('https://raw.githack.com/ttskch/select2-bootstrap4-theme/master/dist/select2-bootstrap4.css');


$this->fileJs('https://cdn.jsdelivr.net/npm/html5shiv@3.7.3/dist/html5shiv.min.js');
$this->fileJs('https://cdn.jsdelivr.net/npm/jquery-sortable-lists@1.4.0/jquery-sortable-lists.js');
$this->fileJs('https://cdn.jsdelivr.net/npm/respond.js@1.4.2/dest/respond.min.js');
$this->fileJs('https://cdn.jsdelivr.net/npm/bootstrap-iconpicker@1.8.2/bootstrap-iconpicker/js/bootstrap-iconpicker.min.js');
$this->fileJs('https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.full.min.js');


/** @var ZView $this */

$id = $this->httpGet('id');

if (empty($id))
    return $this->alertDanger( $this->httpGet(), 'Please put an ID');

$model = CoreMenuNew::findOne($id);
$json = Az::$app->App->shop->json->run($model);

//vdd($json);

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
    $model->json = json_decode($model->json);

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

$menutable = 'coremenunew';
?>

<style>
   
    .group-text_vall{
        width: 71%;
    }
    .group-targetValue{
        width: 80%;
    }
    .target_section{
        width: 55%;
    }
    

</style>


<div class="pr-2 pl-4">
    <div class="row">
        <div class="col-md-6 section-1">
            <div class="card ">

                <div class="card-header text-white d-flex"><i class="fa fa-chart-pie"></i>
                    <h5>

                        Меню "<?= $model->name ?>" <?= $model->title ?>

                    </h5>

                </div>
                <div class="card-body section-2">
                    <ul id="myEditor" class="sortableLists list-group">
                    </ul>
                </div>
            </div>

            <button id="btnOutput" class="btn-1" class="btn"></button>

        </div>

        <div class="col-md-6">
            <div class="card ">
                <div class="card-header text-white d-flex"><i class="fa fa-chart-pie"></i><h5>Изменить элемент</h5>
                </div>
                <div class="card-body">
                    <? $form = ActiveForm::begin(['id' => 'formEdit']) ?>

                    <div>
                        <div class="form-group section-6">

                            <div class="d-flex align-items-center justify-content-between w-100">

                                <input type="hidden" class="item-menu" id="action" name="action">

                                <div class="d-flex align-items-center w-50">
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
                                    
                                    echo ZSelect2WidgetOLD::widget([
                                        'id' => 'vall',
                                        'data' => $action,
                                        'name' => 'action',
                                        'config' => [
                                            'multiple' => false,
                                            'class' => '',
                                            'placeholder' => ''

                                        ]
                                    ]);
                                    ?>
                                    
                                </div>

                                <div class="d-flex align-items-center w-50 ml-3">

                                    <i class="fas fa-cubes iconn"></i>

                                    <?
                                    echo ZInputWidget::widget([
                                        'id' => 'param',
                                        'name' => 'param',
                                        'config' => [
                                            'class' => 'item-menu inputMenu w-100',
                                        ]
                                    ]);
                                    ?>
                                </div>

                            </div>
                        </div>
                    </div>


                    <div>
                        <div class="form-group section-6">


                                <div class="d-flex align-items-center justify-content-between w-100">

                                    <input type="hidden" id="text_value" class="item-menu" name="text">

                                    <div class="d-flex align-items-center w-50">

                                        <?
                                        echo ZButtonWidget::widget([
                                            'id' => 'bta',
                                            'config' => [
                                                'btnType' => ZButtonWidget::btnType['button'],
                                                'btnStyle' => ZButtonWidget::btnStyle['btn-primary'],
                                                'btnSize' => ZButtonWidget::btnSize['btn-sm'],
                                                'btnRounded' => false,
                                                'hasIcon' => true,
                                                'icon' => 'far fa-' . FA::_COPY,
                                            ]
                                        ]);

                                        echo ZSelect2WidgetOLD::widget([
                                            'id' => 'text_vall',
                                            'data' => $titles,
                                            'config' => [
                                                'multiple' => false,
                                                'class' => '',
                                            ]
                                        ]);
                                        ?>


                                    </div>
                                    <div class="d-flex align-items-center w-50 ml-3">

                                        <span class="iconn"><i id="ico"></i></span>
                                        <div>
                                        <?
                                        echo ZInputWidget::widget([
                                            'id' => 'icon_value',
                                            'name' => 'icon',
                                            'config' => [
                                                'class' => 'item-menu inputMenu w-100',
                                                'readonly' => true
                                            ],

                                        ]);
                                        ?>
                                        </div>
                                 
                                </div>
                            </div>


                        </div>
                    </div>

                    <div class="form-group d-flex ml-2">

                        <div class="input-group">

                            <div class="d-flex w-100">

                                <div class="d-flex w-50">
                                    <div>

                                        <i class="fas fa-bullseye iconn"></i>
                                    </div>
                                    <?

                                    $dataTarget = [
                                        '_self' => '_self',
                                        '_blank' => '_blank',
                                        '_top' => '_top',

                                    ];
                                    echo ZSelect2WidgetOLD::widget([
                                        'id' => 'targetValue',
                                        'data' => $dataTarget,
                                        'name' => 'target',
                                        'config' => [
                                            'multiple' => false,
                                            'class' => 'select-4 item-menu',

                                        ]
                                    ]);
                                    ?>
                                </div>


                                <div class="d-flex ml-4 w-50">
                                    <?
                                    echo ZMaterialCheckboxWidget::widget([
                                        'name' => 'active',
                                        'id' => 'active',
                                        'config' => [
                                            'label' => Az::l('Активен'),
                                            'class' => 'item-menu chek',
                                        ],
                                        'event' => [
                                            'click' => <<<JS
                             function() {
                    if($(this).val() === 'true'){
                        $(this).val(false).removeAttr('checked');
                        
                    }
                    else{
                        $(this).val(true).attr('checked', '1');                    
                    }
         }
JS,

                                        ]
                                    ]);
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="form-group d-flex ml-3 section-3 align-items-center justify-content-start w-100">

                        <div>
                            <i class="fab fa-css3-alt iconn"></i>
                        </div>

                        <div class="w-75">
                            <?

                            echo ZSelect2WidgetOLD::widget([
                                'id' => 'SelectOption',
                                'name' => 'class',
                                'data' => [
                                    'btn' => 'btn',
                                    'mt' => 'mt',
                                    'mt-2' => 'mt-2',
                                    'mt-3' => 'mt-3',
                                    'btn-lg' => 'btn-lg',
                                    'btn-sm' => 'btn-sm',
                                    'btn-primary' => 'btn-primary',
                                    'btn-success' => 'btn-success',
                                    'btn-danger' => 'btn-danger',
                                    'btn-warning' => 'btn-warning',
                                    'btn-info' => 'btn-info',
                                    'btn-dark' => 'btn-dark'
                                ],

                                'config' => [
                                    'multiple' => true,
                                    'class' => 'item-menu',


                                ]
                            ]);
                            ?>
                        </div>
                    </div>




                    <div class=" d-flex ml-2 align-items-center justify-content-start">

                        <div>
                            <i class="fas fa-eye iconn"></i>
                        </div>

                        <div class="w-75">
                            <?
                            echo ZSelect2WidgetOLD::widget([
                                'id' => 'RoleValue',
                                'data' => $roles,
                                'name' => 'role',
                                'config' => [
                                    'multiple' => true,
                                    'class' => 'item-menu',
                                ]
                            ]);
                            ?>


                        </div>

                    </div>


                    <? ActiveForm::end() ?>
                </div>

                <div class="card-footer d-flex col-lg-12 section-4">
                    <div class="btn-group">
                        <?
                        echo ZButtonWidget::widget([
                            'id' => 'btnUpdate',
                            'config' => [
                                'hasIcon' => true,
                                'title' => 'Обновить',
                                'icon' => 'ft fas fa-' . FA::_SYNC_ALT,
                                'btnType' => ZButtonWidget::btnType['button'],
                                'btnStyle' => ZButtonWidget::btnStyle['btn-outline-success'],

                            ]
                        ]);

                        $form = ActiveForm::begin(['id' => 'menuform']);


                        echo $form->field($model, 'json')->hiddenInput(['value' => $json])->label(false);


                        echo ZButtonWidget::widget([
                            'id' => 'valueIc',
                            'config' => [
                                'hasIcon' => true,
                                'title' => 'Сохранить',
                                'icon' => 'ft fas fa-' . FA::_SAVE,
                                'btnType' => ZButtonWidget::btnType['submit'],
                                'btnStyle' => ZButtonWidget::btnStyle['btn-outline-primary'],
                                'btnRounded' => false,
                            ]
                        ]);


                        ActiveForm::end();
                        echo ZButtonWidget::widget([
                            'id' => 'btnAdd',
                            'config' => [
                                'hasIcon' => true,
                                'title' => 'Добавить',
                                'icon' => 'ft fas fa-' . FA::_PLUS,
                                'btnType' => ZButtonWidget::btnType['button'],
                                'btnStyle' => ZButtonWidget::btnStyle['btn-outline-dark'],

                            ]
                        ]);
                        ?>
                    </div>
                    <div class="ml-auto">
                        <div class="btn-group">


                            <?

                            echo ZButtonWidget::widget([
                                'id' => 'delMen',
                                'config' => [
                                    'hasIcon' => true,
                                    'title' => 'Удалить меню',
                                    'icon' => 'ft fas fa-' . FA::_TRASH_ALT,
                                    'btnType' => ZButtonWidget::btnType['button'],
                                    'btnStyle' => ZButtonWidget::btnStyle['btn-outline-danger'],

                                ]
                            ]);


                            echo ZButtonWidget::widget([
                                'id' => 'setDat',
                                'config' => [
                                    'hasIcon' => true,
                                    'title' => 'Примерное меню',
                                    'icon' => 'ft fas fa-' . FA::_CODE,
                                    'btnType' => ZButtonWidget::btnType['button'],
                                    'btnStyle' => ZButtonWidget::btnStyle['btn-outline-primary'],

                                ]
                            ]);

                            ?>

                        </div>
                    </div>


                </div>
                <div class="form-group section-5"><textarea id="out" class="form-control" cols="1" rows="1"></textarea>

                </div>


            </div>
        </div>
    </div>
</div>


<?php

$jsCode = <<<JS

jQuery(document).ready(function () {

    var titles = {titles};
    var icons = {icons};
    var actions = {action};
    var json = {json};
    
    var editIcon = $('#myEditor_icon');
    var formEdit = $('#formEdit');
    
            // WEB ACTION
    var actionTitle = $('#text_vall');
    var webAction = $('#vall');
    var webActValue = $('#action_value');
    var webActIcon = $('#ico');
    
            //TEXT 
    var textValue = $('#text_value');
    var iconValue = $('#icon_value');
    var setExamMenu = $('#setDat');
    var btnOutput = $('#btnOutput');
    var out = $('#out');    
    var targetValue = $('#targetValue');
    
            //PARAMETRS
    var parametrs = $('#param');
    var selectOption = $('#SelectOption');
    var roleValue = $('#RoleValue');
    var menuForm = $('#menuform');
            
            //BTN 
    var updateBtn = $('#btnUpdate');
    var menuDeleteBtn = $('#delMen');
    var myEditor = $('#myEditor');
    var btnAdd = $('#btnAdd');
    
    var active = $('#active');
    
        
    
        
        
      
        
        
        var iconPickerOptions = {searchText: "Buscar...", labelHeader: "{0}/{1}"};
        var sortableListOptions = {
            placeholderCss: {'background-color': "#cccccc"}
        };
        
        var arrayjson = [];
        var editor = new MenuEditor('myEditor', {listOptions: sortableListOptions, iconPicker: iconPickerOptions});
        editor.setForm(formEdit);
        editor.setUpdateButton(updateBtn);
        editor.setData(json);
       
        webAction.on('select2:select', function () {
            actionTitle.val(webAction.val()).select2().trigger('change');
            webActIcon.removeClass();            
            webActIcon.addClass(icons[webAction.val()]); 
            iconValue.val(icons[webAction.val()]);  
        }).on('select2:clear', function () {
            $('#text').val('');
            $('#title').val('');
        });
        
        actionTitle.on('select2:select', function () {
            webAction.val(actionTitle.val()).select2().trigger('change');
            webActIcon.removeClass();
            webActIcon.addClass(icons[actionTitle.val()]);
            iconValue.val(icons[actionTitle.val()]);
        });
        setExamMenu.on('click', function () {
            editor.setData(arrayjson);
        });       

        btnOutput.on('click', function () {
            var str = editor.getString();
            out.text(str);
        });

        updateBtn.click(function () {
            $("#$menutable-json").val(editor.getString());           
            
            textValue.val(titles[actionTitle.val()]);
            $('#action').val(webAction.val());
            editor.update();
            webAction.val(null).trigger("change");
            selectOption.val(null).trigger("change");
            roleValue.val(null).trigger("change");
            targetValue.val(null).trigger("change");
            actionTitle.val(null).trigger("change");
            active.val(null).trigger('change').removeAttr('checked');
            btnOutput.click();
        });

        menuDeleteBtn.click(function () {
            myEditor.empty();
        });

        btnAdd.click(function () {
            textValue.val(titles[actionTitle.val()]);
            //console.log(textValue.val());
            $('#action').val(webAction.val());
            editor.add();
            webAction.val(null).trigger("change");
            selectOption.val(null).trigger("change");
            roleValue.val(null).trigger("change");
            targetValue.val(null).trigger("change");
            actionTitle.val(null).trigger("change");
            active.val(null).trigger('change').removeAttr('checked');
            
            btnOutput.click();
            $("#$menutable-json").val(editor.getString());

        });
        menuForm.submit(function () {
            $("#$menutable-json").val(editor.getString());
            return true;
        });

        var action = webAction.select2({
            allowClear: true,
            placeholder: "Веб действия",

        }).trigger('change');
        var text = actionTitle.select2({
            allowClear: true,
            placeholder: "Текст",

        }).trigger('change');

        var Role = roleValue.select2({
            allowclear: true,
            multiple: true,
            placeholder: 'Доступ запрешён для ..'
        }).trigger('change');
        var target = targetValue.select2({
            allowClear: true,
            placeholder: "Веб цель",

        }).trigger('change');
        selectOption.select2({
            allowClear: true,
            multipe: true,
            placeholder: "Выбрать Css класс",
        }).trigger('change');


        /* ====================================== */

        /** PAGE ELEMENTS **/
        $('[data-toggle="tooltip"]').tooltip();
        $.getJSON("https://api.github.com/repos/davicotico/jQuery-Menu-Editor", function (data) {
            $('#btnStars').html(data.stargazers_count);
            $('#btnForks').html(data.forks_count);
        });
            $('#bta').on('click', function () {
                 copyToClipboard(textValue.val());          ``
             });
             $('#ac_btn').on('click', function () {
                 copyToClipboard(actions[$('#action').val()]);
             });
          
        });
      
JS;


$js = strtr($jsCode, [
    '{titles}' => $titleJS,
    '{action}' => $actionJS,
    '{icons}' => $iconJS,
    '{json}' => $json,
]);


$createMenuJS = file_get_contents(Root . '/publish/menus/editor/editor_new_refactor_JK.js');

$createMenuJS = str_replace('{titles}', $titleJS, $createMenuJS);
$createMenuJS = str_replace('{action}', $actionJS, $createMenuJS);
$createMenuJS = str_replace('{icons}', $iconJS, $createMenuJS);
$createMenuJS = str_replace('{json}', $json, $createMenuJS);

$this->registerJs($createMenuJS);
$this->registerJs($js);

?>









