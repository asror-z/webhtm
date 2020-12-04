<? use kartik\form\ActiveForm;
use zetsoft\models\page\PageAction;
use zetsoft\models\menu\Menu;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\helpers\ZHTML;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\navigat\ZButtonWidget;

$this->registerCssFile('https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.12.1/css/all.css');
$this->registerCssFile('https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.css');
$this->registerCssFile('/webhtm/core/menu/assets/jQuery-Menu-Editor-master/bootstrap-iconpicker/css/bootstrap-iconpicker.min.css');

$this->registerJsFile('https://cdn.jsdelivr.net/npm/html5shiv@3.7.3/dist/html5shiv.min.js');
$this->registerJsFile('https://cdn.jsdelivr.net/npm/respond.js@1.4.2/dest/respond.min.js');
$this->registerJsFile('/webhtm/core/menu/assets/jQuery-Menu-Editor-master/jquery-menu-editor_3.js');
$this->registerJsFile('/webhtm/core/menu/assets/jQuery-Menu-Editor-master/bootstrap-iconpicker/js/iconset/fontawesome5-3-1.min.js');
$this->registerJsFile('/webhtm/core/menu/assets/jQuery-Menu-Editor-master/bootstrap-iconpicker/js/bootstrap-iconpicker.min.js');
$this->registerJsFile('https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.full.min.js');


/** @var ZView $this */
$id = $this->httpGet('id');

$actions = ZArrayHelper::map(PageAction::find()->all(), 'data', 'data');

$model = Menu::findOne($id);

if (empty($id))
    die;


$json = '{}';

if ($model !== null) {
    if ($model->rest !== null) {
        $json = json_encode($model->rest);
    }
} else {
    $model = new Menu();
}

//  $this->modelShowPost();

if (Az::$app->request->isPost && $model->load(Az::$app->request->post())) {

    if ($model->save())
        Az::$app->controller->refresh();
}


?>
<style>

    .select2-container .select2-selection--single {
        border-bottom: 1px solid lightgray;
        height: 35px;
        border-top: 0;
        border-left: 0;
        border-right: 0;
    }

    #text {
        border-bottom: 1px solid lightgray;
        border-top: 0;
        border-left: 0;
        border-right: 0;

    }

    .iconn {
        font-size: 30px;
        margin-right: 10px;
        color: darkblue !important;
    }

    #title {
        border-bottom: 1px solid lightgray;
        border-top: 0;
        border-left: 0;
        border-right: 0;

    }

    #class {
        border: 1px solid lightgray;
        border-top: 0;
        border-left: 0;
        border-right: 0;

    }

    #href {
        border-bottom: 1px solid lightgray;
        border-top: 0;
        border-left: 0;
        border-right: 0;

    }

    .invalid-feedback {
        margin: 0 !important;
    }

    .highlight-addon {
        margin: 0 !important;
    }

    #param {
        border-bottom: 1px solid lightgray;
        border-top: 0;
        border-left: 0;
        border-right: 0;

    }

    .select2-container--default .select2-selection--multiple {
        border: 1px solid lightgray;
        border-top: 0;
        border-left: 0;
        border-right: 0;

    }

    .fa-keyboard {
        left: 0;
    }

    .ft {
        font-size: 20px !important;
    }

    /*   .fa-sync-alt {
           margin-right: 10px;
       }

       .fa-adn {
           margin-right: 10px;
       }

       .fa-trash-alt {
           margin-right: 10px;
       }

       .fa-code {
           margin-right: 10px;
       }*/

    .fa-chart-pie {
        font-size: 25px;
        margin-right: 10px;
    }


</style>
<div class="pr-2 pl-4">
    <div class="row">
        <div class="col-md-6" style="padding: 1px !important;">
            <div class="card ">

                <div class="card-header text-white d-flex"><i class="fa fa-chart-pie"></i><h5>Меню</h5>

                </div>
                <div class="card-body" style="min-height: 300px;">
                    <ul id="myEditor" class="sortableLists list-group">
                    </ul>
                </div>
            </div>

            <button id="btnOutput" style="visibility: hidden" class="btn "></button>




        </div>
        <div class="col-md-6">
            <div class="card ">
                <div class="card-header text-white d-flex"><i class="fa fa-chart-pie"></i><h5>Изменить элемент</h5>
                </div>
                <div class="card-body">
                    <? $form = ActiveForm::begin(['id' => 'frmEdit']) ?>
                    <div class="form-group">
                        <label for="text"></label>
                        <div class="input-group">
                            <i class="fas fa-envelope-open-text iconn"></i>
                            <input type="text" class="form-control item-menu" name="text" id="text" placeholder="Текст">
                            <div class="input-group-append">
                                <button type="button" id="myEditor_icon" class="btn btn-outline-secondary"
                                        class="bottom"></button>
                            </div>
                        </div>
                        <input type="hidden" name="icon" class="item-menu">
                    </div>
                    <div class="form-group d-flex">
                        <label for="title"></label>
                        <i class="fas fa-comments iconn"></i>
                        <input type="text" name="title" class="form-control item-menu" id="title"
                               placeholder="Подсказка">
                    </div>


                    <div class="form-group" style="display: flex;width: 100%; margin-top: 20px; ">
                        <label for="action" style="margin-right: 10px;"></label>
                        <input type="hidden" class="form-control item-menu" id="action" name="action"
                               placeholder="action...">
                        <i class="fas fa-keyboard iconn"></i>
                        <select class="js-example-programmatic " style="width:50%;" name="action" id="vall">
                            <option></option>
                            <?

                            $actions = ZArrayHelper::map(PageAction::find()->all(), 'data', 'data');
                            foreach ($actions as $key => $action):
                                ?>
                                <option value="<?= $key ?>"><?= $action ?></option>
                            <?

                            endforeach;
                            ?>
                        </select>

                        <label for="param" style="margin-right: 10px; margin-left: 5px;"></label>
                        <i class="fas fa-cubes iconn"></i>
                        <input type="text" class="form-control item-menu" style="width:45%;height: 35px;" id="param"
                               name="param" placeholder="Параметр">

                    </div>

                    <div class="form-group d-flex">
                        <label for="href"></label>
                        <i class="fas fa-unlink iconn"></i>
                        <input type="text" class="form-control item-menu" id="href" name="href"
                               placeholder="Абсолютный URL">
                    </div>

                    <div class="form-group d-flex" style="width: 90%">

                        <label for="class"></label>
                        <input type="hidden" class="form-control item-menu" multiple="multiple" id="class" name="class"
                               placeholder="addclass...">
                        <i class="fab fa-css3-alt iconn"></i>
                        <select class="js-example-programmatic-5" id="clas-val"
                                style="width: 100%;" name="class" multiple="multiple">
                            <option></option>
                            <option>mt</option>
                            <option>mt-2</option>
                            <option>mt-3</option>
                            <option>btn-lg</option>
                            <option>btn-sm</option>
                            <option>btn-primary</option>
                            <option>btn-success</option>
                            <option>btn-danger</option>
                            <option>btn-warning</option>
                            <option>btn btn-info</option>
                            <option>btn btn-dark</option>
                        </select>

                    </div>


                    <div class="form-group d-flex">
                        <label for="target"></label>
                        <input type="hidden" class="form-control item-menu" id="target" name="target"
                               placeholder="target...">
                        <i class="fas fa-bullseye iconn"></i>
                        <select name="target" id="val__tar" class="js-example-programmatic-2" style="width:100%;">
                            <option></option>
                            <option value="_self">Self</option>
                            <option value="_blank">Blank</option>
                            <option value="_top">Top</option>
                        </select>
                    </div>


                    <div class="form-group d-flex">
                        <label for="role"></label>
                        <input type="hidden" class="form-control item-menu" id="role" name="role" placeholder="role...">
                        <i class="fas fa-eye iconn"></i>
                        <select name="role" id="val__vis" multiple class="js-example-programmatic-3" style="width:90%;">
                            <option>user</option>
                            <option>needer</option>
                            <option>candidate</option>
                            <option>monitor</option>
                        </select>
                    </div>

                    <? ActiveForm::end() ?>
                </div>

                <div id="val-val">


                </div>

                <div class="card-footer d-flex col-lg-12" style="padding:1.75rem !important;">
                    <div class="btn-group">
                        <button type="button" id="btnUpdate" title="Обновить"
                                class="btn btn-rounded  btn-outline-success hint--bottom hint--info hint--medium hint--bounce hint--rounded"
                                disabled style="" aria-label="tooltip"><i
                                    class="fas fa-sync-alt ft"></i>
                        </button>
                        <?php
                        $form = ActiveForm::begin(['id' => 'menuform']);


                        echo $form->field($model, 'json')->hiddenInput(['value' => $json])->label(false);

                        echo ZHTML::submitButton('<i class="fas fa-save ft"></i>', ['class' => 'btn btn-outline-primary', 'title' => 'Сохранить']);

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
                <div class="form-group" style="visibility: visible"><textarea
                            name="<? /*=$model*/ ?>[<? /*=$this->attribute*/ ?>]" id="out" class="form-control"
                            style="overflow:scroll;" cols="1" rows="1"></textarea>

                </div>


            </div>
        </div>
    </div>
</div>


<script>
    jQuery(document).ready(function () {

        var arrayjson = [{
            "text": "Home",
            "icon": "fas fa-address-book",
            "title": "tooltip",
            "href": "url",
            "action": "admin/core-form-db/create",
            "param": "sadad",
            "class": ",btn-primary",
            "target": "_self",
            "perm": "one",
            "children": [{
                "text": "child1",
                "icon": "empty",
                "title": "",
                "href": "",
                "action": "",
                "param": "",
                "class": "",
                "target": "",
                "perm": ""
            }, {
                "text": "child2",
                "icon": "empty",
                "title": "",
                "href": "",
                "action": "",
                "param": "",
                "class": "",
                "target": "",
                "perm": ""
            }]
        }, {
            "text": "About",
            "icon": "fas fa-address-card",
            "title": "asd",
            "href": "asd",
            "action": "admin/core-country/index",
            "param": "asdasd",
            "class": "btn-danger",
            "target": "_top",
            "perm": "three",
            "children": [{
                "text": "child2",
                "icon": "empty",
                "title": "",
                "href": "",
                "action": "",
                "param": "",
                "class": "",
                "target": "",
                "perm": ""
            }, {
                "text": "child1",
                "icon": "empty",
                "title": "",
                "href": "",
                "action": "",
                "param": "",
                "class": "",
                "target": "",
                "perm": ""
            }]
        }, {
            "text": "Contact",
            "icon": "fas fa-air-freshener",
            "title": "asdas",
            "href": "asdasd",
            "action": "admin/core-time-zone/update",
            "param": "asdasd",
            "class": "btn-primary",
            "target": "_self",
            "perm": "three",
            "children": [{
                "text": "child1",
                "icon": "empty",
                "title": "",
                "href": "",
                "action": "",
                "param": "",
                "class": "",
                "target": "",
                "perm": ""
            }, {
                "text": "child2",
                "icon": "empty",
                "title": "",
                "href": "",
                "action": "",
                "param": "",
                "class": "",
                "target": "",
                "perm": ""
            }]
        }, {
            "text": "Gallery",
            "icon": "far fa-address-card",
            "title": "asdas",
            "href": "asdasd",
            "action": "admin/core-time-zone/index",
            "param": "asdasd",
            "class": "btn-succsess",
            "target": "_blank",
            "perm": "three,one",
            "children": [{
                "text": "child1",
                "icon": "empty",
                "title": "",
                "href": "",
                "action": "",
                "param": "",
                "class": "",
                "target": "",
                "perm": ""
            }, {
                "text": "child2",
                "icon": "empty",
                "title": "",
                "href": "",
                "action": "",
                "param": "",
                "class": "",
                "target": "",
                "perm": ""
            }]
        }];


        var iconPickerOptions = {searchText: "Buscar...", labelHeader: "{0}/{1}"};

        var sortableListOptions = {
            placeholderCss: {'background-color': "#cccccc"}
        };


        var editor = new MenuEditor('myEditor', {listOptions: sortableListOptions, iconPicker: iconPickerOptions});
        editor.setForm($('#frmEdit'));
        editor.setUpdateButton($('#btnUpdate'));
        editor.setData(<?=$json?>);

        $('#vall').on('select2:select', function () {
            document.getElementById('href').setAttribute('disabled', 'disabled');
        });
        $('#vall').on('select2:clear', function () {
            var x = document.getElementById('href').removeAttribute('disabled');

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
            editor.update();
            $('#btnOutput').click();
            $("#coremenu-json").val(editor.getString());
        });

        $('#delMen').click(function () {
            $('#myEditor').empty();


        });

        $('#btnAdd').click(function () {

            var abl = $('#vall').val();
            $('#action').val(abl);

            var abl2 = $('#val__tar').val();
            $('#target').val(abl2);


            var abl3 = $('#clas-val').val();
            $('#class').val(abl3);


            var abl4 = $('#val__vis').val();
            $('#role').val(abl4);

            editor.add();
            $('#btnOutput').click();
            $("#coremenu-json").val(editor.getString());

            $('.js-example-programmatic').val(null).trigger("change");
            $('.js-example-programmatic-5').val(null).trigger("change");
            $('.js-example-programmatic-3').val(null).trigger("change");
            $('.js-example-programmatic-2').val(null).trigger("change");


// Unbind the event


        });

        $('#menuform').submit(function () {
            $("#coremenu-json").val(editor.getString());
            return true;
        });

        var example = $('.js-example-programmatic').select2({
            allowClear: true,
            placeholder: "Веб действия",

        }).trigger('change');

        var example3 = $('#val__vis').select2({
            allowclear: true,
            multiple: true,
            placeholder: 'Роль'
        }).trigger('change');
        var example2 = $('.js-example-programmatic-2').select2({
            allowClear: true,
            placeholder: "Веб цель",

        }).trigger('change');
        $('.js-example-programmatic-5').select2({
            placeholder: "Сss класс",

        }).trigger('change');
        $('#class-val').select2({
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


    });

</script>








