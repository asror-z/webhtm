<? use kartik\form\ActiveForm;
use zetsoft\models\page\PageAction;
use zetsoft\models\menu\Menu;
use zetsoft\models\core\CoreRole;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\helpers\ZHTML;
use zetsoft\system\helpers\ZJsonHelper;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\navigat\ZButtonWidget;

$this->registerCssFile('https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.12.1/css/all.css');
$this->registerCssFile('https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.css');
$this->registerCssFile('/webhtm/core/menu/assets/jQuery-Menu-Editor-master/bootstrap-iconpicker/css/bootstrap-iconpicker.min.css');

$this->registerJsFile('https://cdn.jsdelivr.net/npm/html5shiv@3.7.3/dist/html5shiv.min.js');
$this->registerJsFile('https://cdn.jsdelivr.net/npm/respond.js@1.4.2/dest/respond.min.js');
$this->registerJsFile('/webhtm/core/menu/assets/jQuery-Menu-Editor-master/jquery-menu-editor_5.js');
$this->registerJsFile('/webhtm/core/menu/assets/jQuery-Menu-Editor-master/bootstrap-iconpicker/js/iconset/fontawesome5-3-1.min.js');
$this->registerJsFile('/webhtm/core/menu/assets/jQuery-Menu-Editor-master/bootstrap-iconpicker/js/bootstrap-iconpicker.min.js');
$this->registerJsFile('https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.full.min.js');


/** @var ZView $this */
$id = $this->httpGet('id');

$actions = PageAction::find()->all();

$datas = ZArrayHelper::map($actions, 'data', 'data');


$iconsJS = ZJsonHelper::encode($icons);

$titles = ZArrayHelper::map($actions, 'data', 'title');
$titleJS = ZJsonHelper::encode($titles);

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
        <?
          require Root . '/webhtm/core/menu/blocks/cssStyles.php';
        ?>


    </style>
    <div class="pr-2 pl-4">
        <div class="row">
            <div class="col-md-6" style="padding: 1px !important;">
                <div class="card ">

                    <div class="card-header text-white d-flex"><i class="fa fa-chart-pie"></i><h5>

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
            <div class="col-md-6">
                <div class="card ">
                    <div class="card-header text-white d-flex"><i class="fa fa-chart-pie"></i><h5>Изменить элемент</h5>
                    </div>
                    <div class="card-body">
                        <? $form = ActiveForm::begin(['id' => 'frmEdit']) ?>

                        <?
                        require Root . '/webhtm/core/menu/blocks/textIcons.php';
                        ?>

                        <?
                        require Root . '/webhtm/core/menu/blocks/titles.php';
                        ?>

                        <?
                        require Root . '/webhtm/core/menu/blocks/ActionParam.php';
                        ?>

                        <?
                        require Root . '/webhtm/core/menu/blocks/hrefs.php';
                        ?>

                        <?
                        require Root . '/webhtm/core/menu/blocks/styles.php';
                        ?>

                        <?
                        require Root . '/webhtm/core/menu/blocks/targets.php';
                        ?>

                        <?
                        require Root . '/webhtm/core/menu/blocks/roles.php';
                        ?>

                        <? ActiveForm::end() ?>
                    </div>

                    <?
                    require Root . '/webhtm/core/menu/blocks/buttons.php';
                    ?>

                    <div class="form-group" style="visibility: visible"><textarea
                                name="<? /*=$model*/ ?>[<? /*=$this->attribute*/ ?>]" id="out" class="form-control"
                                style="overflow:scroll;" cols="1" rows="1"></textarea>

                    </div>


                </div>
            </div>
        </div>
    </div>


<?php
$titles = ZArrayHelper::map($actions, 'data', 'title');
$icons = ZArrayHelper::map($actions, 'data', 'title');

$jsCode = <<<JS
jQuery(document).ready(function () {

    var titles = {titles};
    var icons = {icons};

    var arrayjson = [{
            "text": "Компоненты",
            "icon": "far fa-address-card",
            "title": "asd",
            "action": "admin/core-speciality/detail",
            "param": "asdsdads",
            "href": "",
            "class": " btn btn-danger",
            "target": "_blank",
            "role": "asdff",
            "children": [{
                "text": "Организация",
                "icon": "fas fa-angle-double-up",
                "title": "фывфыв",
                "action": "kernel/core/logout",
                "param": "фывфвы",
                "href": "",
                "class": "btn btn-dark",
                "target": "_blank",
                "role": "aaaaaaaaaaaa"
            }]
        }, {
            "text": "Система",
            "icon": "fas fa-address-book",
            "title": "фыв",
            "action": "admin/core-speciality/detail",
            "param": "фвыыфв",
            "href": "",
            "class": "mt-3,btn-success",
            "target": "",
            "role": "",
            "children": [{
                "text": "Веб действия",
                "icon": "fas fa-archive",
                "title": "фывыфв",
                "action": "report/main/test",
                "param": "фывыфв",
                "href": "",
                "class": "btn btn-dark",
                "target": "_blank",
                "role": "aaaaaaaaaaaa"
            }]
        }, {
            "text": "Элементы",
            "icon": "fas fa-align-justify",
            "title": "фывфы",
            "action": "mains/main/create-app",
            "param": "фывыфв",
            "href": "",
            "class": "btn-lg,btn-primary",
            "target": "",
            "role": "",
            "children": [{
                "text": "Принять",
                "icon": "fas fa-arrows-alt",
                "title": "фывыфв",
                "action": "kernel/menu/editor_abdulloh",
                "param": "фывфыв",
                "href": "",
                "class": "btn btn-info",
                "target": "_blank",
                "role": ""
            }],

        }];


        var iconPickerOptions = {searchText: "Buscar...", labelHeader: "{0}/{1}"};

        var sortableListOptions = {
            placeholderCss: {'background-color': "#cccccc"}
        };


        var editor = new MenuEditor('myEditor', {listOptions: sortableListOptions, iconPicker: iconPickerOptions});
        editor.setForm($('#frmEdit'));
        editor.setUpdateButton($('#btnUpdate'));
        editor.setData({json});

        $('#vall').on('select2:select', function () {
        alert();
            document.getElementById('href').setAttribute('disabled', 'disabled');
           var icon = $('#myEditor_icon').children()[0]; 
           var actionVal = $('#vall').val();                
            $('#text').val(titles[actionVal]);
            $(icon).removeClass();            
            $(icon).addClass(icons[actionVal]);
                        
        }).on('select2:clear', function () {
            var x = document.getElementById('href').removeAttribute('disabled');
            $('#text').val('');
            $(icon).removeClass();            
            $(icon).addClass(empty);
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
            var abl = $('#vall').val();
            $('#action').val(abl);

            var abl2 = $('#val__tar').val();
            $('#target').val(abl2);


            var abl3 = $('#clas-val').val();
            $('#class').val(abl3);


            var abl4 = $('#val__vis').val();
            $('#role').val(abl4);


            $('.js-example-programmatic').val(null).trigger("change");
            $('.js-example-programmatic-5').val(null).trigger("change");
            $('.js-example-programmatic-3').val(null).trigger("change");
            $('.js-example-programmatic-2').val(null).trigger("change");
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
JS;


$js = strtr($jsCode, [
    '{titles}' => $titleJS,
    '{icons}' => $iconsJS,
    '{json}' => $json,
]);


$this->registerJs($js);








