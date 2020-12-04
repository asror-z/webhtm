<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\models\shop\ShopOrder;
use zetsoft\system\helpers\ZUrl;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZCheckButtonWidget;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\menus\ZMmenuWidget;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;


/** @var ZView $this */


/**
 *
 * Action Params
 */

$action = new WebItem();

$action->title = Azl . 'Заказы';
$action->icon = 'fa fa-line-chart';
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


echo ZMMenuWidget::widget([
    //'data' => $this->cores->menus->create('mmenu'),
    'config' => [
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
    ],
]);
?>

<div id="page" >

    <?
    require Root . '/webhtm/block/header/main.php';
    require Root . '/webhtm/block/navbar/admin.php';

    echo ZSessionGrowlWidget::widget();?>

    <div id="content" class="content-footer p-3">


        <div class="row">
            <div class="col-md-12">

                <?

               /* $userCompanyID = 17;*/
                //$userCompanyID = $this->userIdentity()->user_company_id;

               /* if (empty($userCompanyID))
                    $userCompanyID = 4;*/

                $model = new ShopOrder();

                $model->configs->nameOn = [
                    'name',
                    'contact_name',
                    'date_deliver',
                    'code',
                    'status_logistics',
                    'status_callcenter',
                    'total_price',
                    'status_client'
                ];
              
                $model->columns();
                $url = ZUrl::to([
                    '/api/core/app/word',
                    'namespace' => 'office',
                    'service' => 'word2',
                    'method' => 'test'
                ]);

               /* $bb = ZCheckButtonWidget::widget([
                    'model' => $model,

                    'config' => [
                        'icon' => 'fal fa-clone fa-lg',
                        'hasIcon' => true,
                        'grapes' => false,

                        'url' => $url,

                        'class' => 'checkbox-' . $model->modelClassName,

                        'modelClassName' => $model->modelClassName
                    ]
                ]);*/


                /** @var ZView $this */
                echo ZDynaWidget::widget([
                    'model' => $model,
                    'leftBtn' => [
                        'update' => [
                            'content' => "",  //{$bb}
                            'options' => ['class' => 'btn-group p-1 {btnSize} {iconSize}']
                        ],
                    ],
                    'rightBtn' => [
                        'export' => [
                            'content' => '{exportExcel}',
                            'options' => ['class' => 'btn-group p-1 {btnSize} {iconSize}']
                        ],
                        /*  'add-tabular-clone-delete' => [
                              'content' => '{delete}',
                              'options' => ['class' => 'btn-group p-1 mr-0 {btnSize} {iconSize}']
                          ],*/
                        'filter-sort-id' => [
                            'content' => '{dynagridSettings}',
                            'options' => ['class' => 'btn-group p-1 mr-0 {btnSize} {iconSize}']
                        ],
                    ],
                    'config' => [
                        'chooseQuery' => [
                            'contact_name' => 'testUser'
                        ],
                        'hasToolbar' => true,
                        'editableLink' => true,
                        'search' => true,
                        'isCard' => false,
                        'bordered' => false,
                        'striped' => true,
                        'actionButtons' => [
                            'update',
                            'delete',
                            'clone',
                            'view',
                        ],
                        'columnBefore' => [
                            'serial',
                            'sort',
                            'checkbox',
                            'action',

                        ],
                        'columnAfter' => ['false']
                    ]
                ]);

                ?>

            </div>
        </div>


    </div>
    <? require Root . '\webhtm\block\footer\footerAdmin.php' ?>

</div>



<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>
