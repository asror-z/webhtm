<?php

use kartik\form\ActiveForm;
use zetsoft\dbdata\ALL\RoleData;
use zetsoft\models\page\PageAction;
use zetsoft\models\menu\Menu;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\helpers\ZHTML;
use zetsoft\system\helpers\ZJsonHelper;
use zetsoft\system\kernels\ZView;


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

$model = Menu::findOne($id);
$json = Az::$app->App->shop->json->run($model);

$actions = PageAction::find()
    ->select([
        'id',
        'icon',
        'title',
        'data',
    ])
    ->all();


if (Az::$app->request->isPost && $model->load(Az::$app->request->post())) {

    $model->rest = json_decode($model->rest);

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
        <div class="col-md-6" style="padding: 1px !important;">
            <div class="card ">

                <div class="card-header text-white d-flex"><i class="fa fa-chart-pie"></i>
                    <h5>

                        Меню "<?= $model->name ?>" <?= $model->title ?>

                    </h5>

                </div>
                <div class="card-body" style="min-height: 300px;">
                    <ul id="myEditor" class="sortableLists list-group">
                    </ul>
                </div>
            </div>

            <button id="btnOutput" style="visibility: hidden" class="btn "></button>

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
                    <? $form = ActiveForm::begin(['id' => 'frmEdit']) ?>

                    <div class="">
                        <div class="form-group" style="display: flex;width: 100%; margin-top: 20px; margin-right:20px;">

                            <label for="action"></label>
                            <input type="hidden" class="form-control item-menu" id="action" name="action"
                                   placeholder="action...">
                            <div>
                                <button type="button" id="ac_btn" style="margin-right: 10px"
                                        class="btn btn-sm btn-primary"><i class="far fa-copy"></i></button>
                            </div>

                            <select class="actionSelect" style="width:50%;" name="action" id="vall">
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

                            <label for="param" style="margin-right: 10px; margin-left: 5px;"></label>
                            <i class="fas fa-cubes iconn"></i>
                            <input type="text" class="form-control item-menu"
                                   style="width:45%;height: 35px; margin-right: 20px !important;" id="param"
                                   name="param" placeholder="Параметр">

                        </div>
                    </div>


                    <div class="">
                        <div class="form-group" style="margin-left:2px;">
                            <label for="text"></label>
                            <div class="input-group">
                                <div>
                                    <button type="button" class="btn btn-sm btn-primary" id="bta"><i
                                            class="far fa-copy"></i></button>
                                </div>
                                <select style="width:43%; margin-top: 20px !important;" id="text_vall">
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

                                <i id="ico"></i><input type="text"
                                                       style="height: 35px !important; margin-left: 20px; width: 35%; border: 0; border-bottom: 1px solid gray;"
                                                       id="icon_value">
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

                    <div class="form-group d-flex ml-3" style="width: 100%">

                        <label for="class"></label>
                        <input type="hidden" class="form-control item-menu" multiple="multiple" id="class" name="class"
                               placeholder="addclass...">
                        <i class="fab fa-css3-alt isIc"></i>
                        <select id="SelectOption"
                                style="width: 90%;" name="class" multiple="multiple">
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
                        </select>

                    </div>


                    <div class="form-group d-flex ml-2">
                        <label for="target"></label>
                        <input type="hidden" class="form-control item-menu" id="target" name="target"
                               placeholder="target...">
                        <i class="fas fa-bullseye iconn"></i>
                        <select name="target" id="targetValue"  style="width:90%;">
                            <option></option>
                            <option value="_self">Self</option>
                            <option value="_blank">Blank</option>
                            <option value="_top">Top</option>
                        </select>
                    </div>

                    <div class="form-group d-flex ml-2">
                        <label for="role"></label>
                        <input type="hidden" class="form-control item-menu" id="role" name="role" placeholder="role...">
                        <i class="fas fa-eye iconn"></i>
                        <select name="role" id="RoleValue" multiple style="width:90%;">
                            <?
                            $roles = (new RoleData)->lang();

                            foreach ($roles as $key => $value) :
                                ?>

                                <option value="<?= $key ?>"><?= $value ?></option>
                            <?
                            endforeach;
                            ?>
                        </select>
                    </div>

                    <? ActiveForm::end() ?>
                </div>

                <div class="card-footer d-flex col-lg-12" style="padding:1.75rem !important;">
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
                        <button type="button" class="btn btn-rounded btn-outline-dark" title="Добавить" style=""
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
                <div class="form-group" style="visibility: hidden; overflow:scroll;"><textarea id="out"
                                                                                               class="form-control"
                                                                                               cols="1"
                                                                                               rows="1"></textarea>

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

$menutable = 'coremenu';


$jsCode = <<<JS

jQuery(document).ready(function () {

    var titles = {titles};
    var icons = {icons};
    var actions = {action};
    var json = '{json}';
    var texts = '{texts}';
    var textName = '';
    var actionVal = '';
    
    var actionTitle = $('#text_vall');
    var webAction = $('#vall');
    
 
    
    
    
        var icon = $('#myEditor_icon').children()[0];
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
        editor.setForm($('#frmEdit'));
        editor.setUpdateButton($('#btnUpdate'));
        editor.setData({json});
        
        
        webAction.on('select2:select', function () {
           // document.getElementById('href').setAttribute('disabled', 'disabled');
            var actionVal = webAction.val();
            var actionName = $('#actionName').val(actions[actionVal]);
            actionVal = actionName.val();
            $('#action_value').val(actionVal);
             actionTitle.val(actionVal).select2().trigger('change');
             var actionValue = actionTitle.val();
           var textValue = $('#text2').val(titles[actionValue]);
            textValue.val();
            var TextTitleValue =  $('#text1').val(titles[actionValue]);
            textName = TextTitleValue.val();
            $('#text_value').val(textName);
            var icon = $('#myEditor_icon').children()[0];
            
            $(icon).removeClass();            
            $(icon).addClass(icons[actionVal]);
            
            $('#iconValue').val(icons[actionVal]);
            $('#icon_value').val(icons[actionVal]);
            $('#ico').removeClass();
            $('#ico').addClass(icons[actionVal]);
            
        }).on('select2:clear', function () {
        var icon = $('#myEditor_icon').children()[0]; 
           // var x = document.getElementById('href').removeAttribute('disabled');
            $('#text').val('');
            $('#title').val('');
            $(icon).removeClass();            
        });
        
        actionTitle.on('select2:select', function () {
            
            var actionValue = actionTitle.val();
           var textValue = $('#text2').val(actionValue);
            textValue.val();
            
              webAction.val(actionValue).select2().trigger('change');
            var TextTitleValue =  $('#text1').val(titles[actionValue]);
            textName = TextTitleValue.val();
            
            $('#text_value').val(textName);
            
         
           
            var icon = $('#myEditor_icon').children()[0];
            
            $(icon).removeClass();            
            $(icon).addClass(icons[actionValue]);
            
            $('#iconValue').val(icons[actionValue]);
             $('#icon_value').val(icons[actionValue]);
             $('#ico').removeClass();
             $('#ico').addClass(icons[actionValue]);
        });

        $('#setDat').on('click', function () {
            editor.setData(arrayjson);
        });
        $('#btnReload').on('click', function () {

        });

        $('#btnOutput').on('click', function () {
            var str = editor.getString();
            $("#out").text(str);
        });

        $("#btnUpdate").click(function () {
            $("#$menutable-json").val(editor.getString());
            var action_v = webAction.val();
            $('#action').val(action_v);

            var target_v = $('#targetValue').val();
            $('#target').val(target_v);
            
            var text = actionTitle.val();
            var nameText =  $('#text1').val(titles[text]);
            var text_val =  nameText.val();
           
            $('#text_value').val(text_val);
            
            var actionVal = webAction.val();
            var actionName = $('#actionName').val(actions[actionVal]);
            actionVal = actionName.val();
            $('#action_value').val(actionVal);
            
            
            
            var paramValue = $('#param').val();
            $('#paramVal').val(paramValue);


            var class_v = $('#SelectOption').val();
            $('#class').val(class_v);


            var role_v = $('#RoleValue').val();
            $('#role').val(role_v);
                                    
            var actionVal = webAction.val();
            $('#icon_value').val(icons[actionVal]);
            $('#ico').removeClass();
            $('#ico').addClass(icons[actionVal]);
            $('#ico').removeClass();
            editor.update();

            webAction.val(null).trigger("change");
            $('#class_val').val(null).trigger("change");
            $('#RoleValue').val(null).trigger("change");
            $('#targetValue').val(null).trigger("change");
            actionTitle.val(null).trigger("change");
            $('#btnOutput').click();
        });

        $('#delMen').click(function () {
            $('#myEditor').empty();
        });



        


        $('#btnAdd').click(function () {
    
            var action = webAction.val();
            $('#action').val(action);
            
            var target = $('#targetValue').val();
            $('#target').val(target);
            
            var text = actionTitle.val();
            var nameText =  $('#text1').val(titles[text]);
            var text_value =  nameText.val();
            $('#text_value').val(text_value);
            
            var class_val = $('#SelectOption').val();
            $('#class').val(class_val);
            
            var actionVal = webAction.val();
            var actionName = $('#actionName').val(actions[actionVal]);
            actionVal = actionName.val();
            $('#action_value').val(actionVal);
            
            var paramValue = $('#param').val();
            $('#paramVal').val(paramValue);
            
            var role_val = $('#RoleValue').val();
            $('#role').val(role_val);
            
            var actionVal = webAction.val();
            $('#icon_value').val(icons[actionVal]);
            $('#ico').addClass(icons[actionVal]);
            $('#ico').removeClass();
            
            var icon = $('#myEditor_icon').children()[0];
            editor.add();
            
            webAction.val(null).trigger("change");
            $('#SelectOption').val(null).trigger("change");
            $('#RoleValue').val(null).trigger("change");
            $('#targetValue').val(null).trigger("change");
            actionTitle.val(null).trigger("change");
            $('#btnOutput').click();
            $("#$menutable-json").val(editor.getString());

        });
        
 
 
                
        $('#menuform').submit(function () {
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

        var Role = $('#RoleValue').select2({
            allowclear: true,
            multiple: true,
            placeholder: 'Доступ запрешён для ..'
        }).trigger('change');
        var target = $('#targetValue').select2({
            allowClear: true,
            placeholder: "Веб цель",

        }).trigger('change');
        $('#SelectOption').select2({
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
                 copyToClipboard($('#text_value').val());
             });
             $('#ac_btn').on('click', function () {
                 copyToClipboard($('#action_value').val());
             });
          
        });
      
JS;


$js = strtr($jsCode, [
    '{titles}' => $titleJS,
    '{action}' => $actionJS,
    '{icons}' => $iconJS,
    '{json}' => $json,
]);


$createMenuJS = file_get_contents(Root . '/publish/menus/editor/editor_new_refactor.js');

$createMenuJS = str_replace('{titles}', $titleJS, $createMenuJS);
$createMenuJS = str_replace('{action}', $actionJS, $createMenuJS);
$createMenuJS = str_replace('{icons}', $iconJS, $createMenuJS);
$createMenuJS = str_replace('{json}', $json, $createMenuJS);

$this->registerJs($createMenuJS);
$this->registerJs($js);

?>









