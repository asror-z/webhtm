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


        <!--Hidden Inputs Begin-->

        <input id="text1" name="text1" type="hidden">
        <input id="text2" name="text2" type="hidden">

        <input id="actionName" name="actionName" type="hidden">

        <input type="hidden" id="paramVal">

        <!--Hidden Inputs End-->



        <div class="col-md-6">
            <div class="card ">
                <div class="card-header text-white d-flex"><i class="fa fa-chart-pie"></i><h5>Изменить элемент</h5>
                </div>
                <div class="card-body">
                    <? $form = ActiveForm::begin(['id' => 'formEdit']) ?>

                    <div class="">
                        <div class="form-group section-6">

                            <label for="action"></label>

                            <input type="hidden" class="form-control item-menu" id="action" name="action" placeholder="action...">


                            <div>
                                <button type="button"  id="ac_btn"
                                        class="btn btn-sm btn-primary btn-2"><i class="far fa-copy"></i></button>
                            </div>

                            <select class="actionSelect select-1"  name="action" id="vall">
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

                            <!--Hidden Inputs Begin-->

                            <input type="text" class="form-control item-menu inputMenu" id="param" name="param" placeholder="Параметр">

                            <!--Hidden Inputs End-->


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

                                <input type="hidden" id="text_value" name="text">

                                <select class="select item-menu" id="text_vall" name="text">
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

                                <i id="ico"></i><input type="text" class="inputIcon item-menu" id="icon_value" name="icon">
                            </div>
                        </div>
                    </div>

                    <input type="hidden" id="action_value" name="action">


                    <!--<div class="form-group d-flex">
                        <label for="href"></label>
                        <i class="fas fa-unlink iconn"></i>
                        <input type="text" class="form-control item-menu" id="href" name="href"
                               placeholder="Абсолютный URL">
                    </div>-->

                    <div class="form-group d-flex ml-3 section-3" >

                        <label for="class"></label>
                        <input type="hidden" class="form-control item-menu" multiple="multiple" id="class" name="class"
                               placeholder="addclass...">
                        <i class="fab fa-css3-alt isIc"></i>
                        <select id="SelectOption" class="select-2"
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
                        </select>

                    </div>


                    <div class="form-group d-flex ml-2">
                        <label for="target"></label>
                        <input type="hidden" class="form-control item-menu" id="target" name="target"
                               placeholder="target...">
                        <i class="fas fa-bullseye iconn"></i>
                        <select name="target" id="targetValue" class="select-3">
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
                        <select name="role" id="RoleValue" class="select-4" multiple>
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

                <div class="card-footer d-flex col-lg-12 section-4" >
                    <div class="btn-group">
                        <button type="button" id="btnUpdate" title="Обновить"
                                class="btn btn-rounded  btn-outline-success"
                                disabled style="" aria-label="tooltip"><i class="fas fa-sync-alt ft"></i>
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
                            <button type="button" class="btn btn-rounded btn-outline-danger" title="Удалить меню" id="delMen"><i class="far fa-trash-alt ft"></i>
                            </button>
                            <button type="button" class="btn btn-rounded btn-outline-primary" title="Примерное меню" id="setDat">
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

$menutable = 'coremenu';


$jsCode = <<<JS

jQuery(document).ready(function () {

    var titles = {titles};
    var icons = {icons};
    var actions = {action};
    var json = '{json}';
    //console.log(json);
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
            
            /*$("#$menutable-json").val(editor.getString());           
            
            $('#action').val(webAction.val());
            
            $('#target').val(targetValue.val()); 
            
            textValue.val(idSender.val(titles[actionTitle.val()]));
            
            $('#class').val(selectOption.val());
            
            
            webActValue.val(webActName.val(actions[webAction.val()]));
            
            parametrValue.val(parametrs.val());
            
            $('#role').val(roleValue.val());*/                
            
            
            editor.update();

            /*webAction.val(null).trigger("change");
            $('#class_val').val(null).trigger("change");
            roleValue.val(null).trigger("change");
            targetValue.val(null).trigger("change");
            actionTitle.val(null).trigger("change");*/
            
            
            //btnOutput.click();
        });

        menuDeleteBtn.click(function () {
            myEditor.empty();
        });

        btnAdd.click(function () {
    
            
            $('#action').val(webAction.val());   //hidden
            
            $('#target').val(targetValue.val());
            
            
            textValue.val(actionTitle.val());
            
            $('#class').val(selectOption.val());
            
            var actionName = webActName.val(actions[webAction.val()]);
            console.log(webAction.val());
            webActValue.val(actionName.val());
            
            parametrValue.val(parametrs.val());            
            $('#role').val(roleValue.val());
            
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


$createMenuJS = file_get_contents(Root . '/publish/menus/editor/editor_new_refactor.js');

$createMenuJS = str_replace('{titles}', $titleJS, $createMenuJS);
$createMenuJS = str_replace('{action}', $actionJS, $createMenuJS);
$createMenuJS = str_replace('{icons}', $iconJS, $createMenuJS);
$createMenuJS = str_replace('{json}', $json, $createMenuJS);

$this->registerJs($createMenuJS);
$this->registerJs($js);

?>









