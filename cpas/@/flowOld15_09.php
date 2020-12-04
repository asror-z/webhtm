<?php

use kartik\grid\DataColumn;
use zetsoft\models\cpas\CpasOffer;
use zetsoft\models\cpas\CpasStream;
use zetsoft\models\cpas\CpasStreamItem;
use zetsoft\system\assets\ZColor;
use zetsoft\system\Az;
use zetsoft\system\column\ZKDataColumn;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\helpers\ZUrl;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\navigat\ZButtonWidget;
use zetsoft\widgets\themes\ZCardWidget;

$model = CpasStream::findOne($id);


    ?>

    <div class="py-3">
        <?php


        /** @var ZView $this * */


        $viewUrl = ZUrl::to([
            '/cpas/client/viewFlow',
            'id' => $id,
        ]);

        $view = ZButtonWidget::widget([
            'config' => [
                'url' => $viewUrl,
                'btnStyle' => ZButtonWidget::btnStyle['btn-dark'],
                'icon' => 'fal fa-eye  fa-lg',
                'btn' => true,
                'class' => 'py-2 px-3',
                'btnRounded' => false,
            ]
        ]);

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
            '/cpas/client/updateFlow',
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
        $btn .= $view .$pen . $clone . $trash;
        $btn .= '</div>';


        //vdd($id);



        $title = $model->title;
        ZCardWidget::begin([
            'config' => [
                'title' => $title,
                'type' => ZCardWidget::type['dynCard'],
                'classHeadColor' => 'bg-white text-dark',
                'headerRight' => $btn,
                'hasFooter' => true,
                'footerColor' => ZColor::color['green-special'] . ' text-black',
            ]
        ]);

        $offer_id = $model->cpas_offer_id;
        $offer = CpasOffer::findOne($offer_id);
        $offerPhoto = $offer->photo;

        ?>

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

                $items = CpasStreamItem::find()->where(['cpas_stream_id' => $id])->all();
                //vd($items);
                ?>

                <table class="table table-hover text-center table-borderless">
                    <thead>
                        <th><?= Az::l('Название')?></th>
                        <th><?= Az::l('Трекинг ссылка')?></th>
                    </thead>
                    <tbody class="text-dark font-weight-bold">
                        <?php
                            foreach ($items as $item)
                            {
                                $url = $item->track;
                                $button =  ZButtonWidget::widget([
                                    'config' => [
                                        'url' => $url,
                                        'title' => Az::l('Трекинг ссылка'),
                                        'hasIcon' => true,
                                        'isPjax' => false,
                                        'pjax' => false,
                                        'icon' => 'fal fa-external-link',
                                        'btn' => false,
                                        'target' => ZButtonWidget::target['_blank'],
                                    ]
                                ]);
                        ?>
                        <tr>
                            <th class="text-dark"><?= $item->title?></th>
                            <td><?= $button?></td>
                        </tr>
                    <?php
                            }

                        ?>
                    </tbody>
                </table>
            </div>
        </div>



        <?


        ZCardWidget::end();
        ?>
    </div>


