<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\models\ware\WareEnterItem;
use zetsoft\service\forms\Active;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZUrl;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\former\ZFormBuildWidget;
use zetsoft\widgets\former\ZFormWidget;
use zetsoft\widgets\inputes\ZInputWidget;
use zetsoft\widgets\menus\ZMmenuWidget;
use zetsoft\widgets\menus\ZMmenuWidget_Axror;
use zetsoft\widgets\menus\ZMmenuWidget_Axror1;
use zetsoft\widgets\menus\ZMmenuWidgetSh_Axror;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;
use zetsoft\widgets\themes\ZCardWidget;
use zetsoft\models\ware\WareEnter;


/** @var ZView $this */


/**
 *
 * Action Params
 */

$action = new WebItem();

$action->title = Azl . 'Редактирование Поступление товаров в склад';


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
echo ZMmenuWidget::widget([
    //'data' => $this->cores->menus->create('mmenu'),
    'config' => [
        'isAll' => true,
        'theme' => 'white',
        'content.img.width' => 230,
        'iconbar.top' => [
            "<a href='#/'><i class='fa fa-home'></i>cc</a>",
            "<a href='#/'><i class='fa fa-home'></i>cc</a>",
        ],
        'iconbar.bottom' => [
            "<a href='#/'><i class='fa fa-home'></i>aa</a>",
            "<a href='#/'><i class='fa fa-home'></i>cc</a>",
        ],
        'all.border' => ZMmenuWidget::border['border-full'],
        'menu-effect-slide' => true,
    ],
]);
?>

<div id="page">

    <?
    require Root . '/webhtm/block/navbar/admin.php';
   // require Root . '/webhtm/block/menu/menu-m_Axror.php';

    echo ZSessionGrowlWidget::widget();?>




        <div class="row">
            <div class="mx-auto col-md-10 col-10">

                <?

                $ware_enter_id = $this->httpGet('ware_enter_id');

                $ware_enter = WareEnter::findOne($ware_enter_id);

                if ($this->modelSave($ware_enter))
                    $this->urlRedirect(['index', true]);

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

                
                $ware_enter->responsible = $this->userIdentity()->id;

                $ware_enter->configs->widget = [
                    'date' => ZInputWidget::class
                ];

                $ware_enter->cards = [
                    [
                        'title' => Az::l('Первый этап'),
                        'items' => [
                            [
                                'title' => Az::l('Форма'),
                                'items' => [
                                    [
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


                $ware_enter->columns();

                echo ZFormBuildWidget::widget([
                    'model' => $ware_enter,
                    'form' => $form,
                    'config' => [
                        'botBtn' => false,
                        'cols' => 2,
                        'stepType' => ZFormBuildWidget::stepType['none'],
                        'blockType' => ZFormBuildWidget::blockType['naked']
                    ]
                ]);

                $this->activeEnd();

                ZCardWidget::end();


                ?>

            </div>


            <div class="col-md-10 mx-auto mt-5">

                <?

                $ware_enter_item = new WareEnterItem();
                  
                $ware_enter_item->configs->query = WareEnterItem::find()
                    ->where([
                        'ware_enter_id' => $ware_enter_id
                    ]);

                $ware_enter_item->configs->dynaButtons = [
                    'add-tabular-clone-delete' => [
                        'content' => "{add}{clone}{delete}",
                        'options' => ['class' => 'btn-group p-1 mr-0 {btnSize} {iconSize}']
                    ],
                ];

                $ware_enter_item->columns();

                /** @var ZView $this */
                echo ZDynaWidget::widget([
                    'model' => $ware_enter_item,
                    'config' => [
                        'hasToolbar' => true,
                        'spa' => true,
                        'reloadUrl' => ZUrl::to([
                            'process',
                            'ware_enter_id' => $this->httpGet('ware_enter_id')
                        ]),
                        'spaHeight' => '650px',
                        'columnBefore' => [
                            'serial',
                            'action',
                            'checkbox',
                            'id'
                        ],
                        'actionButtons' => [
                            'clone',
                            'delete',
                            'view'
                        ],
                        'columnAfter' => false,
                        'deleteAllUrl' => ZUrl::to([
                            'deleteItems',
                            'ware_enter_id' => $ware_enter_id
                        ]),
                        'createUrl' => ZUrl::to([
                            'create-process',
                            'ware_enter_id' => $ware_enter_id
                        ]),
                        'createTitle' => Az::l('Создание прихода в склад')
                    ]

                ]);
                ?>

            </div>

        </div>


    
    <? require Root . '\webhtm\block\footer\footerAdmin.php' ?>
</div>



<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>
