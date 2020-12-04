<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\service\forms\Active;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZFormWidget;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;
use zetsoft\widgets\themes\ZCardWidget;
use zetsoft\models\shop\ShopProduct;
use zetsoft\models\shop\ShopElement;
use zetsoft\widgets\former\ZDynaWidget;


/** @var ZView $this */


/**
 *
 * Action Params
 */

$action = new WebItem();

$action->title = Azl . 'Редактирование Продукты';


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

    echo ZSessionGrowlWidget::widget(); ?>

  <div id="content" class="content-footer p-3">


        <div class="row">
            <div class="col-md-12 col-12">

                <?

                $id = $this->httpGet('id');
                $model = ShopProduct::findOne($id);

                if ($this->modelSave($model)) {

                    $this->paramSet(paramIframe, true);

                    $this->urlRedirect([
                        'index',
                        'sort' => '-id'
                    ]);
                }




                ZCardWidget::begin([
                    'config' => [
                        'title' => Az::$app->view->title,
                        'type' => ZCardWidget::type['dynCard'],
                    ]
                ]);

                $active = new Active();

                $form = $this->activeBegin($active);

                $isCard = true;
                if ($this->httpGet('spa'))
                    $isCard = false;

                echo ZFormWidget::widget([
                    'model' => $model,
                    'form' => $form,
                    'config' => [
                        'isCard' => $isCard,
                    ],
                ]);

                $this->activeEnd();

                ZCardWidget::end();

                ?>

            </div>



            <div class="col-md-12 col-12">

                <?

                $elements = new ShopElement();
                $modelhttp = new ShopProduct();

                $elements->query = ShopElement::find()
                    ->where([
                        'shop_product_id' => $id
                    ]);

                $elements->configs->nameOn = [
                    'id',
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
                    'rightNameEx' => [
                        'system'
                    ],

                    'config' => [
                        'hasToolbar' => true,
                        'columnBefore' => [
                            'serial',
                            'action',
                            'checkbox',
                            'id'
                        ],
                        'actionButtons' => [
                            'clone',
                            'delete',
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
