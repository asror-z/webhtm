<?php

use FontLib\Table\Type\name;
use kartik\grid\DataColumn;
use rmrevin\yii\fontawesome\FA;
use yii\helpers\BaseUrl;
use zetsoft\models\cpas\CpasOffer;
use zetsoft\models\cpas\CpasOfferItem;
use zetsoft\models\place\PlaceCountry;
use zetsoft\system\actives\ZActiveRecord;
use zetsoft\system\assets\ZColor;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\helpers\ZInflector;
use zetsoft\system\helpers\ZUrl;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\former\ZDynaWidgetShadow;
use zetsoft\widgets\navigat\ZButtonWidget;
use zetsoft\widgets\themes\ZCardWidget;
use zetsoft\widgets\themes\ZCardWidgetShahzod;

//$id = $this->httpGet('id');

/*if (!isset($id)) {
    $id = 2;
}*/

$model = CpasOffer::findOne($id);

$bool = CpasOfferItem::find()
    ->where([
        'cpas_offer_id' => $id
    ])
    ->exists();

if ($bool) {
    ?>

    <div class="py-3">
        <?php

        /** @var ZView $this * */

        $urlupdate = ZUrl::to([
            '/cpas/admin/updateOffer',
            'id' => $id,
        ]);


        $update = ZButtonWidget::widget([
            'config' => [

                'url' => $urlupdate,
                //'title' => Az::l('Обновить'),
                'btnStyle' => ZButtonWidget::btnStyle['btn-primary'],
                'icon' => 'fa-lg fad fa-pen',
                'btn' => true,
                'class' => 'py-2 px-3',
                'btnRounded' => false,
            ]
        ]);

        $urleye = ZUrl::to([
            '/cpas/admin/view',
            'id' => $id,
        ]);


        $eye = ZButtonWidget::widget([
            'config' => [

                'url' => $urleye,
                //'title' => Az::l('Посмотреть'),
                'btnStyle' => ZButtonWidget::btnStyle['btn-primary'],
                'icon' => 'fa-lg fad fa-' . FA::_EYE,
                'btn' => true,
                'class' => 'py-2 px-3',
                'btnRounded' => false,
            ]
        ]);
        $urlcreate = ZUrl::to([
            '/cpas/admin/createFlow',
            'id' => $id,
        ]);
        $create = ZButtonWidget::widget([
            'config' => [
                'url' => $urlcreate,
                'text' => Az::l('Создать'),

                //'title' => Az::l('Создать'),
                'btnStyle' => ZButtonWidget::btnStyle['btn-primary'],
                'hasIcon' => false,
                'btn' => true,
                'class' => 'py-2 px-3',
                'btnRounded' => false,
            ]
        ]);

        $btn = '<div class="btn-group" role="group">';
        $btn .= $update . $eye;
        $btn .= '</div>';


        $country = new CpasOfferItem();
        $country->query = CpasOfferItem::find()
            ->where([
                'cpas_offer_id' => $id
            ]);


        $country->configs->nameOn = [
            'place_country_id',
            'pay',
            'cost_landing',
            'aproove',
        ];

        $country->configs->readonly = true;
        $country->columns();

        $title = $model->title;
        $footer = $model->text;
        ZCardWidget::begin([
            'config' => [
                'title' => $title,
                'type' => ZCardWidget::type['dynCard'],
                'classHeadColor' => 'bg-white text-dark',
                'headerRight' => $btn,
                'footerText' => $footer,
                'hasFooter' => true,
                'footerColor' => ZColor::color['green-special'] . ' text-black',
            ]
        ]);


        ?>

        <div class="row">
            <div class="col-md-3 px-4 py-2 text-center">

                <a href="<?= $urleye ?>">
                    <img class="rounded" height="120px" width="auto"
                         src="<?= '/uploaz/' . App . '/' . $model->className . '/' . 'photos/' . $model->id . '/' . ZArrayHelper::getValue($model->photos, 0) ?>"
                         alt="img">
                </a>

            </div>
            <div class="col-md-9">
                <?

                echo ZDynaWidget::widget([
                    'model' => $country,
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
                        'hasWidth' => false,
                        'panelTemplate' => "{items}",
                    ]
                ]);


                ?>
            </div>
        </div>
        <div class="row justify-content-around mt-3">
            <div class="col-md-2">
                <h6 class="text-muted">Аудитория</h6>
                <?= $model->audience ?>
            </div>
            <div class="col-md-2">
                <h6 class="text-muted">Колл-центр</h6>
                <ul class="list-unstyled">
                    <?
                    foreach ($model->call_center as $item) {
                        $cont = PlaceCountry::findOne($item);
                        if ($cont === null)
                            continue;
                        ?>
                        <li class=""><?= $cont->name ?></li>
                        <?
                    }
                    ?>

                </ul>
            </div>
            <div class="col-md-2">
                <h6 class="text-muted">Время работы КЦ</h6>
                <?= $model->work_time_end ?>
            </div>
            <div class="col-md-2">
                <h6 class="text-muted">По API</h6>
                <?= $model->api ?>
            </div>
            <div class="col-md-2">
                <h6 class="text-muted">Лимит лидов</h6>
                <?
                if ($model->limit === null)
                    echo 'нет';
                else
                    echo $model->limit
                ?>
            </div>
        </div>
        <!--<div>
                  <?/*=$footer*/ ?>
              </div>-->

        <?


        ZCardWidget::end();
        ?>
    </div>

    <?php
}
?>
