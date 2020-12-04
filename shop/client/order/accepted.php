<?php

use kartik\grid\GridView;
use zetsoft\dbitem\core\WebItem;
use zetsoft\dbitem\data\TabItem;
use zetsoft\models\shop\ShopOrderItem;
use zetsoft\system\Az;
use zetsoft\system\column\ZExpandRowColumn;
use zetsoft\system\column\ZLinkPager;
use zetsoft\system\helpers\ZUrl;
use zetsoft\system\kernels\ZView;
use zetsoft\models\shop\ShopOrder;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\market\ZFooterAllWidget;
use zetsoft\widgets\market\ZFooterAllWidgetOrg;
use zetsoft\widgets\menus\ZMetisMenuWidget;
use zetsoft\widgets\navigat\ZSmartTabWidget;
use zetsoft\widgets\navigat\ZSmartTabWidget;

/** @var ZView $this */
$action = new WebItem();

$action->title = Azl . 'История заказов';
$action->icon = 'fa fa-area-chart';
$action->type = WebItem::type['html'];
$action->csrf = true;
$action->debug = true;



$this->paramSet(paramAction, $action);

$this->title();
$this->toolbar();

/** @var ZView $this */
$this->beginPage();

?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>

    <?php

    echo $this->require( '/webhtm/block/metas/main.php');
    echo $this->require( '/webhtm/block/assets/main.php');

    $this->head();

    ?>

</head>
<body class="<?= ZWidget::skin['white-skin'] ?>">
<?php

$this->beginBody();
echo $this->require( '/render/menus/ZSidebarWidget/ready/main.php');
echo $this->require( '/webhtm/block/navbar/main.php');
?>


<section class="main-sectio">
    <div class="container-fluid mt-2">
        <div class="row mt-3">

            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 media-category">
                <?
                echo ZMetisMenuWidget::widget([
                    'config' => [
                        'mode' => 'shop',
                        'theme' => ZMetisMenuWidget::theme['bozor2'],
                        'nameOn' => [
                            'My profile',
                        ],
                        'MenuOpen' => true,

                    ],
                ]);
                ?>
            </div>

            <div class="col-xl-9 col-lg-9 col-md-9 col-sm-12">
                <h3 class="py-2 text-muted">Завершенные заказы</h3>
                <div class="row">
                    <div class="col-12 mb-3">
                        <?
                        $userCompanyID = $this->userIdentity()->user_company_id;

                        $model = new ShopOrder();
                        $model->configs->edit = false;
                        $model->configs->filter = false;
                        $model->configs->nameOn = [
                            'id',
                            'name',
                            'date_deliver',
                            'status_client',
                            'total_price',
                            
                        ];

                        $model->configs->value=[
                            'contact_name'=>$this->userIdentity()->name,
                            'contact_phone'=>$this->
                            userIdentity()->phone,
                        ];

                        $model->configs->query = ShopOrder::find()
                            ->where([
                                'user_company_id' => $userCompanyID,
                                'status_client' => ShopOrder::status_client['accepted']
                            ]);

                        $model->columns();

                        echo ZDynaWidget::widget([
                            'model' => $model,
                            'rightNameEx' => [
                                'system'
                            ],
                            'config' => [
                                'title' => '',
                                'columnAction' => false,
                                'headerIcon' => '',
                                'titleSummary' => false,
                                'search' => false,
                                'hasToolbar' => false,
                                'editableLink' => true,
                                'copy' => false,
                                'columnBefore' => [
                                    'false'
                                ],
                                'isCard' => false,
                                'columnAfter' => ['asd'],
                                'theme' => 'success',
                                'bordered' => false,
                                'striped' => false,
                                'idColumnTitle' => 'Заказ №',
                                'pagerClass' => [
                                    'class' => ZLinkPager::class,
                                    'activePageCssClass' => 'bg-success rounded-sm ',
                                    'pageCssClass' => '',
                                    'prevPageCssClass' => '',
                                    'nextPageCssClass' => '',

                                ],
                            ]
                        ]);
                        ?>
                    </div>
                    <div class="col-12 my-3">

                        <?php
                        $model1=Az::$app->market->orderXolmat->getUserOrderList();

                        ?>

                    </div>
                </div>
            </div>



        </div>
    </div>
</section>
<?php
echo ZFooterAllWidgetOrg::widget([

]);
?>
<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>

