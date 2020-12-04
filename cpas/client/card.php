<?php

use zetsoft\models\cpas\CpasOffer;
use zetsoft\models\cpas\CpasOfferItem;
use zetsoft\models\place\PlaceCountry;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\helpers\ZUrl;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\former\ZDynaWidgetShadow;
use zetsoft\widgets\navigat\ZButtonWidget;


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

$urlcreate = ZUrl::to([
    '/cpas/client/createFlow',
    'id' => $id,
]);


$eyebtn = ZButtonWidget::widget([
    'config' => [
        'btn' => false,
        'url' => $urleye,
        'title' => Az::l('Посмотреть детали'),
        'class' => 'offerBtnView',
        'btnRounded' => false,
        'icon' =>  'fal fa-eye',
    ]
]);

$addbtn = ZButtonWidget::widget([
    'config' => [
        'btn' => false,
        'url' => $urlcreate,
        'title' => Az::l('Создать поток'),
        'class' => 'offerBtnAdd',
        'btnRounded' => false,
        'icon' =>  'fal fa-sitemap',
    ]
]);

    ?>

    <div class="card card-Offer" style="z-index: 999;">

        <div class="card-header card-offer-header col-md-12 bg-white">
            <div class="d-flex">
                <h5 class="ml-2"><?= $model->title?></h5>

                <div class="btn-group ml-auto" role="group">
                    <!--<a href="<?/*= $urleye*/?>" class="offerBtnView" title="Посмотреть детали">
                        <i class="fal fa-eye"></i>
                    </a>-->
                    <?
                        echo $eyebtn;
                        echo $addbtn;
                    ?>
                    
                    <!--<a href="<?/*= $urlcreate*/?>" class="offerBtnAdd" title="Создать поток">
                        <i class="fal fa-sitemap"></i>
                    </a>-->
                </div>
            </div>
        </div>

        <div class="card-body">
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
                    $items = collect(CpasOfferItem::find()
                        ->where([
                            'cpas_offer_id' => $id
                        ])
                        ->all());


                    $itemsGroup = $items->groupBy('place_country_id');
                    ?>
                    <table class="table table-hover text-center table-borderless">
                        <thead>
                        <th><?= Az::l('Страна')?></th>
                        <th><?= Az::l('Сумма выплаты')?></th>
                        <th><?= Az::l('Средний апрув')?></th>
                        </thead>
                        <tbody class="text-dark font-weight-bold">
                        <?php
                        foreach ($itemsGroup as $key => $item)
                        {
                            $country = PlaceCountry::findOne($key);
                            $myItem = $item->first();
                            ?>
                            <tr>
                                <th class="text-dark"><?= $country->name?></th>
                                <th class="text-dark text-uppercase"><?= $myItem->pay. ' '. $myItem->pay_currency?></th>
                                <th class="text-dark"><?= $myItem->aproove?$myItem->aproove : 0;?> %</th>
                            </tr>
                            <?php
                        }

                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-md-10 row justify-content-around pt-2 pb-1">
                <div class="col-md-2">
                    <h6 class="text-muted"><?= Az::l('Аудитория')?></h6>
                    <?= $model->audience ?>
                </div>
                <div class="col-md-2">
                    <h6 class="text-muted"><?= Az::l('Колл-центр')?></h6>
                    <ul class="list-unstyled">
                        <?
                        if($model->call_center){
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
                    <h6 class="text-muted"><?= Az::l('Время работы КЦ')?></h6>
                    <?= $model->work_time_end ?>
                </div>
                <div class="col-md-2">
                    <h6 class="text-muted"><?= Az::l('По API')?></h6>
                    <?
                    echo Az::l('Да');

                    /* if ($model->api)
                         echo Az::l('Да');
                     else
                         echo Az::l('Нет')*/


                     ?>
                </div>
                <div class="col-md-2">
                    <h6 class="text-muted"><?= Az::l('Лимит лидов')?></h6>
                    <?
                    if ($model->limit === null)
                        echo 'нет';
                    else
                        echo $model->limit
                    ?>
                </div>
            </div>
        </div>

        <div class="card-footer card-offer-footer">
            <p class="footer-text">
                <?
                if ($model->desc === null)
                    echo 'нет';
                else
                    echo $model->desc
                ?>

            </p>

        </div>

    </div>
    </div>

    <?php
}
?>
