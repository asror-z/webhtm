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


$model = CpasOffer::findOne($id);

$exists = CpasOfferItem::find()
    ->where([
        'cpas_offer_id' => $id
    ])
    ->exists();

if ($exists) {
    ?>

    <div class="py-3">
        <?php


        /** @var ZView $this * */


        $urleye = ZUrl::to([
            '/cpas/client/view',
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
            '/cpas/client/createFlow',
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
        $btn .= $eye . $create;
        $btn .= '</div>';


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
                    <img class="rounded img-fluid" style="height: 120px;"
                         src="<?= '/uploaz/' . App . '/' . $model->className . '/' . 'photo/' . $model->id . '/' . ZArrayHelper::getValue($model->photo, 0) ?>"
                         alt="img">
                </a>

            </div>
            <div class="col-md-9">
                <?php
                $items = CpasOfferItem::find()
                    ->where([
                        'cpas_offer_id' => $id
                    ])
                    ->all();
                ?>
                <table class="table table-hover text-center table-borderless">
                    <thead>
                    <th><?= Az::l('Страна')?></th>
                    <th><?= Az::l('Сумма выплаты')?></th>
                    <th><?= Az::l('Средний апрув')?></th>
                    </thead>
                    <tbody class="text-dark font-weight-bold">
                    <?php
                    foreach ($items as $item)
                    {
                        $country = PlaceCountry::findOne($item->place_country_id);

                        ?>
                        <tr>
                            <th class="text-dark"><?= $country->name?></th>
                            <th class="text-dark"><?= $item->pay. ' '. $item->pay_currency?></th>
                            <th class="text-dark"><?= $item->aproove? $item->aproove : 0;?> %</th>
                        </tr>
                        <?php
                    }

                    ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row justify-content-around mt-3 pt-4 pb-2 mx-0 border-top">
            <div class="col-md-2">
                <h6 class="text-muted">Аудитория</h6>
                <?= $model->audience ?>
            </div>
            <div class="col-md-2">
                <h6 class="text-muted">Колл-центр</h6>
                <ul class="list-unstyled">
                    <?
                    if($model->call_center !== null){
                        foreach ($model->call_center as $item) {
                            $cont = PlaceCountry::findOne($item);
                            if ($cont === null)
                                continue;
                            ?>
                            <li class=""><?= $cont->name ?></li>
                            <?
                        }
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
                  <?/*=$footer*/ ?>

        <?


        ZCardWidget::end();
        ?>
    </div>

    <?php
}
?>
