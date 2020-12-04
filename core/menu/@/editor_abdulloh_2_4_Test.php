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

$this->registerJsFile('https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.full.min.js');


/** @var ZView $this */
$id = $this->httpGet('id');


$actions = PageAction::find()
    ->select([
        'title',
        'icon',
        'data',
    ])
    ->all();


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
<select class="js-example-programmatic " style="width:50%;" name="action" id="vall">
    <option></option>
    <?

    $datas = ZArrayHelper::map($actions, 'data', 'data');

    $icons = ZArrayHelper::map($actions, 'data', 'icon');
    $iconsJS = ZJsonHelper::encode($icons);

    $titles = ZArrayHelper::map($actions, 'data', 'title');
    $titleJS = ZJsonHelper::encode($titles);

    foreach ($datas as $key => $action):
        ?>
        <option value="<?= $key ?>"><?= $action ?></option>
    <?

    endforeach;
    ?>
</select>


<script>
    jQuery(document).ready(function () {

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
        editor.setData(<?=$json?>);

        $('#vall').on('select2:select', function () {
            document.getElementById('href').setAttribute('disabled', 'disabled');
        });

        $('#vall').on('select2:clear', function () {
            var x = document.getElementById('href').removeAttribute('disabled');
            s
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

</script>








