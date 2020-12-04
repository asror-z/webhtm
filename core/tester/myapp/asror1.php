<?php

/**
 *
 *
 * Author:  Asror Zakirov
 * https://www.linkedin.com/in/asror-zakirov
 * https://github.com/asror-z
 *
 */


use zetsoft\models\user\User;
use zetsoft\models\App\eyuf\EyufDocument;
use zetsoft\system\kernels\ZView;
use zetsoft\system\module\Models;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\incores\ZDynaCheckboxWidget;

echo 'test';
$action->title = Azl . 'Пользователь';

$action->icon = 'fa fa-birthday-cake';
$action->debug = true;
$action->type = WebItem::type['html'];


/** @var ZView $this */


$model = new User();
$model->configs->editsEx = [
    'name',
    'role',
];

$model->configs->nameOn = [
    'photo',
    'email',
    'name',
    'role',
];



echo ZDynaCheckboxWidget::widget([
    'id' => '',
    'name' => 'selection_all',
    'config' => [
        'class' => 'select-on-check-all',
        'color' => ZDynaCheckboxWidget::color['red']
    ]
]);


$modelClass  = EyufDocument::class;

/** @var Models $model */
$model = new $modelClass();
$columns = $model->columns;


// ?status|need_verify|
 <<<JS

   $(document).on("click", "#Get", function() {

        var keys = "";
        var checkedArray = [];
                                        
        

        $("aziz").each(function (index) {
            if ($(this).prop("checked")) {
                keys += $(this).val() + "|";
                checkedArray.push(keys);
                console.log(checkedArray)
            }
        });

        if (keys === "") {
            alert("Элементы не выбраны?");

        } else {

            if (window.confirm("Вы действительно хотите клонировать все эти данные?")) {

                $.ajax({
                    type: "GET",
                    url: 'http://eyuf.zettest.uz/render/%40%20Other/lazy1/cleanMafa.html',
                    data: {keys: keys},
                    success: function () {

                    }
                });

            }
        }
    });

JS;



foreach ($columns as $key => $column) {
    echo ZDynaCheckboxWidget::widget([
        'name' => $key,
        'value' => $key,
        'config' => [
            'label' => $column->title,
            'class' => 'aziz',
            'color' => ZDynaCheckboxWidget::color['red']
        ]
    ]);
}




