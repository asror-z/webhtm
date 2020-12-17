<?php

use zetsoft\models\cpas\CpasOffer;
use zetsoft\models\cpas\CpasStream;
use zetsoft\models\cpas\CpasStreamItem;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\helpers\ZUrl;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\navigat\ZButtonWidget;

$model = CpasStream::findOne($id);

$items = CpasStreamItem::find()
    ->where([
        'cpas_stream_id' => $id
    ])
    ->limit(10)
    ->all();
if (empty($items))
    return null;

/** @var ZView $this * */


$viewUrl = ZUrl::to([
    '/cpas/client/viewFlow',
    'id' => $id,
]);

$urlupdate = ZUrl::to([
    '/cpas/client/updateFlow',
    'id' => $id,
]);

$cloneaction = ZUrl::to([
    '/cpas/client/action/c',
    'modelClassName' => $model->className,
    'id' => $id,
]);

$delaction = ZUrl::to([
    '/cpas/client/action/d',
    'modelClassName' => $model->className,
    'id' => $id,
]);

$title = $model->title;
$offer_id = $model->cpas_offer_id;
$offer = CpasOffer::findOne($offer_id);
$offerPhoto = $offer->photo;

?>

    <div class="card card-flow my-4">
        <div class="card-header card-flow-header">
            <div class="d-flex">
                <h5 class="card-flow-text ml-3"><?= $title?></h5>

                <div class="btn-group ml-auto" role="group">
                    <a href="<?= $viewUrl?>" class="card-flow-btn--link">
                        Просмотр
                    </a>
                    <a href="<?= $urlupdate?>" class="card-flow-btn--edit">
                        <i class="fal fa-pencil"></i>
                    </a>
                    <a href="<?= $cloneaction?>" class="card-flow-btn--copy">
                        <i class="fal fa-copy"></i>
                    </a>
                   <!-- <a href="<?/*= $delaction*/?>" class="card-flow-btn--trash">
                        <i class="fal fa-trash"></i>
                    </a>-->

                    <?
//                    echo ZButtonWidget::widget([
//                        'config' => [
//
//                            'btnStyle' => 'card-flow-btn--trash',
//                            'icon' => 'fal fa-trash',
//                            'btn' => false,
//                            'btnRounded' => false,
//                            'hasConfirm' => true,
//                        ],
//                        'event' => [
//                            'confirmEvent' => <<<JS
//                window.location.href = '$delaction';
//JS,
//
//                        ]
//                    ]);
                    ?>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-3 px-4 py-2 text-center">

                    <a href="<?= $viewUrl ?>">
                        <img class="rounded img-fluid" style="height: 120px;"
                             src="<?= '/uploaz/' . App . '/' . $offer->className . '/' . 'photo/' . $offer->id . '/' . ZArrayHelper::getValue($offerPhoto, 0)?>"
                             alt="img">
                    </a>

                </div>
                <div class="col-md-9">
                    <?


                    //vd($items);
                    ?>

                    <table class="table table-hover text-center table-borderless">
                        <thead>
                        <th><?= Az::l('Ид элемента')?></th>
                        <th><?= Az::l('Название')?></th>
                        </thead>
                        <tbody class="text-dark font-weight-bold">
                        <?php
                        foreach ($items as $item)
                        {
                            ?>
                            <tr>
                                <th class="text-dark"><?= $item->id?></th>
                                <td><?= $item->title?></td>
                            </tr>
                            <?php
                        }

                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


