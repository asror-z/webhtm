<?php                                

use zetsoft\dbitem\core\WebItem;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\inputes\ZSelect2Widget;
use zetsoft\widgets\inputes\ZSelect2Widget2;
use zetsoft\widgets\menus\ZMmenuWidget;
use zetsoft\widgets\menus\ZMmenuWidgetSh;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;
use zetsoft\models\user\User;


/** @var ZView $this */


/**
 *
 * Action Params
 */
 
$action = new WebItem();

$action->title = Azl . 'Админ';
$action->icon = 'fa fa-globe';
$action->type = WebItem::type['html'];
$action->csrf = true;
$action->debug = true;



$this->paramSet(paramAction, $action);

$this->title();
$this->toolbar();


//$boot->env('sphinxIP');

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

?>

<div id="page">

    <?

    require Root . '/webhtm/block/navbar/admin.php';

    echo ZSessionGrowlWidget::widget();?>

    <div id="content" class="content-footer p-2">

        <div class="row">
            <div class="col-md-12">

                <?
                $id = $this->httpGet('id');
                $model = new User();
                /*$model->configs->query = User::find()
                ->where([
                'status' => 'online'
                ])
                ->andWhere([
                  'role' => 'seller',
                ]);*/

                $select2 = ZSelect2Widget2::widget([
                    'data' => [
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
                        'btn-dark' => 'btn-dark',
                    ],
                ]);

                /** @var ZView $this */
                echo ZDynaWidget::widget([
                    'model' => $model,
                    'leftBtn' => [
                        'update' => [
                            'content' => $select2,
                            'options' => ['class' => 'btn-group p-1 mr-0 {btnSize} {iconSize}']
                        ],
                    ]
                ]);

                echo ZMMenuWidget::widget([
                    'config' => [
                        'theme'=> 'white',
                        'content.img.width' => 80,
                        'iconbar.top' => [
                            "<a href='#/'><i class='fa fa-home'></i>cc</a>",
                            "<a href='#/'><i class='fa fa-home'></i>cc</a>",
                        ],
                        'iconbar.bottom' => [
                            "<a href='#/'><i class='fa fa-home'></i>aa</a>",
                            "<a href='#/'><i class='fa fa-home'></i>cc</a>",
                        ],
                        'all.border' => ZMMenuWidgetSh::border['border-full'],
                    ],
                ]);
          
                ?>

            </div>
        </div>


    </div>

</div>

<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>
