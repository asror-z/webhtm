<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\models\cpas\CpasCompany;
use zetsoft\models\cpas\CpasOffer;
use zetsoft\models\cpas\CpasOfferItem;
use zetsoft\models\cpas\CpasLand;
use zetsoft\models\cpas\CpasStream;
use zetsoft\models\cpas\CpasWidgets;
use zetsoft\models\shop\ShopBrand;
use zetsoft\service\forms\Active;
use zetsoft\system\assets\ZColor;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZUrl;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZCheckDependWidget;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\former\ZDynaWidgetactioncolor;
use zetsoft\widgets\former\ZDynaWidgetbackup_2020_07_02;
use zetsoft\widgets\former\ZFormBuildWidget;
use zetsoft\widgets\inputes\ZHHiddenInputWidget;
use zetsoft\widgets\inputes\ZInputWidget;
use zetsoft\widgets\navigat\ZBreadcrumbsWidget;
use zetsoft\widgets\navigat\ZButtonWidget;
use zetsoft\widgets\navigat\ZDownloadWidget;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;
use zetsoft\widgets\themes\ZCardWidget;
use function GuzzleHttp\Psr7\str;


/** @var ZView $this */


/**
 *
 * Action Params
 */

$action = new WebItem();

$action->title = Azl . 'Создание Item';
$action->icon = 'fa fa-globe';
$action->type = WebItem::type['html'];
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
    require Root . '/webhtm/block/assets/App/main_arbit.php';

    $this->head();

    ?>

</head>


<body class="<?= ZWidget::skin['white-skin'] ?>">

<?php

$this->beginBody();

echo $this->require( '\webhtm\cpas\blocks\header.php');



?>

<div id="page">

    <div class="container-fluid bg-light my-5">
        <div class="col-md-12">
            <div class="row">

                <div class="col-md-12">

                    <?

                    $active = new Active();

                    $form = $this->activeBegin($active);

                    $model = new CpasCompany();

                    $model->columns();


                    echo ZFormBuildWidget::widget([
                        'model' => $model,
                        'form' => $form,
                        'config' => [
                            'stepType' => ZFormBuildWidget::stepType['none'],
                            'blockType' => ZFormBuildWidget::blockType['card'],
                            'stepOptions' => [],
                            'blockOptions' => [
                                'config' => [
                                    'headerColor' => ZColor::color['green-special'],
                                    'classHeadColor' => 'bg-white text-dark px-3 pb-3',
                                ]
                            ],
                            'isStepsVertical' => false,
                            'topBtn' => false,
                            'botBtn' => true,
                            'btnTitle' => null,
                            'isCard' => true,
                            'btnClass' => '',
                            'btnStyle' => ZButtonWidget::btnStyle['btn-outline-default'],
                        ]
                    ]);

                    $this->activeEnd();





                    if ($this->modelSave($model)) {

                        //$this->paramSet(paramIframe, true);

                        $url = ZUrl::to([
                            '/cpas/admin/company',
                        ]);
                        
                        return $this->urlRedirect($url);
                    }
                    ?>
                </div>

            </div>
        </div>
    </div>
</div>

<? echo $this->require( '\webhtm\cpas\blocks\footer.php'); ?>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
