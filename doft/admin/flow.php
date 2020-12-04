<?php

use FontLib\Table\Type\name;
use kartik\grid\DataColumn;
use rmrevin\yii\fontawesome\FA;
use zetsoft\models\cpas\CpasOffer;
use zetsoft\models\cpas\CpasOfferItem;
use zetsoft\models\cpas\CpasLand;
use zetsoft\models\cpas\CpasStream;
use zetsoft\models\place\PlaceCountry;
use zetsoft\service\cpas\Cpa;
use zetsoft\system\assets\ZColor;
use zetsoft\system\Az;
use zetsoft\system\column\ZKDataColumn;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\helpers\ZUrl;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\former\ZCheckButtonWidget;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\former\ZDynaWidgetShadow;
use zetsoft\widgets\inptest\ZCopyToClipboardWidget;
use zetsoft\widgets\navigat\ZButtonWidget;
use zetsoft\widgets\themes\ZCardWidget;


if (!isset($id)) {
    $id = 1;
}


$model = CpasStream::findOne($id);

$model->columns();





?>
<div class="py-3">
    <?php


    $link = ZButtonWidget::widget([
        'config' => [
            'text' => 'Тип: ссылка',
            'btnStyle' => ZButtonWidget::btnStyle['btn-success'],
            'color' => ZColor::btnStyle['btn-success'],
            'btnType' => ZButtonWidget::btnType['button'],
            'hasIcon' => false,
            'btn' => true,
            'class' => 'py-2 px-3 btn-success',
            'btnRounded' => false,
        ]
    ]);

    $urlupdate = ZUrl::to([
        '/cpas/admin/updateFlow',
        'id' => $id,
    ]);

    $pen = ZButtonWidget::widget([
        'config' => [
            'url' => $urlupdate,
            'btnStyle' => ZButtonWidget::btnStyle['btn-dark'],
            'icon' => 'fal fa-pencil  fa-lg',
            'btn' => true,
            'class' => 'py-2 px-3',
            'btnRounded' => false,
        ]
    ]);

    $cloneaction = ZUrl::to([
        '/cpas/block/c',
        'modelClassName' => $model->className,
        'id' => $id,
    ]);

    $clone = ZButtonWidget::widget([
        'config' => [
            'url' => $cloneaction,
            'btnStyle' => ZButtonWidget::btnStyle['btn-dark'],
            'icon' => 'fa fa-clone fa-lg',
            'btn' => true,
            'class' => 'py-2 px-3',
            'btnRounded' => false,
        ]
    ]);


    $delaction = ZUrl::to([
        '/cpas/block/d',
        'modelClassName' => $model->className,
        'id' => $id,
    ]);


    $trash = ZButtonWidget::widget([
        'config' => [
            'url' => $delaction,
            'btnStyle' => ZButtonWidget::btnStyle['btn-danger'],
            'icon' => 'fa fa-trash fa-lg',
            'btn' => true,
            'class' => 'py-2 px-3',
            'btnRounded' => false,
        ]
    ]);


    $btn = '<div class="btn-group" role="group">';
    $btn .= $pen . $clone . $trash;
    $btn .= '</div>';


    $sites = new CpasLand();

    $sites->query = CpasLand::find()
        ->where([
            'id' => $model->cpas_landing_ids
        ]);


    $sites->configs->nameOn = [
        'name',

    ];

    /** @var ZView $this * */


    $sites->configs->after = [
    'title' => [
            [
                'class' => ZKDataColumn::class,
                'label' => Az::l('Cкачать'),
                'width' => '100px',
                'value' => function (CpasLand $sites, $key, $index, DataColumn $dataColumn) use ($model) {
                    $url = $this->urlGetBase() . '/render/cpanet/' . CpasOffer::findOne($model->cpas_offer_id)->title . '/' . PlaceCountry::findOne(CpasOfferItem::findOne($sites->cpas_offer_item_id)->place_country_id)->alpha2 . '/' . $sites->type . '/index.php';

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
            [
                'class' => ZKDataColumn::class,
                'label' => Az::l('Cкачать'),
                'width' => '50px',
                'value' => function ($model, $key, $index, DataColumn $dataColumn) use ($id) {
                    $urld = Az::$app->office->zipArchive->toZip($id, $model->id);



                    return ZButtonWidget::widget([
                        'config' => [
                            'url' => $urld ? $urld : '#',
                            'btnType' => ZButtonWidget::btnType['link'],
                            'btn' => false,
                            'hasIcon' => true,
                            'pjax' => false,
                            'isPjax' => false,
                            'icon' => 'fal fa-download',
                            'download' => $urld ? true : false,
                        ]
                    ]);


                }
            ],
        ],
    ];


    $sites->configs->readonly = true;
    $sites->columns();
    $offer = CpasOffer::findOne($model->cpas_offer_id);

    if ($offer === null) return null;
    $title = $offer->title;
    ZCardWidget::begin([
        'config' => [
            'title' => $title,
            'type' => ZCardWidget::type['dynCard'],
            'classHeadColor' => 'bg-white text-dark',
            'headerRight' => $btn,
        ]
    ]);

    ?>

    <div class="row">
        <div class="col-md-3">

            <img width="100%" height="auto"
                 src="<?= '/uploaz/' . App . '/' . $offer->className . '/' . 'photos/' . $offer->id . '/' . ZArrayHelper::getValue($offer->photos, 0) ?>"
                 alt="rasm">

        </div>
        <div class="col-md-9">
            <?

            echo ZDynaWidget::widget([

                'model' => $sites,

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
                    'sort' => false,
                    'summary' => true,
                    'perfectScrollbar' => false,
                    'striped' => false,
                    'panelTemplate' => "{items}",

                ]
            ]);
            ?>
        </div>
    </div>
    <style>
        .kv-grid-table thead {
            display: none;
        }
    </style>

    <?

    ZCardWidget::end();

    ?>
</div>
