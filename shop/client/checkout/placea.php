<?php

use zetsoft\models\user\User;
use zetsoft\dbitem\core\WebItem;
use zetsoft\models\place\PlaceAdress;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZDynaWidget;


/** @var ZView $this */


/**
 *
 * Action Params
 */

$action = new WebItem();

$action->title = Azl . 'Тестовые компоненты';
$action->icon = 'fa fa-cropLength';
$action->type = WebItem::type['html'];
$action->csrf = true;
$action->debug = true;



$this->paramSet(paramAction, $action);

$this->title();
$this->toolbar();


/**
 *
 * Start Page
 */

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

<div id="page">

    <div id="content" class="content-footer p-3">


        <div class="row">
            <div class="col-md-12">

                <?php


                $model = new PlaceAdress();
                $model->configs->query = PlaceAdress::find()
                    ->where([
                        'id' => $this->userIdentity()->place_adress_ids
                    ]);

                $model->configs->nameOn = [
                    'name',
                    'place_country_id',
                    'place_region_id',
                    'street',
                    'home',
                    'orientation',
                    'postal_code',
                    'place',
                    'location',

                ];

                echo ZDynaWidget::widget([
                    'model' => $model,
                    'rightBtn' => [
                        'update' => [
                            'content' => '{update}',
                            'options' => ['class' => 'btn-group p-0 mr-2 {btnSize} {iconSize}']
                        ],

                        'add-tabular-clone-delete' => [
                            'content' => "{add}{delete}",
                            'options' => ['class' => 'btn-group p-0 mr-2 {btnSize} {iconSize}']
                        ],

                        'filter-sort-id' => [
                            'content' => ''
                        ],

                        'export' => [
                            'content' => ''
                        ],

                        'exportAll' => [
                            'content' => ''
                        ],

                        'exportExcel' => [
                            'content' => ''
                        ],

                        'toggleData' => [
                            'content' => ''
                        ],
                    ],
                    'config' => [
                        'columnBefore' => [
                            'serial',
                            'radio'
                        ],
                        'columnAfter' => [
                            'false'
                        ]
                    ]
                ])

                ?>


            </div>
        </div>


    </div>

</div>


<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>
