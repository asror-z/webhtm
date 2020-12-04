<? use kartik\form\ActiveForm;
use zetsoft\models\page\PageAction;
use zetsoft\models\menu\Menu;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\helpers\ZHTML;
use zetsoft\system\kernels\ZView;

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

if($id === null)
    die;

$json = '{}';

if ($model !== null) 
    if ($model->rest !== null)
        $json = json_encode($model->rest);

 else
    $model = new Menu();

// $this->showPost();

if (Az::$app->request->isPost && $model->load(Az::$app->request->post())) {

    if ($model->save()) {
        $this->urlRefresh();
    }
}


$form = ActiveForm::begin(['id' => 'menuform']);


echo $form->field($model, 'json')->hiddenInput(['value' => $json])->label(false);

echo ZHTML::submitButton('Сохранить', ['class' => 'btn btn-sm btn-primary']);

ActiveForm::end();

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

    .icon {
        font-size: 30px;
        margin-right: 10px;
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

    .fa-sync-alt {
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
    }

    .fa-chart-pie {
        font-size: 25px;
        margin-right: 10px;
    }


</style>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-6">
            <div class="card mb-3">

                <div class="card-header text-white d-flex"><i class="fa fa-chart-pie"></i><h5>Меню</h5>

                </div>
                <div class="card-body" style="min-height: 300px;">
                    <ul id="myEditor" class="sortableLists list-group">
                    </ul>
                </div>
            </div>

            <button id="btnOutput" style="visibility: hidden" class="btn "></button>


            <!--   <div class="form-group" style="visibility: visible"><textarea name="<? /*=$model*/ ?>[<? /*=$this->attribute*/ ?>]" id="out" class="form-control" cols="50" rows="10"></textarea>

            </div>  -->


        </div>
        <div class="col-md-6">
            <div class="card mb-3">
                <div class="card-header text-white d-flex"><i class="fa fa-chart-pie"></i><h5>Изменить элемент</h5>
                </div>
                <div class="card-body">
                    <? $form = ActiveForm::begin(['id' => 'frmEdit']) ?>
                    <div class="form-group">
                        <label for="text"></label>
                        <div class="input-group">
                            <i class="fas fa-envelope-open-text icon"></i>
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
                        <i class="fas fa-comments icon"></i>
                        <input type="text" name="title" class="form-control item-menu" id="title"
                               placeholder="Подсказка">
                    </div>

                    <div class="form-group d-flex">
                        <label for="href"></label>
                        <i class="fas fa-unlink icon"></i>
                        <input type="text" class="form-control item-menu" id="href" name="href"
                               placeholder="Абсолют url">
                    </div>

                    <div class="form-group" style="display: flex;width: 100%; margin-top: 20px; ">
                        <label for="action" style="margin-right: 10px;"></label>
                        <input type="hidden" class="form-control item-menu" id="action" name="action"
                               placeholder="action...">
                        <i class="fas fa-keyboard icon"></i>
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
                        <i class="fas fa-cubes icon"></i>
                        <input type="text" class="form-control item-menu" style="width:45%;height: 35px;" id="param"
                               name="param" placeholder="Параметр">

                    </div>

                    <div class="form-group d-flex" style="width: 90%">

                        <label for="class"></label>
                        <input type="hidden" class="form-control item-menu" multiple id="class" name="class"
                               placeholder="addclass...">
                        <i class="fab fa-css3-alt icon"></i>
                        <select class="js-example-programmatic-5" id="class-val"
                                style="width: 100%;" name="class">
                            <option></option>
                            <option>btn</option>
                            <option>btn-primary</option>
                            <option>btn-succsess</option>
                            <option>btn-danger</option>
                            <option>w-100</option>
                            <option>w-50</option>
                            <option>ml-auto</option>
                        </select>

                    </div>


                    <div class="form-group d-flex">
                        <label for="target"></label>
                        <input type="hidden" class="form-control item-menu" id="target" name="target"
                               placeholder="target...">
                        <i class="fas fa-bullseye icon"></i>
                        <select name="target" id="val__tar" class="js-example-programmatic-2" style="width:100%;">
                            <option></option>
                            <option value="_self">Self</option>
                            <option value="_blank">Blank</option>
                            <option value="_top">Top</option>
                        </select>
                    </div>


                    <div class="form-group d-flex">
                        <label for="perm"></label>
                        <input type="hidden" class="form-control item-menu" id="perm" name="perm" placeholder="perm...">
                        <i class="fas fa-eye icon"></i>
                        <select name="perm" id="val__vis" multiple class="js-example-programmatic-3" style="width:90%;">
                            <option>one</option>
                            <option>two</option>
                            <option>three</option>
                        </select>
                    </div>

                    <? ActiveForm::end() ?>
                </div>

                <div class="card-footer">
                    <button type="button" id="btnUpdate" class="btn btn-primary" disabled><i
                                class="fas fa-sync-alt"></i> Обновить
                    </button>
                    <button type="button" class="btn btn-success" id="btnAdd"><i class="fab fa-adn"></i>Добавить
                    </button>
                    <button type="button" class="btn btn-danger" id="delMen" style="position:absolute; right:  0;"><i
                                class="far fa-trash-alt"></i>Удалить всё
                    </button>
                    <button type="button" class="btn btn-primary" id="setDat" style="position:absolute; right:  180px;">
                        <i class="fas fa-code"></i>Образец
                    </button>

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
            var abl3 = $('#class-val').val();
            $('#class').val(abl3);
            var abl4 = $('#val__vis').val();
            $('#perm').val(abl4);
            editor.add();
            $('#btnOutput').click();
            $("#coremenu-json").val(editor.getString());

            $('.js-example-programmatic').select2('destroy');
            $('.js-example-programmatic').select2();
            $('#val__tar').select2('destroy');
            $('#val__tar').select2();
            $('#class-val').select2('destroy');
            $('#class-val').select2();


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

        var example3 = $('.js-example-programmatic-3').select2({
            allowclear: true,
            multiple: true,
            placeholder: 'Должность'


        }).trigger('change');
        var example2 = $('.js-example-programmatic-2').select2({
            allowClear: true,
            placeholder: "Веб цель",

        }).trigger('change');
        var example4 = $('.js-example-programmatic-5').select2({
            allowClear: true,
            multiple: true,
            placeholder: "Добавьте css класс",

        }).trigger('change');
        $('#class-val').select2({
            allowClear: false,
            multipe: true,
            placeholder: "Выбрать css класс",
        }).trigger('change');

        $("select").on("select2:select", function (evt) {
            // console.log(evt);
            var element = evt.params.data.element;
            var element = $(element);
            element.detach();
            $(this).append(element);
            $(this).trigger("change");
        });


        /* ====================================== */

        /** PAGE ELEMENTS **/
        $('[data-toggle="tooltip"]').tooltip();
        $.getJSON("https://api.github.com/repos/davicotico/jQuery-Menu-Editor", function (data) {
            $('#btnStars').html(data.stargazers_count);
            $('#btnForks').html(data.forks_count);
        });


    });

</script>








