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
            <h2 class="text-muted"><?= Az::l('Обновить поток')?></h2>

        </div>
        <div class="col-md-12">
            <div class="row">

                <div class="col-md-12">

                    <?
                    #region schotchik
                    $stream = CpasStream::findOne($id);
                    $form = $this->activeBegin();
                    $stream->configs->readonlyWidget = [
                            'title',
                            'cpas_offer_id'
                    ];
                    $stream->cards = [
                        [
                            'title' => '',
                            'show' => true,
                            'items' => [
                                [
                                    'items' => [
                                            [
                                                'title',
                                                'cpas_offer_id'
                                            ],
                                            []
                                    ]
                                ],

                                [

                                    'items' => [
                                        ['counter']
                                    ]

                                ],
                                [

                                    'items' => [
                                        ['postback']
                                    ]

                                ],

                                [

                                    'items' => [
                                         [
                                             'sub1',
                                             'sub2',
                                             'sub3',
                                             'sub4',
                                             'sub5',
                                         ],
                                         [
                                             'utm_source',
                                             'utm_company',
                                             'utm_content',
                                             'utm_term',
                                         ],

                                    ]
                                ],
                            ]
                        ]
                    ];

                    $stream->configs->widget = [
                        'cpas_widgets_ids' => ZInputWidget::class,
                        'cpas_landing_ids' => ZInputWidget::class,
                    ];

                    $stream->configs->hasLabel = false;
                    $stream->columns();

                    echo ZFormBuildWidget::widget([
                        'model' => $stream,
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
                        'id' => $stream->id  ,
                        
                    ]);
                    if ($this->modelSave($stream)) {
                    
                        $stream->save();
                        return $this->urlRedirect($urlto);
                    }


                    $streamItem = new CpasStreamItem();
                    $streamItem->query = CpasStreamItem::find()->where(['cpas_stream_id' => $stream->id]);
                    //vdd($streamItem);
                    $streamItem->configs->nameOn = [
                        'title',
                        'link',
                        'track',
                        //'teaser',
                        'cpas_land_id'

                    ];
                    $streamItem->configs->readonly = true;
                    $streamItem->columns();
                    echo ZDynaWidget::widget([
                        'model' => $streamItem,
                        'config' => [
                            'showFooter' => false,
                            'titleSummary' => true,
                            'isCard' => false,
                            'columnBefore' => [
                                'false'
                            ],
                            'columnAfter' => false,
                            'hasToolbar' => false,
                            'search' => false,
                            'heighbody' => '100%',
                            'filter' => false,
                            'sort' => false,
                            'summary' => true,
                            'perfectScrollbar' => false,
                            'striped' => false,
                            'panelTemplate' => "{items}",

                        ]
                    ]);

                    $this->activeEnd();
                    #endregion

                    
                    ?>
                </div>
            </div>


        </div>

    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {

        $("#CpasStreams").click(function () {
            var sites = [];
            $.each($(".checkbox-CpasSites:checkbox:checked"), function (i, el) {
                if ($.inArray(el, sites) === -1)
                    sites.push($(this).val());
            });
            console.log(sites);
            var widgets = [];
            $.each($(".checkbox-CpasWidgets:checkbox:checked"), function (i, el) {
                if ($.inArray(el, widgets) === -1)
                    widgets.push($(this).val());
            });
            $('#cpasstreams-cpas_widgets_ids').val([widgets]);
            $('#cpasstreams-cpas_landing_ids').val([sites]);
        });
    });


</script>


<? echo $this->require( '\webhtm\cpas\blocks\footer.php'); ?>


<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>
