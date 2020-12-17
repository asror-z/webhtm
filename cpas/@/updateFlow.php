<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\models\cpas\CpasOfferItem;
use zetsoft\models\cpas\CpasLand;
use zetsoft\models\cpas\CpasStream;
use zetsoft\models\cpas\CpasWidgets;
use zetsoft\service\cpas\CpasStats;
use zetsoft\system\assets\ZColor;
use zetsoft\system\Az;
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
use zetsoft\widgets\notifier\ZSessionGrowlWidget;
use zetsoft\widgets\themes\ZCardWidget;
use function GuzzleHttp\Psr7\str;


/** @var ZView $this */


/**
 *
 * Action Params
 */

$action = new WebItem();

$action->title = Azl . 'Создание Бренды';
$action->icon = 'fa fa-globe';
$action->type = WebItem::type['html'];
$action->csrf = false;
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

require Root . '/webhtm/block/navbar/mainArbit.php';;


echo ZNProgressWidget::widget([]);

echo ZNProgressWidget::widget([]);


$id = $this->httpGet('id');

?>

<div id="page">

    <?

    echo ZSessionGrowlWidget::widget();?>
    <div class="container-fluid bg-light">
        <div class="mt-2">
            <h2 class="text-muted">Новый поток</h2>

        </div>
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-7">
                    <?php
                    $stream = CpasStream::findOne($id);
                    ?>
                    <div class="mb-2">
                        <?php
                        #region Landing
                        ZCardWidget::begin([
                            'config' => [
                                'title' => 'Лендинги',
                                'type' => ZCardWidget::type['dynCard'],
                                'headerColor' => ZColor::color['green-special'],
                                'classHeadColor' => 'bg-white text-dark px-3 pb-3',
                                'footerText' => '',
                                'hasFooter' => true,
                                'footerColor' => ZColor::color['green-special'] . ' text-black',
                            ]
                        ]);



                       /* $items = CpasOfferItem::find()
                            ->where(['cpas_offer_id' => $id])
                            ->all();
                        $ids = [];
                        foreach ($items as $item){
                            $ids[] = $item->id;
                        }*/

                        $lending = new CpasLand();
                        $lending->query = CpasLand::find()
                            ->where([
                                'id' => $stream->cpas_landing_ids,
                                'type' => CpasLand::type['landing']
                            ]);

                        $lending->configs->nameOn = [
                            'cpas_offer_item_id',
                            'name',
                            'cr',
                            'status',
                            'link',
                            'cpas_offer_id',
                        ];
                        $lending->configs->groups = [
                            'cpas_offer_item_id'
                        ];

                        $lending->configs->groupedRows = [
                            'cpas_offer_item_id' => true
                        ];
                        $lending->configs->groupOddCssClasses = [
                            'cpas_offer_item_id' => 'text-left light-blue lighten-5 px-4'
                        ];
                        $lending->configs->groupEvenCssClasses = [
                            'cpas_offer_item_id' => 'text-left light-blue lighten-5 px-4'
                        ];
                        $lending->configs->readonly = true;
                        $lending->columns();

                        //vdd($lending->query->sql());
                        echo ZDynaWidget::widget([
                            'model' => $lending,
                            'config' => [
                                'heighbody' => '100%',
                                'showFooter' => false,
                                'titleSummary' => true,
                                'isCard' => false,
                                'columnBefore' => [
                                    'checkbox'
                                ],
                                'columnAfter' => false,
                                'hasToolbar' => false,
                                'search' => false,
                                'filter' => false,
                                'summary' => true,
                                'perfectScrollbar' => false,
                                'striped' => false,
                                'hasWidth' => false,
                                'panelTemplate' => "{items}",
                            ]
                        ]);

                        ZCardWidget::end();

                        #endregion
                        ?>
                    </div>
                    <div class="mb-2">
                        <?
                        #region Prelanding
                        ZCardWidget::begin([
                            'config' => [
                                'title' => Az::l('Прелендинг'),
                                'type' => ZCardWidget::type['dynCard'],
                                'headerColor' => ZColor::color['green-special'],
                                'classHeadColor' => 'bg-white text-dark px-3 pb-3',
                                'footerText' => '',
                                'hasFooter' => true,
                                'footerColor' => ZColor::color['green-special'] . ' text-black',
                            ]
                        ]);
                        $items = CpasOfferItem::find()
                            ->where(['cpas_offer_id' => $id])
                            ->all();
                        $ids = [];
                        foreach ($items as $item){
                            $ids[] = $item->id;
                        }

                        $prelanding = new CpasLand();
                        $prelanding->query = CpasLand::find()
                            ->where([
                                'id' => $stream->cpas_landing_ids,
                                'type' => CpasLand::type['prelanding']
                            ]);

                        $prelanding->configs->nameOn = [
                            'cpas_offer_item_id',
                            'name',
                            'cr',
                            'status',
                            'link',
                            'cpas_offer_id',
                        ];
                        $prelanding->configs->groups = [
                            'cpas_offer_item_id'
                        ];

                        $prelanding->configs->groupedRows = [
                            'cpas_offer_item_id' => true
                        ];

                        $prelanding->configs->groupOddCssClasses = [
                            'cpas_offer_item_id' => 'text-left light-blue lighten-5 px-4'
                        ];

                        $prelanding->configs->groupEvenCssClasses = [
                            'cpas_offer_item_id' => 'text-left light-blue lighten-5 px-4'
                        ];


                        $prelanding->configs->readonly = true;


                        $prelanding->columns();


                        echo ZDynaWidget::widget([
                            'model' => $prelanding,
                            'config' => [
                                'border' => false,
                                'heighbody' => '100%',
                                'bordered' => false,
                                'showFooter' => false,
                                'titleSummary' => true,
                                'isCard' => false,
                                'columnBefore' => [
                                    'checkbox'
                                ],
                                'columnAfter' => false,
                                'hasToolbar' => false,
                                'search' => false,
                                'filter' => false,
                                'summary' => true,
                                'perfectScrollbar' => false,
                                'striped' => false,
                                'hasWidth' => false,
                                'panelTemplate' => "{items}",
                            ]
                        ]);

                        ZCardWidget::end();

                        #endregion
                        ?>
                    </div>
                </div>

                <div class="col-md-5">
                    <div class="mb-2">
                        <?php

                        #region widgets
                        ZCardWidget::begin([
                            'config' => [
                                'title' => Az::l('Настройка виджетов и ротатора'),
                                'type' => ZCardWidget::type['dynCard'],
                                'headerColor' => ZColor::color['green-special'],
                                'classHeadColor' => 'bg-white text-dark px-3 pb-3',
                                'footerText' => '',
                                'hasFooter' => true,
                                'footerColor' => ZColor::color['green-special'] . ' text-black',
                            ]
                        ]);
                        $widgets = new CpasWidgets();
                        $widgets->configs->nameOn = [
                            'title',
                            'description'
                        ];
                        $widgets->configs->readonly = true;
                        $widgets->columns();
                        echo ZDynaWidget::widget([
                            'model' => $widgets,
                            'config' => [
                                'heighbody' => '100%',

                                'showFooter' => false,
                                'titleSummary' => true,
                                'isCard' => false,
                                'columnBefore' => [
                                    'checkbox'
                                ],
                                'columnAfter' => false,
                                'hasToolbar' => false,
                                'search' => false,
                                'filter' => false,
                                'summary' => true,
                                'bordered' => false,
                                'perfectScrollbar' => false,
                                'striped' => false,
                                'hasWidth' => false,
                                'panelTemplate' => "{items}",
                            ]
                        ]);

                        ZCardWidget::end();
                        #endregion
                        ?>
                    </div>
                    <div class="mb-2">
                        <?


                        #region schotchik
                        $form = $this->activeBegin();
                        $stream->cards = [
                            [
                                'title' => Az::l('Счетчики'),
                                'show' => true,
                                'items' => [
                                    [
                                        'title' => Az::l('Счетчики'),
                                        'show' => true,
                                        'items' => [
                                            ['api_new'], [
                                                'api_accept'], [
                                                'api_reject'], [
                                                'api_trash',],
                                        ]
                                    ],
                                    [
                                        'title' => Az::l('Счетчики'),
                                        'show' => true,
                                        'items' => [
                                            ['yandex'],
                                            ['google'],
                                            ['mail'],
                                            ['facebook'],
                                        ]
                                    ],
                                    [
                                        'title' => Az::l('Токены'),
                                        'show' => true,
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
                                            [
                                                'cpas_widgets_ids',
                                                'cpas_landing_ids'
                                            ],

                                        ]
                                    ],
                                ]
                            ]
                        ];

                        $sit = $stream->cpas_landing_ids;
                        $wid = $stream->cpas_widgets_ids;

                        $stream->cpas_landing_ids = implode(',', $stream->cpas_landing_ids);
                        $stream->cpas_widgets_ids = implode(',', $stream->cpas_widgets_ids);
                        $stream->configs->widget = [
                            'cpas_widgets_ids' => ZInputWidget::class,
                            'cpas_landing_ids' => ZInputWidget::class,
                        ];
                        $stream->configs->options = [
                            'cpas_widgets_ids' => [
                                'config' => [
                                    'type' => ZInputWidget::type['hidden']
                                ]
                            ],
                            'cpas_landing_ids' => [
                                'config' => [
                                    'type' => ZInputWidget::type['hidden']
                                ]
                            ],
                        ];
                        $stream->configs->hasLabel = false;
                        $stream->columns();

                        foreach ($sit as $key => $value) {
                            ?>

                            <script>
                                $("input.checkbox-CpasSites[type=checkbox]").each(function () {
                                    if ($(this).val() == <?php echo $value?> && $(this).hasClass('checkbox-CpasSites'))
                                        $(this).prop("checked", true);
                                });
                            </script>
                            <?
                        }
                        foreach ($wid as $key => $value) {
                            ?>

                            <script>
                                $("input.checkbox-CpasWidgets[type=checkbox]").each(function () {
                                    if ($(this).val() == <?php echo $value?> && $(this).hasClass('checkbox-CpasWidgets'))
                                        $(this).prop("checked", true);
                                });
                            </script>
                            <?
                        }
                        
                        $stream->modelSave($stream);
                        echo ZFormBuildWidget::widget([
                            'model' => $stream,
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
                        $url = ZUrl::to([
                            '/cpas/admin/flows',
                        ]);
                        if ($this->modelSave($stream)) {
                            $stream->cpas_landing_ids = explode(',', $stream->cpas_landing_ids);
                            $stream->cpas_widgets_ids = explode(',', $stream->cpas_widgets_ids);
                            $stream->save();
                            return $this->urlRedirect($url);
                        }


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
                    if($.inArray(el, sites) === -1)
                        sites.push($(this).val());
                });
                console.log(sites);
                var widgets = [];
                $.each($(".checkbox-CpasWidgets:checkbox:checked"), function (i, el) {
                    if($.inArray(el, widgets) === -1)
                        widgets.push($(this).val());
                });
                $('#cpasstreams-cpas_widgets_ids').val([widgets]);
                $('#cpasstreams-cpas_landing_ids').val([sites]);
            });
        });


    </script>



</div>


<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>
