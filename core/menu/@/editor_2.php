<?php

use kartik\form\ActiveForm;
use zetsoft\system\helpers\ZHTML;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\inputes\ZInputWidget;
use zetsoft\widgets\inputes\ZKSelect2Widget;
use zetsoft\widgets\inputes\ZRadioButtonGroup;
use zetsoft\widgets\navigat\ZButtonWidget;
use zetsoft\widgets\themes\ZCardWidget;


/** @var ZView $this */

$this->registerCssFile('/webhtm/core/menu/assets/JqueryMenu/bootstrap.min.css');
$this->registerCssFile('/webhtm/core/menu/assets/JqueryMenu/bootstrap-iconpicker.min.css');

$this->registerJsFile('/webhtm/core/menu/assets/JqueryMenu/fontawesome5-3-1.min.js');
$this->registerJsFile('/webhtm/core/menu/assets/JqueryMenu/bootstrap-iconpicker.min.js');
$this->registerJsFile('/webhtm/core/menu/assets/JqueryMenu/menueditor.js');


$this->registerJs(<<<JS
var iconPickerOptions = {searchText: "Buscar...", labelHeader: "{0}/{1}"};
var sortableListOptions = {
    placeholderCss: {'background-color': "#cccccc"}
};

var editor = new MenuEditor('myEditor', {listOptions: sortableListOptions, iconPicker: iconPickerOptions});

editor.setForm($('#frmEdit'));

editor.setUpdateButton($('#btnUpdate'));

editor.setData({$json});

$("#btnUpdate").click(function(){
    editor.update();
    $("#coremenu-json").val(editor.getString());
});

$('#btnAdd').click(function(){
    editor.add();
    $("#coremenu-json").val(editor.getString());
});

$('#menuform').submit(function() {
    $("#coremenu-json").val(editor.getString());
    return true;
});

$('.menu-url-type').find('input').addClass('item-menu')

JS
);
$this->registerCss(<<<CSS
.menu-editor-input {
	padding: 22px 15px;
}
CSS
);


$form = ActiveForm::begin(['id' => 'menuform']);

echo $form->field($form, 'json')->textarea(['value' => $json])->label(false);

echo ZHTML::submitButton('Сохранить', ['class' => 'btn btn-sm btn-primary']);

ActiveForm::end();

?>

<div class="row">
    <div class="col-6">
        <ul id="myEditor" class="sortableLists list-group">
        </ul>
    </div>

    <div class="col-6">
        <? ZCardWidget::begin([
            'config' => [
                'type' => ZCardWidget::type['basic_new'],
                'title' => 'Edit Menu'
            ]
        ]);
        ?>
        <div class="card-body">
            <? $form = ActiveForm::begin(['id' => 'frmEdit']);
            ?>
            <div class="form-group">
                <div class="input-group">

                    <?

                    echo ZInputWidget::widget([

                        'config' => [
                            'hasDiv' => false,
                            'inputId' => 'text',
                            'class' => 'form-control item-menu menu-editor-input',
                            'name' => 'text',
                            'placeholder' => 'Text',
                        ]
                    ]);

                    ?>
                    <div class="input-group-append">

                    </div>
                </div>
                <!-- <input type="hidden" name="icon" class="item-menu">-->
                <?

                echo ZInputWidget::widget([

                    'config' => [
                        'hasDiv' => false,
                        'type' => 'hidden',
                        'class' => 'item-menu',
                        'name' => 'icon',
                    ]
                ]);

                ?>
            </div>
            <div class="row">
                <div class="col-6 menu-url-type">
                    <?= ZRadioButtonGroup::widget([
                        'id' => 'urlType',
                        'name' => 'urlType',
                        'data' => [
                            'absolute' => 'Absolute url',
                            'action' => 'action',
                        ],
                    ]) ?>

                </div>
                <div class="col-6 mb-2">
                    <?= ZKSelect2Widget::widget([
                        'id' => 'target',
                        'name' => 'target',
                        'data' => [
                            '_self' => 'Self',
                            '_blank' => 'Blank',
                            '_top' => 'Top',
                        ],
                        'config' => ['class' => 'form-control item-menu']
                    ]) ?>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <?

                        echo ZInputWidget::widget([

                            'config' => [
                                'hasDiv' => false,
                                'inputId' => 'href',
                                'class' => 'form-control item-menu',
                                'name' => 'href',
                                'placeholder' => 'URL',
                                'required' => true
                            ]
                        ]);

                        ?>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <?

                        echo ZInputWidget::widget([

                            'config' => [
                                'hasDiv' => false,
                                'inputId' => 'class',
                                'class' => 'form-control item-menu',
                                'name' => 'class',
                                'placeholder' => 'CSS class',
                            ]
                        ]);

                        ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <?= ZKSelect2Widget::widget([
                        'id' => 'page_action_id',
                        'data' => $actions,
                        'config' => ['class' => 'form-control item-menu'],
                        'event' => ['closing' => <<<JS
             function () {
                
             }           
JS,]
                    ]) ?>
                </div>

                <div class="col-6">
                    <div class="form-group">
                        <?

                        echo ZInputWidget::widget([

                            'config' => [
                                'hasDiv' => false,
                                'inputId' => 'args',
                                'class' => 'form-control item-menu menu menu-editor-input',
                                'name' => 'args',
                                'placeholder' => 'Args',
                            ]
                        ]);

                        ?>
                    </div>
                </div>
            </div>

            <? ActiveForm::end() ?>
        </div>
        <div class="card-end">
            <?
            echo ZButtonWidget::widget([
                'config' => [
                    'icon' => 'fas fa-sync',

                    'class' => 'btn btn-primary',
                    'name' => 'UPDATE',
                ],
                'id' => 'btnUpdate'
            ]);
            ?>

            <?
            echo ZButtonWidget::widget([
                'config' => [
                    'icon' => 'fas fa-plus',

                    'class' => 'btn btn-success',
                    'name' => 'Add',
                ],
                'id' => 'btnAdd'
            ]);
            ?>
        </div>

        <?

        ZCardWidget::end();
        ?>
    </div>
</div>



