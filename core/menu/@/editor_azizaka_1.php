<? use kartik\form\ActiveForm;
use zetsoft\models\page\PageAction;
use zetsoft\models\menu\Menu;
use zetsoft\models\core\CoreRole;
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
$this->registerJsFile('/webhtm/core/menu/assets/jQuery-Menu-Editor-master/jquery-menu-editor_7.js');
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


    $model->rest = json_decode($model->rest);

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
                            <?
                            $roles = CoreRole::find()->all();

                            foreach ($roles as $role) :
                                ?>

                                <option><?= $role->title?></option>
                            <?
                            endforeach;
                            ?>
                        </select>
                    </div>

                    <? ActiveForm::end() ?>
                </div>

                <div id="val-val">


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
            "text":"Компоненты","icon":"far fa-address-card","title":"asd","action":"admin/core-speciality/detail","param":"asdsdads","href":"","class":" btn btn-danger","target":"_blank","role":"asdff","children":[{"text":"Организация","icon":"fas fa-angle-double-up","title":"фывфыв","action":"kernel/core/logout","param":"фывфвы","href":"","class":"btn btn-dark","target":"_blank","role":"aaaaaaaaaaaa"}]},{"text":"Система","icon":"fas fa-address-book","title":"фыв","action":"admin/core-speciality/detail","param":"фвыыфв","href":"","class":"mt-3,btn-success","target":"","role":"","children":[{"text":"Веб действия","icon":"fas fa-archive","title":"фывыфв","action":"report/main/test","param":"фывыфв","href":"","class":"btn btn-dark","target":"_blank","role":"aaaaaaaaaaaa"}]},{"text":"Элементы","icon":"fas fa-align-justify","title":"фывфы","action":"mains/main/create-app","param":"фывыфв","href":"","class":"btn-lg,btn-primary","target":"","role":"","children":[{"text":"Принять","icon":"fas fa-arrows-alt","title":"фывыфв","action":"kernel/menu/editor_abdulloh","param":"фывфыв","href":"","class":"btn btn-info","target":"_blank","role":""}],

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
            placeholder: 'Доступ запрещён для ..'
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








