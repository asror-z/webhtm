<?php

use kartik\grid\DataColumn;
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
use zetsoft\widgets\navigat\ZButtonWidget;
use zetsoft\widgets\navigat\ZGAccordionWidget;
use zetsoft\widgets\navigat\ZGAccordionReadmoreWidget;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;
use zetsoft\widgets\themes\ZCardWidget;


/** @var ZView $this */


/**
 *
 * Action Params
 */

$action = new WebItem();

$action->title = Azl . 'Создание Бренды';
$action->icon = 'fa fa-globe';
$action->type = WebItem::type['html'];
$action->csrf = true;
$action->loader = false;
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
            <div>
                <a href="/cpas/admin/offer.aspx" style="font-size: small">Главная</a>
                <a href="/cpas/admin/offer.aspx" style="font-size: small">/ Офферы</a>
                <span href="/cpas/admin/view.aspx?id=1" style="font-size: small">/ Детали оффера</span>
            </div>
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
                             alt="image">

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
                    <!--<div class="border-top">
                        <h6 class="">Производитель</h6>
                        <P class="text-muted">
                            <?/*= $model->user_company_id */?>
                        </p>
                    </div>-->
                    <div class="border-top">
                        <h6 class="">Состав</h6>
                        <P class="text-muted">
                            <?= $model->composition ?>
                        </p>
                    </div>
                    <div class="border-top">
                        <h6 class="">Доставки</h6>
                        <P class="text-muted">
                            <? foreach ($model->deliver as $item) {
                                echo PlaceCountry::findOne($item)->name;
                            } ?>
                        </p>
                    </div>
                    <!--<div class="border-top">
                        <h6 class="">Фото продукта</h6>
                        <P class="text-muted">
                            <?/*= $model->deliver */?>
                        </p>
                    </div>-->
                    <!--<div class="border-top">
                        <h6 class="">Промо архив</h6>
                        <P class="text-muted">
                            <?/*= $model->promo */?>
                        </p>
                    </div>-->

                </div>

                <? ZCardWidget::end(); ?>

            </div>

            <div class="col-md-8">

                <div class="mb-2">
                    <?php
                    $items = CpasOfferItem::find()
                        ->where(['cpas_offer_id' => $id])
                        ->all();
                    $ids = [];
                    foreach ($items as $item){
                        $ids[] = $item->id;
                    }

                    $lending = new CpasLand();
                    $len = CpasLand::find()->select(['cpas_offer_item_id'])->where([
                        'cpas_offer_item_id' =>$ids,
                        'type' => CpasLand::type['landing'],
                    ])->asArray()->all();
                    $arr = [];
                    foreach ($len as $key => $value) {
                        foreach ($value as $item) {
                            $arr[] = $item;
                        }
                    }
                    $arr = array_unique($arr);
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
                    $lending->configs->nameOn = [
                        'name',
                        'cr',
                        'status',
                        'cpas_offer_item_id',
                        'path',
                    ];
                    $lending->configs->readonly = true;
                    $lending->columns();
                    foreach ($arr as $item) {
                        $lending->query = CpasLand::find()
                            ->where([
                                'cpas_offer_item_id' => $item,
                                'type' => CpasLand::type['landing'],
                            ]);

                        $url = $this->urlGetBase() . '/render/cpanet/' . $model->title . '/' . PlaceCountry::findOne(CpasOfferItem::findOne($item)->place_country_id)->alpha2 . '/landing/index.php';

                        $lending->configs->after = [
                            'path' => [
                                [
                                    'class' => ZKDataColumn::class,
                                    'label' => Az::l(''),
                                    'width' => '200px',
                                    'value' => function ($model, $key, $index, DataColumn $dataColumn) use($url) {

                                        return ZButtonWidget::widget([
                                            'config' => [
                                                'url' => $url,
                                                'hasIcon' => true,
                                                'isPjax' => false,
                                                'pjax' => false,
                                                'icon' => 'fal fa-external-link fa-lg',
                                                'btn' => false,
                                                'target' => ZButtonWidget::target['_blank'],
                                            ]
                                        ]);


                                    }
                                ],
                            ],
                        ];
                        $title = PlaceCountry::findOne(CpasOfferItem::findOne($item)->place_country_id);
                        
                        echo ZGAccordionReadmoreWidget::widget([
                            'config' => [
                                'show' => false,
                                'title' => $title->name,
                                'content' => ZDynaWidget::widget([
                                    'model' => $lending,
                                    'config' => [
                                        'hasWidth' => false,
                                        'perfectScrollbar' => false,
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
                                        'striped' => true,
                                        'panelTemplate' => "{items}",
                                    ]
                                ]),
                            ]
                        ]);
                    }
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
                    $items = CpasOfferItem::find()
                        ->where(['cpas_offer_id' => $id])
                        ->all();
                    $ids = [];
                    foreach ($items as $item){
                        $ids[] = $item->id;
                    }
                    $prelending = new CpasLand();
                    $pre = CpasLand::find()->select(['cpas_offer_item_id'])->where([
                        'cpas_offer_item_id' =>$ids,
                        'type' => CpasLand::type['prelanding'],
                    ])->asArray()->all();
                    $arr = [];
                    foreach ($pre as $key => $value) {
                        foreach ($value as $item) {
                            $arr[] = $item;
                        }
                    }
                    $arr = array_unique($arr);
                    $prelending->configs->nameOn = [
                        'name',
                        'cr',
                        'status',
                        'cpas_offer_item_id',
                        'cpas_offer_id',
                        'path',
                    ];
                    $prelending->configs->readonly = true;
                    $prelending->columns();
                    foreach ($arr as $item) {
                        $prelending->query = CpasLand::find()
                            ->where([
                                'cpas_offer_item_id' => $item,
                                'type' => CpasLand::type['prelanding'],
                            ]);
                        $url = $this->urlGetBase() . '/render/cpanet/' . $model->title . '/' . PlaceCountry::findOne(CpasOfferItem::findOne($item)->place_country_id)->alpha2 . '/prelanding/index.php';
                        $prelending->configs->after = [
                            'path' => [
                                [
                                    'class' => ZKDataColumn::class,
                                    'label' => Az::l(''),
                                    'width' => '200px',
                                    'value' => function ($model, $key, $index, DataColumn $dataColumn) use($url) {

                                        return ZButtonWidget::widget([
                                            'config' => [
                                                'url' => $url,
                                                'hasIcon' => true,
                                                'isPjax' => false,
                                                'pjax' => false,
                                                'icon' => 'fal fa-external-link fa-lg',
                                                'btn' => false,
                                                'target' => ZButtonWidget::target['_blank'],
                                            ]
                                        ]);


                                    }
                                ],
                            ],
                        ];
                        $title = PlaceCountry::findOne(CpasOfferItem::findOne($item)->place_country_id);
                        echo ZGAccordionReadmoreWidget::widget([
                            'config' => [
                                'show' => false,
                                'title' => $title->name,
                                'content' => ZDynaWidget::widget([
                                    'model' => $prelending,
                                    'config' => [
                                        'hasWidth' => false,
                                        'perfectScrollbar' => false,
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
                                        'striped' => true,
                                        'panelTemplate' => "{items}",
                                    ]
                                ]),
                            ]
                        ]);
                    }
                    ZCardWidget::end();
                    ?>
                </div>
            </div>
        </div>
    </div>



</div>
<style>
    .kv-grid-table thead {
        display: none;
    }
</style>

<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>
