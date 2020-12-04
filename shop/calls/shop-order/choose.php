<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\helpers\ZUrl;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZCheckButtonWidget;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\menus\ZMmenuWidgetSh;
use zetsoft\widgets\navigat\ZButtonWidget;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;
use zetsoft\models\shop\ShopOrder;


/** @var ZView $this */


/**
 *
 * Action Params
 */

$action = new WebItem();

$action->title = Azl . 'Подобрать Заказы';
$action->icon = 'fal fa-lock';
$action->type = WebItem::type['html'];
$action->csrf = true;
$action->debug = false;



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

?>

<div class="p-3">

    <?

    echo ZSessionGrowlWidget::widget();?>


    <div class="p-2 row justify-content-end dynaCheck">

        <?

        $parentQuery = $this->httpGet('parentQuery');
        $query = $this->httpGet('chooseQuery');

        $model = new ShopOrder();

        $checkUrl = ZUrl::to([
            '/api/core/dyna/choose-dyna',
            'query' => $query,
            'parentQuery' => ZArrayHelper::getValue($parentQuery, 'where')
        ]);


        echo ZCheckButtonWidget::widget([
            'model' => $model,

            'config' => [

                'icon' => '',
                'text' => Az::l('Подобрать'),
                'hasIcon' => false,
                'btnType' => ZButtonWidget::btnType['link'],
                'grapes' => false,
                'btnStyle' => ZButtonWidget::btnStyle['btn-outline-primary'],
                'url' => $checkUrl,
                'title' => Az::l('Подборка'),
                'message' => Az::l('Вы хотите подобрать эти элементы?'),
            ],
            'event' => [
                'ajaxSuccess' => <<<JS
                     function() {
                         window.parent.closeSweet()
                         //window.parent.location.reload()    
                         $('#{$model->className}_Grid_Reset').click();
                     }
JS,
            ]

        ]);

        ?>

    </div>
    <div class="row">
        <div class="col-md-12 col-12">

            <?
            /** @var ZView $this */

            $model = new ShopOrder();

            $model->configs->query = ShopOrder::find()
                ->where($query);

            $model->configs->readonly = true;

            $model->columns();
            
            echo ZDynaWidget::widget([
                'model' => $model,
                'config' => [
                    'isCard' => false,
                    'columnBefore' => [
                        'checkbox',
                        'serial',
                        'id'
                    ],
                    'columnAfter' => [
                        'asd'
                    ],
                    'hasToolbar' => false,
                    'search' => false,
                ]
            ]);

            ?>

        </div>
    </div>
    <div class="p-2 row justify-content-end dynaCheck">

        <?

        echo ZCheckButtonWidget::widget([
            'model' => $model,

            'config' => [

                'icon' => '',
                'text' => Az::l('Подобрать'),
                'hasIcon' => false,
                'btnType' => ZButtonWidget::btnType['link'],
                'grapes' => false,
                'btnStyle' => ZButtonWidget::btnStyle['btn-outline-primary'],
                'url' => $checkUrl,
                'title' => Az::l('Подборка'),
                'message' => Az::l('Вы хотите подобрать эти элементы?'),
            ],
            'event' => [
                'ajaxSuccess' => <<<JS
                     function() {
                         window.parent.closeSweet()
                         //window.parent.location.reload()    
                         $('#{$model->className}_Grid_Reset').click();
                         }
JS,
            ]

        ]);

        ?>

    </div>


</div>


<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>
