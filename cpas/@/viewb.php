<?php

use kartik\grid\DataColumn;
use phpDocumentor\Reflection\DocBlock\Description;
use rmrevin\yii\fontawesome\FA;
use zetsoft\dbitem\core\WebItem;
use zetsoft\models\cpas\CpasOffer;
use zetsoft\models\cpas\CpasOfferItem;
use zetsoft\models\cpas\CpasLand;
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
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\former\ZListViewWidget;
use zetsoft\widgets\inptest\ZCopyToClipboardWidget;
use zetsoft\widgets\inputes\ZKSelect2Widget;
use zetsoft\widgets\inputes\ZSelect2Widget;
use zetsoft\widgets\navigat\ZBreadcrumbsWidget;
use zetsoft\widgets\navigat\ZButtonWidget;
use zetsoft\widgets\notifier\ZJspanelWidgetWebphone;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;
use zetsoft\widgets\themes\ZCardWidget;
use zetsoft\widgets\themes\ZCardWidgetShahzod;


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
$action->cache = false;
$action->call = null;
$action->cacheHttp = false;
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


?>

<div id="page">

    <?

    echo ZSessionGrowlWidget::widget();?>
    <div class="container-fluid  grey lighten-5">
        <div class="mt-2">
            <h2 class="text-muted">Детали оффера</h2>
        </div>
        <div class="row">
            <div class="col-md-4 pb-2">
                <?php


                /** @var ZView $this * */


                $id = $this->httpGet('id');

                $model = CpasOffer::findOne($id);

                #errorCheck
                if ($model === null)
                    return null;

                $title = $model->title;
                $footer = $model->text;
                ZCardWidget::begin([
                    'config' => [
                        'title' => $title,
                        'type' => ZCardWidget::type['dynCard'],
                        'headerColor' => ZColor::color['green-special'],
                        'classHeadColor' => 'bg-white text-dark px-4 pb-3',
                        'footerText' => '',
                        'hasFooter' => true,
                        'footerColor' => ZColor::color['green-special'] . ' text-black',
                    ]
                ]); ?>

                <div class="row d-block">
                    <div class="px-4 pb-3">

                        <img class="rounded w-100" height="auto"
                             src="<?= '/uploaz/' . App . '/' . $model->className . '/' . 'photos/' . $model->id . '/' . ZArrayHelper::getValue($model->photos, 0) ?>"
                             alt="rasm">

                    </div>
                    <div class="border-top">
                        <h6 class="">Краткое описание</h6>
                        <P class="text-muted">
                            <?= $model->text ?>
                        </p>
                    </div>
                    <div class="border-top">
                        <h6 class="">Форм фактор</h6>
                        <P class="text-muted">
                            <?= $model->type_substance ?>
                        </p>
                    </div>
                    <div class="border-top">
                        <h6 class="">Производитель</h6>
                        <P class="text-muted">
                            <?= $model->user_company_id ?>
                        </p>
                    </div>
                    <div class="border-top">
                        <h6 class="">Состав</h6>
                        <P class="text-muted">
                            <?= $model->composition ?>
                        </p>
                    </div>
                    <div class="border-top">
                        <h6 class="">Доставки</h6>
                        <P class="text-muted">
                            <?= $model->deliver ?>
                        </p>
                    </div>
                    <div class="border-top">
                        <h6 class="">Фото продукта</h6>
                        <P class="text-muted">
                            <?= $model->deliver ?>
                        </p>
                    </div>
                    <div class="border-top">
                        <h6 class="">Промо архив</h6>
                        <P class="text-muted">
                            <?= $model->deliver ?>
                        </p>
                    </div>
                    <div class="border-top text-center">
                        <?

                        $url = ZUrl::to([
                            '/cpas/admin/createFlow',
                            'id' => $id,
                        ]);
                        echo ZButtonWidget::widget([
                            'config' => [
                                'url' => $url,
                                'text' => Az::l('Создать поток'),
                                'btnStyle' => ZButtonWidget::btnStyle['btn-success'],
                                'color' => ZColor::btnStyle['btn-success'],
                                'btnType' => ZButtonWidget::btnType['link'],
                                'hasIcon' => false,
                                'btn' => true,
                                'class' => 'py-2 px-3',
                                'btnRounded' => false,
                            ]
                        ]);
                        ?>
                    </div>

                </div>

                <? ZCardWidget::end(); ?>

            </div>

            <div class="col-md-8">

                <div class="mb-2">
                    <?php

                    $country_id = $this->httpGet('country');
                    
                    $data = Az::$app->cpas->cpasSite->getCountry($id);
                    ZCardWidget::begin([
                        'config' => [
                            'title' => ' ',
                            'type' => ZCardWidget::type['dynCard'],
                            'headerColor' => ZColor::color['green-special'],
                            'classHeadColor' => 'bg-white text-dark px-3 pb-3',
                            'footerText' => '',
                            'hasFooter' => true,
                            'footerColor' => ZColor::color['green-special'] . ' text-black',
                        ]
                    ]);
                    echo ZKSelect2Widget::widget([
                        'data' => $data,
                        'name' => 'countries',
                        'value' => $country_id,
                        'config' => [
                            'placeholder' => Az::l('Выберите страну ...'),
                            'hasPlace' => true,
                        ],
                        'event' => [
                            'select' => <<<JS
                function() {
                 window.location.href = '/cpas/admin/view.aspx?id={$id}&country=' + $(this).val();        
                }
JS,

                        ]
                    ]);

                    ZCardWidget::end();
                    ?>
                </div>
                <div class="mb-2">
                    <?php

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


                    $lending = new CpasLand();


                    if ($country_id) {

                        $lending->query = CpasLand::find()
                            ->where([
                                'cpas_offer_id' => $id,
                                'type' => CpasLand::type['landing'],
                                'place_country_id' => $country_id
                            ]);

                    } else {

                        $lending->query = CpasLand::find()
                            ->where([
                                'cpas_offer_id' => $id,
                                'type' => CpasLand::type['landing'],
                            ]);

                    }

                    $lending->configs->nameOn = [
                        'name',
                        'cr',
                        'status',
                        'place_country_id',
                        'link',
                        'cpas_offer_id',
                    ];

                    $lending->configs->groups = [
                        'name'
                    ];

                    $lending->configs->groupedRows = [
                        'name' => true
                    ];

                    $lending->configs->groupOddCssClasses = [
                        'name' => 'text-left light-blue lighten-5 px-4'
                    ];

                    $lending->configs->groupEvenCssClasses = [
                        'name' => 'text-left border light-blue lighten-5 px-4'
                    ];
                    $lending->configs->after = [
                        'cpas_offer_id' => [
                            [
                                'class' => ZKDataColumn::class,
                                'label' => Az::l('Cкачать'),
                                'width' => '50px',
                                'value' => function ($model, $key, $index, DataColumn $dataColumn) {

                                    return ZButtonWidget::widget([
                                        //'id' => 'settings-widget-' . $key,
                                        'config' => [
                                            'title' => Az::l('Cкачать'),
                                            'icon' => 'fal fa-download fa-2x text-success',
                                            'pjax' => 0,
                                            'btnSize' => ZColor::btnSize['btn-sm'],
                                            'btnRounded' => true,
                                            'btn' => false,
                                            'hasIcon' => true,
                                            'btnType' => ZButtonWidget::btnType['link'],
                                            'url' => '',
                                            //'color' => ZColor::color['green'],
                                        ]
                                    ]);


                                }
                            ],
                        ],
                    ];

                    $lending->configs->readonly = true;


                    $lending->configs->valueWidget = [
                        'link' => ZCopyToClipboardWidget::class
                    ];


                    $lending->configs->options = [
                        'link' => [
                            'config' => [
                                'type' => ZCopyToClipboardWidget::type['input'],
                            ]
                        ],
                    ];

                    $lending->configs->width = [
                        'name' => '80px',
                        'cr' => '80px',
                        'status' => '80px',
                        'place_country_id' => '80px',
                        'link' => '80px',
                        'cpas_offer_id' => '80px',
                    ];


                    $lending->columns();


                    echo ZDynaWidget::widget([
                        'model' => $lending,
                        'config' => [

                            'showFooter' => false,
                            'titleSummary' => true,
                            'isCard' => false,
                            'columnBefore' => false,
                            'columnAfter' => false,
                            'hasToolbar' => false,
                            'search' => false,
                            'heighbody' => '100%',
                            'filter' => false,
                            'summary' => true,
                            'perfectScrollbar' => false,
                            'striped' => false,
                            'panelTemplate' => "{items}",
                        ]
                    ]);

                    ZCardWidget::end();

                    ?>
                </div>

                <div class="mb-2">
                    <?php
                    ZCardWidget::begin([
                        'config' => [
                            'title' => 'Прелендинги',
                            'type' => ZCardWidget::type['dynCard'],
                            'headerColor' => ZColor::color['green-special'],
                            'classHeadColor' => 'bg-white text-dark px-3 pb-3',
                            'footerText' => '',
                            'hasFooter' => true,
                            'footerColor' => ZColor::color['green-special'] . ' text-black',
                        ]
                    ]);


                    $country_id = '';

                    $data = Az::$app->cpas->cpasSite->getCountry($id);

                    $country_id = $this->httpGet('country');

                    $prelending = new CpasLand();

                    if ($country_id) {
                        $prelending->query = CpasLand::find()
                            ->where([
                                'cpas_offer_id' => $id,
                                'type' => CpasLand::type['prelanding'],
                                'place_country_id' => $country_id
                            ]);

                    } else {
                        $prelending->query = CpasLand::find()
                            ->where([
                                'cpas_offer_id' => $id,
                                'type' => CpasLand::type['prelanding'],
                            ]);
                    }


                    $prelending->configs->nameOn = [
                        'name',
                        'cr',
                        'status',
                        'place_country_id',
                        'link',
                        'cpas_offer_id',
                    ];

                    $prelending->configs->readonlyAll = true;
                    $prelending->configs->after = [
                        'cpas_offer_id' => [
                            [
                                'class' => ZKDataColumn::class,
                                'label' => Az::l('Cкачать'),
                                'width' => '50px',
                                'value' => function ($model, $key, $index, DataColumn $dataColumn) {

                                    return ZButtonWidget::widget([
                                        //'id' => 'settings-widget-' . $key,
                                        'config' => [
                                            'title' => Az::l('Cкачать'),
                                            'icon' => 'fal fa-download fa-2x text-success',
                                            'pjax' => 0,
                                            'btnSize' => ZColor::btnSize['btn-sm'],
                                            'btnRounded' => true,
                                            'btn' => false,
                                            'hasIcon' => true,
                                            'btnType' => ZButtonWidget::btnType['link'],
                                            'url' => '',
                                            //'color' => ZColor::color['green'],
                                        ]
                                    ]);


                                }
                            ],
                        ],
                    ];
                    $prelending->configs->readonly = true;

                    $prelending->columns();

                    echo ZDynaWidget::widget([
                        'model' => $prelending,
                        'config' => [
                            'showFooter' => false,
                            'titleSummary' => true,
                            'isCard' => false,
                            'columnBefore' => false,
                            'columnAfter' => false,
                            'hasToolbar' => false,
                            'search' => false,
                            'heighbody' => '100%',
                            'filter' => false,
                            'summary' => true,
                            'perfectScrollbar' => false,
                            'striped' => false,
                            'panelTemplate' => "{items}",
                        ]
                    ]);

                    ZCardWidget::end();
                    
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
