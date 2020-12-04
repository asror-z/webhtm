<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\models\ware\WareExitItem;
use zetsoft\service\forms\Active;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZUrl;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\former\ZDynaWidget2;
use zetsoft\widgets\former\ZFormBuildWidget;
use zetsoft\widgets\former\ZFormWidget;
use zetsoft\widgets\inputes\ZInputWidget;
use zetsoft\widgets\menus\ZMmenuWidget;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;
use zetsoft\widgets\themes\ZCardWidget;
use zetsoft\models\ware\WareExit;


/** @var ZView $this */


/**
 *
 * Action Params
 */

$action = new WebItem();

$action->title = Azl . 'Новое списание со склада';


$action->icon = 'fal fa-film';
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
echo ZNProgressWidget::widget([]);

echo ZMmenuWidget::widget([]);
?>


<div id="page">

    <?
    require Root . '/webhtm/block/header/main.php';
    require Root . '/webhtm/block/navbar/admin.php';

    echo ZSessionGrowlWidget::widget();?>

    <div id="content" class="content-footer p-3">


        <div class="row">
            <div class="mx-auto col-md-12">

                <?

                $ware_exit_id = $this->httpGet('ware_exit_id');

                $ware_exit = WareExit::findOne($ware_exit_id);

                if ($this->modelSave($ware_exit))
                    $this->urlRedirect([
                        'index'
                    ]);

                ZCardWidget::begin([
                    'config' => [
                        'title' => Az::$app->view->title,
                        'type' => ZCardWidget::type['dynCard'],
                    ]
                ]);


                $active = new Active();
                $active->type = Active::type['vertical'];
                $active->childClass = 'my-3';

                $form = $this->activeBegin($active);
                $ware_exit->responsible = $this->userIdentity()->id;
                //$ware_exit->responsible = 265;

                $ware_exit->configs->readonlyWidgets = [
                    'responsible',
                    'date'
                ];

                $ware_exit->configs->widget = [
                    'date' => ZInputWidget::class
                ];

                $ware_exit->cards = [
                    [
                        'title' => Az::l('Первый этап'),
                        'items' => [
                            [
                                'title' => Az::l('Форма'),
                                'items' => [
                                    [
                                        'name',
                                        'date',
                                        'ware_id',
                                        'responsible',
                                        'user_company_id',
                                        // 'shop_courier_id',
                                        'comment',
                                    ],
                                ],
                            ],
                        ],
                    ]
                ];

                $ware_exit->configs->readonlyWidgetOff = [
                    'comment',
                ];
                $ware_exit->columns();

                echo ZFormBuildWidget::widget([
                    'model' => $ware_exit,
                    'form' => $form,
                    'config' => [
                        'title' => Az::l('Новое списание со склада'),
                        'botBtn' => false,
                        'btnTitle' => Az::l('Сформировать и закрыть'),
                        'cols' => 2,
                        'stepType' => ZFormBuildWidget::stepType['none'],
                        'blockType' => ZFormBuildWidget::blockType['naked']
                    ]
                ]);

                $this->activeEnd();

                ZCardWidget::end();


                ?>

            </div>


            <div class="col-md-12 mx-auto mt-5">

                <?

                $ware_exit_item = new WareExitItem();

                $ware_exit_item->query = WareExitItem::find()
                    ->where([
                        'ware_exit_id' => $ware_exit_id
                    ]);

                $ware_exit_item->configs->title = Az::l('Продукты для списания со склада');

                $ware_exit_item->configs->dynaButtons = [
                    'update' => [
                        'content' => "{update}",
                        'options' => ['class' => 'btn-group p-1 mr-0 {btnSize} {iconSize}']
                    ],
                    'add-tabular-clone-delete' => [
                        'content' => "{add}{delete}",
                        'options' => ['class' => 'btn-group p-1 mr-0 {btnSize} {iconSize}']
                    ],
                ];

                $ware_exit_item->configs->nameOff = [
                    'ware_exit_id'
                ];


                $ware_exit_item->configs->width = [
                    'shop_catalog_id' => '500px',
                    'name' => '250px',
                    'weight' => '80px',
                    'amount' => '80px',
                    'ware_series_id' => '120px',
                ];

                $ware_exit_item->columns();
                /** @var ZView $this */
                echo ZDynaWidget::widget([
                    'model' => $ware_exit_item,
                    'config' => [
                        'hasToolbar' => true,
                        'spa' => true,
                        'spaHeight' => [
                            'create' => '550px',
                            'update' => '900px',
                            'view' => '750px',
                        ],
                        'viewUrl' => '{fullUrl}/view-process.aspx?id={id}',
                        'columnBefore' => [
                            'serial',
                            'action',
                            'checkbox',
                            'id'
                        ],
                        'chooseUrl' => '{fullUrl}/choose.aspx?ware_id=' . $ware_exit->ware_id . '&user_company_id=' . $ware_exit->user_company_id,
                        'actionButtons' => [
                            'clone',
                            'delete',
                            'view'
                        ],

                        'columnAfter' => false,

                        'deleteAllUrl' => '/api/core/dyna/delete-all.aspx?modelClassName={modelClassName}&ware_exit_id=' . $ware_exit_id,
                        
                        'createUrl' => '{fullUrl}/create-process.aspx?ware_exit_id=' . $ware_exit_id
                          .  '&ware_id=' . $ware_exit->ware_id . '&user_company_id=' . $ware_exit->user_company_id,
                        'createTitle' => Az::l('Создание прихода в склад')
                    ]

                ]);
                ?>

            </div>

        </div>


    </div>
    <?

    require(Root . '/webhtm/block\footer\mplace\footerAdmin.php')

    ?>
</div>



<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>
