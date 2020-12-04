<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\models\place\PlaceAdress;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZUrl;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\former\ZFormBuildWidget;
use zetsoft\widgets\former\ZFormWidget;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;
use zetsoft\widgets\themes\ZCardWidget;
use zetsoft\models\shop\ShopBrand;


/** @var ZView $this */


/**
 *
 * Action Params
 */

$action = new WebItem();

$action->title = Azl . 'Создание Бренды';
$action->icon = 'fa fa-globe';
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
require Root . '/webhtm/block/header/main.php';
require Root . '/webhtm/block/navbar/main.php';
require Root . '/render/menus/ZSidebarWidget/ready/main.php';

echo ZNProgressWidget::widget([]);

?>

<div id="page">

    <?

    echo ZSessionGrowlWidget::widget();?>

    <div id="content" class="content-footer p-3">

        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-12 mt-5">
                <div class="d-flex  justify-content-between">
                    <h5 class="text-uppercase text-muted ml-2 pt-3 pb-3 texts"><?= Az::l('Мои адреса') ?></h5>
                    <a href="<? echo ZUrl::to(['create']) ?>" class="text-success ml-1 mt-4 mr-2"><i
                                class="fas fa-map-marker-alt mr-2"></i><?= Az::l('Добавить новый адрес') ?></a>

                </div>

                <?

                $user = $this->userIdentity();

                /* if($this->userIsGuest())
                     $this->urlRedirect(['/core/user/user-auth/login-register']);*/

                $place = new PlaceAdress();

                if($user->place_adress_ids == null){
                    $place->query =
                        PlaceAdress::find()
                            ->where([
                                'id' => 65
                            ]);
                }else{
                    $place->query =
                        PlaceAdress::find()
                            ->where([
                                'id' => $user->place_adress_ids
                            ]);
                }



                $place->configs->filter = false;
                $place->configs->nameOn = [
                    'name',
                    'place',
                ];
                $place->configs->readonly = [
                    'place',
                    'adress',
                    'name',
                ];
                $place->columns();
                echo ZDynaWidget::widget([
                    'model' => $place,
                    'config' => [
                        'hasToolbar' => true,
                        'editableLink' => true,
                        'search' => false,
                        'copy' => false,
                        'columnBefore' => [
                            'radio'
                        ],
                        'isCard' => false,
                        'columnAfter' => ['asd'],
                        'panelTemplate' => '{items}',
                        'theme' => 'success',
                        'bordered' => false,
                        'striped' => false,
                    ],
                     'rightBtn' => [
                            'update' =>
                            [
                                'content' => '',
                            ],

                            'add-tabular-clone-delete' =>
                            [
                                'content' => '{delete}',
                            ],

                            'filter-sort-id' => [
                                'content' => '',
                            ],

                            'export' => [
                                'content' => '',
                            ],

                            'exportAll' => [
                                'content' => '',
                            ],

                            'exportExcel' => [
                                'content' => '',
                            ],

                            'toggleData' => [
                                'content' => '',
                            ],
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
