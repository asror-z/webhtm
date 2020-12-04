<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\models\shop\ShopOrder;
use zetsoft\models\shop\ShopOrderTest;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\menus\ZMmenuWidget;
use zetsoft\widgets\values\ZDateFormatWidget;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;
use zetsoft\models\calls\CallsCel;


/** @var ZView $this */


/**
 *
 * Action Params
 */

$action = new WebItem();

$action->title = Azl . 'Детализация звонков';
$action->icon = 'fal fa-balance-scale';
$action->type = WebItem::type['html'];
$action->csrf = true;

if ($this->httpGet('spa'))
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
if (!$this->httpGet('spa'))
    echo ZMmenuWidget::widget([
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
            'menu-effect-slide' => true,
        ],
    ]);
?>

<div id="page">

    <?
    if (!$this->httpGet('spa'))
        require Root . '/webhtm/block/navbar/admin.php';

    echo ZSessionGrowlWidget::widget();?>

    <div id="content" class="content-footer p-3">

        <div class="row">
            <div class="col-md-12 col-12">

                <?

                $model = new ShopOrderTest();

                $model->columns();

                /** @var ZView $this */
                echo ZDynaWidget::widget([
                    'model' => $model,
                    'rightNameEx' => [
                        'system',
                        'add-clone-delete'
                    ],
                    'config' => [
                        'actionButtons' => [
                            'update',
                            'delete',
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

</div>

<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>
