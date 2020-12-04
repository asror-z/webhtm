<?php

use kartik\grid\DataColumn;
use zetsoft\dbitem\core\WebItem;
use zetsoft\models\cpas\CpasLand;
use zetsoft\models\cpas\CpasOfferItem;
use zetsoft\models\cpas\CpasStream;
use zetsoft\models\cpas\CpasStreamItem;
use zetsoft\models\cpas\CpasWidgets;
use zetsoft\models\place\PlaceCountry;
use zetsoft\system\assets\ZColor;
use zetsoft\system\Az;
use zetsoft\system\column\ZKDataColumn;
use zetsoft\system\helpers\ZArrayHelper;
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
use zetsoft\widgets\navigat\ZGAccordionReadmoreWidget;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;
use zetsoft\widgets\themes\ZCardWidget;
use function GuzzleHttp\Psr7\str;


/** @var ZView $this */


/**
 *
 * Action Params
 */

$action = new WebItem();

$action->title = Azl . 'Обновить поток';
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
    require Root . '/webhtm/block/assets/App/main_arbit.php';

    $this->head();

    ?>

</head>


<body class="<?= ZWidget::skin['white-skin'] ?>">

<?php

$this->beginBody();

echo $this->require( '\webhtm\cpas\blocks\header.php');



$id = $this->httpGet('id');

?>

<div id="page">
    <div class="container-fluid bg-light">
        <div class="mt-2">
            <h2 class="text-muted"><?= Az::l('Обновить элемент потока')?></h2>

        </div>
        <div class="col-md-12">
            <div class="row">

                <div class="col-md-12">

                    <?
                    $model = CpasStreamItem::findOne($id);
                    $form = $this->activeBegin();

                    $model->cards = [
                        [
                            'title' => Az::l('Первый этап'),
                            'shows' => true,
                            'items' => [
                                [
                                    'title' => Az::l('Форма'),
                                    'shows' => true,
                                    'items' => [

                                        ['title'],
                                        ['cpas_land_id'],
                                        ['cpas_trans'],
                                        ['cpas_trans_form'],
                                        ['trans_link'],
                                        ['link']

                                    ],
                                ],
                            ],
                        ],
                    ];
                    $model->columns();

                    echo ZFormBuildWidget::widget([
                        'model' => $model,
                        'form' => $form,
                        'config' => [
                            'stepType' => ZFormBuildWidget::stepType['none'],
                            'blockType' => ZFormBuildWidget::blockType['card'],
                            'stepOtions' => [],
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
                    $urlto = ZUrl::to([
                        '/cpas/client/viewFlow',
                        'id' => $model->cpas_stream_id  ,
                        
                    ]);
                    if ($this->modelSave($model)) {
                    
                        return $this->urlRedirect($urlto);
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
