<?php

use kartik\form\ActiveForm;
use zetsoft\dbdata\ALL\RoleData;
use zetsoft\models\page\PageAction;
use zetsoft\models\menu\Menu;
use zetsoft\models\core\CoreMenuNew;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\helpers\ZHTML;
use zetsoft\system\helpers\ZJsonHelper;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\inputes\ZSelect2WidgetOLD;


$this->fileCss('https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.css');
$this->fileCss('https://cdn.jsdelivr.net/npm/bootstrap-iconpicker@1.8.2/bootstrap-iconpicker/css/bootstrap-iconpicker.min.css');

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

$actions = PageAction::find()
    ->select([
        'id',
        'icon',
        'title',
        'data',
        'name'
    ])
    ->all();


if (Az::$app->request->isPost && $model->load(Az::$app->request->post())) {

    $model->json = json_decode($model->json);

    if ($model->save())
        Az::$app->controller->refresh();
}


?>

<style>
    <?
      require Root . '/webhtm/core/menu/blocks/cssStyles.php';
    ?>


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

        <input id="text1" name="text1" type="hidden">
        <input id="text2" name="text2" type="hidden">

        <input id="actionName" name="actionName" type="hidden">

        <input type="hidden" id="paramVal">

        <div class="col-md-6">
            <div class="card ">
                <div class="card-header text-white d-flex"><i class="fa fa-chart-pie"></i><h5>Изменить элемент</h5>
                </div>
                <div class="card-body">
                    <? $form = ActiveForm::begin(['id' => 'formEdit']) ?>

                    <div class="">
                        <div class="form-group section-6">

                            <label for="action"></label>
                            <input type="hidden" class="form-control item-menu" id="action" name="action"
                                   placeholder="action...">
                            <div>
                                <button type="button" id="ac_btn"
                                        class="btn btn-sm btn-primary btn-2"><i class="far fa-copy"></i></button>
                            </div>

                            <select class="actionSelect select-1" name="action" id="vall">
                                <option></option>
                                <?


                                $datas = ZArrayHelper::map($actions, 'id', 'data');

                                $icons = ZArrayHelper::map($actions, 'id', 'icon');

                                $titles = ZArrayHelper::map($actions, 'id', 'title');

                                $iconsJS = ZJsonHelper::encode($icons);

                                foreach ($datas as $key => $action):
                                    ?>
                                    <option value="<?= $key ?>"><?= $action ?></option>
                                <?

                                endforeach;
                                ?>
                            </select>

                            <label for="param" class="selectLabel"></label>
                            <i class="fas fa-cubes iconn"></i>
                            <input type="text" class="form-control item-menu inputMenu"
                                   id="param"
                                   name="param" placeholder="Параметр">

                        </div>
                    </div>


                    <div class="">
                        <div class="form-group formGroup">
                            <label for="text"></label>
                            <div class="input-group">
                                <div>
                                    <button type="button" class="btn btn-sm btn-primary" id="bta">
                                        <i class="far fa-copy"></i></button>
                                </div>
                                <select class="select" id="text_vall">
                                    <option></option>
                                    <?

                                    $titles = ZArrayHelper::map($actions, 'id', 'title');

                                    $iconsJS = ZJsonHelper::encode($icons);

                                    foreach ($titles as $key => $action):
                                        ?>

                                        <option value="<?= $key ?>"><?= $action ?></option>

                                    <?
                                    endforeach;
                                    ?>
                                </select>

                                <i id="ico"></i><input type="text" class="inputIcon" id="icon_value">
                            </div>
                        </div>
                    </div>

                    <input type="hidden" id="text_value" name="text_value">
                    <input type="hidden" id="action_value" name="action_value">


                    <!--<div class="form-group d-flex">
                        <label for="href"></label>
                        <i class="fas fa-unlink iconn"></i>
                        <input type="text" class="form-control item-menu" id="href" name="href"
                               placeholder="Абсолютный URL">
                    </div>-->

                    <div class="form-group d-flex ml-3 section-3">

                        <label for="class"></label>
                        <input type="hidden" class="form-control item-menu" multiple="multiple" id="class" name="class"
                               placeholder="addclass...">
                        <i class="fab fa-css3-alt isIc"></i>
                        <!--<select id="SelectOption" class="select-2"
                                name="class" multiple="multiple">
                            <option>btn</option>
                            <option>mt</option>
                            <option>mt-2</option>
                            <option>mt-3</option>
                            <option>btn-lg</option>
                            <option>btn-sm</option>
                            <option>btn-primary</option>
                            <option>btn-success</option>
                            <option>btn-danger</option>
                            <option>btn-warning</option>
                            <option>btn-info</option>
                            <option>btn-dark</option>
                        </select>-->
                        <?php
                        echo ZSelect2WidgetOLD::widget([
                            'data' => [
                                'btn',
                                'mt',
                                'mt-2',
                                'mt-3',
                                'btn-lg',
                                'btn-sm',
                                'btn-primary',
                                'btn-success',
                                'btn-danger',
                                'btn-warning',
                                'btn-info',
                                'btn-dark',
                            ],
                            'config' =>[
                                'placeholder' => 'Выбрать Сss класс',
                                'multiple' => false,
                                'class' => 'w-75'
                            ]
                        ]);
                        ?>
                    </div>


                    <div class="form-group d-flex ml-2">
                        <label for="target"></label>
                        <input type="hidden" class="form-control item-menu" id="target" name="target"
                               placeholder="target...">
                        <i class="fas fa-bullseye iconn"></i>
                        <?php
                            echo ZSelect2WidgetOLD::widget([
                                'data' => [
                                    'Self',
                                    'Blank',
                                    'Top'
                                ],
                                'config' =>[
                                        'placeholder' => 'Веб цель',
                                        'multiple' => false,
                                        'class' => 'w-75'
                                    ]
                            ]);
                        ?>
                    </div>

                    <div class="form-group d-flex ml-2">
                        <label for="role"></label>
                        <input type="hidden" class="form-control item-menu" id="role" name="role" placeholder="role...">
                        <i class="fas fa-eye iconn"></i>
                        <?php
                        $roles = (new RoleData)->lang();
                        echo ZSelect2WidgetOLD::widget([
                            'data' => $roles,
                            'config' => [
                                'placeholder' => 'Dilmurod',
                                'class' => 'w-75',
                            ]
                        ]);
                        ?>
                    </div>

                    <? ActiveForm::end() ?>
                </div>

                <div class="card-footer d-flex col-lg-12 section-4">
                    <div class="btn-group">
                        <button type="button" id="btnUpdate" title="Обновить"
                                class="btn btn-rounded  btn-outline-success"
                                disabled style="" aria-label="tooltip"><i
                                    class="fas fa-sync-alt ft"></i>
                        </button>
                        <?php
                        $form = ActiveForm::begin(['id' => 'menuform']);


                        echo $form->field($model, 'json')->hiddenInput(['value' => $json])->label(false);

                        echo ZHTML::submitButton('<i class="fas fa-save ft"></i>', ['class' => 'btn btn-outline-primary', 'title' => 'Сохранить', 'id' => 'valueIc']);

                        ActiveForm::end();

                        ?>
                        <button type="button" class="btn btn-rounded btn-outline-dark" title="Добавить"
                                id="btnAdd"><i class="fas fa-plus ft"></i>
                        </button>
                    </div>
                    <div class="ml-auto">
                        <div class="btn-group">
                            <button type="button" class="btn btn-rounded btn-outline-danger" title="Удалить меню"
                                    id="delMen"><i
                                        class="far fa-trash-alt ft"></i>
                            </button>
                            <button type="button" class="btn btn-rounded btn-outline-primary" title="Примерное меню"
                                    id="setDat">
                                <i class="fas fa-code"></i>
                            </button>

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


$titles = ZArrayHelper::map($actions, 'id', 'title');
$action = ZArrayHelper::map($actions, 'id', 'data');
$icons = ZArrayHelper::map($actions, 'id', 'icon');

$titleJS = ZJsonHelper::encode($titles);
$iconJS = ZJsonHelper::encode($icons);
$actionJS = ZJsonHelper::encode($action);

$menutable = 'coremenunew';


$jsCode = <<<JS

jQuery(document).ready(function () {

    var titles = {titles};
    var icons = {icons};
    var actions = {action};
    var json = {json};
    var texts = '{texts}';
    var textName = '';
    var actionVal = '';
    var editIcon = $('#myEditor_icon');
    var formEdit = $('#formEdit');
    
            // WEB ACTION
    var actionTitle = $('#text_vall');
    var webAction = $('#vall');
    var webActValue = $('#action_value');
    var webActName = $('#actionName');
    var webActIcon = $('#ico');
    var valueReceiver = $('#text2');
    var idSender = $('#text1');  
     
            //TEXT 
    var textValue = $('#text_value');
    var iconValue = $('#icon_value');
    var setExamMenu = $('#setDat');
    var btnOutput = $('#btnOutput');
    var out = $('#out');    
    var targetValue = $('#targetValue');
    
            //PARAMETRS
    var parametrs = $('#param');
    var parametrValue = $('#paramVal');
    var selectOption = $('#SelectOption');
    var roleValue = $('#RoleValue');
    var menuForm = $('#menuform');
            
            //BTN 
    var updateBtn = $('#btnUpdate');
    var menuDeleteBtn = $('#delMen');
    var myEditor = $('#myEditor');
    var btnAdd = $('#btnAdd');
    
    
    
 
    
    
    
        var icon = editIcon.children()[0];
        var iconPickerOptions = {searchText: "Buscar...", labelHeader: "{0}/{1}"};

        var sortableListOptions = {
            placeholderCss: {'background-color': "#cccccc"}
        };
        
        var arrayjson = [
   {
      "icon":"fa fa-line-chart",
      "role":"user",
      "text":"Просмотр  Тип новостей",
      "class":"mt,btn-lg,btn-warning",
      "param":"asror=2",
      "action":"1681",
      "target":"_blank"
   },
   {
      "icon":"fa fa-th",
      "role":"",
      "text":"Редактирование  Мнения о стипендианте",
      "class":"",
      "param":"",
      "action":"734",
      "target":""
   },
   {
      "icon":"fa fa-line-chart",
      "role":"",
      "text":"Просмотр  Тип новостей",
      "class":"",
      "param":"",
      "action":"707",
      "target":""
   },
   {
      "icon":"fa fa-gears",
      "role":"",
      "text":"Изменениe пароля",
      "class":"",
      "param":"",
      "action":"548",
      "target":"_blank"
   }
];

        var editor = new MenuEditor('myEditor', {listOptions: sortableListOptions, iconPicker: iconPickerOptions});
        editor.setForm(formEdit);
        editor.setUpdateButton(updateBtn);
        editor.setData({json});
        
        
        webAction.on('select2:select', function () {
           // document.getElementById('href').setAttribute('disabled', 'disabled');
            var actionVal = webAction.val();
            
            var actionName = webActName.val(actions[actionVal]);
            actionVal = actionName.val();
            
            webActValue.val(actionVal);
            actionTitle.val(actionVal).select2().trigger('change');
            var actionValue = actionTitle.val();
            var textValue = valueReceiver.val(titles[actionValue]);
            
            textValue.val();
            var TextTitleValue =  idSender.val(titles[actionValue]);
            textName = TextTitleValue.val();
            textValue.val(textName);
            var icon = editIcon.children()[0];
            
            webActIcon.removeClass();            
            webActIcon.addClass(icons[actionVal]);
            
            iconValue.val(icons[actionVal]);
            icon.removeClass();
            icon.addClass(icons[actionVal]);
            
        }).on('select2:clear', function () {
        var icon = editIcon.children()[0]; 
           // var x = document.getElementById('href').removeAttribute('disabled');
            $('#text').val('');
            $('#title').val('');
            $(icon).removeClass();            
        });
        
        actionTitle.on('select2:select', function () {
            
            var actionValue = actionTitle.val();
            var textValue = valueReceiver.val(actionValue);
            textValue.val();
            
            webAction.val(actionValue).select2().trigger('change');
            var TextTitleValue =  idSender.val(titles[actionValue]);
            textName = TextTitleValue.val();            
            textValue.val(textName);        
           
            var icon = editIcon.children()[0];            
            $(icon).removeClass();            
            $(icon).addClass(icons[actionValue]);
            iconValue.val(icons[actionValue]);
            
            webActIcon.removeClass();
            webActIcon.addClass(icons[actionValue]);
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
            var action_v = webAction.val();
            $('#action').val(action_v);
            var target_v = targetValue.val();
            $('#target').val(target_v);
            
            var text = actionTitle.val();
            var nameText =  idSender.val(titles[text]);
            var text_val =  nameText.val();           
            textValue.val(text_val);
            
            var actionVal = webAction.val();
            var actionName = webActName.val(actions[actionVal]);
            actionVal = actionName.val();
            webActValue.val(actionVal);
            
            var paramValue = parametrs.val();
            parametrValue.val(paramValue);
            var class_v = selectOption.val();
            $('#class').val(class_v);


            var role_v = roleValue.val();
            $('#role').val(role_v);                                   
            var actionVal = webAction.val();
            iconValue.val(icons[actionVal]);
            
            webActIcon.removeClass();
            webActIcon.addClass(icons[actionVal]);
            webActIcon.removeClass();
            editor.update();

            webAction.val(null).trigger("change");
            $('#class_val').val(null).trigger("change");
            roleValue.val(null).trigger("change");
            targetValue.val(null).trigger("change");
            actionTitle.val(null).trigger("change");
            btnOutput.click();
        });

        menuDeleteBtn.click(function () {
            myEditor.empty();
        });

        btnAdd.click(function () {
    
            var action = webAction.val();
            $('#action').val(action);
            
            var target = targetValue.val();
            $('#target').val(target);
            
            var text = actionTitle.val();
            var nameText =  idSender.val(titles[text]);
            var text_value =  nameText.val();
            textValue.val(text_value);
            
            var class_val = selectOption.val();
            $('#class').val(class_val);
            
            var actionVal = webAction.val();
            var actionName = webActName.val(actions[actionVal]);
            actionVal = actionName.val();
            webActValue.val(actionVal);
            
            var paramValue = parametrs.val();
            parametrValue.val(paramValue);            
            var role_val = roleValue.val();
            $('#role').val(role_val);
            
            iconValue.val(icons[actionVal]);
            webActIcon.addClass(icons[actionVal]);
            webActIcon.removeClass();
            
            var icon = editIcon.children()[0];
            editor.add();            
            webAction.val(null).trigger("change");
            selectOption.val(null).trigger("change");
            
            roleValue.val(null).trigger("change");
            targetValue.val(null).trigger("change");
            actionTitle.val(null).trigger("change");
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
                 copyToClipboard(textValue.val());
             });
             $('#ac_btn').on('click', function () {
                 copyToClipboard(webActValue.val());
             });
          
        });
      
JS;


$js = strtr($jsCode, [
    '{titles}' => $titleJS,
    '{action}' => $actionJS,
    '{icons}' => $iconJS,
    '{json}' => $json,
]);


$textJS = file_get_contents(Root . '/publish/menus/editor/editor_new_refactor.js');

$createMenuJS = strtr($textJS,[
    '{titles}' => $titleJS,
    '{action}' => $actionJS,
    '{icons}' => $iconJS,
    '{json}' => $json,
]);

$this->registerJs($createMenuJS);
$this->registerJs($js);


?>









