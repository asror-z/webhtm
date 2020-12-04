<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\models\cpas\CpasOffer;
use zetsoft\models\cpas\CpasOfferItem;
use zetsoft\models\cpas\CpasLand;
use zetsoft\models\cpas\CpasStream;
use zetsoft\models\cpas\CpasWidgets;
use zetsoft\models\shop\ShopBrand;
use zetsoft\system\assets\ZColor;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZUrl;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZCheckDependWidget;
use zetsoft\widgets\former\ZDynaCheckWidget;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\former\ZDynaWidgetactioncolor;
use zetsoft\widgets\former\ZDynaWidgetbackup_2020_07_02;
use zetsoft\widgets\former\ZFormBuildWidget;
use zetsoft\widgets\inputes\ZHHiddenInputWidget;
use zetsoft\widgets\inputes\ZInputWidget;
use zetsoft\widgets\inputes\ZSelect2Widget;
use zetsoft\widgets\navigat\ZBreadcrumbsWidget;
use zetsoft\widgets\navigat\ZButtonWidget;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;
use zetsoft\widgets\themes\ZCardWidget;
use function GuzzleHttp\Psr7\str;


/** @var ZView $this */


/**
 *
 * Action Params
 */

$action = new WebItem();

$action->title = Azl . 'Создание Сайт';
$action->icon = 'fa fa-globe';
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


< class="<?= ZWidget::skin['white-skin'] ?>">

<?php

$this->beginBody();

/*require Root . '/webhtm/block/header/main.php';*/
require Root . '/webhtm/block/header/main.php';

echo ZNProgressWidget::widget([]);

echo ZNProgressWidget::widget([]);


//$sit = $this->httpPost('sites');

?>

<div id="page">

    <?

    echo ZSessionGrowlWidget::widget();?>
    <div class="container-fluid grey lighten-5">
        <div class="mt-2">
            <h2 class="text-muted">Новый поток</h2>
            <?php
            $id = $this->httpGet('id');
            if (isset($id))
                echo ZBreadcrumbsWidget::widget([
                    'config' => [
                        'mode' => ZBreadcrumbsWidget::mode['page'],
                        'category_id' => $id
                    ]
                ]);
            ?>
        </div>
        <div class="col-md-12">
            <div class="row">

                <div class="col-md-12">
                    <?
                    $model = new CpasOffer();

                    echo '<div class="ml-2">' . ZDynaCheckWidget::widget([

                            'config' => [
                                'attr' => 'status',
                                'value' => 'active',
                                'modelClassName' => $model->className,
                                'btnOptions' => [
                                    'config' => [
                                        'text' => Az::l('подтвердить'),
                                        'btnType' => ZButtonWidget::btnType['button'],
                                        'btnRounded' => false,
                                        'btnStyle' => 'text-info',
                                        'btnSize' => 'btn-ml',
                                        'class' => 'p-1'
                                    ]
                                ]
                            ],
                            'event' => [
                                'ajaxComplete' => <<<JS
   function () {
           location.reload()
   }
JS,

                            ]
                        ]) . '</div>';

                    $form = $this->activeBegin();


                    $model->configs->query = CpasOffer::find()
                        ->where([
                            'status' => 'not_accepted'
                        ]);
                    $model->columns();

//                    echo ZDynaWidget::widget([
//                        'model' => $model,
//
//                    ]);


                    $this->activeEnd();

                    $step = ZUrl::to([
                        '/cpas/main/offer',
                    ]);
                    if ($this->modelSave($model)) {
                        //return $this->urlRedirect($step);
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
    <!--    --><?//= $this->require( '/webhtm/block/footer/cpas/footerAdmin.php') ?>
</div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
