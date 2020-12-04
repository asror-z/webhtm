<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\models\shop\ShopCatalog;
use zetsoft\models\shop\ShopCatalogWare;
use zetsoft\models\shop\ShopOrder;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\helpers\ZUrl;
use zetsoft\system\helpers\ZVarDumper;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZCheckButtonWidget;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\navigat\ZButtonWidget;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;


/** @var ZView $this */


/**
 *
 * Action Params
 */

$action = new WebItem();

$action->title = Azl . 'Страны';
$action->icon = 'fal fa-line-chart';
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
        $user_company_id = $this->httpGet('user_company_id');
        $ware_id = $this->httpGet('ware_id');

        //$query = ZVarDumper::arrayFilter($query, true);

        $model = new ShopCatalog();

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
                'btnStyle' => ZButtonWidget::btnStyle['btn-transparent'],
                'btnSize' => ZButtonWidget::btnSize['btn-mini'],
                'url' => $checkUrl,
                'class' => 'rounded-0',
                'title' => Az::l('Подборка'),
                'message' => Az::l('Вы хотите подобрать эти элементы?'),
            ],
            'event' => [
                'ajaxSuccess' => <<<JS
                     function() {
                         window.parent.closeSweet()
                         window.parent.location.reload()    
                     }
JS,
            ]

        ]);

        ?>

    </div>
    <div class="row">
        <div class="col-md-12">

            <?
            $this->pjaxBegin();
            /** @var ZView $this */


            $shop_catalogs = ShopCatalog::find()
                ->where([
                    'user_company_id' => $user_company_id
                ])
                ->asArray()
                ->all();

            $shop_catalog_ids = ZArrayHelper::getColumn($shop_catalogs, 'id');

            $shop_catalog_wares = ShopCatalogWare::find()
                ->where([
                    'ware_id' => $ware_id,
                    'shop_catalog_id' => $shop_catalog_ids
                ])
                ->asArray()
                ->all();

            $shop_catalog_ids = ZArrayHelper::getColumn($shop_catalog_wares, 'shop_catalog_id');
            
            $model->configs->query = ShopCatalog::find()
                ->where([
                    'id' => $shop_catalog_ids
                ]);

            $model->configs->readonly = true;
            $model->configs->nameOn = [
                'name',
                'user_company_id',
                'shop_element_id',
                'amount',
                'price',
                'price_old',
                'currency',
            ];
            $model->columns();

            echo ZDynaWidget::widget([
                'model' => $model,
                'config' => [
                    'isCard' => false,
                    'pjax' => false,
                    'columnBefore' => [
                        'checkbox',
                        'serial',
                        'id'
                    ],
                    'hasToolbar' => false,
                    'search' => false,
                    'heighbody' => '62vh',
                ]
            ]);
            $this->pjaxEnd();
            ?>

        </div>
    </div>


</div>


<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>
