<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZViewWidget;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;
use zetsoft\models\shop\ShopProduct;
use zetsoft\models\shop\ShopElement;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\system\Az;


/** @var ZView $this */


/**
 *
 * Action Params
 */

$action = new WebItem();

$action->title = Azl . 'Просмотр Продукты';
$action->icon = 'fal fa-calendar-plus-o';
$action->type = WebItem::type['html'];
$action->csrf = true;

if ($this->httpGet('spa'))
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

<div id="page">

    <?

    if (!$this->httpGet('spa'))
        require Root . '/webhtm/block/navbar/main.php';

    echo ZSessionGrowlWidget::widget();?>

    <div id="content" class="content-footer p-3">


        <div class="row">
            <div class="col-md-12 col-12">
                <?
                $id = $this->httpGet('id');
                $model = ShopProduct::findOne($id);

                $isCard = true;
                if ($this->httpGet('spa'))
                    $isCard = false;

                echo ZViewWidget::widget([
                    'model' => $model,
                    'config' => [
                        'isCard' => $isCard
                    ]
                ]);

                ?>

                </div>

                <div class="col-md-12 col-12 mt-5">

                <?

                $elements = new ShopElement();
                $modelhttp = new ShopProduct();

                $elements->query = ShopElement::find()
                    ->where([
                        'shop_product_id' => $id
                    ]);

                $elements->configs->nameOn = [
                    'name',
                    'user_company_id',
                    'shop_product_id',
                    'barcode',
                    'barcode_type',
                    'active',
                    'shop_option_ids',
                ];

                $elements->configs->dynaButtons = [
                    'update' => [
                        'content' => '{update}',
                        'options' => ['class' => 'btn-group p-1 mr-0 {btnSize} {iconSize}']
                    ],
                    'add-tabular-clone-delete' => [
                        'content' => '{add}{clone}{delete}',
                        'options' => ['class' => 'btn-group p-1 mr-0 {btnSize} {iconSize}']
                    ],

                ];

                $elements->configs->widget = [
                    'weight' => ZHInputWidget::class
                ];

                $elements->columns();


                /** @var ZView $this */
                echo ZDynaWidget::widget([

                    'model' => $elements,

                    'config' => [
                            'search' => false,
                        'hasToolbar' => false,
                        'columnBefore' => [
                            'serial',
                        ],
                        'actionButtons' => [
                            '',
                        ],
                        'spaHeight' => [
                            'create' => '800px',
                            'view' => '800px',
                        ],
                        'columnAfter' => false,
                        'viewUrl' => '/shop/admin/shop-element/view-process.aspx?shop_product_id=' . $id,
                        'deleteAllUrl' => '/api/core/dyna/delete-all.aspx?modelClassName={modelClassName}&shop_product_id=' . $id,
                        'createUrl' => "/shop/admin/shop-element/create-element-process.aspx?shop_product_id=" . $id . "&model=ShopProduct",
//                        ?id=111130&model=ShopProduct
                        'createTitle' => Az::l('Создание прихода в склад')

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
