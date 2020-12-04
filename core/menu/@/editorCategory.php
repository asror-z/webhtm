<style>
    #setDat {
        border-top-right-radius: 20px;
        border-bottom-right-radius: 20px;
    }
    #delMen {
        border-top-left-radius: 20px;
        border-bottom-left-radius: 20px;
    }
    #btnAdd {
        border-top-right-radius: 20px;
        border-bottom-right-radius: 20px;
        height: 47px;
    }
    #btnUpdate {
        border-top-left-radius: 20px;
        border-bottom-left-radius: 20px;
        height: 47px;
    }
    .card-header i {
        font-size: 30px;
        margin-right: 10px;
    }
    #ac_btn {
        width: 10px;
        height: 40px;
        margin-right: 10px;
        padding: 22px;
        text-align: center;
        position: relative;
    }
    #bta {
        width: 10px;
        height: 40px;
        margin-right: 10px;
        padding: 22px;
        position: relative;
    }
    .iconColor-bta {
        font-size: 13px !important;
        margin-bottom: 10px !important;
        position: absolute;
        top: -5px;
        left: -4px;
    }
    .iconColor-ac_btn {
        font-size: 13px !important;
        margin-bottom: 10px !important;
        position: absolute;
        top: -5px;
        left: -4px;
    }
    #param-app {
        margin-left: 10px;
    }
    #icon_value-app {
        margin-left: 10px;
    }
    #targetValue {
        margin-left: 20px;
    }
    .section-1 {
        padding: 5px;
    }
    .section-2 {
        padding: 5px;
    }
    .card-header {
        height: 50px;
        text-align: center;
    }
    .card-header i {
        font-size: 25px;
    }
    .card-header h5 {
        text-align: center;
        font-size: 20px;
    }
</style>
<?php

use kartik\form\ActiveForm;
use rmrevin\yii\fontawesome\FA;
use zetsoft\dbdata\App\eyuf\RoleData;
use zetsoft\dbitem\core\WebItem;
use zetsoft\models\page\PageAction;
use zetsoft\models\menu\Menu;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\helpers\ZJsonHelper;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\incores\ZMCheckboxGroupWidget;
use zetsoft\widgets\inputes\ZInputWidget;
use zetsoft\widgets\inputes\ZSelect2Widget;
use zetsoft\widgets\navigat\ZButtonWidget;

//assets CSS
$this->fileJs('https://cdn.jsdelivr.net/npm/jquery-sortable-lists@1.4.0/jquery-sortable-lists.js');
$this->fileCss('/render/menus/assets/css/editor.css');
$this->fileJs('https://cdn.jsdelivr.net/npm/respond.js@1.4.2/dest/respond.min.js');
$this->fileJs('https://cdnjs.cloudflare.com/ajax/libs/bootstrap-iconpicker/1.10.0/js/bootstrap-iconpicker.min.js');

/** @var ZView $this */
$action = new WebItem();

$action->title = Azl . 'Главная страница';
$action->icon = 'fa fa-area-chart';
$action->type = WebItem::type['html'];
$action->csrf = true;
$action->debug = true;

$action->cache = false;

$action->call = [
//    TagDependency::invalidate()
];
$action->cacheHttp = false;

$this->paramSet(paramAction, $action);

$this->title();
$this->toolbar();

/** @var ZView $this */
$id = 41;
if (!empty($this->httpGet('id')))
    $id = $this->httpGet('id');

if (empty($id))
    return $this->alertDanger( $this->httpGet(), 'Please put an ID');

$model = Menu::findOne($id);

if ($model === null) {
    return $this->alertDanger( 'Model not found', 'Error');
}
$actions = PageAction::find()->all();
$json = Az::$app->menu->json->run($model);

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

$menutable = 'ShopCategory';

$this->beginPage();
?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>

    <?php
    require Root . '/webhtm/block/metas/main.php';
    require Root . '/webhtm/block/assets/main.php';

    $this->head();
    ?>

</head>
<body class="<?= ZWidget::skin['white-skin'] ?>">
<?php

$this->beginBody();


?>

<div class="market-container">
    <div class="row">
        <div class="col-md-6 section-1">
            <div class="card ">
                <div class="card-header text-white d-flex"><i class="fas fa-chart-pie"></i>
                    <h5>
                        Меню "<?= $model->name ?>" <?= $model->title ?>
                    </h5>
                </div>

                <div class="card-body section-2">
                    <ul id="myEditor" class="sortableLists list-group">

                    </ul>
                </div>
            </div>

            <button id="btnOutput" class="btn-1 btn btnOutes"></button>

        </div>

        <div class="col-md-6 section-2">

            <div class="card">

                <div class="card-header text-white d-flex">
                    <i class="fas fa-chart-pie"></i>
                    <h5>Изменить элемент</h5>
                </div>

                <div class="card-body">

                    <?php $form = ActiveForm::begin(['id' => 'formEdit']) ?>

                    <div class="form-group section-6">

                        <div class="d-flex align-items-center w-100">

                            <input type="hidden" class="item-menu" id="action" name="action">

                            <?php
                            echo ZButtonWidget::widget([
                                'id' => 'ac_btn',
                                'config' => [
                                    'btnType' => ZButtonWidget::btnType['button'],
                                    'btnStyle' => ZButtonWidget::btnStyle['btn-primary'],
                                    'btnSize' => ZButtonWidget::btnSize['btn-sm'],
                                    'btnRounded' => true,
                                    'hasIcon' => true,
                                    'icon' => 'far fa-' . FA::_COPY,
                                ]
                            ]);
                            ?>

                            <div class="d-flex align-items-center w-50">
                                <?php
                                echo ZSelect2Widget::widget([
                                    'id' => 'vall',
                                    'data' => $action,
                                    'name' => 'action',
                                    'config' => [
                                        'multiple' => false,
                                        'class' => '',
                                        'placeholder' => Az::l('Веб действия')

                                    ],
                                    'event' => [
                                        'select' => <<<JS
        function() {
        
          $('#text_vall').val($('#vall').val()).trigger("change");
        $('#ico').removeClass();
        $('#ico').addClass(icons[$('#vall').val()]);
        $('#icon_value').val(icons[$('#vall').val()]);
        }

JS,

                                    ]

                                ]);
                                ?>

                            </div>

                            <div class="d-flex align-items-center w-25 ml-4">

                                <i class="fas fa-cubes iconn param"></i>

                                <?php
                                echo ZInputWidget::widget([
                                    'id' => 'param',
                                    'data' => $titles,
                                    'name' => 'param',
                                    'config' => [
                                        'class' => 'item-menu inputMenu w-100',
                                        'placeholder' => Az::l('Параметр')
                                    ]
                                ]);
                                ?>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">

                        <div class="d-flex align-items-center w-100">

                            <input type="hidden" id="text_value" class="item-menu" name="text">

                            <?php
                            echo ZButtonWidget::widget([
                                'id' => 'bta',
                                'config' => [
                                    'btnType' => ZButtonWidget::btnType['button'],
                                    'btnStyle' => ZButtonWidget::btnStyle['btn-primary'],
                                    'btnSize' => ZButtonWidget::btnSize['btn-sm'],
                                    'btnRounded' => true,
                                    'hasIcon' => true,
                                    'icon' => 'far fa-' . FA::_COPY,
                                ]
                            ]);
                            ?>

                            <div class="d-flex align-items-center w-50">

                                <?php

                                echo ZSelect2Widget::widget([
                                    'id' => 'text_vall',
                                    'name' => 'title',
                                    'data' => $titles,
                                    'config' => [
                                        'multiple' => false,
                                        'class' => '',
                                        'placeholder' => Az::l('Текст')
                                    ],
                                    'event' => [
                                        'select' => <<<JS
                               function() {
                 $('#vall').val($('#text_vall').val()).trigger('change');
                $('#ico').removeClass();
                $('#ico').addClass(icons[$('#text_vall').val()]);
                $('#icon_value').val(icons[$('#text_vall').val()]);
                               }
JS,
]
                                ]);
                                ?>
                            </div>

                            <div class="d-flex align-items-center w-25 ml-4">

                                <span class="iconn"><i id="ico" class="fab fa-font-awesome iconn wrift"></i></span>

                                <?php
                                echo ZInputWidget::widget([
                                    'id' => 'icon_value',
                                    'name' => 'icon',
                                    'config' => [
                                        'class' => 'item-menu inputMenu w-100',
                                        'readonly' => true,
                                        'placeholder' => Az::l('Иконка')
                                    ],

                                ]);
                                ?>

                            </div>
                        </div>
                    </div>

                    <div class="form-group d-flex ml-2 marg">

                        <div class="input-group">

                            <div class="d-flex w-100">
                                <i class="fas fa-bullseye iconn target"></i>

                                <div class="d-flex w-50 ml-2">

                                    <?php
                                    $dataTarget = [
                                        '_self' => '_self',
                                        '_blank' => '_blank',
                                        '_top' => '_top',

                                    ];
                                    echo ZSelect2Widget::widget([
                                        'id' => 'targetValue',
                                        'data' => $dataTarget,
                                        'name' => 'target',
                                        'config' => [
                                            'multiple' => false,
                                            'class' => 'select-4 item-menu',
                                            'placeholder' => Az::l('Веб цель')
                                        ],

                                    ]);
                                    ?>
                                </div>

                                <div class="d-flex w-25 Editorcheckbox">
                                    <?php
                                    echo ZMCheckboxGroupWidget::widget([
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

                    <div class="form-group d-flex ml-1 section-3 align-items-center justify-content-start w-100 ">

                        <i class="fab fa-css3-alt icon_css"></i>

                        <div class="w-100">
                            <?php

                            echo ZSelect2Widget::widget([
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
                                    'width' => '98%',
                                    'theme' => ZSelect2Widget::theme['bootstrap'],
                                    'placeholder' => Az::l('Выбрать Css класс')
                                ]
                            ]);
                            ?>
                        </div>
                    </div>
                    <div class=" d-flex ml-2 align-items-center w-100">

                        <i class="fas fa-eye iconn roleUser"></i>

                        <div class="col-md-9 p-0">
                            <?
                            echo ZSelect2Widget::widget([
                                'id' => 'RoleValue',
                                'data' => $roles,
                                'name' => 'role',
                                'config' => [
                                    'multiple' => true,
                                    'width' => '98%',
                                    'class' => 'item-menu',
                                    'theme' => ZSelect2Widget::theme['bootstrap'],
                                    'placeholder' => Az::l('Доступ запрешён для ..')
                                ]
                            ]);
                            ?>
                        </div>
                    </div>
                    <? ActiveForm::end() ?>
                </div>

                <div class="card-footer d-flex col-lg-12 section-4 col-md-6">

                    <div class="btn-group btnUpdates">
                        <?php
                        echo ZButtonWidget::widget([
                            'id' => 'btnUpdate',
                            'config' => [
                            'toggle'=>'',
                                'hasIcon' => true,
                                'btnRounded' => false,
                                'title' => 'Обновить',
                                'icon' => 'ft fas fa-' . FA::_SYNC_ALT,
                                'btnType' => ZButtonWidget::btnType['button'],
                                'btnStyle' => ZButtonWidget::btnStyle['btn-outline-success'],
                            ],


                        ]);

                        $form = ActiveForm::begin(['id' => 'menuform']);
                        echo $form->field($model, 'json')->hiddenInput([
                            'value' => $json
                        ])->label(false);

                        echo ZButtonWidget::widget([
                            'id' => 'valueIc',
                            'config' => [
                                'toggle'=>'',
                                'hasIcon' => true,
                                'class' => 'submitBtn',
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
                                'toggle'=>'',
                                'hasIcon' => true,
                                'title' => 'Добавить',
                                'icon' => 'ft fas fa-' . FA::_PLUS,
                                'btnType' => ZButtonWidget::btnType['button'],
                                'btnStyle' => ZButtonWidget::btnStyle['btn-outline-dark'],
                                'btnRounded' => false
                            ],
                            
                        ]);
                        ?>
                    </div>

                    <div class="ml-auto">
                        <div class="btn-group">

                            <?php
                            echo ZButtonWidget::widget([
                                'id' => 'delMen',
                                'config' => [
                                    'toggle'=>'',
                                    'hasIcon' => true,
                                    'title' => 'Удалить меню',
                                    'icon' => 'ft fas fa-' . FA::_TRASH_ALT,
                                    'btnType' => ZButtonWidget::btnType['button'],
                                    'btnStyle' => ZButtonWidget::btnStyle['btn-outline-danger'],
                                    'btnRounded' => false
                                ],
                                'event' =>[
                                'click'=><<<JS
                                function () {
                                    var myEditor = $('#myEditor');
                                    myEditor.empty();
                                }
JS,

                                ]
                            ]);

                            echo ZButtonWidget::widget([
                                'id' => 'setDat',
                                'config' => [
                                    'toggle'=>'',
                                    'hasIcon' => true,
                                    'title' => 'При мерное меню',
                                    'icon' => 'ft fas fa-' . FA::_CODE,
                                    'btnType' =>  ZButtonWidget::btnType['button'],
                                    'btnStyle' => ZButtonWidget::btnStyle['btn-outline-primary'],
                                    'btnRounded' => false
                                ]
                            ]);
                            ?>
                        </div>
                    </div>
                </div>

                <div id="out" class="form-group section-5 shadow-textare">
                 <textarea  class="form-control z-depth-512 min-tx-heigth" cols="1" rows="2"></textarea>
                </div>
            </div>
        </div>
    </div>
</div>

<?php

$createMenuJS = file_get_contents(Root . '/render/menus/assets/js/editor_library.js');
$editor_js = file_get_contents(Root . '/render/menus/assets/js/editor_js.js');

$editor_js = strtr($editor_js, [
    '{titles}' => $titleJS,
    '{action}' => $actionJS,
    '{icons}' => $iconJS,
    '{json}' => $json,
    '{menutable}' => $menutable,

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

<script>
    
    $(function () {

        let forms = $('.highlight-addon');
        forms.removeClass('form-group');
        
        
    });
    
    
</script>
<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>









