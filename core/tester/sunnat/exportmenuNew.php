<script>
    $(document).ready(() => {
            const data = {
                'export_type': 'Xls',
                'exportFull_w0': '1',
                'export_columns': ["0", "1", "2", "3", "4", "5", "6"],
                'column_selector_enabled': '1',
            }
            console.log(JSON.stringify(data))
            const postRequest = () => {
                fetch('', {
                    method: 'POST', // GET, POST, PUT, DELETE, etc.
                    headers: {
                        'Content-Type': 'application/json'
                        // 'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: JSON.stringify(data), // тип данных в body должен соответcвовать значению заголовка "Content-Type"

                }).then(response => response.json())
                    .then(response => {
                        console.log(response)
                    })
                    .catch(err => console.log(err))
            };
            $('#ed8b4524-afdf-4fb8-84d4-1c747d0c8d5a').attr('onclick', postRequest());
        }
    );

    /* document.getElementById("w0-csv").setAttribute('onclick', 'postRequest()')
       document.getElementById("w0-txt").setAttribute('onclick', 'postRequest()')
       document.getElementById("w0-pdf").setAttribute('onclick', 'postRequest()')
       document.getElementById("w0-xls").setAttribute('onclick', 'postRequest()')
       document.getElementById("w0-xlsx").setAttribute('onclick', 'postRequest()')
    */

</script>

<?php

/**
 *
 *
 * Author:  Asror Zakirov
 * https://www.linkedin.com/in/asror-zakirov
 * https://www.facebook.com/asror.zakirov
 * https://github.com/asror-z
 *
 */


use kartik\export\ExportMenu;
use kartik\grid\GridView;
use kartik\helpers\Html;
use zetsoft\models\user\User;
use zetsoft\system\kernels\ZView;

$model = new User();
$dataProvider = $model->search();
$dataProvider->pagination = [
    'pageSize' => 10,
];


/*$gridColumns = [
    ['class' => 'kartik\grid\SerialColumn'],
    'id',
    'name',
    'role',
];        */


/*echo ExportMenu::widget([
    'dataProvider' => $dataProvider,
    'columns' => $gridColumns,
]);  */

/**************************/

$gridColumns = [
    ['class' => 'kartik\grid\SerialColumn'],
    'id',
    'name',
    [
        'attribute' => 'role',
        'label' => 'Role',
        'vAlign' => 'middle',
        'width' => '190px',
        'value' => function ($model, $key, $index, $widget) {
            return Html::a($model->role, '#', []);
        },
        'format' => 'raw'
    ],
    'email',
    'phone',
    'password',
    //['attribute'=>'buy_amount','format'=>['decimal',2], 'hAlign'=>'right', 'width'=>'110px'],
    //['attribute'=>'sell_amount','format'=>['decimal',2], 'hAlign'=>'right', 'width'=>'110px'],
    ['class' => 'kartik\grid\ActionColumn', 'urlCreator' => function () {
        return '#';
    }]
];


/** @var ZView $this */
$this->modelPost();


echo ExportMenu::widget([
    'dataProvider' => $dataProvider,
    'columns' => $gridColumns,
    'target' => ExportMenu::TARGET_BLANK,
    'pjaxContainerId' => 'kv-pjax-container',
    'exportContainer' => [
        'class' => 'btn-group mr-2'
    ],
    'dropdownOptions' => [
        'label' => 'Full',
        'class' => 'btn btn-secondary',
        'itemsBefore' => [
            '<div class="dropdown-header">Export All Data</div>',
        ],
    ],
]);


$fullExportMenu = ExportMenu::widget([
    'dataProvider' => $dataProvider,
    'columns' => $gridColumns,
    'target' => ExportMenu::TARGET_BLANK,
    'pjaxContainerId' => 'kv-pjax-container',
    'exportContainer' => [
        'class' => 'btn-group mr-2'
    ],
    'dropdownOptions' => [
        'label' => 'Full',
        'class' => 'btn btn-secondary',
        'itemsBefore' => [
            '<div class="dropdown-header">Export All Data</div>',
        ],
    ],
]);

echo "<button class='btn btn-success' id='ed8b4524-afdf-4fb8-84d4-1c747d0c8d5a'>Export to Excel</button>";
echo GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => $gridColumns,
    'pjax' => true,
    'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container']],
    'panel' => [
        'type' => GridView::TYPE_PRIMARY,
        'heading' => '<h3 class="panel-title"><i class="fas fa-book"></i> Library</h3>',
    ],
    // set a label for default menu
    'export' => [
        'label' => 'Page',
    ],
    'exportContainer' => [
        'class' => 'btn-group mr-2'
    ],
    // your toolbar can include the additional full export menu
    'toolbar' => [
        '{export}',
        $fullExportMenu,
        [
            'content' =>
                Html::button('<i class="fas fa-plus"></i>', [
                    'class' => 'btn btn-success',
                    'title' => Yii::t('kvgrid', 'Add Book'),
                    'onclick' => 'alert("This will launch the book creation form.\n\nDisabled for this asset!");'
                ]) . ' ' .
                Html::a('<i class="fas fa-redo"></i>', ['grid-asset'], [
                    'class' => 'btn btn-outline-secondary',
                    'title' => Yii::t('kvgrid', 'Reset Grid'),
                    'data-pjax' => 0,
                ]),
            'options' => ['class' => 'btn-group']
        ],
    ]
]);
?>
